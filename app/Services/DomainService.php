<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;

class DomainService
{
    private string $username;
    private string $token;
    private string $link;
    private string $credentials;

    private Client $client;

    /**
     * Create a new DomainService instance.
     */
    public function __construct()
    {
        $this->username = env('NAME_COM_USERNAME');
        $this->token = env('NAME_COM_API');
        $this->link = env('NAME_COM_API_URL');

        $this->credentials = base64_encode(
            $this->username . ':' . $this->token
        );

        $this->client = new Client([
            'base_uri' => rtrim($this->link, '/'),
            'timeout' => 30,
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Basic ' . $this->credentials,
            ],
        ]);
    }

    /**
     * @param string $domainName
     * @return array
     */
    public function dnsRecords(string $domainName)
    {
        $domainNaming = strtolower(trim($domainName));

        $response = $this->client->get(
            "/core/v1/domains/{$domainNaming}/records?perPage=500",
        );

            $data = json_decode((string) $response->getBody(), true);

        return $data;
    }


    /**
     * Check domain availability.
     *
     * @param string $domainName
     * @return array
     *
     * @throws \Exception
     */
    public function checkDomainAvailability(string $domainName): array
    {
        $domainName = strtolower(trim($domainName));

        $response = $this->client->post(
            '/core/v1/domains:checkAvailability',
            [
                'json' => [
                    'domainNames' => [$domainName],
                    'purchaseType' => 'registration',
                ],
            ]
        );

        $statusCode = $response->getStatusCode();

        $data = json_decode(
            (string) $response->getBody(),
            true
        );

        if (
            $statusCode < 200 ||
            $statusCode >= 300
        ) {
            throw new \Exception(
                'Грешка при свързването с услугата за проверка на домейни.'
            );
        }

        if (!is_array($data)) {
            throw new \Exception(
                'Получен е невалиден отговор от услугата за проверка на домейни.'
            );
        }

        if (
            isset($data['message']) &&
            $data['message'] === 'None of the submitted domains are valid'
        ) {
            throw new \Exception(
                'Моля, въведете валиден формат на домейна (.com, .net, .org и т.н.).'
            );
        }

        if (isset($data['message'])) {
            throw new \Exception(
                'Услугата за проверка на домейни върна грешка: ' . $data['message']
            );
        }

        if (
            empty($data['results']) ||
            !isset($data['results'][0])
        ) {
            throw new \Exception(
                'Отговорът от услугата не съдържа резултат за проверения домейн.'
            );
        }

        $domain = $data['results'][0];

        if (
            empty($domain['domainName']) ||
            strtolower($domain['domainName']) !== $domainName
        ) {
            throw new \Exception(
                "Върнатият домейн не съвпада с проверения домейн {$domainName}."
            );
        }

        if (
            !isset($domain['purchasable']) ||
            $domain['purchasable'] !== true
        ) {
            throw new \Exception(
                "Домейнът {$domainName} не е свободен за регистрация."
            );
        }

        return $domain;
    }


    /**
     * Register a domain.
     *
     * @param string $domainName
     * @param int $years
     * @return array
     *
     * @throws \Exception
     */
    public function registerDomain(string $domainName, int $years = 1): array
    {
        $response = $this->client->post(
            '/core/v1/domains',
            [
                'json' => [
                    'domain' => [
                        'domainName' => $domainName,
                    ],
                    'years' => $years,
                ],
            ]
        );

        $statusCode = $response->getStatusCode();

        $data = json_decode(
            (string) $response->getBody(),
            true
        );

        if (
            $statusCode < 200 ||
            $statusCode >= 300
        ) {
            throw new \Exception(
                "Възникна грешка при регистрацията на домейна {$domainName}."
            );
        }

        return [
            'status' => $statusCode,
            'response' => $data,
            'raw' => (string) $response->getBody(),
        ];
    }

    /**
     * Update domain settings.
     *
     * @param string $domainName
     * @param bool|null $autorenewEnabled
     * @param bool|null $privacyEnabled
     * @param bool|null $locked
     * @return array
     *
     * @throws \Exception
     */
    public function updateDomain(
        string $domainName,
        ?bool $autorenewEnabled = null,
        ?bool $privacyEnabled = null,
        ?bool $locked = null
    ): array {

        $data = array_filter([
            'autorenewEnabled' => $autorenewEnabled,
            'privacyEnabled' => $privacyEnabled,
            'locked' => $locked,
        ], fn($value) => $value !== null);

        if (empty($data)) {
            throw new \Exception(
                'Няма избрани настройки за промяна.'
            );
        }

        $response = $this->client->patch(
            "/core/v1/domains/{$domainName}",
            [
                'json' => $data,
            ]
        );

        $statusCode = $response->getStatusCode();

        $result = json_decode(
            (string) $response->getBody(),
            true
        );

        if (
            $statusCode < 200 ||
            $statusCode >= 300
        ) {
            throw new \Exception(
                "Възникна грешка при обновяването на домейна {$domainName}."
            );
        }

        return $result ?? [];
    }


    /**
     * Return all domain listings.
     *
     * @return array
     *
     * @throws \Exception
     */
    public function listDomains(): array
    {
        $response = $this->client->get(
            '/core/v1/domains',
            [
                'query' => [
                    'perPage' => 250,
                    'includeRenewalPrice' => 'true',
                ],
            ]
        );

        $statusCode = $response->getStatusCode();

        $data = json_decode((string) $response->getBody(), true);

        return $data;
    }


    /**
     * Check domain pricing for registration years.
     *
     * @param string $domainName
     * @param array|null $years
     * @return array
     *
     * @throws \Exception
     */
    public function checkDomainPrice(string $domainName, ?array $years = null): array
    {
        $years = $years ?? range(1, 10);

        $promises = [];

        foreach ($years as $year) {
            $promises[$year] = $this->client->getAsync(
                "/core/v1/domains/{$domainName}:getPricing",
                [
                    'query' => [
                        'years' => $year,
                    ],
                ]
            );
        }

        $responses = Utils::unwrap($promises);

        $prices = [];

        foreach ($responses as $year => $response) {
            $statusCode = $response->getStatusCode();

            $data = json_decode(
                (string) $response->getBody(),
                true
            );

            if (
                $statusCode < 200 ||
                $statusCode >= 300 ||
                !is_array($data) ||
                !array_key_exists('purchasePrice', $data)
            ) {
                throw new \Exception(
                    "Възникна грешка при зареждането на цената за {$domainName}."
                );
            }

            $prices[$year] = [
                'years' => (int) $year,
                'purchase_price' => $data['purchasePrice'],
                'renewal_price' => $data['renewalPrice'] ?? null,
                'transfer_price' => $data['transferPrice'] ?? null,
                'premium' => $data['premium'] ?? false,
            ];
        }

        return $prices;
    }


    /**
     * Get TLD pricing from Name.com.
     *
     * @param int $perPage
     * @param int $page
     * @param int $duration
     * @return array
     *
     * @throws \Exception
     */
    public function getTldPricing(int $perPage = 1000, int $page = 1, int $duration = 1): array
    {
        $tlds = [
            'eu',
            'net',
        ];

        $response = $this->client->get(
            '/core/v1/tldpricing',
            [
                'query' => [
                    'perPage' => $perPage,
                    'page' => $page,
                    'duration' => $duration,
                    'tlds' => $tlds,
                ],
            ]
        );


        $data = json_decode((string) $response->getBody(), true);


        return $data;
    }
}

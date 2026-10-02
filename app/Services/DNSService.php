<?php

namespace App\Services;

use GuzzleHttp\Client;

class DNSService
{
    private ?Client $client = null;

    /**
     * Get the Name.com API client.
     *
     * @return Client
     */
    private function client(): Client
    {
        $username = env('NAME_COM_USERNAME');
        $token = env('NAME_COM_API');
        $link = env('NAME_COM_API_URL');

        $credentials = base64_encode($username . ':' . $token);

        $this->client = new Client([
            'base_uri' => rtrim($link, '/'),
            'timeout' => 30,
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Basic ' . $credentials,
            ],
        ]);

        return $this->client;
    }

    /**
     * Retrieve the dns records of a domain
     *
     * @param string $domainName
     * @return array
     */
    public function dnsRecords(string $domainName)
    {
        $domainNaming = strtolower(trim($domainName));

        $response = $this->client()->get(
            "/core/v1/domains/{$domainNaming}/records?perPage=500",
        );

        $data = json_decode((string) $response->getBody(), true);

        return $data;
    }

    /**
     * Create a new DNS record for a domain.
     *
     * @param string $domainName
     * @param array $record
     * @return array
     */
    public function createDNSrecord(string $domainName, array $record): array
    {
        $domainNaming = strtolower(trim($domainName));

        $response = $this->client()->post(
            "/core/v1/domains/{$domainNaming}/records",
            [
                'json' => $record,
            ]
        );

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Update an existing DNS record for a domain.
     *
     * @param string $domainName
     * @param int $recordId
     * @param array $record
     * @return array
     */
    public function updateDNSrecord(string $domainName, int $recordId, array $record): array
    {
        $domainNaming = strtolower(trim($domainName));

        $response = $this->client()->put(
            "/core/v1/domains/{$domainNaming}/records/{$recordId}",
            [
                'json' => $record,
            ]
        );

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Delete an existing DNS record.
     *
     * @param string $domainName
     * @param int $recordId
     * @return array
     */
    public function deleteDNSrecord(string $domainName, int $recordId): array
    {
        $domainNaming = strtolower(trim($domainName));

        $response = $this->client()->delete(
            "/core/v1/domains/{$domainNaming}/records/{$recordId}"
        );

        if ($response->getStatusCode() === 204) {
            return ['success' => true];
        }

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Configure the necessary DNS records when a domain is bought.
     *
     * @param string $domainName
     * @return array
     */
    public function assignNecessaryDNSRecords(string $domainName): array
    {
        $domainNaming = strtolower(trim($domainName));

        $records = [
            [
                'type' => 'A',
                'host' => '@',
                'answer' => env('VPS_HOST'),
                'ttl' => 3600,
            ],
            [
                'type' => 'CNAME',
                'host' => 'www',
                'answer' => $domainNaming,
                'ttl' => 3600,
            ],
        ];

        $responses = [];

        foreach ($records as $record) {
            $response = $this->client()->post(
                "/core/v1/domains/{$domainNaming}/records",
                [
                    'json' => $record,
                ]
            );

            $responses[] = [
                'status' => $response->getStatusCode(),
                'response' => json_decode((string) $response->getBody(), true),
            ];
        }

        return $responses;
    }
}

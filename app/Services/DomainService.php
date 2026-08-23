<?php

namespace App\Services;

class DomainService
{
    private string $username;
    private string $token;
    private string $link;

    /**
     * Create a new DomainService instance.
     */
    public function __construct()
    {
        $this->username = env('NAME_COM_USERNAME');
        $this->token = env('NAME_COM_API');
        $this->link = env('NAME_COM_API_URL');
    }

    /**
     * Check domain availability.
     *
     * @param string $domainName
     * @return array
     */
    public function checkDomainAvailability(string $domainName): array
    {
        $credentials = base64_encode($this->username . ':' . $this->token);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "{$this->link}/core/v1/domains:checkAvailability",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',

            CURLOPT_POSTFIELDS => json_encode([
                'domainNames' => [$domainName],
                'purchaseType' => 'registration',
            ]),

            CURLOPT_HTTPHEADER => [
                'Authorization: Basic ' . $credentials,
                'Content-Type: application/json',
            ],
        ]);

        $rawResponse = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        if ($rawResponse === false || $error) {
            return [
                'errorMsg'   => $error,
                'success' => false,
                'message' => 'Възникна грешка при проверката на домейна.',
            ];
        }

        $response = json_decode($rawResponse, true);

        if (!is_array($response)) {
            return [
                'success' => false,
                'message' => 'Възникна грешка при проверката на домейна.',
            ];
        }

        if (
            isset($response['message']) &&
            $response['message'] === 'None of the submitted domains are valid'
        ) {
            return [
                'success' => false,
                'message' => 'Моля, въведете валиден формат на домейна (.com, .net, .org и т.н.).',
            ];
        }


        if (isset($response['message'])) {
            return [
                'success' => false,
                'message' => 'Възникна грешка при проверката на домейна.',
            ];
        }

        if (isset($response['results'])) {
            return [
                'success' => true,
                'results' => $response['results'],
            ];
        }

        return [
            'success' => false,
            'message' => 'Възникна грешка при проверката на домейна.',
        ];
    }

    /**
     * Get TLD pricing from Name.com.
     *
     * @param int $perPage
     * @param int $page
     * @param int $duration
     * @return array
     */
    public function getTldPricing(
        int $perPage = 1000,
        int $page = 1,
        int $duration = 1
    ): array {
        $credentials = base64_encode(
            $this->username . ':' . $this->token
        );

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "{$this->link}/core/v1/tldpricing?perPage={$perPage}&page={$page}&duration={$duration}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Authorization: Basic ' . $credentials,
            ],
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        if ($error) {
            throw new \Exception(
                'Name.com API error: ' . $error
            );
        }

        return json_decode($response, true);
    }
}

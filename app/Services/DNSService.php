<?php

namespace App\Services;

use GuzzleHttp\Client;

class DNSService
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

        $this->credentials = base64_encode($this->username . ':' . $this->token);

        $this->client = new Client([
            'base_uri' => rtrim($this->link, '/'),
            'timeout' => 30,
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Basic ' . $this->credentials,
            ],
        ]);
    }



    /** Retrieve the dns records of a domain
     *
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
     * Create a new DNS record for a domain.
     *
     * @param string $domainName
     * @param array $record
     * @return array
     */
    public function createDNSrecord(string $domainName, array $record): array
    {
        $domainNaming = strtolower(trim($domainName));

        $response = $this->client->post(
            "/core/v1/domains/{$domainNaming}/records",
            [
                'json' => $record,
            ]
        );

        return json_decode((string) $response->getBody(), true);
    }
}

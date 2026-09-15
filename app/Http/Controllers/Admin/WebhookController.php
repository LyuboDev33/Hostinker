<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class WebhookController extends Controller
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

    public function subscribeToDomain() {}

    public function retrieveAllWebhookSubscriptions()
    {
        $response = $this->client->get('/core/v1/notifications');

        $data = json_decode($response->getBody()->getContents(), true);

        return response()->json($data, $response->getStatusCode());
    }


    public function subscribeDomainExpiry()
    {
        $response = $this->client->post('/core/v1/notifications', [
            'json' => [
                'eventName' => 'domain.expiration',
                'url' => env('APP_URL'). '/mytestlink',
                'active' => true,
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        return response()->json($data, $response->getStatusCode());
    }
}

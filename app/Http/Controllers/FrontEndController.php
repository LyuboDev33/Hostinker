<?php

namespace App\Http\Controllers;


class FrontEndController extends Controller
{
    /** Show the welcome route */
    public function welcome()
    {
        return view('Frontend.welcome');
    }


    /** Show the welcome route */
    public function about()
    {
        return view('Frontend.about');
    }


    /** Show the welcome route */
    public function contact()
    {
        return view('Frontend.contact');
    }

    /** Show the pricing route */
    public function pricing()
    {
        return view('Frontend.pricing');
    }

    /**
     * Check domain availability.
     */
    public function domain()
    {
        $username = env('NAME_COM_USERNAME');
        $token = env('NAME_COM_API');

        $credentials = base64_encode($username . ':' . $token);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.dev.name.com/core/v1/domains:checkAvailability',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                'domainNames' => ['softex.pro'],
                'purchaseType' => 'registration',
            ]),
            CURLOPT_HTTPHEADER => [
                'Authorization: Basic ' . $credentials,
                'Content-Type: application/json',
            ],
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            dd($error);
        }

        dd(json_decode($response, true));

        return view('Frontend.domain.domain-name-serach');
    }
}

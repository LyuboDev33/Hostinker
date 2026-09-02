<?php

namespace App\Services;

use Stripe\StripeClient;

class StripeService
{

    private StripeClient $stripeDomainAccount;
    private StripeClient $stripeHostingAccount;

    public function __construct()
    {
        $this->stripeDomainAccount = new \Stripe\StripeClient(env('STRIPE_SECRET_DOMAIN_ACCOUNT'));
        $this->stripeHostingAccount = new \Stripe\StripeClient(env('STRIPE_SECRET_HOSTING_ACCOUNT'));
    }




}

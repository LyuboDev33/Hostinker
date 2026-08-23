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

}

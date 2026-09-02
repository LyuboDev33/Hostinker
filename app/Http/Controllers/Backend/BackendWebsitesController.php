<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackendWebsitesController extends Controller
{
       /** Return all the domains */
    public function index () {
        $websites = Domain::where('user_id', Auth::id())->get();

        return view('Backend.websites.Index', [
            'websites' => $websites
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Admin\HostingPlan;
use Illuminate\Http\Request;

class HostingController extends Controller
{
    /** Hosting plans index */
    public function index () {
        return view('Frontend.hosting.Index', [
            'hostingPlans' => HostingPlan::get()
        ]);
    }

    

}

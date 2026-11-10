<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\VPS;
use Illuminate\Http\Request;

class VPSAdminController extends Controller
{
    /**
     * Show all VPS servers.
     */
    public function index()
    {
        $vpsServers = VPS::query()
            ->withCount('hostingAccounts')
            ->withSum([
                'hostingAccounts as allocated_gb' => function ($query) {
                    $query->whereNull('resources_deleted_at');
                },
            ], 'storage_gb')
            ->latest()
            ->paginate(10);

        return view('admin.VPS.Index', compact('vpsServers'));
    }

    /**
     * Store a new VPS server.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'host' => ['required', 'string', 'max:255'],
            'port' => ['required', 'integer', 'between:1,65535'],
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
            'capacity_gb' => ['required', 'integer', 'min:1'],
        ]);

        VPS::create($validated);

        return back()->with('success', 'VPS сървърът беше добавен успешно.');
    }
}

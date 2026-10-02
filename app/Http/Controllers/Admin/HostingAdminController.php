<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\HostingPlan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HostingAdminController extends Controller
{
    /** Show all plans */
    public function index()
    {
        return view('admin.Hosting.Index', [
            'hostingPlans' => HostingPlan::get()
        ]);
    }

    /**
     * Store a new hosting plan.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'storage_gb' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'numeric', 'min:0'],
            'renewal_price' => ['required', 'numeric', 'min:0'],
            'stripe_price' => ['required', 'string', 'max:255'],
            'stripe_price_renewal' => ['required', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        HostingPlan::create([
            'name' => $validated['name'],
            'storage_gb' => $validated['storage_gb'],
            'price' => $validated['price'],
            'renewal_price' => $validated['renewal_price'],
            'stripe_price' => $validated['stripe_price'],
            'stripe_price_renewal' => $validated['stripe_price_renewal'],
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('super_admin.hosting.index')
            ->with('success', 'Хостинг планът беше създаден успешно.');
    }
}

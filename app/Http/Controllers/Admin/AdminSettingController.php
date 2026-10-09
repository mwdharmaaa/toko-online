<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdminSettingController extends Controller
{
    public function edit(): View
    {
        $setting = SiteSetting::current();
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(UpdateSettingRequest $request): RedirectResponse
    {
        $setting = SiteSetting::current();
        $setting->update($request->validated());

        return redirect()->route('admin.settings.edit')
            ->with('success', 'Pengaturan toko dan nomor WhatsApp berhasil disimpan.');
    }
}

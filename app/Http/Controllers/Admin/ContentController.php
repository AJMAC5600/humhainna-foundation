<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function edit(): View
    {
        return view('pages.admin.content', ['settings' => Setting::allCached()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $keys = [
            'org_name', 'org_short_name', 'org_tagline', 'reg_number',
            'mission', 'vision', 'story', 'core_values',
            'address', 'phone', 'helpline', 'email', 'office_hours', 'map_link',
            'upi_id', 'bank_account_name', 'bank_account_number', 'bank_ifsc', 'bank_name_branch',
            'tax_note_80g', 'fund_utilization_note',
            'social_facebook', 'social_instagram', 'social_twitter', 'social_youtube', 'social_linkedin', 'whatsapp_number',
            'signatory_name', 'signatory_designation',
            'hero_title', 'hero_subtitle', 'footer_note',
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                Setting::set($key, trim((string) $request->input($key)) ?: null);
            }
        }

        // hero banner uploads (optional) - stored in public disk
        if ($request->hasFile('hero_banner')) {
            $request->validate(['hero_banner' => ['image','max:5120']]);
            $path = $request->file('hero_banner')->store('hero', 'public');
            Setting::set('hero_banner', $path);
        }
        if ($request->hasFile('hero_banner_mobile')) {
            $request->validate(['hero_banner_mobile' => ['image','max:5120']]);
            $path = $request->file('hero_banner_mobile')->store('hero', 'public');
            Setting::set('hero_banner_mobile', $path);
        }

        return back()->with('success', 'Site content saved.');
    }
}

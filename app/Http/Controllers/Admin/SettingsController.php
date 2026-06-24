<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function adsense()
    {
        $settings = [
            'adsense_client_id' => SiteSetting::get('adsense_client_id', ''),
            'adsense_header_slot' => SiteSetting::get('adsense_header_slot', ''),
            'adsense_sidebar_slot' => SiteSetting::get('adsense_sidebar_slot', ''),
            'adsense_content_slot' => SiteSetting::get('adsense_content_slot', ''),
            'adsense_footer_slot' => SiteSetting::get('adsense_footer_slot', ''),
        ];

        return view('admin.settings.adsense', compact('settings'));
    }

    public function updateAdsense(Request $request)
    {
        $request->validate([
            'adsense_client_id' => 'nullable|string|max:50',
            'adsense_header_slot' => 'nullable|string|max:20',
            'adsense_sidebar_slot' => 'nullable|string|max:20',
            'adsense_content_slot' => 'nullable|string|max:20',
            'adsense_footer_slot' => 'nullable|string|max:20',
        ]);

        SiteSetting::set('adsense_client_id', $request->adsense_client_id);
        SiteSetting::set('adsense_header_slot', $request->adsense_header_slot);
        SiteSetting::set('adsense_sidebar_slot', $request->adsense_sidebar_slot);
        SiteSetting::set('adsense_content_slot', $request->adsense_content_slot);
        SiteSetting::set('adsense_footer_slot', $request->adsense_footer_slot);

        return redirect()->back()->with('success', 'AdSense settings updated successfully!');
    }
}

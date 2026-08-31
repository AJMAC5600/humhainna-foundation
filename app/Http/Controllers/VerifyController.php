<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Volunteer;
use Illuminate\Contracts\View\View;

class VerifyController extends Controller
{
    public function form(): View
    {
        return view('pages.verify', ['code' => null]);
    }

    public function verify(string $code): View
    {
        $code = trim($code);

        // Volunteer ID card, e.g. HHNF-2026-00123
        if (preg_match('/^HHNF-\d{4}-\d{5}$/i', $code)) {
            $volunteer = Volunteer::whereRaw('LOWER(volunteer_id) = ?', [strtolower($code)])->first();

            return view('pages.verify', [
                'code' => $code,
                'type' => 'volunteer',
                'volunteer' => $volunteer,
            ]);
        }

        // Certificate number, e.g. HHNF-CERT-2026-00001 (or a receipt number)
        $certificate = Certificate::where('certificate_number', $code)->first();

        return view('pages.verify', [
            'code' => $code,
            'type' => 'certificate',
            'certificate' => $certificate,
        ]);
    }
}

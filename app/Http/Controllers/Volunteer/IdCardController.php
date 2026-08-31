<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as Http;

class IdCardController extends Controller
{
    public function show(): View
    {
        return view('pages.dashboard.idcard', [
            'volunteer' => auth()->user()->volunteer,
            'qr' => $this->qrFor(auth()->user()->volunteer),
        ]);
    }

    public function download(): Response
    {
        $volunteer = auth()->user()->volunteer;
        abort_unless($volunteer && $volunteer->status === 'approved', 403, 'Your application has not been approved yet.');

        $pdf = Pdf::loadView('pdf.idcard', [
            'volunteer' => $volunteer,
            'settings' => \App\Models\Setting::allCached(),
            'qr' => $this->qrFor($volunteer),
        ])->setPaper([0, 0, 460, 640]);

        return $pdf->download("id-card-{$volunteer->volunteer_id}.pdf");
    }

    public function certificatePdf(Certificate $certificate): Response
    {
        abort_unless($certificate->volunteer_id === auth()->user()?->volunteer?->id, 403);

        $verifyUrl = route('verify.code', ['code' => $certificate->certificate_number]);
        $qr = app(\App\Services\QrService::class)->pngDataUri($verifyUrl);

        $pdf = Pdf::loadView('pdf.certificate', [
            'certificate' => $certificate,
            'settings' => \App\Models\Setting::allCached(),
            'qr' => $qr,
        ])->setPaper('a4', 'landscape');

        return $pdf->download("certificate-{$certificate->certificate_number}.pdf");
    }

    private function qrFor(?\App\Models\Volunteer $volunteer): string
    {
        if (! $volunteer || ! $volunteer->volunteer_id) {
            return '';
        }

        return app(\App\Services\QrService::class)->pngDataUri(route('verify.code', ['code' => $volunteer->volunteer_id]));
    }
}

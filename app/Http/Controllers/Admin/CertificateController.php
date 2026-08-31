<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Event;
use App\Models\Volunteer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function index(): View
    {
        return view('pages.admin.certificates.index', [
            'certificates' => Certificate::with('volunteer')->latest()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('pages.admin.certificates.form', [
            'certificate' => new Certificate,
            'volunteers' => Volunteer::where('status', 'approved')->orderBy('full_name')->get(),
            'events' => Event::orderByDesc('starts_at')->take(50)->get(),
            'types' => Certificate::TYPES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'type' => ['required', 'in:'.implode(',', array_keys(Certificate::TYPES))],
            'volunteer_id' => ['nullable', 'exists:volunteers,id'],
            'recipient_name' => ['required_without:volunteer_id', 'nullable', 'string', 'max:255'],
            'recipient_email' => ['nullable', 'email'],
            'reason' => ['nullable', 'string', 'max:500'],
            'duration' => ['nullable', 'string', 'max:100'],
            'issued_on' => ['required', 'date'],
            'signatory_name' => ['nullable', 'string', 'max:120'],
            'signatory_designation' => ['nullable', 'string', 'max:120'],
        ]);

        if (empty($data['recipient_name']) && ! empty($data['volunteer_id'])) {
            $data['recipient_name'] = Volunteer::find($data['volunteer_id'])->full_name;
            $data['recipient_email'] ??= Volunteer::find($data['volunteer_id'])->email;
        }

        $certificate = Certificate::create([...$data, 'certificate_number' => Certificate::nextNumber()]);

        return redirect()
            ->route('admin.certificates.pdf', $certificate)
            ->with('success', "Certificate {$certificate->certificate_number} generated.");
    }

    public function pdf(Certificate $certificate)
    {
        $verifyUrl = route('verify.code', ['code' => $certificate->certificate_number]);
        $qr = app(\App\Services\QrService::class)->pngDataUri($verifyUrl);
        $settings = \App\Models\Setting::allCached();
        Storage::makeDirectory('certificates');

        return Pdf::loadView('pdf.certificate', compact('certificate', 'qr', 'settings'))
            ->setPaper('a4', 'landscape')
            ->download("{$certificate->certificate_number}.pdf");
    }
}

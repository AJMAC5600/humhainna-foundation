<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonateController extends Controller
{
    public function show(): View
    {
        return view('pages.donate');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'donor_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'mobile' => ['required', 'string', 'max:20'],
            'pan' => ['nullable', 'string', 'regex:/^[A-Z]{5}[0-9]{4}[A-Z]$/', 'max:10'],
            'amount' => ['required', 'numeric', 'min:10', 'max:10000000'],
            'frequency' => ['required', 'in:one_time,monthly'],
            'cause' => ['nullable', 'string', 'max:60'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        $upiId = \App\Models\Setting::get('upi_id', config('hhnf.upi_id'));

        $donation = Donation::create([
            ...$data,
            'receipt_number' => null,
            'method' => $upiId ? 'upi' : 'bank',
            'status' => 'pending',
        ]);

        // Build a UPI deep-link intent so the donor can pay straight away.
        $intent = $upiId
            ? sprintf('upi://pay?pa=%s&pn=%s&am=%.2f&cu=INR&tn=%s',
                urlencode($upiId),
                urlencode(\App\Models\Setting::get('org_short_name', config('hhnf.org_short_name'))),
                (float) $data['amount'],
                urlencode('Donation '.now()->format('YmdHis'))
            )
            : null;

        session(['pending_donation_'.$donation->id.'_intent' => $intent]);

        if ($request->boolean('pay_now') && $intent) {
            return redirect()->away($intent);
        }

        return back()->with('donation_success', true)->with('donation', $donation);
    }

    public function receipt(Donation $donation)
    {
        abort_if($donation->status !== 'completed', 404);

        $qr = app(\App\Services\QrService::class)->pngDataUri(url('/verify/'.$donation->receipt_number));

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.receipt', [
            'donation' => $donation,
            'settings' => \App\Models\Setting::allCached(),
            'qr' => $qr,
        ]);

        Storage::makeDirectory('receipts');

        return $pdf->download("receipt-{$donation->receipt_number}.pdf");
    }
}

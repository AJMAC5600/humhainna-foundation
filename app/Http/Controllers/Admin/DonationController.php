<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DonationController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->string('status', '');

        return view('pages.admin.donations.index', [
            'donations' => Donation::query()
                ->when($status, fn ($q) => $q->where('status', $status))
                ->latest()
                ->paginate(25)
                ->withQueryString(),
            'status' => (string) $status,
            'totalCompleted' => Donation::where('status', 'completed')->sum('amount'),
            'totalPending' => Donation::where('status', 'pending')->sum('amount'),
        ]);
    }

    public function update(Request $request, Donation $donation): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,completed,failed'],
            'gateway_ref' => ['nullable', 'string', 'max:120'],
        ]);

        if ($data['status'] === 'completed' && ! $donation->receipt_number) {
            $donation->receipt_number = Donation::nextReceiptNumber();
            $donation->paid_at = now();
        }

        $donation->fill($data);
        $donation->save();

        return back()->with('success', $donation->status === 'completed'
            ? "Payment confirmed. Receipt {$donation->receipt_number} generated."
            : "Donation marked as {$donation->status}.");
    }

    public function export(): Response
    {
        $rows = Donation::latest()->get()->map(fn ($d) => [
            $d->id,
            $d->receipt_number,
            $d->donor_name,
            $d->email,
            $d->mobile,
            $d->pan,
            number_format((float) $d->amount, 2),
            $d->frequency,
            $d->cause,
            $d->method,
            $d->status,
            optional($d->paid_at)->toDateTimeString() ?? '',
            $d->created_at->toDateTimeString(),
        ]);

        $header = ['ID', 'Receipt No', 'Name', 'Email', 'Mobile', 'PAN', 'Amount', 'Frequency', 'Cause', 'Method', 'Status', 'Paid At', 'Created At'];
        $csv = fopen('php://temp', 'r+');
        fputcsv($csv, $header);
        foreach ($rows as $row) {
            fputcsv($csv, $row instanceof \Illuminate\Support\Collection ? $row->all() : (array) $row);
        }
        rewind($csv);

        return response(stream_get_contents($csv), 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="donations-'.now()->format('Ymd-His').'.csv"',
        ]);
    }

    public function receiptPdf(Donation $donation)
    {
        abort_unless($donation->status === 'completed', 404);

        $qr = app(\App\Services\QrService::class)->pngDataUri(route('verify.code', ['code' => $donation->receipt_number]));

        return Pdf::loadView('pdf.receipt', [
            'donation' => $donation,
            'settings' => \App\Models\Setting::allCached(),
            'qr' => $qr,
        ])->download("receipt-{$donation->receipt_number}.pdf");
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Volunteer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->string('status', '');

        return view('pages.admin.volunteers.index', [
            'volunteers' => Volunteer::query()
                ->when($status, fn ($q) => $q->where('status', $status))
                ->latest()
                ->paginate(20)
                ->withQueryString(),
            'status' => (string) $status,
        ]);
    }

    public function show(Volunteer $volunteer): View
    {
        return view('pages.admin.volunteers.show', [
            'volunteer' => $volunteer->load(['tasks', 'certificates']),
            'generatedPassword' => session('volunteer_password'),
        ]);
    }

    public function decide(Request $request, Volunteer $volunteer): RedirectResponse
    {
        $data = $request->validate([
            'decision' => ['required', 'in:approve,reject'],
            'rejection_note' => ['nullable', 'string', 'max:500', 'required_if:decision,reject'],
        ]);

        if ($data['decision'] === 'reject') {
            $volunteer->update([
                'status' => 'rejected',
                'rejection_note' => $data['rejection_note'],
            ]);

            return back()->with('success', "{$volunteer->full_name}'s application was rejected.");
        }

        if (! $volunteer->user_id) {
            $password = \Illuminate\Support\Str::password(12, symbols: false);

            $user = User::firstOrCreate(
                ['email' => $volunteer->email],
                ['name' => $volunteer->full_name, 'role' => 'volunteer', 'phone' => $volunteer->mobile, 'password' => $password]
            );

            $volunteer->user_id = $user->id;

            if ($user->wasRecentlyCreated) {
                session()->flash('volunteer_password', $password);
                session()->flash('volunteer_email', $user->email);
            }
        }

        if (! $volunteer->volunteer_id) {
            $volunteer->volunteer_id = Volunteer::nextVolunteerId();
            $volunteer->valid_from = now();
            $volunteer->valid_till = now()->addYear();
        }

        $volunteer->status = 'approved';
        $volunteer->save();

        return back()->with('success',
            "Approved! {$volunteer->full_name} is now {$volunteer->volunteer_id}. ID card can be downloaded from their profile or the dashboard.")
            ->with('volunteer_password', session('volunteer_password'));
    }

    public function viewIdProof(Volunteer $volunteer)
    {
        abort_if(! $volunteer->id_proof_path || ! \Illuminate\Support\Facades\Storage::exists($volunteer->id_proof_path), 404);

        return \Illuminate\Support\Facades\Storage::response($volunteer->id_proof_path);
    }

    public function idCardPdf(Volunteer $volunteer)
    {
        abort_unless($volunteer->status === 'approved', 403);

        $verifyUrl = route('verify.code', ['code' => $volunteer->volunteer_id]);
        $qr = app(\App\Services\QrService::class)->pngDataUri($verifyUrl);

        return Pdf::loadView('pdf.idcard', [
            'volunteer' => $volunteer,
            'settings' => \App\Models\Setting::allCached(),
            'qr' => $qr,
        ])->setPaper([0, 0, 460, 640])->download("id-card-{$volunteer->volunteer_id}.pdf");
    }
}

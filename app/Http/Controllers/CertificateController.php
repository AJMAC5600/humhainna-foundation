<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Contracts\View\View;

class CertificateController extends Controller
{
    public function info(): View
    {
        return view('pages.certificates');
    }
}

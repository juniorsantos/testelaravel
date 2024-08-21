<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class ForgotController extends Controller
{
    public function __invoke()
    {
        return view('forgot');
    }
}

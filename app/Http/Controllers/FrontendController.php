<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FrontendController extends Controller
{
    public function about() {
        

        return view('about');
    }
}

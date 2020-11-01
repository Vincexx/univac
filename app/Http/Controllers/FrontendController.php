<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Campus;

class FrontendController extends Controller
{
    public function index() {
        return view('welcome')->with('campuses', Campus::all());
    }

    public function about() {
        return view('about');
    }
}

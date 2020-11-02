<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Campus;

class FrontendController extends Controller
{
    public function showAllCampuses() {
        return view('welcome')->with('campuses', Campus::all());
    }

    public function about() {
        return view('about');
    }

    public function showCampusPrograms(Campus $campus) {

        return view('program')->with('campusPrograms', $campus->programs)->with('campus', $campus);
    }
}

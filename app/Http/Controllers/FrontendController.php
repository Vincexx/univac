<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Campus;
use App\Program;
use App\OtherDocument;

class FrontendController extends Controller
{
    public function showAllCampuses() {
        return view('welcome')->with('campuses', Campus::orderBy('name')->get())->with('documents', OtherDocument::all());
    }

    public function about() {
        return view('about');
    }

    public function showCampusPrograms(Campus $campus) {

        return view('program')->with('campusPrograms', $campus->programs)->with('campus', $campus);
    }

    public function orderByNamePrograms() {

        return response()->json(Program::orderBy('name')->get(), 200);

    }
}

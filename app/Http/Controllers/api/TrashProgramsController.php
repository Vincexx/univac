<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Program;

class TrashProgramsController extends Controller
{
    public function index()
    {
        return Program::onlyTrashed()->get();
    }

    public function restore($id)
    {
        $trashProgram = Program::onlyTrashed()->find($id);

        if($trashProgram) {
            $trashProgram->restore();
            return response()->json([
                'message' => 'Selected program already restored'
            ]);
        } else {
            return response()->json([
                'message' => '404 not Found'
            ]);
        }
    }
    
    public function destroy($id)
    {
        $trashProgram = Program::onlyTrashed()->find($id);

        if($trashProgram) {
            $trashProgram->forceDelete();
            return response()->json([
                'message' => 'Selected program already deleted.'
            ]);
        } else {
            return response()->json([
                'message' => '404 not Found'
            ]);
        }
    }
}

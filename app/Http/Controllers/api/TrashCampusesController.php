<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Campus;

class TrashCampusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Campus::onlyTrashed()->get();
    }

    public function restore($id)
    {
        $trashCampus = Campus::onlyTrashed()->find($id);

        if($trashCampus) {
            $trashCampus->restore();
            return response()->json([
                'message' => 'Selected campus already restored'
            ]);
        } else {
            return response()->json([
                'message' => '404 not Found'
            ]);
        }
    }

    public function destroy($id)
    {
        $trashCampus = Campus::onlyTrashed()->find($id);

        if($trashCampus) {
            $trashCampus->forceDelete();
            return response()->json([
                'message' => 'Selected campus already deleted'
            ]);
        } else {
            return response()->json([
                'message' => '404 not Found'
            ]);
        }
    }

    
}

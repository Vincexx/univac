<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class TrashUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::onlyTrashed()->get();
    }

    public function restore($id)
    {
        $trashUser = User::onlyTrashed()->find($id);

        if($trashUser) {
            $trashUser->restore();
            return response()->json([
                'message' => $trashUser->name.' account already restored.'
            ]);
        } else {
            return response()->json([
                'message' => '404 not Found'
            ]);
        }
    }

    public function destroy($id)
    {
        $trashUser = User::onlyTrashed()->find($id);

        if($trashUser) {
            $trashUser->forceDelete();
            return response()->json([
                'message' =>  $trashUser->name.' account already deleted'
            ]);
        } else {
            return response()->json([
                'message' => '404 not Found'
            ]);
        }
    }
}

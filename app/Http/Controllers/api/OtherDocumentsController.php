<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OtherDocument;
use Illuminate\Support\Facades\Storage;

class OtherDocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(OtherDocument::orderBy('id', 'desc')->get(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'file' => ''
        ]);

        if($request->hasFile('file')) {
            $file = $request->file->store('other_documents');
        } else {
            $file = '';
        }

        $document = OtherDocument::create([
            'name' => $request->name,
            'file' => $file
        ]);

        return response()->json([
            'message' => $document->name . " created successfully.",
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(OtherDocument $otherDocument)
    {
        return response()->json($otherDocument);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(OtherDocument $otherDocument)
    {
        return response()->json($otherDocument);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OtherDocument $otherDocument)
    {
        if($request->hasFile('file')) {
            Storage::disk()->delete($otherDocument->file);
            $file = $request->file->store('other_documents');
            $otherDocument->file = $file;
            $otherDocument->save();
        }

        $otherDocument->update([
            'name' => $request->name
        ]);

        return response()->json([
            'message' => $otherDocument->name . " updated successfully.",
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OtherDocument $otherDocument)
    {
        if($otherDocument->file) {
            Storage::disk()->delete($otherDocument->file);
        }
        
        $otherDocument->delete();
        return response()->json([
            'message' => $otherDocument->name . " deleted successfully."
        ]);
    }
}

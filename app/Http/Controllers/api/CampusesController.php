<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Campus;
use Illuminate\Support\Facades\Storage;

class CampusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Campus::all(), 200);
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
            'name' => 'required|unique:campuses',
            'description' => 'required',
            'image' => 'image',
        ]);

        $image = $request->image->store('campuses_images');

        $campus = Campus::create([      
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image,
        ]);

        return response()->json([
            'message' => 'Campus Created Successfully.',
            'campus' => $campus
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Campus $campus)
    {
        return response()->json($campus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Campus $campus)
    {
        return response()->json($campus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campus $campus)
    {
        if($request->hasFile('image')) {
            Storage::disk()->delete($campus->image);
            $image = $request->image->store('campuses_images');
            $campus->image = $image;
            $campus->save();
        }

        $campus->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
       
        return response()->json($campus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campus $campus)
    {
        $campus->delete();

        return response()->json([
            'message' => 'Campus has already removed.'
        ]);
    }
}

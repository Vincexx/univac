<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Campus;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CampusesController extends Controller
{
    public function __construct()
    {
        $this->middleware('delete_campus')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campuses = Campus::with('programs')->orderBy('name')->get();
        return response()->json($campuses);
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
            'description' => '',
            'image' => 'image|max:5000',
            'certificate' => ''
        ]);

        if($request->hasFile('image')) {
            $image = $request->image->store('campuses_images');
            $img = Image::make(public_path('storage/' . $image))->fit(1200, 687);
            $img->save();
        }

        $campus = Campus::create([      
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image,
            'certificate' => $request->certificate,
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

    public function showCampusPrograms(Campus $campus)
    {
        return response()->json($campus->programs);
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
            $img = Image::make(public_path('storage/' . $image))->fit(1200, 687);
            $img->save();
            $campus->image = $image;
            $campus->save();
        }

        $campus->update([
            'name' => $request->name,
            'description' => $request->description,
            'certificate' => $request->certificate,
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

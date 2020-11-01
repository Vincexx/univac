<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProgramsPerCampus;

class ProgramsPerCampusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(ProgramsPerCampus::all());
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
        $data = $this->validate($request, [
            'campus_id' => 'required',
            'name' => 'required',
            'level' => 'required',
            'validity' => 'required',
            'link' => 'required',
        ]);

        
        $programsPerCampus = ProgramsPerCampus::create([
            'campus_id' => $data['campus_id'],
            'name' => $data['name'],
            'level' => $data['level'],
            'validity' => $data['validity'],
            'link' => $data['link'],
        ]);

        return response()->json($programsPerCampus);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProgramsPerCampus $programsPerCampus)
    {
        return response()->json($programsPerCampus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgramsPerCampus $programsPerCampus)
    {

        $data = $this->validate($request, [
            'campus_id' => 'required',
            'name' => 'required',
            'level' => 'required',
            'validity' => 'required',
            'link' => 'required',
        ]);

        $programsPerCampus->update([
            'campus_id' => $data['campus_id'],
            'name' => $data['name'],
            'level' => $data['level'],
            'validity' => $data['validity'],
            'link' => $data['link'],
        ]);
        
        return response()->json([
            'message' => 'Updated'
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgramsPerCampus $programsPerCampus)
    {
        $programsPerCampus->delete();

        return response()->json([
            'message' => 'Deleted'
        ]);
    }
}

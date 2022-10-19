<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Camera;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CameraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cameras = Camera::accessible()->paginate(10);
        return view('camera')
            ->with('cameras', $cameras);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $areas = Area::all();
        return view('camera_create')
            ->with('areas', $areas);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //        
        Camera::create([
            'name' => $request->name,
            'token' =>  md5(rand(1,10).microtime()),
            'area_id' => $request->area,
        ]);

        return redirect()->route('camera');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Camera  $camera
     * @return \Illuminate\Http\Response
     */
    public function show(Camera $camera)
    {
        //
        return view('camera_show')
            ->with('camera', $camera);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Camera  $camera
     * @return \Illuminate\Http\Response
     */
    public function edit(Camera $camera)
    {
        //
        $areas = Area::all();
        return view('camera_edit')
            ->with('camera', $camera)
            ->with('areas', $areas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Camera  $camera
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Camera $camera)
    {
        //
        $camera->update([
            'name' => $request->name,
        ]);

        return redirect()->route('camera');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Camera  $camera
     * @return \Illuminate\Http\Response
     */
    public function destroy(Camera $camera)
    {
        //
        $camera->delete();
        
        return redirect()->route('camera');
    }

    public function activeCheckFromAPI(Request $request)
    {
        $camera = Camera::where('token',$request->camera_token)->firstOrFail();
        $camera->update([
            'last_active_time' => Carbon::now(),
        ]);
        return "Success";
    }
}

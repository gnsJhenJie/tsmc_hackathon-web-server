<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $areas = Area::accessible()->paginate(10);
        return view('area')
            ->with('areas',$areas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return view('area_create')
            ->with('users', User::all());
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
        $managers = $request->managers;
        sort($managers);
        $managers = array_map(function($value) {
            return intval($value);
        }, $managers);

        Area::create([
            'name' => $request->name,
            'description' => $request->description,
            'managers' => $managers,
        ]);

        return redirect()->route('area');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
        $cameras = $area->cameras()->paginate(10);
        return view('area_show')
            ->with('area', $area)
            ->with('cameras', $cameras);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        //
        return view('area_edit')
            ->with('area', $area)
            ->with('users', User::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        //
        $managers = $request->managers;
        sort($managers);
        $managers = array_map(function($value) {
            return intval($value);
        }, $managers);

        $area->update([
            'name' => $request->name,
            'description' => $request->description,
            'managers' => $managers,
        ]);

        return redirect()->route('area');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        //
        $area->delete();
        return redirect()->route('area');
    }

}

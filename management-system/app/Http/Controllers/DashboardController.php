<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Camera;
use App\Models\Incident;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $areas = Area::all();
        $area_count = $areas->count();

        $area_has_incident_count = 0;
        foreach ($areas as $area) {
            if (Incident::where('area_id','=',$area->id)->count()>0) {
                $area_has_incident_count += 1;
            }
        }

        $cameras = Camera::all();
        $camera_count = $cameras->count();

        $camera_active_count = $cameras->where('last_active_time','>', Carbon::now()->subMinutes(30))->count();

        $incidents = Incident::where('status', '=', 0)->paginate(5);
        $incidents_30d_count = Incident::where('created_at','>',Carbon::now()->subDays(30))->count();
        $incidents_count = Incident::where('status', '=', 0)->count();

        return view('dashboard')
            ->with('area_count',$area_count)
            ->with('area_has_incident_count', $area_has_incident_count)
            ->with('camera_count', $camera_count)
            ->with('camera_active_count', $camera_active_count)
            ->with('incidents', $incidents)
            ->with('incidents_count', $incidents_count)
            ->with('incidents_30d_count',$incidents_30d_count);

    }
}

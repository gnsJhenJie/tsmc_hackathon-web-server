<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\IncidentType;
use App\Models\Camera;
use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function pendingIndex()
    {
        $incidents = Incident::where('status', '=', 0)->paginate(8);

        return view('incident_pending')
            ->with('incidents', $incidents);
    }

    public function doneIndex()
    {
        $incidents = Incident::where('status', '=', 1)->paginate(10);

        return view('incident_done')
            ->with('incidents', $incidents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $areas = Area::accessible();
        $incident_types = IncidentType::where('id', '>', 1)->get();
        return view('incident_create')
            ->with('areas', $areas)
            ->with('incident_types', $incident_types);
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
        $area = Area::find($request->area);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('incidents_images/', strval($incident->id).'.jpg');
        } 

        $description = array(
            "description"=>$request->description,
            "has_image"=>$request->hasFile('image'),
        );

        Incident::create([
            'area_id' => $area->id,
            'managers' => $area->managers,
            'status' => 0,
            'description' => json_encode($description),
            'created_at' => $request->time,
            'incident_type_id' => $request->incident_type,
        ]);

        return redirect()->route('incident_pending');
    }

    /**
     * Store a newly created camera incident from API call in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCameraIncidentFromAPI(Request $request)
    {
        //
        // dd($request);
        $camera = Camera::where('token',$request->camera_token)->firstOrFail();
        $area = $camera->area()->first();

        // TODO: change 1 to 30
        // if (Incident::where([['camera_id','=',$camera->id],['area_id','=',$area->id],['created_at','>=', Carbon::now()->subMinutes(1)]])->exists()) {
        //     return "Existed";
        // }

        if (!$request->has('without_amount') || !$request->has('total')) abort(501);
        $detail = [
            "without_amount" => intval($request->without_amount),
            "total" => intval($request->total),
            "has_image" => $request->hasFile('image'),
        ];

        $incident = Incident::create([
            "incident_type_id" => 1,
            "area_id" => $area->id,
            "camera_id" => $camera->id,
            "status" => 0,
            "description" => json_encode($detail),
            "managers" => $area->managers,
        ]);

        // $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('incidents_images/', strval($incident->id).'.jpg');
        }
        
        foreach($area->managers as $user_id){
            if (!is_null(User::find($user_id)->line_user_id)){
                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://fe97-2001-288-3001-197-250-56ff-fe96-e9f7.jp.ngrok.io/sendIncident',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('area' => $area->name, 'created_at' => $incident->created_at,'line_user_id' => User::find($user_id)->line_user_id, 'incident_id' => $incident->id, 'without_amount' => intval($request->without_amount)),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
            }
        }
        return "Success";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function show(Incident $incident)
    {
        //
        if ($incident->incident_type_id == 1) {
            return view('incident_show')
                ->with('incident',$incident);
        }else {
            return view('incident_showGeneral')
                ->with('incident',$incident);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function edit(Incident $incident)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incident $incident)
    {
        //
        $description = json_decode($incident->description, true);
        $description['deal_description'] = $request->deal_description;
        $incident->update([
            'status' => $request->status,
            'description' => json_encode($description),
        ]);
        $incident->save();

        return redirect()->route('incident_pending');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function updateFromAPI(Incident $incident, Request $request)
    {
        //
        if ($request->management_secret != env("MANAGEMENT_SECRET")) abort(401);
        $description = json_decode($incident->description, true);
        $description['deal_description'] = "已透過Line Bot完成";
        $incident->update([
            'status' => 1,
            'description' => json_encode($description),
        ]);
        $incident->save();

        return "Success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incident $incident)
    {
        //
        if ($incident->incident_type_id == 1 && $incident->has_image) {
            Storage::copy('incidents_images/'.$incident->id.'.jpg', 'mis_identified/'.$incident->id.'.jpg');
            $incident->update([
                "status" => 3, // 攝影機誤報
            ]);
            $incident->save();
            $incident->delete();
        }else {
            $incident->update([
                "status" => 4, // 刪除
            ]);
            $incident->save();
            $incident->delete();
        }
        return redirect()->route('incident_pending');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function destroyFromAPI(Incident $incident, Request $request)
    {
        //
        if ($request->management_secret != env("MANAGEMENT_SECRET")) abort(401);
        if ($incident->incident_type_id == 1 && $incident->has_image) {
            Storage::copy('incidents_images/'.$incident->id.'.jpg', 'mis_identified/'.$incident->id.'.jpg');
            $incident->update([
                "status" => 3, // 攝影機誤報
            ]);
            $incident->save();
            $incident->delete();
        }else {
            $incident->update([
                "status" => 4, // 刪除
            ]);
            $incident->save();
            $incident->delete();
        }
        return "Success";
    }

    public function getIncidentImage(Incident $incident)
    {
        if (Storage::exists('incidents_images/'.$incident->id.'.jpg')) {
            return Storage::download('incidents_images/'.$incident->id.'.jpg');
        }
        return redirect('/assets/images/default_incident.png');
    }
}

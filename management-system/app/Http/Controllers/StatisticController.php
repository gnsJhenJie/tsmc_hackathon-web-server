<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\IncidentType;
use DateInterval;
use Datetime;
use DateTimeZone;

class StatisticController extends Controller
{
    //
    public function getPeriodIncidentStatisticsByDay(Request $request)
    {
        // dd(date("Y-m-d"));
        $x_array = array();
        $y_array = array();
        
        $begin = new Datetime($request->beginDate, new DateTimeZone('Europe/London'));
        $end = new Datetime($request->endDate, new DateTimeZone('Europe/London'));
        $interval = $end->diff($begin)->days + 1;
        $timestamp = $this->datetime2TimestampDate($end);
        $oneDay = new DateInterval('P1D');
        $array = [
            // ["amount" => 0, "date" => 0, "category" => "incident"],
        ];
        //dd($begin->format('Y-m-d'));
        for ($day = 0; $day < $interval; $day++) {
            // dd($end->format('Y-m-d'));
            array_push($x_array,$end->format('Y-m-d'));
            $date = $this->datetime2TimestampDate($end);
            $nextDay = clone $end;
            $nextDay->add($oneDay);
            $count = Incident::where([
                ['created_at', '>=', $end->format('Y-m-d')],
                ['created_at', '<', $nextDay->format('Y-m-d')],
            ])->count();
            if ($count||true) {
                array_push($array, [
                    "amount" => $count,
                    "date" => $date,
                    "category" => "incident",
                ]);
            }
            $end->sub($oneDay);
            array_push($y_array,$count);
        }
        $x_array = array_reverse($x_array);
        $y_array = array_reverse($y_array);

        $pie_array = array();
        $incidentTypes = IncidentType::all();
        foreach ($incidentTypes as $incidentType) {
            $pie_array[$incidentType->name] = Incident::where('incident_type_id','=',$incidentType->id)->count();
        }
        $pie_code = "";
        foreach ($pie_array as $key => $val) {
            $pie_code .="{name:'".$key."',y:".strval($val)."},";
        }
        // dd($pie_code);
        // dd($pie_array);
        // dd($y_array);
        // dd(implode("','",$x_array));
        return view('chart')
            ->with('x_array', $x_array)
            ->with('y_array', $y_array)
            ->with('pie_code', $pie_code);

    }

    private function datetime2TimestampDate(Datetime $datetime)
    {
        $timestamp = $datetime->getTimeStamp() * 1000;
        return $timestamp - $timestamp % 86400000 + 86400000;
    }
}

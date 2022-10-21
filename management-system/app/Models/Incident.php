<?php

namespace App\Models;

use App\Models\Area;
use App\Models\Camera;
use App\Models\IncidentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Incident extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'area_id',
        'camera_id',
        'managers',
        'status',
        'description',
        'incident_type_id',
        'created_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'managers' => 'array',
    ];

    protected $appends = ['without_amount','total_amount','has_image'];

    public static function accessible(User $user = null)
    {
        if (is_null($user)) $user = Auth::user();
        if ($user->role == 2){
            return Area::all();
        }else {
            $areas = Area::all();
            foreach ($areas as $key => $area) {
                if (!in_array($user->id, $area)) {
                    $areas->forget($key);
                }
            }
        }
        return $areas;
    }

    public function managers()
    {
        $managers = collect(new User);
        foreach ($this->managers as $uid) {
            $managers->push(User::find($uid));
        }
        return $managers;
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function camera()
    {
        return $this->belongsTo(Camera::class);
    }

    public function incidentType()
    {
        return $this->belongsTo(IncidentType::class);
    }

    public function getWithoutAmountAttribute()
    {
        if ($this->incident_type_id == 1) {
            return json_decode($this->description, true)['without_amount'];
        }else {
            return "";
        }
    }

    public function getTotalAmountAttribute()
    {
        if ($this->incident_type_id == 1) {
            return json_decode($this->description, true)['total'];
        }else {
            return "";
        }
    }

    public function getHasImageAttribute()
    {
        return json_decode($this->description, true)['has_image'];

    }

}

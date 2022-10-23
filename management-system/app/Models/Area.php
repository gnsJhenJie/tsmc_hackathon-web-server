<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Camera;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Area extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'managers',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'managers' => 'array',
    ];

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

    public function cameras()
    {
        return $this->hasMany(Camera::class);
    }

    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }

    // public static function hasIncidentToday()
    // {
    //     return Area::with('incident')->where('')
    //     return $this->incidents()->where('created_at', '>=', Carbon::now()->subDays(1));
    // }

}

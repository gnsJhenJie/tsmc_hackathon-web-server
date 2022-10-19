<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Camera extends Model
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
        'token',
        'area_id',
        'last_active_time',
    ];


    public static function accessible(User $user = null)
    {
        if (is_null($user)) $user = Auth::user();
        if ($user->role == 2){
            return Camera::all();
        }else {
            $cameras = Camera::all();
            foreach ($cameras as $key => $camera) {
                if (!in_array($user->id, $camera->area()->get()->first()->managers)) {
                    $cameras->forget($key);
                }
            }
        }
        return $cameras;
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use App\Models\CustomNotification;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Unit;
use App\Models\SubUnit;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'password_hint',
        'status',
        'thumbnail',
        'nid',
        'address'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'password_hint',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getImageAttribute($value)
    {
        if ($value) {
            return env('APP_URL') . 'assets/images/' . $value;
        }else{
            return '';
        }
    }
    public function getThumbnailAttribute($value)
    {
        if ($value) {
            return env('APP_URL').'/storage/'.$value;
        }else{
            return '';
        }
    }

    public function getBannerAttribute($value)
    {
        if ($value) {
            return env('APP_URL').'/storage/'.$value;
        }else{
            return '';
        }
    }

    public function notifications()
    {
        return $this->hasMany(CustomNotification::class, 'user_id', 'id');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'id', 'user_id');
    }

    public static function getTimeAgo($time)
    {
        $time_difference = time() - $time;

        if ($time_difference < 1) {
            return '1 second ago';
        }
        $condition = array(
            12 * 30 * 24 * 60 * 60 =>  'year',
            30 * 24 * 60 * 60       =>  'month',
            24 * 60 * 60            =>  'day',
            60 * 60                 =>  'hour',
            60                      =>  'minute',
            1                       =>  'second'
        );

        foreach ($condition as $secs => $str) {
            $d = $time_difference / $secs;

            if ($d >= 1) {
                $t = round($d);
                return $t . ' ' . $str . ($t > 1 ? 's' : '') . ' ago';
            }
        }
    }

}

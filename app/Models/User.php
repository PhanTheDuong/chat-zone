<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id','name','birthday', 'email', 'password','phone','avatar','cover','address','href',
        'province','district','deleted','wards'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $slug = Str::slug($user->name);

            // Kiểm tra xem slug có trùng không
            $count = static::where('href', $slug)->count();

            // Nếu trùng, thêm kí tự để tránh trùng
            while ($count > 0) {
                $slug = Str::slug($user->name) . '-' . Str::random(3);
                $count = static::where('href', $slug)->count();
            }

            $user->href = $slug;
        });
    }
}

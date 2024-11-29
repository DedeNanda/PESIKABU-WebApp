<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
        'name',
        'email',
        'password',
        'level',
        'photo',
    ];

    public function kasus()
    {
        return $this->hasMany(Kasus::class, 'id_user');
    }

    public function getMaskedEmailAttribute()
    {
        $email = $this->attributes['email'];  
        $emailParts = explode('@', $email);
        $localPart = $emailParts[0];
        $domainPart = $emailParts[1];

        $visibleStart = 2; 
        $visibleEnd = 1; 
        $localPartLength = strlen($localPart);

        if ($localPartLength <= $visibleStart + $visibleEnd) {
            $maskedLocalPart = $localPart; 
        } else {
            $maskedLocalPart = substr($localPart, 0, $visibleStart)
                . str_repeat('*', $localPartLength - $visibleStart - $visibleEnd)
                . substr($localPart, -$visibleEnd);
        }

        return $maskedLocalPart . '@' . $domainPart;
    }

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
}

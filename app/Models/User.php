<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'gender',
        'phone',
        'photo',
        'password',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function CityAdmin()
    {
        return $this->hasMany(CityAdmin::class);
    }

    public function Shop()
    {
        return $this->hasOne(shop::class);
    }

    public function Review()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function userCart()
    {
        return $this->hasMany(UserCart::class);
    }

    public function getPhoto(){
        return $this->gambar ? Storage::url($this->photo) : ' https://ui-avatars.com/api/?background=000C32&color=fff&name='.$this->name;
    }


}

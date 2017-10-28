<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\App;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    const STATUS_ACTIVE = 'Activo';

    const LEVEL_USER = 'USER';
    const LEVEL_ADMIN = 'ADMIN';

    protected $table = 'users';

    protected $fillable = ['user','email','status','level'];

    protected $hidden = ['password','password_temp'];

    public function getCinemas() {
        return $this->hasMany('App\Cinema','user_id');
    }

    public function getComments() {
        return $this->hasMany('App\Comment','user_id');
    }

    public function getMoviesLikes() {
        return $this->belongsToMany('App\Movie','likes','movie_id','user_id');
    }

    public static function initRegisterValidationParams() {
        $params = [
            'user' => [
                'label' => 'Usuario',
                'required' => true,
                'unique' => [
                    'class' => self::class,
                    'field' => 'user'
                ],
                'min' => 6,
                'max' => 20,
                'custom' => [
                    '/^[a-z]+[a-z0-9]*$/i',
                ],
            ],
            'password' => [
                'label' => 'Contraseña',
                'required' => true,
                'min' => 6,
                'max' => 20,
            ],
            'email' => [
                'label' => 'Email',
                'required' => true,
                'unique' => [
                    'class' => self::class,
                    'field' => 'email',
                ],
                'min' => 10,
                'max' => 80,
                'custom' => [
                    '/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*.(\.[a-z]{2,4})$/i',
                ]
            ],
            'cine_name' => [
                'label' => 'Nombre de cine',
                'required' => true,
                'min' => 3,
                'max' => 20,
                'unique' => [
                    'class' => \App\Cinema::class,
                    'field' => 'name',
                ],
            ],
        ];

        return $params;
    }

    public static function initLoginValidationParams() {
        $params = [
            'user' => [
                'label' => 'Usuario',
                'required' => true,
            ],
            'password' => [
                'label' => 'Contraseña',
                'required' => true,
            ],
        ];

        return $params;
    }

    public static function initChangePasswordValidationParams() {
        $params = [
            'password' => [
                'label' => 'Contraseña',
                'required' => true,
                'min' => 6,
                'max' => 20,
            ],
        ];

        return $params;
    }

    public static function getCinemaFromUsername($username) {
        $user = self::where('user', $username)->get()[0];

        return $user->getCinemas[0]->name;
    }
}

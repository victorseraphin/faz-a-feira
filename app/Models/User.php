<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Hash;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function do_all()
    {
        $data = User::get();
        return $data;
    }

    public static function do_show($id)
    {
        $data = User::where('id', $id)->get();
        return $data;
    }

    public static function do_save($request, $id = null)
    {
        if ($id) {
            $data = User::findOrFail($id);
            if ($request['password'] != null) {
                $data->password = Hash::make($request['password']);
            }
        } else {
            $data = new User;
            $data->password = Hash::make($request['password']);
        }

        $data->name = $request['name'];
        $data->email = $request['email'];
        $data->save();
        return $data;
    }

    public static function do_delete($id)
    {
        $data = User::where('id', $id)->firstOrFail();
        $data->delete();
        return $data;
    }

    public static function register($request)
    {
        
        $data = new User;   
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->save();
        return $data;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}

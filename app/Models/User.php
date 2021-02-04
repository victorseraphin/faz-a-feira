<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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
}

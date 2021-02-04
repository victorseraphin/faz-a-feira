<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ListaDesejo extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'produto_id',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public static function do_all()
    {
        $data = ListaDesejo::get();
        return $data;
    }

    public static function do_show($id)
    {
        $data = ListaDesejo::where('id', $id)->get();
        return $data;
    }

    public static function do_save($request, $id = null)
    {
        $data = new ListaDesejo;        

        $data->produto_id   = $request['produto_id'];
        $data->user_id      = $request['user_id'];
        $data->save();
        return $data;
    }

    public static function do_delete($id)
    {
        $data = ListaDesejo::where('id', $id)->firstOrFail();
        $data->delete();
        return $data;
    }
}

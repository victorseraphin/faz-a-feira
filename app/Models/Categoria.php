<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Categoria extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'nome',
        'descricao',
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
        $data = Categoria::get();
        return $data;
    }

    public static function do_show($id)
    {
        $data = Categoria::where('id', $id)->get();
        return $data;
    }

    public static function do_save($request, $id = null)
    {
        if ($id) {
            $data = Categoria::findOrFail($id);
        } else {
            $data = new Categoria;
        }

        $data->nome         = $request['nome'];
        $data->descricao    = $request['descricao'];
        $data->save();
        return $data;
    }

    public static function do_delete($id)
    {
        $data = Categoria::where('id', $id)->firstOrFail();
        $data->delete();
        return $data;
    }
}

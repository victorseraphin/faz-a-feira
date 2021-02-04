<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Produto extends Model
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
        'preco',
        'categoria_id',
        'photo',
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
        $data = Produto::get();
        return $data;
    }

    public static function do_show($id)
    {
        $data = Produto::where('id', $id)->get();
        return $data;
    }

    public static function do_save($request, $id = null)
    {
        if ($id) {
            $data = Produto::findOrFail($id);
        } else {
            $data = new Produto;
        }

        $data->nome         = $request['nome'];
        $data->descricao    = $request['descricao'];
        $data->preco        = $request['preco'];
        $data->categoria_id = $request['categoria_id'];
        $data->photo        = $request['photo'];
        $data->save();
        return $data;
    }

    public static function do_delete($id)
    {
        $data = Produto::where('id', $id)->firstOrFail();
        $data->delete();
        return $data;
    }
}


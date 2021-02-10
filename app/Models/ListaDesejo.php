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
        $data = ListaDesejo::paginate(10);
        return $data;
    }

    public static function do_show($user_id)
    {
        $data = ListaDesejo::
        select('lista_desejos.id','lista_desejos.produto_id','lista_desejos.user_id', 'produtos.nome', 'produtos.descricao', 'produtos.preco', 'produtos.photo')
        ->where('lista_desejos.user_id', $user_id)
        ->join('produtos', 'lista_desejos.produto_id', '=', 'produtos.id')
        ->paginate(10);
        return $data;
    }

    public static function do_save($request, $id = null)
    {
        $data = ListaDesejo::where('produto_id', $request['produto_id'])
        ->where('user_id', $request['user_id'])
        ->first();

        if(!$data){
            $data = new ListaDesejo;       

            $data->produto_id   = $request['produto_id'];
            $data->user_id      = $request['user_id'];
            $data->save();
            return $data;
        }else{
            $data = ListaDesejo::where('id', $data->id)->firstOrFail();
            $data->delete();
            return $data;
        }
        
    }

    public static function do_delete($user_id,$id)
    {
        $data = ListaDesejo::where('user_id', $user_id)->where('id', $id)->firstOrFail();
        $data->delete();
        return $data;
    }
}

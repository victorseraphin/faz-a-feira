<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

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
        'user_id'
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
        $data = Produto::paginate(12);
        return $data;
    }

    public static function do_show($user_id)
    {
        $data = Produto::
        select('produtos.id','produtos.nome','produtos.descricao','produtos.preco','produtos.photo', 
        DB::raw('coalesce(count(lista_desejos.id),0) as curtidas'))
        
        ->leftjoin('lista_desejos', 'produtos.id', '=', 'lista_desejos.produto_id')

        ->where('produtos.user_id', $user_id)
        ->groupBy('produtos.id','produtos.nome','produtos.descricao','produtos.preco','produtos.photo')
        ->paginate(10);
        return $data;
    }

    public static function do_save($request, $user_id, $id = null)
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
        $data->user_id      = $user_id;
        $data->save();
        return $data;
    }

    public static function do_delete($user_id,$id)
    {
        $data = Produto::where('user_id', $user_id)->where('id', $id)->firstOrFail();
        $data->delete();
        return $data;
    }

    public static function show_by_ID($id)
    {
        $data = Produto::select('produtos.id','produtos.nome','produtos.descricao','produtos.preco','produtos.photo', 
                DB::raw('coalesce(count(lista_desejos.id),0) as curtidas'))        
                ->leftjoin('lista_desejos', 'produtos.id', '=', 'lista_desejos.produto_id')        
                ->where('produtos.id', $id)
                ->groupBy('produtos.id','produtos.nome','produtos.descricao','produtos.preco','produtos.photo')
                ->paginate(10);

        return $data;
    }
}


<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Produto;
use Log;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = Produto::do_all();
        return response()->json($dados, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_id)
    {
        $validate = $this->validate_inputs($request);

        if(!$validate){
            $dados = Produto::do_save($request, $user_id);
            if($dados){
                Log::info("Produto ID {$dados->id} created successfully.");                
                return response()->json(['message' => 'Registro incluído com sucesso.'], 201);
            }else{
                Log::info("Produto ID {$dados->id} problem registering new record.");
                return response()->json(['message' => 'Problem registering new record.'], 400);
            }
        }else{
            return response()->json(['message' => $validate], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $dados = Produto::do_show($user_id);
        return response()->json($dados, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id, $id)
    {
        $validate = $this->validate_inputs($request, $id);
        if(!$validate){
            $dados = Produto::do_save($request, $user_id, $id);
            if($dados){
                Log::info("Produto ID {$dados->id} updated successfully.");                
                return response()->json(['message' => 'Registro atualizado com sucesso.'], 201);
            }else{
                Log::info("Produto ID {$dados->id} problem changing record.");
                return response()->json(['message' => 'Problem changing record.'], 400);
            }
        }else{
            return response()->json(['message' => $validate], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id,$id)
    {
        $dados = Produto::do_delete($user_id,$id);
        if($dados){
            Log::info("Produto ID {$dados->id} deleted successfully.");
            return response()->json(['message' => 'Registro deletado com sucesso.'], 200);
        }else{
            Log::info("Produto ID {$dados->id} problem deleting record.");
            return response()->json(['message' => 'Problem deleting record.'], 400);
        } 
    }

    /**
    * Validates input
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function validate_inputs($request, $id = null)
    {    

        if($request->nome ==  null){
            return "Digite um nome.";
        }

        if($request->descricao ==  null){
            return "Digite uma descrição.";
        }

        if($request->preco ==  null){
            return "Digite um preço.";
        }

        if($request->photo ==  null){
            return "Digite uma foto.";
        }
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_detalhes($id)
    {
        $dados = Produto::show_by_ID($id);
        return response()->json($dados, 200);
    }
}

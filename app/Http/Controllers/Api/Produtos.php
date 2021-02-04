<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;
use Log;

class Produtos extends Controller
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
    public function store(Request $request)
    {
        $validate = $this->validate_inputs($request);

        if(!$validate){
            $dados = Produto::do_save($request);
            if($dados){
                Log::info("Produto ID {$dados->id} created successfully.");                
                return response()->json(['message' => 'Registro incluído com sucesso.'], 201);
            }else{
                Log::info("Produto ID {$dados->id} problem registering new record.");
                return response()->json(['message' => 'Problem registering new record.'], 404);
            }
        }else{
            return response()->json(['message' => $validate], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dados = Produto::do_show($id);
        return response()->json($dados, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $this->validate_inputs($request, $id);
        if(!$validate){
            $dados = Produto::do_save($request, $id);
            if($dados){
                Log::info("Produto ID {$dados->id} updated successfully.");                
                return response()->json(['message' => 'Registro atualizado com sucesso.'], 201);
            }else{
                Log::info("Produto ID {$dados->id} problem changing record.");
                return response()->json(['message' => 'Problem changing record.'], 404);
            }
        }else{
            return response()->json(['message' => $validate], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dados = Produto::do_delete($id);
        if($dados){
            Log::info("Produto ID {$dados->id} deleted successfully.");
            return response()->json(['message' => 'Registro deletado com sucesso.'], 200);
        }else{
            Log::info("Produto ID {$dados->id} problem deleting record.");
            return response()->json(['message' => 'Problem deleting record.'], 404);
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
            return response()->json(['message' => "Digite um nome."], 404);
        }

        if($request->descricao ==  null){
            return response()->json(['message' => "Digite uma descrição."], 404);
        }

        if($request->preco ==  null){
            return response()->json(['message' => "Digite um preço."], 404);
        }

        if($request->categoria_id ==  null){
            return response()->json(['message' => "Digite uma categoria."], 404);
        }

        if($request->photo ==  null){
            return response()->json(['message' => "Digite uma foto."], 404);
        }
        
    }
}

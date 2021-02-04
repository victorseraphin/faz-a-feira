<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListaDesejo;
use Log;

class ListaDesejos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = ListaDesejo::do_all();
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
            $dados = ListaDesejo::do_save($request);
            if($dados){
                Log::info("ListaDesejo ID {$dados->id} created successfully.");                
                return response()->json(['message' => 'Registro incluído com sucesso.'], 201);
            }else{
                Log::info("ListaDesejo ID {$dados->id} problem registering new record.");
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
        $dados = ListaDesejo::do_show($id);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dados = ListaDesejo::do_delete($id);
        if($dados){
            Log::info("ListaDesejo ID {$dados->id} deleted successfully.");
            return response()->json(['message' => 'Registro deletado com sucesso.'], 200);
        }else{
            Log::info("ListaDesejo ID {$dados->id} problem deleting record.");
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

        if($request->produto_id ==  null){
            return response()->json(['message' => "Digite um produto."], 404);
        }

        if($request->user_id ==  null){
            return response()->json(['message' => "Digite uma user."], 404);
        }
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Estudante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    // use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $estudantes = Estudante::all();

        if($estudantes->count() > 0)
        {
            return response()->json([
                'status' => 200,
                'estudantes' => $estudantes
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'estudantes' => 'Sem registros'
            ], 404); 
        }
  
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome'    => 'required|string|max:191',
            'curso'   => 'required|string|max:191',
            'email'   => 'required|email|max:191',
            'celular' => 'required|digits:11'
        ]);

        if($validator->fails()){

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);

        }else{

            $estudante = Estudante::create([
                'nome' => $request->nome,
                'curso' => $request->curso,
                'email' => $request->email,
                'celular' => $request->celular,
            ]);

            if($estudante){
                return response()->json([
                    'status' => 200,
                    'message' => "Estudante adicionado com sucesso"
                ],200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => "Erro ao adicionar estudante"
                ],500);
            }
        }
    }

    public function show($id)
    {
        $estudante = Estudante::find($id);

        if($estudante)
        {
            return response()->json([
                'status' => 200,
                'estudante' => $estudante
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'Estudante não encontrado'
            ], 404); 
        }
    }

    public function edit($id)
    {
        $estudante = Estudante::find($id);

        if($estudante)
        {
            return response()->json([
                'status' => 200,
                'estudante' => $estudante
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'Estudante não encontrado'
            ], 404); 
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'nome'    => 'required|string|max:191',
            'curso'   => 'required|string|max:191',
            'email'   => 'required|email|max:191',
            'celular' => 'required|digits:11'
        ]);

        if($validator->fails()){

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);

        }
        else
        {

            $estudante = Estudante::find($id);

            if($estudante){

                $estudante->update([
                    'nome' => $request->nome,
                    'curso' => $request->curso,
                    'email' => $request->email,
                    'celular' => $request->celular,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => "Estudante atualizado com sucesso"
                ],200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => "Erro ao alterar estudante"
                ],404);
            }
        }
    }

    public function destroy($id)
    {
        $estudante = Estudante::find($id);

        if($estudante)
        {
            $estudante->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Estudante deletado com sucesso'
            ], 200); 
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'Estudante não encontrado'
            ], 404); 
        }
    }
}

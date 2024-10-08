<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Throwable;

class AuthorController extends Controller
{
    public function index(){
        $authors = Author::all();
        $arrayAuthors = $authors->toArray();
        $data = $this->addActionsBtn($arrayAuthors);
        return response()->json($data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorRequest $request):JsonResponse
    {
        try{
            Author::create($request->all());
            return response()->json(array('error'=>'','message'=>'Autor creado exitosamente'));
        }catch(Throwable $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>"No se pudo guardar el autor"),500);
        }
        
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):JsonResponse
    {
        try{
            $Author = Author::findOrFail($id);
            return response()->json($Author);
        }catch(ModelNotFoundException $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>'Autor no encontrado'),404);
        }
            
    }

    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorRequest $request, string $id):JsonResponse
    {
        try{
            $Author = Author::findOrFail($id);
            $Author->update($request->all());
            return response()->json(array('error'=>'','message'=>'Autor actualizado exitosamente'));
        }catch(ModelNotFoundException $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>'Autor no encontrado'),404);
        }
        catch(Throwable $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>'Autor no actualizado'),500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):JsonResponse
    {
        try{
            $Author = Author::findOrFail($id);
            $Author->delete();
            return response()->json(array('error'=> '', 'message'=> 'Autor eliminado exitosamente'));
        }catch(ModelNotFoundException $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>'Autor no encontrado'),404);
        }

    }
}

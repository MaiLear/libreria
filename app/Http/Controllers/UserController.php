<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Throwable;

class UserController extends Controller
{
    public function index():JsonResponse{
        $users = User::all();
        $arrayUsers = $users->toArray();
        $data = $this->addActionsBtn($arrayUsers);
        return response()->json($data);
    }

/**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request):JsonResponse
    {
        try{
            User::create($request->all());
            return response()->json(array('error'=>'','message'=>'Usuario creado exitosamente'));
        }
        catch(Throwable $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>"No se pudo guardar el usuario"),500);
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):JsonResponse
    {
        try{
            $user = User::findOrFail($id);
            return response()->json($user);
        }catch(ModelNotFoundException $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>'Usuario no encontrado'),404);
        }
            
    }

    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id):JsonResponse
    {
        try{
            $user = User::findOrFail($id);
            $user->update($request->all());
            return response()->json(array('error'=>'','message'=>'Usuario actualizado exitosamente'));
        }catch(ModelNotFoundException $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>'Usuario no encontrado'),404);
        }
        catch(Throwable $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>'Usuario no actualizado'),500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):JsonResponse
    {
        try{
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(array('error'=> '', 'message'=> 'Usuario eliminado exitosamente'));
        }catch(ModelNotFoundException $e){
            return response()->json(array('error'=>'Usuario no encontrado','message'=>$e->getMessage()),404);
        }

    }
}

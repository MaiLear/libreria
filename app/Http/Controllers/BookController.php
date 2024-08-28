<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Throwable;

class BookController extends Controller
{

    public function index():JsonResponse{
        $books = Book::select(['id','name','cost','quantity','author_id'])->with(['author:id,first_name,second_name'])->get();
        $arrayBooks = $books->toArray();
        $data = $this->addActionsBtn($arrayBooks);
        return response()->json($data);
    }

  

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request):JsonResponse
    {
        try{
            Book::create($request->all());
            return response()->json(array('error'=>'','message'=>'Libro creado exitosamente'));
        }catch(Throwable $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>"No se pudo guardar el libro"),500);
        }
        
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):JsonResponse
    {
        try{
            $book = Book::findOrFail($id);
            return response()->json($book);
        }catch(ModelNotFoundException $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>'Libro no encontrado'),404);
        }
            
    }

    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, string $id):JsonResponse
    {
        try{
            $book = Book::findOrFail($id);
            $book->update($request->all());
            return response()->json(array('error'=>'','message'=>'Libro actualizado exitosamente'));
        }catch(ModelNotFoundException $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>'Libro no encontrado'),404);
        }
        catch(Throwable $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>'Libro no actualizado'),500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):JsonResponse
    {
        try{
            $book = Book::findOrFail($id);
            $book->delete();
            return response()->json(array('error'=> '', 'message'=> 'Libro eliminado exitosamente'));
        }catch(ModelNotFoundException $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>'Libro no encontrado'),404);
        }

    }
}

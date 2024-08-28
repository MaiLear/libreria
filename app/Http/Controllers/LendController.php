<?php

namespace App\Http\Controllers;

use App\Http\Requests\LendRequest;
use App\Models\Book;
use App\Models\Lend;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Throwable;

class LendController extends Controller
{

    public function index():JsonResponse{
        $lends = Lend::select(['id','quantity','start_date','end_date','user_id','book_id'])
        ->with(['book:id,name','user:id,name'])->get();
        $arrayLends = $lends->toArray();
        $data = $this->addActionsBtn($arrayLends);
        return response()->json($data);
    }
  

    /**
     * Store a newly created resource in storage.
     */
    public function store(LendRequest $request):JsonResponse
    {
        try{
            $decreaseBookQuantity = $this->updateBooksQuanity($request->book_id,$request->quantity);
            if(!is_bool($decreaseBookQuantity)) return $decreaseBookQuantity;
            Lend::create($request->all());
            return response()->json(array('error'=>'','message'=>'El prestamo se hizo exitosamente'));
        }
        catch(Throwable $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>"No se pudo hacer el prestamo"),500);
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):JsonResponse
    {
        try{
            $lend = Lend::findOrFail($id);
            return response()->json($lend);
        }catch(ModelNotFoundException $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>'El prestamo no fue encontrado'),404);
        }
            
    }

    public function returnedBook(int $id):JsonResponse
    {
        try{
            $lend = Lend::find($id);
            $book = Book::find($lend->book_id);
            $book->quantity += $lend->quantity;
            $book->save(); 

            $this->destroy($id);
            return response()->json(array('error'=>'','message'=>'El libro fue devuelto exitosamente'));
            
        }catch(ModelNotFoundException $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>' El prestamo no fue encontrado'),404);
        }catch(Throwable $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>'El libro no pudo ser devuelto'),500);
        }


    }

    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(LendRequest $request, string $id):JsonResponse
    {
        try{
            $decreaseBookQuantity = $this->updateBooksQuanity($request->book_id,$request->quantity);
            if(!is_bool($decreaseBookQuantity)) return $decreaseBookQuantity;

            $lend = Lend::findOrFail($id);
            $lend->update($request->all());
            return response()->json(array('error'=>'','message'=>'El prestamo fue actualizado exitosamente'));

        }catch(ModelNotFoundException $e){
            return response()->json(array('error'=>'El prestamo no fue encontrado','message'=>$e->getMessage()),404);
        }
        catch(Throwable $e){
            return response()->json(array('error'=>'El prestamo no se pudo actualizar','message'=>$e->getMessage()),500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    private function destroy(string $id):JsonResponse
    {
        try{
            $lend = Lend::findOrFail($id);
            $lend->delete();
            return response()->json(array('error'=> '', 'message'=> 'El prestamo se elimino exitosamente'));
        }catch(ModelNotFoundException $e){
            return response()->json(array('error'=>'El prestamo no fue encontrado','message'=>$e->getMessage()),404);
        }

    }
}

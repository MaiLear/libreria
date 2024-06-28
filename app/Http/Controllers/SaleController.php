<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Models\Book;
use App\Models\Sale;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Throwable;

class SaleController extends Controller
{

    public function index():JsonResponse{
        $sales = Sale::selectRaw('id,quantity,user_id,book_id, (SELECT SUM(subtotal) FROM sales) AS total')
        ->with(['user:id,name','book:id,name'])->get();
        $arraySales = $sales->toArray();
        $data = $this->addActionsBtn($arraySales);
        return response()->json($data);
    }

   /**
     * Store a newly created resource in storage.
     */

    private function generateSubtotal(int $id,int $quantity):int{
        $book = Book::find($id);
        $subtotal = $quantity * $book->cost;
        return $subtotal;

    }

    public function store(SaleRequest $request)
    {
        try{
            $decreaseBookQuantity = $this->updateBooksQuanity($request->book_id,$request->quantity);
            if(!is_bool($decreaseBookQuantity)) return $decreaseBookQuantity;

            $request['subtotal'] = $this->generateSubtotal($request->book_id,$request->quantity);
            Sale::create($request->all());
            return response()->json(array('error'=>'','message'=>'Sale created successfull'));
        }
        catch(Throwable $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>"Can't  save sale"),500);
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):JsonResponse
    {
        try{
            $sale = Sale::findOrFail($id);
            return response()->json($sale);
        }catch(ModelNotFoundException $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>'Sale not found'),404);
        }
            
    }

    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(SaleRequest $request, string $id):JsonResponse
    {
        try{
            $this->updateBooksQuanity($request->book_id,$request->quantity);
            $sale = Sale::findOrFail($id);
            $sale->update($request->all());
            return response()->json(array('error'=>'','message'=>'Sale updated successfull'));
        }catch(ModelNotFoundException $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>'Sale not found'),404);
        }
        catch(Throwable $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>'Sale not updated'),500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):JsonResponse
    {
        try{
            $sale = Sale::findOrFail($id);
            $sale->delete();
            return response()->json(array('error'=> '', 'message'=> 'Sale deleted successfull'));
        }catch(ModelNotFoundException $e){
            return response()->json(array('error'=>$e->getMessage(),'message'=>'Sale not found'),404);
        }

    }
}

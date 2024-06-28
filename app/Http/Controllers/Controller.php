<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    protected function updateBooksQuanity(int $id,int $quantity):JsonResponse|bool{
        $book = Book::find($id);
        $decreaseBookQuantity = $book->quantity - $quantity;
        if($decreaseBookQuantity < 0) return response()->json(array(
            'error'=>'','message'=>'Insufficient books for this amount'),500);
        $book->quantity -= $quantity;
        $book->save(); 
        return true;
    }

    protected function addActionsBtn(array $array):array{
        if(empty($array)) return [];
        $data = array_map(function($value){
            $value['actions'] = "<button class='btn btn-primary' id='edit-btn' data-bs-toggle='modal' data-bs-target='#modal' data-id={$value['id']}>Editar</button>
            <button class='btn btn-danger' id='btn-delete' data-id={$value['id']}>Eliminar</button>";
            return $value;
        },$array);
        return $data;
    }


    
}

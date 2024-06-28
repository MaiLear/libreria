@extends('layouts.layout')

@section('title','PRESTAMOS')

@section('body')

<button class="float-end btn btn-primary mt-2" data-bs-toggle='modal' data-bs-target='#modal' id="create-lend">Crear reservacion</button>
<br>
<br>
<br>

<table id="home-table" class="mt-5 w-100">
    <thead>
        <th>ID</th>
        <th>CANTIDAD</th>
        <th>FECHA DE INICIO</th>
        <th>FECHA FIN</th>
        <th>USUARIO</th>
        <th>LIBRO</th>
        <th>ACTIONS</th>

    </thead>

</table>

<div class="modal" tabindex="-1" id="modal">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h5 class="modal-title">Reserva tu libro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST" id="book-form">
            @csrf
        <div class="modal-body row-cols-1">
            <label class="col">Cantidad<input class="form-control" type="number" name="quantity" ></label>
                
            
            <label class="col">Plazo de entrega<input class="form-control" type="text" name="end_date" placeholder="AAA-MM-D 24-00-00"></label>
                
            
            <label class="col mb-5">Usuario<select class="form-select" name="user_id" id="user-select"></select></label>
            
                
            
            <label class="col mb-5">Libro<select class="form-select" name="book_id" id="book-select"></select></label>
            
             <div id="error-container"></div>   
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button  class="btn btn-primary">Reservar</button>
        </div>
    </form>
      </div>
    </div>
  </div>

@endsection

@section('script')
<script src="{{asset('js/Views/lend.js')}}" type="module"></script>

@endsection
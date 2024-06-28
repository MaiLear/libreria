@extends('layouts.layout')

@section('title','LIBROS')

@section('body')

<button class="float-end btn btn-primary mt-2" data-bs-toggle='modal' data-bs-target='#modal' id="create-book">Crear Libro</button>
<br>
<br>
<br>

<table id="home-table" class="mt-5 w-100">
    <thead>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>COSTO</th>
        <th>QUANTITY</th>
        <th>AUTHOR</th>
        <th>ACTIONS</th>

    </thead>

</table>

<div class="modal" tabindex="-1" id="modal">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h5 class="modal-title">Agregar un libro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST" id="book-form">
            @csrf
        <div class="modal-body row-cols-1">
            <label class="col">Nombre<input class="form-control" type="text" name="name" ></label>
  
               
          
            <label class="col">Costo<input class="form-control" type="text" name="cost"></label>
  
               
          
            <label class="col">Cantidad<input class="form-control" type="text" name="quantity"></label>
          
               
          
            <label class="col mb-5">Autor<select class="form-select" name="author_id" id="author-select"></select></label>
            
            <div id="error-container"></div>
          
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button  class="btn btn-primary">Guardar</button>
        </div>
    </form>
      </div>
    </div>
  </div>

@endsection

@section('script')
<script src="{{asset('js/Views/book.js')}}" type="module"></script>

@endsection
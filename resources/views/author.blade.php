@extends('layouts.layout')

@section('title','AUTORES')

@section('body')

<button class="float-end btn btn-primary mt-2" data-bs-toggle='modal' data-bs-target='#modal' id="create-author">Crear autor</button>
<br>
<br>
<br>

<table id="home-table" class="mt-5 w-100">
    <thead>
        <th>ID</th>
        <th>PRIMER NOMBRE</th>
        <th>SEGUNDO NOMBRE</th>
        <th>EDAD</th>
        <th>ACTIONS</th>

    </thead>

</table>

<div class="modal" tabindex="-1" id="modal">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h5 class="modal-title">Agregar un autor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST" id="book-form">
            @csrf
        <div class="modal-body row-cols-1">
            <label class="col">Primer nombre<input class="form-control" type="text" name="first_name"></label>
          
            <label class="col">Segundo nombre<input class="form-control" type="text" name="second_name"></label>
            
            <label class="col">Edad<input class="form-control" type="number" name="age"></label>

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
<script src="{{asset('js/Views/author.js')}}" type="module"></script>

@endsection
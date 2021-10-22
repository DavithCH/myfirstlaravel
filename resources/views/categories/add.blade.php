@extends('layouts.layout')

@section('content')
<div class="container">
    <h3>Ajouter une catégorie</h3>
    <form action="{{route('storeCategory')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="">nom de la catégorie :</label>
            <input type="text" required class="form-control" name="name">
        </div>
        <button type="submit" class="btn btn-primary mt-1">Sumit</button>
    </form>
</div>
@endsection

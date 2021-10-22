@extends('layouts.layout')

@section('content')
<div class="container">
    <h3>les Catégories</h3>

    <ul>
        @foreach ($categories as $category )
        <li>{{$category->name}}</li>
        <form action="{{route('deleteCategory',$category->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">supprimer</button>
        </form>

        <form action="{{route('updateCategory',$category->id)}}" method="post">
            @csrf
            @method('PUT')
            <input type="text" name="name" required class="form-control" value='{{$category->name}}'>
            <button class="btn btn-warning btn-sm">modifier</button>
        </form>

        @endforeach
    </ul>

    <a href="{{route('createCategory')}}" class="btn btn-primary">Ajouter une catégorie</a>
</div>
@endsection

@extends('layouts.layout')

@section('content')

<h2>Add Post</h2>

@if($errors->any())
@foreach ($errors->all() as $error)
<p style="color:red">{{$error}}</p>
@endforeach

@endif
<form action="/posts" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" id='title' value="{{old('title')}}" name='title' type="text" required>
    </div>
    <div class="form-group mt-1">
        <label for="description">Description</label>
        <textarea class="form-control" id='description' name='description' rows="5" required>
            {{old('description')}}
        </textarea>
    </div>

    <div>
        <label> Catégories :</label>
        @foreach ($categories as $category)
        <div class="form-checkbox form-check-inline">
            <input type="checkbox" class="form-check-input" value="{{$category->id}}" id="check-{{$category->id}}"
                name="checkboxCategories[{{$category->id}}]">
            <label for="check-{{$category->id}}" class="form-check-label">{{$category->name}}</label>
        </div>
        @endforeach
    </div>

    <div class="form-group mt-1">
        <label for="extrait">Extrait</label>
        <input class="form-control" id="extrait" value="{{old('extrait')}}" name='extrait' type="text">
    </div>
    <div class="form-group mt-1">
        <label for="picture">Picture</label>
        <input id="picture" type="file" class="form-control" name='picture' accept="image/*">
    </div>
    <input class="btn btn-primary mt-1" type="submit" value="submit">
</form>

@endsection

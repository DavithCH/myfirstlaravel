@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Détails de : {{$post->title}}</h1>
    <form action="{{route('updatePost',$post->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" id='title' value="{{old('title', $post->title)}}" name='title' type="text"
                required>
        </div>
        <div class="form-group mt-1">
            <label for="description">Description</label>
            <textarea class="form-control" id='description' name='description' rows="5" required>
                {{old('description', $post->description)}}
            </textarea>
        </div>
        <div class="form-group mt-1">
            <label for="extrait">Extrait</label>
            <input class="form-control" id="extrait" value="{{old('extrait', $post->extrait)}}" name='extrait'
                type="text">
        </div>

        @foreach ($categories as $category)
        <div class="form-checkbox form-check-inline">
            <input type="checkbox" class="form-check-input" value="{{$category->id}}" id="check-{{$category->id}}"
                name="checkboxCategories[{{$category->id}}]" @if ($post->categories->contains('id',$category->id))
            checked
            @endif >
            <label for="check-{{$category->id}}" class="form-check-label">{{$category->name}}</label>
        </div>
        @endforeach

        <input class="btn btn-warning mt-1" type="submit" value="modifier">
    </form>
</div>

<div class="mt-5 container">
    <div><img style="max-width:250px" src="{{asset('storage/'.$post->picture)}}" alt=""></div>
    <form action="{{route('updatePostPicture', $post->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>modifier l'image</label>
            <input type="file" name="picture" required class="form-control" accept="image/*">
            <button type="submit" class="btn btn-primary mt-1">submit</button>
        </div>
    </form>
</div>

<div>
    <h2>commentaire</h2>
    @if(sizeof($post->comments) > 0)
    <ul>
        @foreach($post->comments as $comment)
        <li class="d-flex align-items-center border justify-content-between w-70 m-1">
            <p class='text-center mx-5 align-items-center'>{{$comment->content}}</p>
            <form action="{{route('deleteComment', $comment->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">supprimer</button>
            </form>

        </li>

        @endforeach
    </ul>
    @else
    <p>no comment available</p>
    @endif

</div>

<form action="{{route('addComment', $post->id)}}" method="post">
    @csrf
    <div class="form-group">
        <label>votre commentaire</label>
        <input type="text" name="content" class="form-control" required>
        <button class="btn btn-primary" type="submit">ajouter ce commentaire</button>
    </div>
</form>

@endsection

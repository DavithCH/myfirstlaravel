@extends('layouts.layout')

@section('content')
<div class="d-flex justify-content-between mt-3 border-bottom">
    <h1 class="text-uppercase">Ma list de l'article</h1>
    <a class="btn btn-primary h-25" href="{{route('addPost')}}">Add new post</a>
</div>

<div class="row">
    @foreach ($posts as $post)
    <div class="col-md-4 col-sm-12 card m-2">
        <img style="object-fit:cover" src="{{asset('storage/'.$post->picture)}}" class="card-img-top" alt="">
        <div class="card-body">
            <h5 class="card-title">{{$post->title}}</h5>
            <p class="card-text">{{$post->extrait}}</p>
            <div>commentaire : {{$post->countComments()}}</div>
            <div>
                @foreach($post->categories as $category)
                <span>{{$category->name}}</span>
                @endforeach
            </div>
            <div class="d-flex">
                <form method="post" action="{{route('deletePost',$post->id)}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">supprimer</button>
                </form>
                <a class="btn btn-warning mx-2" href="{{route('updatePost', $post->id)}}">details</a>
            </div>


        </div>


    </div>
    @endforeach
</div>



@endsection

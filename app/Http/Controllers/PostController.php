<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdatePictureRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Posts;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index() {
        $posts = Posts::orderBy('updated_at', 'desc')->get();
        return view('posts.list', compact('posts'));
    }

    public function addPost() {
        $categories = Category::all();
        return view('posts.addPost', compact('categories'));
    }

    public function show($id) {
        $post = Posts::find($id);
        $categories = Category::all();
        return view('posts.postDetails',compact(['post', 'categories']));
    }

    public function store(PostStoreRequest $request) {
        $params = $request->validated();
        $file = Storage::put('public', $params['picture']);
        $params['picture'] = substr($file, 7);
        $post = Posts::create($params);

        if(!empty($params['checkboxCategories'])){
            $post->categories()->attach($params['checkboxCategories']);
        }
        return redirect()->route('postList');
    }

    public function deletePost($id) {
        $post = Posts::find($id);
        if(Storage::exists("public/$post->picture")){
            Storage::delete("public/$post->picture");
        }
        $post->categories()->detach();
        $post->delete();
        return back();
    }

    public function updatePost(PostUpdateRequest $request, $id) {
        $post = Posts::find($id);
        $params = $request->validated();

        $post->update($params);
        $post->categories()->detach();

        if(!empty($params['checkboxCategories'])){
            $post->categories()->attach($params['checkboxCategories']);
        }

        return redirect()->route('postDetails', $id);
        // $post->update([
        //     'title'-> $params['title']
        // ])
    }

    public function updatePostPicture(PostUpdatePictureRequest $request, $id) {
        $params = $request->validated();
        $post = Posts::find($id);
        if(Storage::exists("public/$post->picture")) {
            Storage::delete("public/$post->picture");
        }
        $file = Storage::put('public', $params['picture']);
        $params['picture'] = substr($file, 7);
        $post->picture = $params['picture'];
        $post->save();

        return redirect()->route('postDetails',$id);
    }
}

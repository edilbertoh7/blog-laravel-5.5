<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
class PageController extends Controller
{
    public function blog()
    {	/*listar todos los datos posts disponibles que  hayan sido publicados*/
    	$posts = Post::orderBy('id','DESC')->where('status','PUBLISHED')->paginate(3);
    	return view('web.posts',compact('posts')) ;
    }

    public function category($slug)
    {
    	/*el metodo pluck hace que solo me retorne el id*/
    	$category = Category::where('slug' ,$slug)->pluck('id')->first();
    	/*listar todos los que tengan relación con esta categoria*/
    	$posts = Post::where('category_id',$category)
    	->orderBy('id','DESC')->where('status','PUBLISHED')->paginate(3);
    	return view('web.posts',compact('posts'));

    }

    public function post($slug)
    {
    	$post = Post::where('slug',$slug)->first();
    	return view('web.post',compact('post'));
    }
}

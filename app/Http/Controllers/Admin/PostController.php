<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
//funcionalidad para guardar archivos 'en este caso imagenes'
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post:: orderBy('id','ASC')
        /*traer los posts donde el id de usuario sea igual al id del usuario que
        esta logueado*/
        ->where('user_id',auth()->user()->id)
        ->paginate();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name','ASC')->pluck('name','id');
        $tags       = Tag::orderBy('name','ASC')->get();

        return view('admin.posts.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {


        $post = Post::create($request->all());
       /*si se envia un a imagen desde el campo file guardar en la
       carpeta public en la carpeta image con el nombre que trae el archivo */
        if($request->file('file')){
            $path = Storage::disk('public')->put('image',$request->file('file'));
            $post->fill(['file'=>asset($path)])->save();
        }
       /* si existe relacion con un a etiqueta se sincronizara correctamente */
       $post->tags()->attach($request->get('tags'));
        return redirect()->route('posts.edit',$post->id)
        ->with('info','Entrada creada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $post = Post::find($id);
       /*se usa el metodo authorize 7 y se pasa como argumento la funccion pass
        creada en el archivo PostPolicy para evitar que se acceda a posts que no 
        le pertenezcan  al usuario*/
        $this->authorize('pass',$post);
        /*esta autorizacio se debe dar de alta en el archivo AuthServiceProvider par 
        que funcione correctamente*/
       return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        /*se usa el metodo authorize 7 y se pasa como argumento la funccion pass
        creada en el archivo PostPolicy para evitar que se acceda a posts que no 
        le pertenezcan  al usuario*/
        $this->authorize('pass',$post);
        /*esta autorizacio se debe dar de alta en el archivo AuthServiceProvider par 
        que funcione correctamente*/
          $categories = Category::orderBy('name','ASC')->pluck('name','id');
        $tags       = Tag::orderBy('name','ASC')->get();
       return view('admin.posts.edit',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::find($id);
        /*se usa el metodo authorize 7 y se pasa como argumento la funccion pass
        creada en el archivo PostPolicy para evitar que se acceda a posts que no 
        le pertenezcan  al usuario*/
        $this->authorize('pass',$post);
        /*esta autorizacio se debe dar de alta en el archivo AuthServiceProvider par 
        que funcione correctamente*/
        $post->fill($request->all())->save();

         /*si se envia un a imagen desde el campo file guardar en la
       carpeta public en la carpeta image con el nombre que trae el archivo */
        if($request->file('file')){
            $path = Storage::disk('public')->put('image',$request->file('file'));
            $post->fill(['file'=>asset($path)])->save();
        }
       /* si existe relacion con un a etiqueta se sincronizara correctamente */
       $post->tags()->sync($request->get('tags'));
    
          return redirect()->route('posts.edit',$post->id)
        ->with('info','Entrada actualizada con exito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $post = Post::find($id);
       /*se usa el metodo authorize 7 y se pasa como argumento la funccion pass
        creada en el archivo PostPolicy para evitar que se acceda a posts que no 
        le pertenezcan  al usuario*/
        $this->authorize('pass',$post);
        /*esta autorizacio se debe dar de alta en el archivo AuthServiceProvider par 
        que funcione correctamente*/
        $post->delete();
       return back()->with('info','la Entrada  se ha eliminado correctamente');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;     // import Storage to enable delete of images
use App\Repositories\Posts\PostContract;

class PostsController extends Controller
{




      /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $repo;

    public function __construct(PostContract $postContract)
    {
        $this->repo = $postContract;
        $this->middleware('auth', ['except' => ['index','show']]);      // authentication access to pages [display only [index and show to guest users]]
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Maysu Blog';
        
        $posts = $this->repo->show();
        return view('posts/index', ['posts'=>$posts, 'page_title'=>$page_title]);     // homepage of blog
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required',
            'post_image' => 'image|nullable|max:1999',  // file must be an image, can be left blank, 
                                                        //  must not exceed 2mb
        ]);

        $this->repo->create($request);

        return redirect('/posts')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $post = $this->repo->findID($id);

        return view('posts/show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = $this->repo->findID($id);    // find post content with this id

        // check for correct user
        if( auth()->user()->id !== $post->user_id ){    // if current user is not the post owner
            // disallow edit access
            return redirect('/posts')->with('error', 'Unauthorized page access');  // redirect back to posts
        }
        
        return view('posts/edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         //
         $this->validate($request, [
            'title'=>'required',
            'body'=>'required',
        ]);

        $this->repo->edit($id, $request);

        return redirect('/posts')->with('success', 'Post edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $this->repo->remove($id);

        return redirect('/posts')->with('success', 'Post was deleted successfully');
    }
}

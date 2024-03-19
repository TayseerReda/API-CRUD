<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();
        // $user = auth()->user();
        // $posts = Post::where('user_id', $user->id)->get();
        // return response()->json(['status'=>200,'data'=> $posts],200);
        return PostResource::collection( $posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'title'=>'required|string|max:20',
            'description'=>'required|string|max:200',
        ]);
        if($validator->fails())
        {
            return response()->json(['status'=>422,'error'=>$validator->messages()],422);
        }
        else
        {
            Post::create([
                'title'=>$request->title,
                'description'=>$request->description,
                
            ]);
            return response()->json(['status'=>200,'message'=>'post created successfully'],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);

        return new PostResource($post);
        // return response()->json(['status'=>200,'data'=>$post],200);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
        return response()->json(['status'=>202,'message'=>'post deleted'],200);
    }
}

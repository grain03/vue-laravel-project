<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
        try{
            $posts = Post::with('Users')->get();
            return new PostCollection($posts);
        }catch(\Exception $e){
            Log::error('Error Message:', [
                'message' => $e->getMessage(),
            ]);
            return ApiResponse::error();
        }
    }

    public function store(PostRequest $postRequest){

        
        
        try{
            $request = $postRequest->validated();
            $userId = Auth::id();
            $postData = array_merge($request, ['user_id' => $userId]);;
            $post = Post::create($postData);
            return ApiResponse::success(new PostResource($post),'Post created successfully.');
        }catch(\Exception $e){
            Log::error('Error Message:', [
                'message' => $e->getMessage(),
            ]);
            return ApiResponse::error();
        }
    
    }

    public function update($id, PostRequest $request){
        
        try{
            $post = Post::find($id);
            $post->update($request->all());
            return ApiResponse::success(new PostResource($post),'Post updated successfully.');
        }catch(\Exception $e){
            Log::error('Error Message:', [
                'message' => $e->getMessage(),
            ]);
            return ApiResponse::error();
        }
        
    }

    public function show($id){
        try {
            $post = Post::find($id);
            if (!$post) {
                return ApiResponse::error('This post is Unavailable', 404);
            }
            return new PostResource($post); 
        } catch (\Exception $e) {
            Log::error('Error Message:', [
                'message' => $e->getMessage(),
            ]);
            return ApiResponse::error();
        }
    }

    public function delete($id){
        try {
            $post = Post::find($id);
            if ($post->user_id !== Auth::id()) {
                return ApiResponse::error('Unauthorized', 403);
            }
            if (!$post) {
                return ApiResponse::error('This post is Unavailable', 404);
            }
            $post = $post->delete();
                    
            if ($post) {
                return ApiResponse::success(null,'This post is deleted successfully.');
            }
        } catch (\Exception $e) {
            Log::error('Error Message:', [
                'message' => $e->getMessage(),
            ]);
            return ApiResponse::error();
        }

         
    }
}

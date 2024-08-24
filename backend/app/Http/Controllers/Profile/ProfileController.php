<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ProfileRequest;
use App\Http\Resources\Profile\ProfileResource;
use App\Models\User;
use App\Responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;

class ProfileController extends Controller
{
    public function index(){
        try{
            $user = User::find(Auth::id());
            $userData = $user->loadCount('posts');
            return new ProfileResource($userData);
        }catch(\Exception $e){
            Log::error('Error Message:', [
                'message' => $e->getMessage(),
            ]);
            return ApiResponse::error();
        }
    }

    public function edit(ProfileRequest $request){
        
        try {
            $profileData = $request->validated();
            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('profileImages'), $imageName);
                $profileData['profile_image'] = $imageName;
            }
            $userID = Auth::id();
            $user = User::find($userID);
            $user->update($profileData);
            return ApiResponse::success(new ProfileResource($user),'Profile updated successfully.');
        } catch(\Exception $e){
            Log::error('Error Message:', [
                'message' => $e->getMessage(),
            ]);
            return ApiResponse::error($e->getMessage());
        }
    }
}

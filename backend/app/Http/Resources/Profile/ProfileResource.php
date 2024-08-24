<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "data" => [
                "f_name" => $this->f_name,
                "l_name" => $this->l_name,
                "email" => $this->email,
                "profile_image" => $this->profile_image,
            ],
            "meta" => [
                "totalPosts" => $this->posts_count
            ]
        ];
    }
}

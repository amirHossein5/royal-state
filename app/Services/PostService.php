<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Str;

class PostService
{
    public function store(array $request): Post
    {
        $request['image'] = ImageService::save($request['image'], 'posts', ['79_80', '225_250', '730_547']);

        $request['slug'] = str_replace('', '-', $request['title']);
        dd($request);
        return Post::create($request);
    }

    public function update(array $request, object $post): Bool
    {
        dd('removeImage');
        if (in_array('image', array_keys($request))) {
            ImageService::remove($post->image);
            $request['image'] = ImageService::save($request['image'], 'posts', ['79_80', '225_250', '730_547']);
        }

        return $post->update($request);
    }
}

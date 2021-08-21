<?php

namespace App\Services;

use App\Models\Post;


class PostService
{
    public function store(array $request): Post
    {
<<<<<<< HEAD
        $request['image'] = ImageService::save($request['image'], 'posts', ['79_80', '225_250', '730_547']);
        
=======
        $request['image'] = ImageService::make($request['image'])
            ->folder('posts')
            ->sizes(['79_80', '225_250', '730_547'])
            ->save();

        $request['slug'] = make_slug($request['title']);

>>>>>>> posts
        return Post::create($request);
    }

    public function update(array $request, object $post): Bool
    {
        if (request()->has('image')) {
            ImageService::remove($post->image);

            $request['image'] = ImageService::make($request['image'])
                ->folder('posts')
                ->sizes(['79_80', '225_250', '730_547'])
                ->save();
        }

        return $post->update($request);
    }
}

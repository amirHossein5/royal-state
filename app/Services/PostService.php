<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function store(array $request): Post
    {
        $request['image'] = $this->saveImage($request['image']);

        $request['slug'] = make_slug($request['title']);

        return Post::create($request);
    }

    public function update(array $request, object $post): Bool
    {
        if (request()->has('image')) {
            ImageService::remove($post->image);

            $request['image'] = $this->saveImage($request['image']);
        }

        return $post->update($request);
    }

    public function forceDelete(object $post): Void
    {
        ImageService::remove($post->image);

        $post->forceDelete();
    }

    private function saveImage(object $image): array
    {
        return ImageService::make($image)
            ->folder('posts')
            ->sizes(['79_80', '225_250', '730_547'])
            ->save();
    }
}

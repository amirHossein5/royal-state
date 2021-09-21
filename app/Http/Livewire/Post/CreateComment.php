<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use App\Services\AuthService;
use Livewire\Component;

class CreateComment extends Component
{
    public array $userInformation = [];
    public array $comment = [];
    public Post $post;

    protected $listeners = ['replySetted'];

    protected function rules(): array
    {
        $rules = [];

        if (!auth()->user()) {
            $rules['userInformation.first_name'] = 'required|string';
            $rules['userInformation.last_name'] = 'required|string';
            $rules['userInformation.email'] = 'required|email';
            $rules['userInformation.password'] = 'required|confirmed';
        }

        $rules['comment.comment'] = 'required|string';
        $rules['comment.replyTo'] = 'sometimes|exists:comments,id';

        return $rules;
    }

    protected function validationAttributes()
    {
        return [
            "userInformation.first_name" => "نام",
            "userInformation.last_name"  => 'نام خانوادگی',
            "userInformation.email"      => 'ایمیل',
            "userInformation.password"   => 'رمز',

            "comment.comment"            => 'نظر',
            'comment.replyTo'            => 'replyTo'
        ];
    }

    public function replySetted(int $id)
    {
        $this->comment['replyTo'] = $id;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->validate();

        $user = !auth()->user()
            ? AuthService::setUser($this->userInformation)
            ->loginOrRegister(false)
            ->get()
            : auth()->user();

        if (is_string($user)) {
            return $this->addError('userInformation.email', $user);
        }

        $this->post->comments()->create([
            'user_id' => $user->id,
            'comment' => $this->comment['comment'],
            !array_key_exists('replyTo', $this->comment) ?: 'parent_id' => $this->comment['replyTo'] ?? ''
        ]);

        $this->reset(['comment', 'userInformation']);
        $this->emit('commentCreated');
    }

    public function render()
    {
        return view('livewire.post.create-comment');
    }
}

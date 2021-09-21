<ul class="children">
    <li class=" comment">
        <div class="flex-row mb-2 d-flex justify-content-between align-items-baseline">
            <div class="meta">


                <div class="text-left">
                    @if (auth()->user()?->id === $comment->user_id)
                        <form wire:submit.prevent="destroy({{ $comment->id }})" class="d-inline">
                            <button type="submit" class="rounded btn btn-danger btn-sm">حذف</button>
                        </form>
                    @endif
                </div>


                <small>
                    {{ jDate()->forge($comment->created_at)->format('%A, %d %B %Y, H:i:s') }}
                </small>

            </div>
            <h5>{{ $comment->user->full_name }}</h3>
        </div>
        <div class="comment-body">
            <p>{{ $comment->comment }}</p>

            <p>
                <span class="reply" style="cursor: pointer;" wire:click="setReplyTo({{ $comment->id }})">پاسخ
                </span>
            </p>

        </div>
        @foreach ($comment->children as $comment)
            @include('app.layouts.partials.comments-children',['comment'=>$comment])
        @endforeach
    </li>
</ul>

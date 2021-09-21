<form class="d-inline" wire:submit.prevent="changeStatus">
    {!! $comment->approved_button !!}

    <button wire:loading class="btn btn-secondary waves-effect waves-light">درحال انجام...</button>
</form>

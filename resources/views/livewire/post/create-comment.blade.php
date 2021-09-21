<form wire:submit.prevent="store" id="commentForm" class="p-5 bg-light">
    @csrf

    <section id="commentCreated" style="display: none">
        <p class=" text-success">نظر شما ارسال و منتظر تایید است</p>
    </section>

    @guest
        <section class="row">
            <div class="form-group col-md-6">
                <label for="name">نام</label>

                <input type="text" wire:model.lazy="userInformation.first_name" class="form-control" id="first_name">

                @error('userInformation.first_name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="name">نام خانوادگی </label>
                <input type="text" class="form-control" id="last_name" wire:model.lazy="userInformation.last_name">

                @error('userInformation.last_name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </section>

        <div class="form-group">
            <label for="email">ایمیل</label>
            <input type="email" class="form-control" id="email" wire:model.lazy="userInformation.email">

            @error('userInformation.email')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <section class="row">
            <div class="form-group col-md-6">
                <label for="password">رمز عبور</label>
                <input type="password" class="form-control" id="password" wire:model.lazy="userInformation.password">

                @error('userInformation.password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="confirmation_password"> تکرار رمز عبور</label>
                <input type="password" class="form-control" id="confirmation_password"
                    wire:model.lazy="userInformation.password_confirmation">

                @error('confirmation_password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </section>

    @endguest

    <div class="form-group">
        <label for="comment">نظر</label>
        <textarea style="direction: rtl;" id="comment" cols="30" rows="10" class="form-control"
            wire:model.lazy="comment.comment"></textarea>

        @error('comment.comment')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <input type="submit" value="ارسال نطر" class="px-4 py-3 btn btn-primary">
    </div>

</form>

@push('scripts')

    <script>
        document.addEventListener('livewire:load', function() {
            @this.on('commentCreated', () => {

                $('#commentCreated').show();

                setInterval(() => {
                    $('#commentCreated').fadeOut();
                }, 2000);
            })
        })

        Livewire.on('replySetted', () => {
            var scrollTop = $('#commentForm').offset().top - 100;

            $('html,body').animate({
                scrollTop: scrollTop
            })
        })
    </script>

@endpush

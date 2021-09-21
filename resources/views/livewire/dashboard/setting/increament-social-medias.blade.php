<fieldset class="form-group">

    <section id="updatedMessage" class="text-success" style="display: none">
        <p>با موفقیت ویرایش شد</p>
    </section>

    <label for="social_media">صفحات اجتماعی</label>

    <section id="social_medias">

        @foreach ($social_medias as $social_media)

            <section class="mt-2 row social_media_item">

                <section class="col-md-6">
                    <label for="">
                        آدرس
                    </label>

                    <input type="text" class="form-control" wire:model.lazy="social_medias.{{ $loop->index }}.url"
                        name="social_medias[{{ $loop->index }}][url]">

                    @error("social_medias.$loop->index.url")
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </section>

                <section class="col-md-6">
                    <label for="">
                        لوگو
                    </label>

                    <select wire:model="social_medias.{{ $loop->index }}.logo" class="form-control"
                        name="social_medias[{{ $loop->index }}][logo]">

                        <option value="icon-twitter">
                            twitter
                        </option>
                        <option value="icon-facebook">
                            facebook
                        </option>
                        <option value="icon-instagram">
                            instagram
                        </option>
                    </select>

                    @error("social_medias.$loop->index.logo")
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </section>
            </section>
        @endforeach

    </section>

    <button class="mt-3 btn btn-primary btn-block" type="button" wire:click.prevent="addSocial" id="add_social_media">
        اضافه کردن
    </button>

    <button class="mt-1 btn btn-danger btn-block " type="button" wire:click.prevent="removeSocial"
        id="remove_social_media">
        حذف کردن
    </button>

    <button class="mt-1 btn btn-secondary " type="button" wire:click.prevent="save" wire:loading.remove>
        ویرایش
    </button>

    <button class="mt-1 btn btn-secondary " type="button" wire:loading.block>
        درحال انجام...
    </button>
</fieldset>

@push('script')
    <script type="text/javascript">
        document.addEventListener('livewire:load', function() {

            @this.on('updated', () => {
                $('#updatedMessage').show();

                setInterval(() => {
                    $('#updatedMessage').fadeOut();
                }, 2000);
            })

        })
    </script>
@endpush

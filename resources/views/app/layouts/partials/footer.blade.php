<footer class="ftco-footer ftco-bg-dark ftco-section">
    <div class="container">
        <div class="mb-5 row">
            <div class="col-md">
                <div class="mb-4 text-left ftco-footer-widget">
                    <h2 class="ftco-heading-2">{{ $site_name }}</h2>
                    <p>{!! $short_description !!}</p>
                    <ul class="mt-5 ftco-footer-social list-unstyled float-md-left float-lft">

                        @foreach ($social_medias as $social_media)
                            <li class="ftco-animate">
                                <a href="{{ $social_media['url'] }}">
                                    <span class="{{ $social_media['logo'] }}"></span>
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>

            <div class="col-md">
                <div class="mb-4 ftco-footer-widget">
                    <h2 class="ftco-heading-2">سوالی دارید؟</h2>
                    <div class="mb-3 block-23">
                        <ul style="list-style-type: none;">
                            <li style="direction: rtl;">
                                <span class="icon icon-map-marker"></span>
                                <span class="text">
                                    {{ $address }}
                                </span>
                            </li>
                            <li style="direction: rtl;">
                                <span class="icon icon-phone"></span>
                                <span class="text">
                                    {{ $phone }}
                                </span>
                            </li>
                            <li>
                                <a href="mail:to">
                                    <span class="icon icon-envelope"></span>
                                    <span class="text">
                                        {{ $email }}
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

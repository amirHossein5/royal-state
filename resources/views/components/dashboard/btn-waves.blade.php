@props(['color'=>'info'])


<a {{ $attributes->merge(['class' => "btn btn-{$color} waves-effect waves-light"]) }}>{{ $slot }}</a>

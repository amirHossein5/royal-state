@props(['href','class'=>null,'margin'=>'', 'method'=>'post' ,'confirm' => false,'width' => null])

<form
    class="d-inline {{ $margin }}"
    action="{{ $href }}"
    method="post"
    @if ($confirm)
        onclick="return window.confirm('مطمین هستید؟')"
    @endif
>

    @csrf

    @if ($method === "delete" && !$class)
        @php $class='danger'; @endphp
        @method('delete')
    @elseif($method === "put" && !$class)
        @php $class='danger'; @endphp
        @method('put')
    @elseif(!$class)
        @php $class='success'; @endphp
    @endif

    <button type="submit"
    class="btn btn-{{ $class }} waves-effect waves-light"
    @if ($width)
        style="width: {{$width}}"
    @endif
    >{{ $slot }}</button>
</form>

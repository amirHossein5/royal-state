@props(['href', 'method'=>'post' ,'confirm' => false])

<form
    class="d-inline"
    action="{{ $href }}"
    method="post"
    @if ($confirm)
        onclick="return window.confirm('مطمین هستید؟')"
    @endif
>

    @csrf
    @if ($method === "delete")
        @php $class='danger'; @endphp
        @method('delete')
    @elseif($method === "put")
        @php $class='danger'; @endphp
        @method('put')
    @else
        @php $class='success'; @endphp
    @endif

    <button type="submit" class="btn btn-{{ $class }} waves-effect waves-light">{{ $slot }}</button>
</form>

<form method="{{ $standardMethod }}" action="{{ $action }}" {{ $attributes }} >

    @csrf
    @if ($hasMethod())
        @method($method)
    @endif

    {{ $slot }}
</form>

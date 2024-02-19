@props(['messages'])

@if ($messages)
    <ul>
        @foreach ((array) $messages as $message)
            <li class="text-danger text-opacity-75 pt-2">{{ $message }}</li>
        @endforeach
    </ul>
@endif

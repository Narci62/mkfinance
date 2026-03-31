@props(['messages'])

@if ($messages)
    <div class="text-danger">
        @foreach ((array) $messages as $message)
        <span class="fa fa-exclamation-circle fa-sm"></span> {{ $message }}
        @endforeach
    </div>
@endif
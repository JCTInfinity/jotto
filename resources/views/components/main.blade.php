@props(['poll'=>false])
<main {{ $attributes->merge(['class'=>'my-2 mx-auto max-w-5xl border border-black shadow-lg p-2 space-y-4']) }}
    @if($poll) wire:poll="{{$poll}}" @endif >
    {{ $slot }}
</main>

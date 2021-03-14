@props(['left'=>false, 'header'=>false])
<div class="@if($left) self-start @else self-end @endif sm:self-auto flex space-x-2 @if($header) font-boldsa @endif ">
    {{ $slot }}
</div>

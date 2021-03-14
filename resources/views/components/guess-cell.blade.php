@props(['left'=>false, 'header'=>false])
<div class="@if($left) self-start @else self-end @endif md:self-auto flex space-x-2 @if($header) bg-black text-white divide-x divide-white @endif ">
    {{ $slot }}
</div>

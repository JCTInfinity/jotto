@props(['player'])
@php
$active = $player->active_at > now()->subSeconds(10);
@endphp
<span class="text-xs normal-case">
    @if($active)
        <x-feathericon-activity class="inline -mt-1 h-3"/>
    @else
        <x-feathericon-zap-off class="inline -mt-1 h-3"/>
    @endif
    {{$active ? 'Active' : 'Last active '.$player->lastActive}}
</span>

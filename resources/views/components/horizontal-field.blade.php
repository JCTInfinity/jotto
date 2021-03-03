@props(['label','name'])
<div {{ $attributes->merge(['class'=>'flex items-center']) }}>
    <label class="font-bold mr-2">{{ $label ?? ucfirst($name) }}</label>
    <div>
        {{ $slot }}
        @if(isset($name))<x-error :name="$name"/>@endif
    </div>
</div>

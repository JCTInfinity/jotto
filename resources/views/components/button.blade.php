@props(['text'])
<button {{ $attributes->merge(['class'=>'px-2 py-1 bg-blue-200 rounded-lg shadow']) }}>
    {{ $text ?? $slot }}
</button>

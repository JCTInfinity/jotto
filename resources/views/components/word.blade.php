@props(['letters'])
<span {{ $attributes->merge(['class'=>'font-hand uppercase flex justify-center items-center']) }}>
    @for($i = 0; $i < 5; $i++)
        <x-letter :letter="$letters[$i] ?? ''"/>
    @endfor
</span>

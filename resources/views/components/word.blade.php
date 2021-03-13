<span {{ $attributes->merge(['class'=>'h-7 w-35 border border-black font-mono uppercase text-lg pl-2 tracking-boxes relative block']) }}>
    {{$slot}}
    <x-word-grid/>
</span>

<label class="relative block w-min">
    <input
        {{ $attributes->merge(['type'=>'text','required'=>true, 'maxlength'=>5, 'minlength'=>5,
        'class'=>'bg-white border border-black focus:tracking-input-boxes font-mono h-7 pl-2 text-lg tracking-boxes uppercase w-35']) }}>
    <x-word-grid />
</label>

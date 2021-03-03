<div class="text-lg uppercase font-hand h-7 grid grid-cols-5 divide-x divide-black border border-black"
     x-data="{
        word: @entangle($attributes->wire('model')->name()),

      }"
>
    @for($i = 0; $i < 5; $i++)
        <input type="text" maxlength="1"
        <span class="w-7"></span>
    @endfor
    <input {{ $attributes->merge(['type'=>'text','required'=>true, 'maxlength'=>5,
        'class'=>'outline-none absolute inset-0 pl-2 bg-transparent h-full text-lg uppercase font-hand border-black tracking-boxes']) }}>
</div>

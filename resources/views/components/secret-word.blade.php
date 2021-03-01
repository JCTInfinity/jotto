@props(['letters'])
<button {{ $attributes->merge(['class'=>'font-hand uppercase flex justify-center items-center cursor-pointer overflow-hidden']) }}
      x-data='{visible:false, letters: @json($letters) }' x-on:click="visible = !visible">
    @for($i = 0; $i < 5; $i++)<x-letter x-text="visible ? letters[{{$i}}] : ''" x-bind:class="{'bg-black':!visible}" />@endfor
    <x-feathericon-eye x-show="!visible" class="align-middle ml-2 h-5 w-5" title="show"/>
    <x-feathericon-eye-off x-show="visible" class="align-middle ml-2 h-5 w-5" title="hide"/>
</button>

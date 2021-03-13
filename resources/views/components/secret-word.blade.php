@props(['word'])
<button {{ $attributes->merge(['class'=>'flex justify-center items-center cursor-pointer']) }}
      x-data='{visible:false}' x-on:click="visible = !visible">
    <span class="block relative">
        <x-word class="invisible" x-bind:class="{invisible:!visible}">{{ $word }}</x-word>
        <span class="block absolute inset-0 bg-black" x-bind:class="{invisible:visible}"></span>
    </span>
    <x-feathericon-eye x-show="!visible" class="align-middle ml-2 h-5 w-5" title="show"/>
    <x-feathericon-eye-off x-cloak x-show="visible" class="align-middle ml-2 h-5 w-5" title="hide"/>
</button>

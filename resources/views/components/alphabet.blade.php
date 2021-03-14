@php
$alphabet = array_map(fn()=>null,array_flip(str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ')));
@endphp
@once
<script>
    function alphabetData(){
        return {
            ... @json($alphabet) ,
            next: function(value){
                return ({
                    null: false,
                    false: true,
                    true: null
                })[value]
            },
            style: function(value){
                return ({
                    null: 'shadow',
                    false: 'line-through text-gray-400',
                    true: 'font-bold text-green-600 border-green-600',
                })[value];
            }
        }
    }
</script>
@endonce
<div class="w-full max-w-xl mx-auto flex flex-wrap justify-evenly" x-data="alphabetData()">
    @foreach($alphabet as $letter=>$null)
        <button class="mx-2 mb-2 px-3 py-1 rounded-full border border-transparent" x-on:click="{{ $letter }} = next( {{ $letter }} )" x-bind:class="style({{$letter}})">{{$letter}}</button>
    @endforeach
</div>

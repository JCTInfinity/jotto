<x-horizontal-field :name="$attributes->wire('model')->value()">
    <input {{ $attributes->merge(['type'=>'text','required'=>true,
        'class'=>'bg-white border border-black tracking-names font-mono h-7 pl-2 text-lg tracking-boxes']) }}>
</x-horizontal-field>

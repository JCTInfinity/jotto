<x-horizontal-field :name="$attributes->wire('model')->value()">
    <input {{ $attributes->merge(['type'=>'text','required'=>true,'class'=>'rounded shadow p-2 w-full']) }}>
</x-horizontal-field>

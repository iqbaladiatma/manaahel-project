@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-gray-700 font-medium mb-2']) }}>
    {{ $value ?? $slot }}
</label>

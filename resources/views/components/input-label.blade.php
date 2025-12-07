@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-gray-700 dark:text-gray-300 font-medium mb-2']) }}>
    {{ $value ?? $slot }}
</label>

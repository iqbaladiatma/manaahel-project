@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-blue-primary dark:text-gold']) }}>
        {{ $status }}
    </div>
@endif



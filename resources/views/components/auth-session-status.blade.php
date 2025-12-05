@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-blue-primary']) }}>
        {{ $status }}
    </div>
@endif



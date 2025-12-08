<!-- Session Success Alert -->
@if(session('success'))
    <x-alert type="success" role="alert" dismissible class="mb-4">
        {{ session('success') }}
    </x-alert>
@endif

<!-- Session Error Alert -->
@if(session('error'))
    <x-alert type="error" role="alert" dismissible class="mb-4">
        {{ session('error') }}
    </x-alert>
@endif

<!-- Session Warning Alert -->
@if(session('warning'))
    <x-alert type="warning" role="alert" dismissible class="mb-4">
        {{ session('warning') }}
    </x-alert>
@endif

<!-- Session Info Alert -->
@if(session('info'))
    <x-alert type="info" role="alert" dismissible class="mb-4">
        {{ session('info') }}
    </x-alert>
@endif

<!-- Validation Errors -->
@if($errors->any())
    <x-alert type="error" role="alert" class="mb-4">
        <x-slot name="title">
            Terdapat {{ $errors->count() }} kesalahan:
        </x-slot>
        <ul class="list-disc list-inside space-y-1 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alert>
@endif

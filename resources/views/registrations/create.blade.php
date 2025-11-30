<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Register for Program') }}: {{ $program->getTranslation('name', app()->getLocale()) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Program Summary -->
                    <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <h3 class="text-lg font-semibold mb-2">{{ __('Program Details') }}</h3>
                        <div class="space-y-2">
                            <p><span class="font-semibold">{{ __('Type') }}:</span> {{ ucfirst($program->type) }}</p>
                            <p><span class="font-semibold">{{ __('Fees') }}:</span> Rp {{ number_format($program->fees, 0, ',', '.') }}</p>
                            <p><span class="font-semibold">{{ __('Start Date') }}:</span> {{ $program->start_date->format('d F Y') }}</p>
                        </div>
                    </div>

                    <!-- Registration Form -->
                    <form method="POST" action="{{ route('registrations.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Hidden Program ID -->
                        <input type="hidden" name="program_id" value="{{ $program->id }}">

                        <!-- Payment Proof Upload -->
                        <div>
                            <x-input-label for="payment_proof" :value="__('Payment Proof')" />
                            <input 
                                id="payment_proof" 
                                name="payment_proof" 
                                type="file" 
                                accept=".jpg,.jpeg,.png,.pdf"
                                class="mt-1 block w-full text-sm text-gray-900 dark:text-gray-100
                                       file:mr-4 file:py-2 file:px-4
                                       file:rounded-md file:border-0
                                       file:text-sm file:font-semibold
                                       file:bg-blue-50 file:text-blue-700
                                       hover:file:bg-blue-100
                                       dark:file:bg-blue-900 dark:file:text-blue-200
                                       dark:hover:file:bg-blue-800
                                       border border-gray-300 dark:border-gray-600 rounded-md
                                       cursor-pointer"
                                required
                            />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                {{ __('Upload proof of payment (JPG, PNG, or PDF, max 5MB)') }}
                            </p>
                            <x-input-error :messages="$errors->get('payment_proof')" class="mt-2" />
                        </div>

                        <!-- Instructions -->
                        <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                            <h4 class="font-semibold text-blue-900 dark:text-blue-200 mb-2">{{ __('Important Instructions') }}</h4>
                            <ul class="list-disc list-inside text-sm text-blue-800 dark:text-blue-300 space-y-1">
                                <li>{{ __('Please upload a clear image or PDF of your payment proof') }}</li>
                                <li>{{ __('Your registration will be reviewed by our admin team') }}</li>
                                <li>{{ __('You will be notified once your registration is approved') }}</li>
                            </ul>
                        </div>

                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                                <h4 class="font-semibold text-red-900 dark:text-red-200 mb-2">{{ __('Please correct the following errors:') }}</h4>
                                <ul class="list-disc list-inside text-sm text-red-800 dark:text-red-300 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Submit Button -->
                        <div class="flex items-center justify-between">
                            <a href="{{ route('programs.show', $program->slug) }}" 
                               class="text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                                ← {{ __('Back to Program') }}
                            </a>
                            
                            <x-primary-button>
                                {{ __('Submit Registration') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

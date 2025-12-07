<x-app-layout>
    <div class="py-12 mt-20">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                    {{ __('Register for Program') }}
                </h1>
                <p class="text-gray-600 dark:text-gray-400">
                    {{ __('Fill out the form below to register') }}
                </p>
            </div>

            <div class="bg-white dark:bg-dark-card rounded-lg shadow-lg dark:shadow-dark-border border-2 border-gray-100 dark:border-dark-border p-8">
                @if(session('error'))
                    <div class="mb-6 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 p-4 rounded">
                        <p class="text-red-700">{{ session('error') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('registrations.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Program Selection -->
                    <div class="mb-6">
                        <label for="program_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Select Program') }} <span class="text-red-500">*</span>
                        </label>
                        <select id="program_id" name="program_id" required
                                class="w-full rounded-lg border-2 border-gray-200 dark:border-dark-border focus:border-blue-primary dark:border-gold focus:ring-2 focus:ring-blue-100 transition-all">
                            <option value="">{{ __('Choose a program') }}</option>
                            @foreach($programs as $program)
                                @php
                                    $isEnrolled = in_array($program->id, $enrolledProgramIds ?? []);
                                @endphp
                                <option value="{{ $program->id }}" 
                                        {{ request('program') == $program->id ? 'selected' : '' }}
                                        {{ $isEnrolled ? 'disabled' : '' }}
                                        data-fees="{{ $program->fees }}">
                                    {{ $program->name }}
                                    @if($isEnrolled)
                                        ({{ __('Already Enrolled') }})
                                    @elseif($program->fees > 0)
                                        - Rp {{ number_format($program->fees, 0, ',', '.') }}
                                    @else
                                        - {{ __('Free') }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('program_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Notes (Optional) -->
                    <div class="mb-6">
                        <label for="notes" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Additional Notes') }} <span class="text-gray-500 dark:text-gray-500">({{ __('Optional') }})</span>
                        </label>
                        <textarea id="notes" 
                                  name="notes" 
                                  rows="4"
                                  class="w-full rounded-lg border-2 border-gray-200 dark:border-dark-border focus:border-blue-primary dark:border-gold focus:ring-2 focus:ring-blue-100 transition-all"
                                  placeholder="{{ __('Any additional information or questions...') }}"></textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Info Box -->
                    <div class="mb-6 bg-blue-50 dark:bg-blue-dark/20 border-l-4 border-blue-primary dark:border-gold p-4 rounded-r-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-primary dark:text-gold mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-blue-900 mb-1">{{ __('Registration Information') }}</p>
                                <p class="text-sm text-blue-800">
                                    {{ __('Your registration will be automatically approved. You can start accessing the program content immediately after registration.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-dark-border">
                        <a href="{{ route('programs.index') }}" 
                           class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:text-gray-100 font-medium transition-colors">
                            ← {{ __('Cancel') }}
                        </a>
                        <button type="submit" 
                                class="gradient-blue text-white px-8 py-3 rounded-full font-semibold hover:shadow-xl dark:hover:shadow-gold/20 transition-all duration-300 transform hover:scale-105">
                            {{ __('Submit Registration') }}
                        </button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</x-app-layout>



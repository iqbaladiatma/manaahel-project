<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Avatar Upload -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Profile Photo') }}</label>
            <div class="flex items-center space-x-6">
                <div class="shrink-0">
                    <div class="h-24 w-24 rounded-full border-4 border-gray-200 overflow-hidden bg-gray-100 flex items-center justify-center">
                        @if ($user->avatar_url)
                            <img id="avatar-preview" src="{{ asset('storage/' . $user->avatar_url) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                        @else
                            <span id="avatar-preview" class="text-3xl font-bold text-gray-400">{{ substr($user->name, 0, 1) }}</span>
                        @endif
                    </div>
                </div>
                <label class="block cursor-pointer">
                    <span class="inline-flex items-center px-4 py-2 bg-white border-2 border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ __('Change Photo') }}
                    </span>
                    <input id="avatar" name="avatar" type="file" class="hidden" accept="image/*" onchange="previewAvatar(event)"/>
                </label>
            </div>
            <p class="mt-2 text-xs text-gray-500">{{ __('PNG, JPG, GIF up to 2MB. Recommended: 400x400px') }}</p>
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <!-- Name & Email Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Full Name') }}</label>
                <input id="name" name="name" type="text" class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ old('name', $user->name) }}" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Email Address') }}</label>
                <input id="email" name="email" type="email" class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ old('email', $user->email) }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-3 p-3 bg-amber-50 border border-amber-200 rounded-lg">
                        <p class="text-sm text-amber-800">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification" class="underline font-semibold hover:text-amber-900">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-sm text-green-600 font-semibold">
                                {{ __('A new verification link has been sent!') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Phone & Batch Year -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Phone Number') }}</label>
                <input id="phone" name="phone" type="tel" class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ old('phone', $user->phone) }}" placeholder="+62 812 3456 7890" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            <div>
                <label for="batch_year" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Batch Year') }}</label>
                <input id="batch_year" name="batch_year" type="number" class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ old('batch_year', $user->batch_year) }}" min="1900" max="{{ date('Y') + 10 }}" placeholder="2024" />
                <x-input-error class="mt-2" :messages="$errors->get('batch_year')" />
            </div>
        </div>

        <!-- Bio -->
        <div>
            <label for="bio" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Bio') }}</label>
            <textarea id="bio" name="bio" rows="3" class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" placeholder="{{ __('Tell us about yourself...') }}">{{ old('bio', $user->bio) }}</textarea>
            <p class="mt-1 text-xs text-gray-500">{{ __('Brief description for your profile.') }}</p>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <!-- Social Media -->
        <div class="border-t border-gray-200 pt-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z"/>
                </svg>
                {{ __('Social Media Links') }}
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="instagram_url" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                        <span class="w-5 h-5 mr-2 text-pink-500">📷</span>
                        {{ __('Instagram') }}
                    </label>
                    <input id="instagram_url" name="instagram_url" type="url" class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition" value="{{ old('instagram_url', $user->instagram_url) }}" placeholder="https://instagram.com/username" />
                    <x-input-error class="mt-2" :messages="$errors->get('instagram_url')" />
                </div>

                <div>
                    <label for="linkedin_url" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                        <span class="w-5 h-5 mr-2 text-blue-700">💼</span>
                        {{ __('LinkedIn') }}
                    </label>
                    <input id="linkedin_url" name="linkedin_url" type="url" class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ old('linkedin_url', $user->linkedin_url) }}" placeholder="https://linkedin.com/in/username" />
                    <x-input-error class="mt-2" :messages="$errors->get('linkedin_url')" />
                </div>

                <div>
                    <label for="facebook_url" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                        <span class="w-5 h-5 mr-2 text-blue-600">👍</span>
                        {{ __('Facebook') }}
                    </label>
                    <input id="facebook_url" name="facebook_url" type="url" class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ old('facebook_url', $user->facebook_url) }}" placeholder="https://facebook.com/username" />
                    <x-input-error class="mt-2" :messages="$errors->get('facebook_url')" />
                </div>

                <div>
                    <label for="youtube_url" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                        <span class="w-5 h-5 mr-2 text-red-600">📺</span>
                        {{ __('YouTube') }}
                    </label>
                    <input id="youtube_url" name="youtube_url" type="url" class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition" value="{{ old('youtube_url', $user->youtube_url) }}" placeholder="https://youtube.com/c/channel" />
                    <x-input-error class="mt-2" :messages="$errors->get('youtube_url')" />
                </div>
            </div>
        </div>

        <!-- Location -->
        <div class="border-t border-gray-200 pt-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                </svg>
                {{ __('Location') }}
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="latitude" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Latitude') }}</label>
                    <input id="latitude" name="latitude" type="number" step="0.00000001" class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" value="{{ old('latitude', $user->latitude) }}" placeholder="-6.200000" />
                    <x-input-error class="mt-2" :messages="$errors->get('latitude')" />
                </div>

                <div>
                    <label for="longitude" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Longitude') }}</label>
                    <input id="longitude" name="longitude" type="number" step="0.00000001" class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" value="{{ old('longitude', $user->longitude) }}" placeholder="106.816666" />
                    <x-input-error class="mt-2" :messages="$errors->get('longitude')" />
                </div>
            </div>
            <p class="mt-2 text-xs text-gray-500">{{ __('Your location will be displayed on the member map (optional)') }}</p>
        </div>

        <!-- Save Button -->
        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
            <div class="flex items-center gap-4">
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ __('Save Changes') }}
                </button>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 3000)"
                        class="text-sm text-green-600 font-semibold flex items-center"
                    >
                        <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        {{ __('Profile updated successfully!') }}
                    </p>
                @endif
            </div>
        </div>
    </form>
</section>

<script>
function previewAvatar(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('avatar-preview');
            if (preview.tagName === 'IMG') {
                preview.src = e.target.result;
            } else {
                const img = document.createElement('img');
                img.id = 'avatar-preview';
                img.src = e.target.result;
                img.className = 'h-full w-full object-cover';
                preview.parentNode.replaceChild(img, preview);
            }
        }
        reader.readAsDataURL(file);
    }
}
</script>

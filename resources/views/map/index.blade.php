<x-app-layout>
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-blue-50 to-white pt-32 pb-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold text-gray-900 mb-4 animate-fade-in">
                {{ __('Member Map') }}
            </h1>
            <p class="text-xl text-gray-600 animate-slide-up">
                {{ __('See where our members are located around the world') }}
            </p>
        </div>
    </div>

    <div class="pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border-2 border-gray-100 overflow-hidden shadow-xl">
                <!-- Map Container -->
                <div id="map" class="w-full h-[600px] bg-gray-100"></div>

                <!-- Stats Sidebar -->
                <div class="p-8 border-t-2 border-gray-100 bg-gradient-to-br from-blue-50 to-white">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <div class="text-center p-4 bg-white rounded-xl border border-blue-100 hover:border-blue-primary transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                            <div class="text-3xl font-bold gradient-blue-text mb-2" id="total-members">-</div>
                            <div class="text-sm font-medium text-gray-600">{{ __('Total Members') }}</div>
                        </div>
                        <div class="text-center p-4 bg-white rounded-xl border border-blue-100 hover:border-blue-primary transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                            <div class="text-3xl font-bold gradient-gold-text mb-2" id="total-cities">-</div>
                            <div class="text-sm font-medium text-gray-600">{{ __('Cities') }}</div>
                        </div>
                        <div class="text-center p-4 bg-white rounded-xl border border-blue-100 hover:border-blue-primary transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                            <div class="text-3xl font-bold gradient-blue-text mb-2" id="total-countries">-</div>
                            <div class="text-sm font-medium text-gray-600">{{ __('Countries') }}</div>
                        </div>
                        <div class="text-center p-4 bg-white rounded-xl border border-gold/30 hover:border-gold transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                            <div class="text-3xl font-bold gradient-gold-text mb-2">2024</div>
                            <div class="text-sm font-medium text-gray-600">{{ __('Batch Year') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script>
        // Initialize map
        const map = L.map('map').setView([0, 0], 2);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Fetch member locations
        fetch('{{ route('map.locations') }}')
            .then(response => response.json())
            .then(data => {
                // Update stats
                document.getElementById('total-members').textContent = data.total;
                document.getElementById('total-cities').textContent = data.cities;
                document.getElementById('total-countries').textContent = data.countries || '-';

                // Add markers
                data.members.forEach(member => {
                    const marker = L.marker([member.latitude, member.longitude])
                        .addTo(map)
                        .bindPopup(`
                            <div class="text-center">
                                <strong>${member.name}</strong><br>
                                <small>${member.city || 'Unknown'}</small>
                            </div>
                        `);
                });

                // Fit bounds if there are markers
                if (data.members.length > 0) {
                    const bounds = L.latLngBounds(data.members.map(m => [m.latitude, m.longitude]));
                    map.fitBounds(bounds, { padding: [50, 50] });
                }
            });
    </script>
    @endpush
</x-app-layout>


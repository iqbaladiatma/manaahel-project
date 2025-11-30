<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Member Distribution Map') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Map Container -->
                    <div id="map" style="height: 600px; width: 100%;" class="rounded-lg"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize map with default center (Indonesia)
            const map = L.map('map').setView([-2.5489, 118.0149], 5);

            // Add OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19
            }).addTo(map);

            // Fetch member locations via AJAX
            fetch('{{ route('map.locations') }}')
                .then(response => response.json())
                .then(data => {
                    // Add markers for each member
                    data.forEach(member => {
                        const marker = L.marker([member.latitude, member.longitude]).addTo(map);
                        
                        // Create popup content with member info
                        let popupContent = `
                            <div class="text-center">
                                ${member.avatar_url ? `<img src="${member.avatar_url}" alt="${member.name}" class="w-16 h-16 rounded-full mx-auto mb-2">` : ''}
                                <strong>${member.name}</strong><br>
                                ${member.batch_year ? `Batch: ${member.batch_year}` : ''}
                            </div>
                        `;
                        
                        marker.bindPopup(popupContent);
                    });

                    // Adjust map bounds to show all markers if there are any
                    if (data.length > 0) {
                        const bounds = L.latLngBounds(data.map(m => [m.latitude, m.longitude]));
                        map.fitBounds(bounds, { padding: [50, 50] });
                    }
                })
                .catch(error => {
                    console.error('Error fetching member locations:', error);
                });
        });
    </script>
</x-app-layout>

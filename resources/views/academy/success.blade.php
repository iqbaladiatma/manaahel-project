<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-gold/5 dark:from-dark-bg dark:via-dark-card dark:to-dark-bg flex items-center justify-center py-12 px-4 transition-colors duration-200">
        <div class="max-w-2xl w-full">
            <!-- Success Icon -->
            <div class="text-center mb-8">
                <!-- Arabic Success Text -->
                <div class="mb-4">
                    <p class="text-3xl md:text-4xl font-bold text-green-600 dark:text-green-400 mb-2" style="font-family: 'Times New Roman', serif; direction: rtl;">
                        مَاشَاءَ اللّٰه تَبَارَكَ اللّٰه
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 italic">Maa Syaa Allah Tabarakallah</p>
                </div>

                <div class="inline-flex items-center justify-center w-24 h-24 gradient-gold rounded-full mb-4 shadow-lg dark:shadow-dark-border animate-bounce">
                    <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-gray-100 mb-2">Alhamdulillah, Pendaftaran Berhasil!</h1>
                <p class="text-lg text-gray-600 dark:text-gray-400">Terima kasih telah bergabung dengan program kami</p>
            </div>

            <!-- Registration Details Card -->
            <div class="bg-white dark:bg-dark-card rounded-xl shadow-lg dark:shadow-dark-border p-8 mb-6 border-t-4 border-gold dark:border-gold-dark transition-colors duration-200">
                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Detail Pendaftaran</h2>
                
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between py-2 border-b border-gray-200 dark:border-dark-border">
                        <span class="text-gray-600 dark:text-gray-400">Program:</span>
                        <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $registration->academyProgram->name }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-200 dark:border-dark-border">
                        <span class="text-gray-600 dark:text-gray-400">Nama:</span>
                        <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $registration->name }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-200 dark:border-dark-border">
                        <span class="text-gray-600 dark:text-gray-400">Email:</span>
                        <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $registration->email }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-200 dark:border-dark-border">
                        <span class="text-gray-600 dark:text-gray-400">No. WhatsApp:</span>
                        <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $registration->phone }}</span>
                    </div>
                </div>

                @if($registration->whatsapp_group_link)
                    <!-- WhatsApp Group Link -->
                    <div class="bg-green-50 dark:bg-green-900/20 border-2 border-green-200 dark:border-green-700 rounded-xl p-6 mb-6 transition-colors duration-200">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">Bergabung dengan Grup WhatsApp</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Klik tombol di bawah untuk bergabung dengan grup WhatsApp eksklusif program ini.</p>
                                <a href="{{ $registration->whatsapp_group_link }}" 
                                   target="_blank"
                                   class="inline-flex items-center bg-green-600 hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-800 text-white font-bold py-3 px-6 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg dark:shadow-dark-border">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                    Gabung Grup WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Info Box -->
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800/30 rounded-xl p-4 mb-6 transition-colors duration-200">
                    <p class="text-sm text-blue-800 dark:text-blue-300">
                        <strong>Catatan:</strong> Kami telah mengirimkan konfirmasi pendaftaran ke email Anda. 
                        Jika tidak menemukannya, silakan cek folder spam.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('academy.index') }}" 
                       class="flex-1 text-center bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold py-3 px-6 rounded-lg transition-all duration-200 transform hover:scale-105">
                        Lihat Program Lain
                    </a>
                    <a href="{{ route('home') }}" 
                       class="flex-1 text-center gradient-blue text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg dark:shadow-dark-border">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

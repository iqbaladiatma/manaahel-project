<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 gradient-blue text-white font-medium rounded-full hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-primary focus:ring-offset-2 transition shadow-md']) }}>
    {{ $slot }}
</button>

<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-6 py-3 bg-white border-2 border-blue-primary text-blue-primary font-medium rounded-full hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-primary focus:ring-offset-2 transition']) }}>
    {{ $slot }}
</button>

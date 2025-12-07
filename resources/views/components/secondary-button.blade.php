<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-6 py-3 bg-white dark:bg-dark-card border-2 border-blue-primary dark:border-gold text-blue-primary dark:text-gold font-medium rounded-full hover:bg-blue-50 dark:bg-blue-dark/20 focus:outline-none focus:ring-2 focus:ring-blue-primary focus:ring-offset-2 transition']) }}>
    {{ $slot }}
</button>

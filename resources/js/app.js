import './bootstrap';
import $ from 'jquery';

// Make jQuery available globally FIRST
window.jQuery = window.$ = $;

// Import hero carousel initialization (it will dynamically load owl-carousel)
import './hero-carousel';

// Load Alpine.js
(function() {
    if (document.querySelector('[x-data]') || document.querySelector('[x-cloak]')) {
        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js';
        script.defer = true;
        document.head.appendChild(script);
    }
})();


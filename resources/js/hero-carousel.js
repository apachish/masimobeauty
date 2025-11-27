// Dynamic import of owl-carousel
let owlCarouselPromise = null;

async function ensureOwlCarousel() {
    if (owlCarouselPromise) {
        return owlCarouselPromise;
    }
    
    // Ensure jQuery is available
    if (typeof window.jQuery === 'undefined' || typeof window.jQuery.fn === 'undefined') {
        console.error('jQuery is not available');
        return Promise.reject('jQuery not available');
    }
    
    // Dynamically import owl-carousel
    owlCarouselPromise = import('owl.carousel').then(() => {
        // Verify owlCarousel is available
        if (typeof window.jQuery.fn.owlCarousel === 'undefined') {
            throw new Error('owlCarousel plugin not loaded');
        }
        return true;
    }).catch(error => {
        console.error('Error loading owl-carousel:', error);
        owlCarouselPromise = null; // Reset on error
        throw error;
    });
    
    return owlCarouselPromise;
}

// Hero Carousel Initialization
export async function initHeroCarousel() {
    const slider = document.getElementById('Gslider');
    if (!slider) {
        return false;
    }
    
    try {
        // Ensure owl-carousel is loaded
        await ensureOwlCarousel();
    } catch (error) {
        return false;
    }
    
    // Check if jQuery and owlCarousel are available
    if (typeof window.jQuery === 'undefined' || typeof window.jQuery.fn === 'undefined' || typeof window.jQuery.fn.owlCarousel === 'undefined') {
        return false;
    }
    
    // Check if already initialized
    if (window.jQuery('#Gslider').data('owlCarousel')) {
        return true;
    }
    
    try {
        window.jQuery('#Gslider').owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            nav: true,
            dots: true,
            navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 1
                },
                992: {
                    items: 1
                }
            }
        });
        return true;
    } catch (error) {
        console.error('Error initializing Owl Carousel:', error);
        return false;
    }
}

// Auto-initialize with retry mechanism
let retryCount = 0;
const maxRetries = 50; // Max 10 seconds

async function tryInit() {
    retryCount++;
    
    // Debug logging
    if (retryCount === 1) {
        console.log('Attempting to initialize Hero Carousel...');
        console.log('jQuery available:', typeof window.jQuery !== 'undefined');
        console.log('Slider element:', document.getElementById('Gslider'));
    }
    
    const success = await initHeroCarousel();
    if (!success) {
        if (retryCount < maxRetries) {
            setTimeout(tryInit, 200);
        } else {
            console.error('Failed to initialize Hero Carousel after', maxRetries, 'attempts');
        }
    } else {
        console.log('Hero Carousel initialized successfully');
    }
}

// Wait for everything to be ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(tryInit, 100);
    });
} else {
    setTimeout(tryInit, 100);
}

window.addEventListener('load', () => {
    setTimeout(tryInit, 100);
});

// Also initialize after Livewire updates
document.addEventListener('livewire:load', () => {
    setTimeout(tryInit, 100);
});

if (typeof Livewire !== 'undefined') {
    Livewire.hook('message.processed', () => {
        setTimeout(tryInit, 200);
    });
}


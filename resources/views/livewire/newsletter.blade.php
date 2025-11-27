<div>
    <!-- Newsletter -->
    <section class="newsletter">
        <div class="container">
            <h2>Join our cosmetics news & offers.</h2>
            <form class="newsletter-form" wire:submit.prevent="subscribe">
                <input type="email" placeholder="E-mail address" wire:model="email" required>
                <button type="submit"><i class="fas fa-envelope"></i></button>
            </form>
            @if (session()->has('message'))
                <div class="alert alert-success mt-3">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </section>
</div>

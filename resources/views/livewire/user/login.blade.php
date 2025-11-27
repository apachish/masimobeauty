<section class="shop login section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="login-form">
                    <h2>Login</h2>
                    <p>Please register in order to checkout more quickly</p>
                    <!-- Form -->
                    <form class="form" method="post" wire:submit.prevent="login">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Your Email<span>*</span></label>
                                    <input type="email"  placeholder="" required="required" wire:model.defer="email">
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Your Password<span>*</span></label>
                                    <input type="password" wire:model.defer="password" placeholder="" required="required" >
                                    @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group login-btn">
                                    <button class="btn btn-login" type="submit">Login</button>
                                    <a href="{{route('register.user')}}" class="register-link">Register</a>
                                    <span class="or-separator">OR</span>
                                    <a href="{{route('login.redirect','facebook')}}" class="btn btn-social btn-facebook"><i class="ti-facebook"></i></a>
                                    <a href="{{route('login.redirect','github')}}" class="btn btn-social btn-github"><i class="ti-github"></i></a>
                                    <a href="{{route('login.redirect','google')}}" class="btn btn-social btn-google"><i class="ti-google"></i></a>
                                </div>
                                <div class="form-footer">
                                <div class="checkbox">
                                    <label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox">Remember me</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="lost-pass" href="{{ route('password.request') }}">
                                        Lost your password?
                                    </a>
                                @endif
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--/ End Form -->
                </div>
            </div>
        </div>
    </div>
</section>


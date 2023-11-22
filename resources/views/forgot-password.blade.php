<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <div class="login-brand">
                    <img src="{{ asset('uploads/logo/' . DB::table('tokos')->first()->logo) }}" alt="logo"
                        width="100" class="shadow-light rounded-circle">
                </div>
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="card card-primary">
            <div class="card-header">
                <h4>Lupa Password</h4>
            </div>
            <div class="card-body">
                <form method="GET" action="/lupa-password/get-email" class="needs-validation" novalidate="">

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email" tabindex="1" required
                            autofocus>
                        <div class="invalid-feedback">
                            Please fill in your email
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                            Lupa Password
                        </button>
                    </div>
                </form>



            </div>
        </div>

        <div class="text-muted text-center">
            Kembali lagi ke <a href="{{ route('login') }}">Login</a>
        </div>

    </x-auth-card>
</x-guest-layout>

<x-guest-layout>
    @include('sweetalert::alert')
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
                <form method="POST" action="/lupa-password" class="needs-validation" novalidate="">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email" tabindex="1" required
                            autofocus value="{{ $user->email }}" readonly>
                        <div class="invalid-feedback">
                            Please fill in your email
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Password Baru</label>
                        <input type="password" class=" form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label for="">Konfirmasi Password Baru</label>
                        <input type="password" class=" form-control" name="password_confirmation">
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                            Ubah Password
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

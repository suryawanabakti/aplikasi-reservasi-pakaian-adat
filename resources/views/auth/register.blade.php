<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <div class="login-brand">
                    {{-- <img src="/images/logo.png" alt="logo" width="200" class="shadow-light "> --}}
                </div>
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />


        <div class="card card-primary">
            <div class="card-header">
                <h4>Register</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate="">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input id="name" type="text" class="form-control" name="name" tabindex="1" required
                            autofocus>
                        <div class="invalid-feedback">
                            Please fill in your name
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input id="alamat" type="text" class="form-control" name="alamat" tabindex="1" required
                            autofocus>
                        <div class="invalid-feedback">
                            Please fill in your alamat
                        </div>
                    </div>

                    @php
                        if (empty(DB::table('tokos')->first())) {
                            $hidden = '';
                        } else {
                            $hidden = 'hidden';
                        }
                    @endphp
                    <div class="form-group" {{ $hidden }}>
                        <label class="form-label">Role</label>
                        <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                                <input type="radio" name="role" value="customer" class="selectgroup-input"
                                    checked="">
                                <span class="selectgroup-button">Customer</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="role" value="admintoko" class="selectgroup-input">
                                <span class="selectgroup-button">Penjual</span>
                            </label>
                        </div>
                    </div>




                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email" tabindex="1" required
                            autofocus>
                        <div class="invalid-feedback">
                            Please fill in your email
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki - Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">Password</label>
                        </div>
                        <input id="password" type="password" class="form-control" name="password" tabindex="2"
                            required>
                        <div class="invalid-feedback">
                            please fill in your password
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Password Confirmation</label>
                        <input id="password_confirmation" type="password" class="form-control"
                            name="password_confirmation" tabindex="2" required>
                        <div class="invalid-feedback">
                            please fill in your password confirmation
                        </div>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                            Register
                        </button>
                    </div>
                </form>



            </div>
        </div>

        <div class="mt-5 text-muted text-center">
            Do you have an account? <a href="{{ route('login') }}">Login here</a>
        </div>
    </x-auth-card>
</x-guest-layout>

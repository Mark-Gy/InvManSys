<x-guest-layout>
    <style>
        body {
            background: url('https://wallpapershome.com/images/pages/pic_h/17796.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            padding: 2.5rem;
            color: white;
        }

        .glass-input {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            border-radius: 10px;
            padding: 0.75rem 1rem;
        }

        .glass-input::placeholder {
            color: rgba(255, 255, 255, 0.8);
        }

        .glass-input:focus {
            background: rgba(255, 255, 255, 0.3);
            outline: none;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .glass-btn {
            background-color: #007bff;
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 10px;
            transition: 0.3s;
        }

        .glass-btn:hover {
            background-color: #0056b3;
            box-shadow: 0 4px 20px rgba(0, 123, 255, 0.4);
            transform: translateY(-2px);
        }

        h2, label, .text-sm {
            color: white;
        }

        .text-red-500, .text-gray-600 {
            color:rgb(224, 43, 43) !important;
        }

        #password-requirements li {
            color:rgb(255, 255, 255);
        }

        #password-requirements li.valid {
            color: #9fff9f;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 glass-card">
            <div class="mb-8 text-center">
                <h2 class="text-2xl font-bold text-white">Create Account</h2>
                <p class="text-white opacity-80">Register to get started</p>
            </div>

            @if ($errors->any())
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: `{!! implode('<br>', $errors->all()) !!}`,
                        confirmButtonColor: '#d33'
                    });
                </script>
            @endif

            @if (session('status') === 'account-created')
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Account created successfully!',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        allowOutsideClick: false
                    }).then(() => {
                        window.location.href = "{{ route('login') }}";
                    });
                </script>
            @endif

            <form method="POST" action="{{ route('register') }}" onsubmit="return validateForm(event)">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-white mb-1">{{ __('Name') }}</label>
                    <input id="name" class="glass-input block w-full" type="text" name="name" value="{{ old('name') }}" autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <label for="email" class="block text-sm font-medium text-white mb-1">{{ __('Email') }}</label>
                    <input id="email" class="glass-input block w-full" type="email" name="email" value="{{ old('email') }}" autocomplete="username" />
                </div>

                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-white mb-1">{{ __('Password') }}</label>
                    <input id="password" class="glass-input block w-full" type="password" name="password" autocomplete="new-password" 
                        pattern="^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#$%^&*]).{8,}$"
                        oninput="validatePassword()" />

                    <div id="password-requirements" class="text-xs mt-2">
                        <p>Password must contain:</p>
                        <ul class="list-disc pl-5">
                            <li id="length">At least 8 characters</li>
                            <li id="letter">At least 1 letter</li>
                            <li id="number">At least 1 number</li>
                            <li id="special">At least 1 special character (!@#$%^&*)</li>
                        </ul>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-white mb-1">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" class="glass-input block w-full" type="password" name="password_confirmation" autocomplete="new-password" />
                </div>

                <div class="flex items-center justify-end mt-6">
                    <a class="text-sm text-blue-200 hover:text-white underline" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <button type="submit" class="glass-btn ms-4">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function validatePassword() {
            const password = document.getElementById('password').value;
            document.getElementById('length').classList.toggle('valid', password.length >= 8);
            document.getElementById('letter').classList.toggle('valid', /[a-zA-Z]/.test(password));
            document.getElementById('number').classList.toggle('valid', /[0-9]/.test(password));
            document.getElementById('special').classList.toggle('valid', /[!@#$%^&*]/.test(password));
        }

        function validateForm(event) {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (!name || !email || !password || !confirmPassword) {
                event.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'All fields are required!',
                    confirmButtonColor: '#3085d6'
                });
                return false;
            }

            if (password !== confirmPassword) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Passwords do not match!',
                    confirmButtonColor: '#d33'
                });
                return false;
            }

            return true;
        }
    </script>
</x-guest-layout>

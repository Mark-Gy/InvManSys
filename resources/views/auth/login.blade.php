<x-guest-layout>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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

        .glass-link {
            color: #cce3ff;
            text-decoration: none;
            font-weight: 500;
        }

        .glass-link:hover {
            color: white;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
            text-decoration: underline;
        }

        .glass-checkbox {
            accent-color: #007bff;
        }

        h2, label, .text-sm {
            color: white;
        }

        .text-red-100 {
            color: #ff9999;
        }

        .text-green-100 {
            color: #9fff9f;
        }
        
        .forgot-password-link {
            display: block;
            margin-top: 10px;
            color: #cce3ff;
            text-decoration: none;
            font-weight: 500;
            text-align: right;
            font-size: 0.875rem;
        }
        
        .forgot-password-link:hover {
            color: white;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
            text-decoration: underline;
        }
    </style>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 glass-card">
            <div class="mb-8 text-center">
                <h2 class="text-2xl font-bold text-white">Welcome</h2>
                <p class="text-white opacity-80">Sign in to your account</p>
            </div>

            @if ($errors->any())
                <div id="validation-errors" style="display: none;">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('status'))
                <div id="status-message" style="display: none;" data-message="{{ session('status') }}"></div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-white mb-1">{{ __('Email') }}</label>
                    <input id="email" class="glass-input block w-full" type="email" name="email" value="{{ old('email') }}" autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-white mb-1">{{ __('Password') }}</label>
                    <input id="password" class="glass-input block w-full" type="password" name="password" autocomplete="current-password" />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" id="remember_me" name="remember" class="glass-checkbox" />
                        <span class="text-sm text-white">{{ __('Remember me') }}</span>
                    </label>
                    <a href="javascript:void(0)" class="forgot-password-link text-sm" id="forgotPassword">Forgot your password?</a>
                </div>

                <div class="mt-6 text-center">
                    <button type="submit" class="glass-btn">
                        {{ __('Log in') }}
                    </button>
                </div>

                <div class="mt-6 text-center">
                    @if (Route::has('register'))
                        <a class="glass-link text-sm" href="{{ route('register') }}">
                            {{ __('Don\'t have an account? Register') }}
                        </a>
                    @endif
                </div>

            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const validationErrors = document.getElementById('validation-errors');
            if (validationErrors) {
                const errorMessages = [];
                const errorDivs = validationErrors.querySelectorAll('div');
                errorDivs.forEach(div => {
                    errorMessages.push(div.textContent);
                });
                
                if (errorMessages.length > 0) {
                    Swal.fire({
                        title: 'Error',
                        html: errorMessages.join('<br>'),
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#007bff',
                        background: 'rgba(255, 255, 255, 0.9)',
                        backdrop: 'rgba(0, 0, 0, 0.4)',
                        customClass: {
                            title: 'text-red-500',
                            content: 'font-medium'
                        }
                    });
                }
            }

            const statusMessage = document.getElementById('status-message');
            if (statusMessage && statusMessage.dataset.message) {
                Swal.fire({
                    title: 'Success',
                    text: statusMessage.dataset.message,
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#007bff',
                    background: 'rgba(255, 255, 255, 0.9)',
                    backdrop: 'rgba(0, 0, 0, 0.4)'
                });
            }

            document.getElementById('forgotPassword').addEventListener('click', function() {
                Swal.fire({
                    title: 'Forgot Password',
                    text: 'Please contact the administrator to reset your password.',
                    icon: 'info',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#007bff',
                    background: 'rgba(255, 255, 255, 0.9)',
                    backdrop: 'rgba(0, 0, 0, 0.4)',
                });
            });

            document.getElementById('loginForm').addEventListener('submit', function(event) {
                const email = document.getElementById('email').value.trim();
                const password = document.getElementById('password').value.trim();
                let hasError = false;
                let errorMessage = '';

                if (!email) {
                    hasError = true;
                    errorMessage += 'Email is required.<br>';
                }

                if (!password) {
                    hasError = true;
                    errorMessage += 'Password is required.<br>';
                }

                if (hasError) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Error',
                        html: errorMessage,
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#007bff',
                        background: 'rgba(255, 255, 255, 0.9)',
                        backdrop: 'rgba(0, 0, 0, 0.4)'
                    });
                }
            });
        });
    </script>
</x-guest-layout>

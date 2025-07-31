<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* ANIMASI GRADIENT BACKGROUND */
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #4a1d96 100%);
            background-size: 300% 300%;
            animation: gradient 12s ease infinite, pulseBg 8s ease infinite alternate;
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes pulseBg {
            0% { filter: brightness(100%); }
            50% { filter: brightness(110%); }
            100% { filter: brightness(100%); }
        }

        /* ANIMASI KARTU LOGIN */
        .login-card {
            animation: 
                fadeInUp 0.8s ease-out forwards,
                floatCard 6s ease-in-out infinite;
            transform-style: preserve-3d;
            perspective: 1000px;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px) rotateX(15deg);
            }
            to {
                opacity: 1;
                transform: translateY(0) rotateX(0);
            }
        }
        
        @keyframes floatCard {
            0%, 100% { transform: translateY(0) rotate(0.5deg); }
            50% { transform: translateY(-15px) rotate(-0.5deg); }
        }

        /* ANIMASI ELEMEN DEKORATIF */
        .floating-particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            animation: floatParticle 15s linear infinite;
            filter: blur(1px);
        }
        
        @keyframes floatParticle {
            0% { transform: translateY(0) translateX(0); opacity: 0; }
            10% { opacity: 0.1; }
            90% { opacity: 0.1; }
            100% { transform: translateY(-100vh) translateX(20vw); opacity: 0; }
        }

        /* ANIMASI TOMBOL & INTERAKSI */
        .btn-magic {
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transform: translateZ(0);
        }
        
        .btn-magic:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 30px -10px rgba(102, 126, 234, 0.5);
        }
        
        .btn-magic:active {
            transform: translateY(1px) scale(0.98);
        }
        
        .btn-magic::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }
        
        .btn-magic:hover::after {
            transform: translateX(100%);
        }

        /* ANIMASI TRANSISI HALAMAN */
        .page-transition {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #4a1d96 0%, #764ba2 100%);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            clip-path: circle(0% at 50% 50%);
        }
        
        .transition-active {
            animation: circleReveal 1.2s cubic-bezier(0.77, 0, 0.175, 1) forwards;
        }
        
        @keyframes circleReveal {
            0% { clip-path: circle(0% at 50% 50%); }
            100% { clip-path: circle(150% at 50% 50%); }
        }

        /* ANIMASI INPUT FIELD */
        .input-field {
            transition: all 0.3s ease;
            transform: translateZ(0);
        }
        
        .input-field:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px -5px rgba(102, 126, 234, 0.3);
        }
        
        .input-field:focus {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px -8px rgba(102, 126, 234, 0.4) !important;
        }

        /* ANIMASI SPARKLE */
        .sparkle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: white;
            border-radius: 50%;
            opacity: 0;
            animation: sparkle 1.5s ease-out infinite;
        }
        
        @keyframes sparkle {
            0% { transform: scale(0); opacity: 0; }
            50% { transform: scale(1); opacity: 0.8; }
            100% { transform: scale(0); opacity: 0; }
        }
    </style>
</head>
<body class="font-sans antialiased overflow-x-hidden">

    <!-- Transition Overlay -->
    <div id="page-transition" class="page-transition">
        <div class="text-center text-white">
            <div class="w-24 h-24 mx-auto mb-6 animate-spin">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-white">
                    <path d="M12 2C6.477 2 2 6.477 2 12C2 17.523 6.477 22 12 22C17.523 22 22 17.523 22 12C22 6.477 17.523 2 12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="1 4"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold mb-2">Mempersiapkan halaman...</h2>
            <p class="text-indigo-200">Hang on tight!</p>
        </div>
    </div>

    <div class="min-h-screen gradient-bg flex flex-col sm:justify-center items-center p-4 relative overflow-hidden">
        <!-- Floating Particles Background -->
        <div id="particles-container" class="absolute inset-0 overflow-hidden"></div>
        
        <!-- Main Login Card -->
        <div id="login-card" class="login-card w-full max-w-md p-8 space-y-8 bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl mx-4 sm:mx-0 relative z-10 border border-white/20">
            <!-- Sparkle Effects -->
            <div id="sparkles-container" class="absolute inset-0 overflow-hidden pointer-events-none"></div>
            
            <div class="text-center">
                <a href="/" class="flex justify-center transform hover:scale-105 transition-transform duration-300">
                    <x-application-logo class="w-20 h-20 fill-current text-indigo-600 drop-shadow-lg hover:drop-shadow-xl transition-all duration-300" />
                </a>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                    Sign in to your account
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Or
                    <a href="{{ route('register') }}" id="register-link" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-300 relative group">
                        <span class="relative">
                            create a new account
                            <span class="absolute left-0 bottom-0 h-0.5 bg-indigo-500 w-0 group-hover:w-full transition-all duration-500"></span>
                        </span>
                    </a>
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 p-4 bg-green-100/90 text-green-700 rounded-lg" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6" id="login-form">
                @csrf

                <div class="rounded-md shadow-sm space-y-4">
                    <!-- Username Field -->
                    <div class="space-y-1 relative">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1 transition-all duration-300">Username</label>
                        <input 
                            id="name" 
                            name="name" 
                            type="name" 
                            autocomplete="name" 
                            required 
                            value="{{ old('name') }}"
                            class="input-field appearance-none relative block w-full px-4 py-3 border border-gray-300/80 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent sm:text-sm bg-white/90 backdrop-blur-sm"
                            placeholder="Username">
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-1 relative">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1 transition-all duration-300">Password</label>
                        <div class="relative">
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                autocomplete="current-password" 
                                required 
                                class="input-field appearance-none relative block w-full px-4 py-3 border border-gray-300/80 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent sm:text-sm bg-white/90 backdrop-blur-sm pr-10"
                                placeholder="••••••••">
                            <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-indigo-600 focus:outline-none transition-colors duration-300 transform hover:scale-125">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input 
                            id="remember_me" 
                            name="remember" 
                            type="checkbox" 
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded transition-all duration-300 transform hover:scale-110 cursor-pointer">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700 hover:text-gray-900 transition-colors duration-300 cursor-pointer">
                            Remember me
                        </label>
                    </div>

                    <!-- Forgot Password -->
                    @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-300 transform hover:translate-x-1 inline-block">
                                Forgot your password?
                            </a>
                        </div>
                    @endif
                </div>

                <div>
                    <button type="submit" id="submit-btn" class="btn-magic group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3 transform group-hover:translate-x-2 transition-transform duration-500">
                            <svg class="h-5 w-5 text-indigo-300 group-hover:text-white transition-colors duration-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <span id="button-text">Sign in</span>
                        <span id="button-spinner" class="hidden ml-2">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                    </button>
                </div>
            </form>

            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300/50"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white/95 text-gray-500 backdrop-blur-sm">
                            Or continue with
                        </span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <div>
                        <a href="#" class="social-btn w-full inline-flex justify-center py-2 px-4 border border-gray-300/80 rounded-md shadow-sm bg-white/90 hover:bg-gray-50 text-sm font-medium text-gray-500 hover:text-gray-700 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-md backdrop-blur-sm">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.477 0 10c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.342-3.369-1.342-.454-1.155-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0110 4.844c.85.004 1.705.114 2.504.336 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.933.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C17.14 18.163 20 14.418 20 10c0-5.523-4.477-10-10-10z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>

                    <div>
                        <a href="#" class="social-btn w-full inline-flex justify-center py-2 px-4 border border-gray-300/80 rounded-md shadow-sm bg-white/90 hover:bg-gray-50 text-sm font-medium text-gray-500 hover:text-gray-700 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-md backdrop-blur-sm">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ======================
            // PARTICLE BACKGROUND
            // ======================
            const particlesContainer = document.getElementById('particles-container');
            if (particlesContainer) {
                const particleCount = 20;
                
                for (let i = 0; i < particleCount; i++) {
                    const particle = document.createElement('div');
                    particle.classList.add('floating-particle');
                    
                    // Random size
                    const size = Math.random() * 10 + 5;
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    
                    // Random position
                    particle.style.left = `${Math.random() * 100}%`;
                    particle.style.top = `${Math.random() * 100}%`;
                    
                    // Random animation duration and delay
                    const duration = Math.random() * 20 + 10;
                    const delay = Math.random() * 10;
                    particle.style.animationDuration = `${duration}s`;
                    particle.style.animationDelay = `${delay}s`;
                    
                    particlesContainer.appendChild(particle);
                }
            }

            // ======================
            // SPARKLE EFFECTS
            // ======================
            const sparklesContainer = document.getElementById('sparkles-container');
            const loginCard = document.getElementById('login-card');
            
            function createSparkle() {
                if (!sparklesContainer) return;
                
                const sparkle = document.createElement('div');
                sparkle.classList.add('sparkle');
                
                // Random position
                sparkle.style.left = `${Math.random() * 100}%`;
                sparkle.style.top = `${Math.random() * 100}%`;
                
                // Random delay
                sparkle.style.animationDelay = `${Math.random() * 2}s`;
                
                sparklesContainer.appendChild(sparkle);
                
                // Remove sparkle after animation
                setTimeout(() => {
                    sparkle.remove();
                }, 1500);
            }
            
            // Create initial sparkles
            if (sparklesContainer) {
                for (let i = 0; i < 8; i++) {
                    createSparkle();
                }
                
                // Continuous sparkles
                setInterval(createSparkle, 300);
            }

            // ======================
            // PASSWORD TOGGLE
            // ======================
            const togglePassword = document.getElementById('toggle-password');
            const passwordInput = document.getElementById('password');
            
            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    // Add animation class
                    this.classList.add('animate-ping');
                    setTimeout(() => this.classList.remove('animate-ping'), 500);
                    
                    // Change icon
                    const icon = this.querySelector('svg');
                    if (icon) {
                        if (type === 'password') {
                            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
                        } else {
                            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
                        }
                    }
                });
            }

            // ======================
            // FORM SUBMISSION
            // ======================
            const loginForm = document.getElementById('login-form');
            const submitBtn = document.getElementById('submit-btn');
            const buttonText = document.getElementById('button-text');
            const buttonSpinner = document.getElementById('button-spinner');
            
            if (loginForm && submitBtn && buttonText && buttonSpinner) {
                loginForm.addEventListener('submit', function(e) {
                    if (this.checkValidity()) {
                        e.preventDefault();
                        
                        // Show loading state
                        buttonText.textContent = 'Signing in...';
                        buttonSpinner.classList.remove('hidden');
                        submitBtn.disabled = true;
                        
                        // Add ripple effect
                        const ripple = document.createElement('span');
                        ripple.classList.add('absolute', 'rounded-full', 'bg-white/30');
                        ripple.style.width = '10px';
                        ripple.style.height = '10px';
                        ripple.style.animation = 'ripple 1s linear';
                        submitBtn.appendChild(ripple);
                        
                        // Remove ripple after animation
                        setTimeout(() => {
                            if (ripple.parentNode === submitBtn) {
                                ripple.remove();
                            }
                        }, 1000);
                        
                        // Simulate network delay
                        setTimeout(() => {
                            this.submit();
                        }, 2000);
                    }
                });
            }

            // ======================
            // PAGE TRANSITION
            // ======================
            const registerLink = document.getElementById('register-link');
            const pageTransition = document.getElementById('page-transition');
            
            if (registerLink && pageTransition) {
                registerLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    const href = this.getAttribute('href');
                    
                    // Show transition
                    pageTransition.classList.add('transition-active');
                    
                    // Navigate after animation
                    setTimeout(() => {
                        window.location.href = href;
                    }, 1000);
                });
            }

            // ======================
            // INPUT FIELD EFFECTS - FIXED VERSION
            // ======================
            const inputs = document.querySelectorAll('.input-field');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    const parent = this.parentElement;
                    if (parent) {
                        const label = parent.querySelector('label');
                        if (label) {
                            label.classList.add('text-indigo-600', 'font-bold');
                        }
                        parent.classList.add('ring-2', 'ring-indigo-500/30');
                    }
                });
                
                input.addEventListener('blur', function() {
                    const parent = this.parentElement;
                    if (parent) {
                        const label = parent.querySelector('label');
                        if (label) {
                            label.classList.remove('text-indigo-600', 'font-bold');
                        }
                        parent.classList.remove('ring-2', 'ring-indigo-500/30');
                    }
                });
            });

            // ======================
            // SOCIAL BUTTON HOVER
            // ======================
            const socialButtons = document.querySelectorAll('.social-btn');
            socialButtons.forEach(btn => {
                btn.addEventListener('mouseenter', function() {
                    const icon = this.querySelector('svg');
                    if (icon) {
                        icon.classList.add('animate-bounce');
                        setTimeout(() => icon.classList.remove('animate-bounce'), 1000);
                    }
                });
            });
        });
    </script>
</body>
</html>
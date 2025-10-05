<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Professional Healthcare Management</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <x-application-logo class="w-10 h-10 fill-current text-indigo-600" />
                        <span class="ml-3 text-xl font-bold text-gray-900">HealthCare Pro</span>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                            <a href="#register" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">Get Started</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-indigo-50 via-white to-blue-50 pt-24 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                        Professional
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-600">
                            Healthcare
                        </span>
                        Management
                    </h1>
                    <p class="text-xl text-gray-600 leading-relaxed">
                        Streamline your healthcare operations with our comprehensive management system. 
                        Connect patients, doctors, and administrators in one secure platform.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#register" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-lg text-lg font-semibold transition duration-150 ease-in-out transform hover:scale-105 shadow-lg">
                            Start Free Trial
                        </a>
                        <a href="#features" class="border-2 border-indigo-600 text-indigo-600 hover:bg-indigo-600 hover:text-white px-8 py-4 rounded-lg text-lg font-semibold transition duration-150 ease-in-out">
                            Learn More
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <div class="bg-white rounded-2xl shadow-2xl p-8 transform rotate-3 hover:rotate-0 transition duration-300">
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                                <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                                <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                            </div>
                            <div class="bg-gray-100 rounded-lg p-4">
                                <div class="flex items-center space-x-3 mb-3">
                                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900">Dr. Sarah Johnson</div>
                                        <div class="text-sm text-gray-500">Cardiologist</div>
                                    </div>
                                </div>
                                <div class="text-sm text-gray-600">
                                    Patient consultation scheduled for tomorrow at 2:00 PM
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Floating Elements -->
        <div class="absolute top-20 right-20 w-20 h-20 bg-blue-200 rounded-full opacity-20 animate-pulse"></div>
        <div class="absolute bottom-20 left-20 w-16 h-16 bg-indigo-200 rounded-full opacity-20 animate-pulse delay-1000"></div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Why Choose HealthCare Pro?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Our platform provides everything you need to manage healthcare operations efficiently and securely.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gradient-to-br from-indigo-50 to-blue-50 p-8 rounded-2xl hover:shadow-xl transition duration-300">
                    <div class="w-16 h-16 bg-indigo-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Secure Patient Data</h3>
                    <p class="text-gray-600">HIPAA-compliant data storage with end-to-end encryption and secure access controls.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-8 rounded-2xl hover:shadow-xl transition duration-300">
                    <div class="w-16 h-16 bg-green-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Efficient Scheduling</h3>
                    <p class="text-gray-600">Smart appointment scheduling with automated reminders and conflict detection.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-8 rounded-2xl hover:shadow-xl transition duration-300">
                    <div class="w-16 h-16 bg-purple-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Health Analytics</h3>
                    <p class="text-gray-600">Comprehensive health insights and reporting for better patient care decisions.</p>
                </div>
                
                <!-- Feature 4 -->
                <div class="bg-gradient-to-br from-yellow-50 to-orange-50 p-8 rounded-2xl hover:shadow-xl transition duration-300">
                    <div class="w-16 h-16 bg-yellow-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Role-Based Access</h3>
                    <p class="text-gray-600">Secure role-based access control for doctors, nurses, and administrators.</p>
                </div>
                
                <!-- Feature 5 -->
                <div class="bg-gradient-to-br from-red-50 to-pink-50 p-8 rounded-2xl hover:shadow-xl transition duration-300">
                    <div class="w-16 h-16 bg-red-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" viewBox="0 0 100 100" fill="currentColor">
                            <circle cx="50" cy="50" r="45" fill="currentColor" opacity="0.1"/>
                            <rect x="45" y="25" width="10" height="50" fill="currentColor" rx="2"/>
                            <rect x="25" y="45" width="50" height="10" fill="currentColor" rx="2"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Health Tips</h3>
                    <p class="text-gray-600">Curated health tips and educational content for patients and healthcare providers.</p>
                </div>
                
                <!-- Feature 6 -->
                <div class="bg-gradient-to-br from-teal-50 to-cyan-50 p-8 rounded-2xl hover:shadow-xl transition duration-300">
                    <div class="w-16 h-16 bg-teal-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Real-time Updates</h3>
                    <p class="text-gray-600">Instant notifications and real-time updates for all healthcare activities.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Registration Section -->
    <section id="register" class="py-20 bg-gradient-to-br from-indigo-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Join HealthCare Pro Today</h2>
                                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Choose your role and start managing healthcare operations with our secure platform. 
                        <span class="text-sm text-gray-500 block mt-2">Administrator accounts are created through secure internal processes.</span>
                    </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Doctor Registration -->
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="p-6 text-center">
                        <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-blue-600" viewBox="0 0 100 100" fill="currentColor">
                                <circle cx="50" cy="50" r="45" fill="currentColor" opacity="0.1"/>
                                <rect x="45" y="25" width="10" height="50" fill="currentColor" rx="2"/>
                                <rect x="25" y="45" width="50" height="10" fill="currentColor" rx="2"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Doctor</h3>
                        <p class="text-gray-600 mb-4 text-sm">Patient care and health tips management</p>
                        <button onclick="openRegistrationModal('doctor')" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-150 ease-in-out">
                            Register as Doctor
                        </button>
                    </div>
                </div>
                
                <!-- Nurse Registration -->
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="p-6 text-center">
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-green-600" viewBox="0 0 100 100" fill="currentColor">
                                <circle cx="50" cy="50" r="45" fill="currentColor" opacity="0.1"/>
                                <rect x="45" y="25" width="10" height="50" fill="currentColor" rx="2"/>
                                <rect x="25" y="45" width="50" height="10" fill="currentColor" rx="2"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Nurse</h3>
                        <p class="text-gray-600 mb-4 text-sm">Patient care and limited administrative access</p>
                        <button onclick="openRegistrationModal('nurse')" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition duration-150 ease-in-out">
                            Register as Nurse
                        </button>
                    </div>
                </div>
                
                <!-- Patient Registration -->
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="p-6 text-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-gray-600" viewBox="0 0 100 100" fill="currentColor">
                                <circle cx="50" cy="50" r="45" fill="currentColor" opacity="0.1"/>
                                <rect x="45" y="25" width="10" height="50" fill="currentColor" rx="2"/>
                                <rect x="25" y="45" width="50" height="10" fill="currentColor" rx="2"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Patient</h3>
                        <p class="text-gray-600 mb-4 text-sm">Personal health management and tips access</p>
                        <button onclick="openRegistrationModal('patient')" class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition duration-150 ease-in-out">
                            Register as Patient
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

            <!-- Health Tips Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Today's Health Tips</h2>
                <p class="text-xl text-gray-600">Stay informed with expert health advice and wellness tips</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="health-tips-container">
                <!-- Loading state -->
                <div class="text-center text-gray-500 col-span-full">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600 mx-auto mb-4"></div>
                    <p>Loading health tips...</p>
                </div>
            </div>
        </div>
    </section>

        <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <x-application-logo class="w-10 h-10 fill-current text-white" />
                        <span class="ml-3 text-xl font-bold">HealthCare Pro</span>
                    </div>
                    <p class="text-gray-400">Professional healthcare management platform for modern medical facilities.</p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Platform</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#features" class="hover:text-white transition duration-150">Features</a></li>
                        <li><a href="#register" class="hover:text-white transition duration-150">Registration</a></li>
                        <li><a href="#" class="hover:text-white transition duration-150">Pricing</a></li>
                        <li><a href="#" class="hover:text-white transition duration-150">Security</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Support</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition duration-150">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition duration-150">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition duration-150">Documentation</a></li>
                        <li><a href="#" class="hover:text-white transition duration-150">Training</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Legal</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition duration-150">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition duration-150">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition duration-150">HIPAA Compliance</a></li>
                        <li><a href="#" class="hover:text-white transition duration-150">Data Protection</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2024 HealthCare Pro. All rights reserved. Built with modern healthcare standards in mind.</p>
            </div>
        </div>
        </footer>

    <!-- Registration Modal -->
    <div id="registrationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-900" id="modalTitle">Register</h3>
                    <button onclick="closeRegistrationModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <form id="registrationForm" method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="role" id="modalRole" value="">
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" name="name" id="name" required
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" name="email" id="email" required
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="password" required
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-4 rounded-lg font-medium transition duration-150 ease-in-out">
                        Create Account
                    </button>
                </form>
                
                <div class="mt-4 text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500 font-medium">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Load health tips when page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadHealthTips();
        });

        function loadHealthTips() {
            fetch('/api/health-tips/random')
                .then(response => response.json())
                .then(tip => {
                    if (tip) {
                        displayHealthTip(tip);
                    }
                })
                .catch(error => {
                    console.error('Error loading health tip:', error);
                    document.getElementById('health-tips-container').innerHTML = 
                        '<div class="text-center text-gray-500 col-span-full">Unable to load health tips at this time.</div>';
                });
        }

        function displayHealthTip(tip) {
            const container = document.getElementById('health-tips-container');
            container.innerHTML = `
                <div class="bg-gradient-to-br from-indigo-50 to-blue-50 rounded-2xl p-8 hover:shadow-xl transition duration-300">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-indigo-600" viewBox="0 0 100 100" fill="currentColor">
                                <circle cx="50" cy="50" r="45" fill="currentColor" opacity="0.1"/>
                                <rect x="45" y="25" width="10" height="50" fill="currentColor" rx="2"/>
                                <rect x="25" y="45" width="50" height="10" fill="currentColor" rx="2"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-900">${tip.title}</h4>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                ${tip.category}
                            </span>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed">${tip.content}</p>
                </div>
            `;
        }

        function openRegistrationModal(role) {
            document.getElementById('modalRole').value = role;
            document.getElementById('modalTitle').textContent = `Register as ${role.charAt(0).toUpperCase() + role.slice(1)}`;
            document.getElementById('registrationModal').classList.remove('hidden');
        }

        function closeRegistrationModal() {
            document.getElementById('registrationModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('registrationModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRegistrationModal();
            }
        });
    </script>
    </body>
</html>

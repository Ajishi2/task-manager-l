<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>✨ Task Planner ✨</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        
        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        <style>
            :root {
                --primary-color: #a855f7;
                --primary-light: #f3e8ff;
                --primary-dark: #7e22ce;
                --pending-color: #eab308;
                --in-progress-color: #3b82f6;
                --completed-color: #22c55e;
                --dark-bg: #1e293b;
                --card-bg: #f9fafb;
            }
            
            body {
                font-family: 'Quicksand', sans-serif;
                background-color: #f5f3ff;
                color: #334155;
            }
            
            .app-header {
                background-color: white;
                border-radius: 1rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                margin-bottom: 1.5rem;
            }
            
            .logo-icon {
                background-color: var(--primary-color);
                color: white;
                width: 3rem;
                height: 3rem;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .btn-primary {
                background-color: var(--primary-color);
                color: white;
                border-radius: 9999px;
                padding: 0.5rem 1.5rem;
                font-weight: 600;
                transition: all 0.3s ease;
            }
            
            .btn-primary:hover {
                background-color: var(--primary-dark);
            }
            
            .task-card {
                background-color: white;
                border-radius: 0.75rem;
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
                transition: all 0.3s ease;
                border-left: 4px solid var(--primary-color);
            }
            
            .task-card:hover {
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }
            
            .status-badge {
                padding: 0.25rem 0.75rem;
                border-radius: 9999px;
                font-size: 0.75rem;
                font-weight: 600;
            }
            
            .status-pending {
                background-color: #fef3c7;
                color: #92400e;
            }
            
            .status-in-progress {
                background-color: #dbeafe;
                color: #1e40af;
            }
            
            .status-completed {
                background-color: #dcfce7;
                color: #166534;
            }
            
            .priority-high {
                background-color: #fee2e2;
                color: #b91c1c;
            }
            
            .priority-medium {
                background-color: #fef3c7;
                color: #92400e;
            }
            
            .priority-low {
                background-color: #dcfce7;
                color: #166534;
            }
            
            .stats-card {
                background-color: #1e293b;
                color: white;
                border-radius: 1rem;
                padding: 1.5rem;
            }
            
            .chart-container {
                height: 200px;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            
            .modal-content {
                background-color: white;
                border-radius: 1rem;
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
            
            .form-control {
                border-radius: 9999px;
                border: 1px solid #e2e8f0;
                padding: 0.5rem 1rem;
            }
            
            .form-control:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.25);
            }
            
            textarea.form-control {
                border-radius: 0.75rem;
            }
            
            .dark-mode {
                background-color: var(--dark-bg);
                color: white;
            }
            
            .dark-mode .app-header,
            .dark-mode .task-card,
            .dark-mode .modal-content {
                background-color: #334155;
                color: white;
            }
        </style>
    </head>
    <body>
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        
        <!-- Bootstrap JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
        <script>
            // Theme toggle functionality
            document.addEventListener('DOMContentLoaded', function() {
                // Check for saved theme
                const savedTheme = localStorage.getItem('theme') || 'light';
                document.documentElement.classList.toggle('dark', savedTheme === 'dark');
                
                // Theme toggle button
                const themeToggle = document.getElementById('theme-toggle');
                if (themeToggle) {
                    themeToggle.addEventListener('click', function() {
                        document.documentElement.classList.toggle('dark');
                        const isDark = document.documentElement.classList.contains('dark');
                        localStorage.setItem('theme', isDark ? 'dark' : 'light');
                    });
                }
            });
        </script>
        @stack('scripts')
    </body>
</html>

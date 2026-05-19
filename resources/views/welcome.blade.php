<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Knote</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>
<body class="bg-gray-50 text-gray-900 dark:bg-gray-950 dark:text-gray-50 font-sans antialiased transition-colors duration-300">

    <header class="bg-white dark:bg-gray-900 shadow-sm sticky top-0 z-50 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="text-2xl font-black tracking-tight text-purple-600"><i class="fa-solid fa-sticky-note"></i> Knote</span>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="#" class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2.5 rounded-lg font-medium transition shadow-sm">
                    Login
                </a>
                <a href="#" class="hidden md:block hover:bg-purple-700 text-purple-700 hover:text-white dark:text-purple-400 dark:border-purple-400 dark:hover:bg-purple-700 dark:hover:text-white border border-purple-700 px-5 py-2.5 rounded-lg font-medium transition shadow-sm">
                    Sign up
                </a>
            </div>
        </div>
    </header>

    <main>
        <!-- Grid Hero Section -->
        <section class="relative bg-[url('https://static.vecteezy.com/system/resources/thumbnails/067/763/049/small/futuristic-hud-grid-blueprint-with-wireframe-lines-seamless-digital-mesh-and-sci-fi-interface-abstract-black-and-white-background-for-vr-dashboards-ai-systems-tech-maps-or-space-themed-ui-design-vector.jpg')] overflow-hidden py-20 lg:py-32 bg-cover bg-center">
            <div class="absolute inset-0 bg-white/90 dark:bg-gray-950/90 transition-colors duration-300"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center menu-utama">
                <div class="space-y-6 max-w-xl mx-auto lg:mx-0 text-center lg:text-left">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 dark:text-gray-100 tracking-tight leading-tight transition-colors duration-300">
                        Create your memo with <span class="text-purple-600">Knote</span>
                    </h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300 sm:text-xl transition-colors duration-300">
                        An Online Note web application that allows you to create, edit, and delete notes with ease.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#" class="bg-purple-600 hover:bg-purple-700 text-white text-center rounded-lg px-8 py-3.5 font-medium shadow-lg hover:shadow-purple-500/20 transition duration-150">
                            Sign up now!
                        </a>
                    </div>
                </div>
                <div class="w-full h-64 sm:h-96 lg:h-[450px] bg-gradient-to-tr from-purple-100 to-purple-200 dark:from-purple-950 dark:to-slate-900 border border-purple-300 dark:border-purple-500 shadow-inner flex items-center justify-center rounded-2xl transition-colors duration-300">
                     <span class="text-purple-700 dark:text-purple-300 font-semibold">Dashboard View</span>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-100 text-gray-600 dark:bg-gray-950 dark:text-gray-400 py-12 border-t border-gray-200 dark:border-gray-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-6">
            <span class="text-xl font-black tracking-tight text-gray-900 dark:text-white">Knote</span>
            <p class="text-sm">&copy; 2026 Knote. Final Project Semester 2.</p>
        </div>
    </footer>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan (404) - knote</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        theme: '#363473'
                    }
                }
            }
        }
    </script>
    
    @vite('resources/css/app.css')

    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #ffffff; /* Full background putih */
        }
        .fill-theme { fill: #363473; }
        .stroke-theme { stroke: #363473; }
    </style>
</head>
<body class="bg-white min-h-screen w-full flex items-center justify-center p-6 relative overflow-x-hidden">


    <div class="w-full max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-center gap-16 md:gap-32">
        
        <div class="w-full md:w-1/2 flex justify-center items-center relative order-2 md:order-1 mt-8 md:mt-0">
            <div class="absolute w-64 h-64 sm:w-80 sm:h-80 bg-slate-50 rounded-full -z-10"></div>
            
            <svg viewBox="0 0 300 400" class="w-56 sm:w-72 md:w-[320px] h-auto z-10" style="max-width: 350px;">
                <path d="M 40 50 C 40 120, 160 80, 160 150" fill="none" class="stroke-theme" stroke-width="8" stroke-linecap="round" />
                <path d="M 148 150 L 172 150 C 172 165, 168 175, 160 175 C 152 175, 148 165, 148 150 Z" class="fill-theme" />
                <rect x="135" y="175" width="50" height="25" rx="4" class="fill-theme" />
                
                <rect x="145" y="210" width="6" height="20" rx="2" class="fill-theme" />
                <rect x="169" y="210" width="6" height="20" rx="2" class="fill-theme" />
                <rect x="135" y="230" width="50" height="25" rx="4" class="fill-theme" />
                <path d="M 148 255 L 172 255 C 172 270, 168 280, 160 280 C 152 280, 148 270, 148 255 Z" class="fill-theme" />
                <path d="M 160 280 C 160 340, 260 330, 260 380 C 260 410, 40 400, 40 450" fill="none" class="stroke-theme" stroke-width="8" stroke-linecap="round" />
            </svg>
        </div>

        <div class="w-full md:w-1/2 flex flex-col items-center text-center order-1 md:order-2">
            <h1 class="text-[8rem] sm:text-[10rem] md:text-[12rem] font-bold text-theme leading-none tracking-tighter mb-2 md:mb-0">
                404
            </h1>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-slate-800 mb-6 tracking-tight">
                Page Not Found
            </h2>
            <p class="text-slate-500 text-base md:text-lg max-w-[300px] md:max-w-md mx-auto mb-10 font-medium leading-relaxed">
                Maaf, halaman atau URL yang Anda tuju pada platform <span class="text-theme font-bold">knote</span> tidak dapat ditemukan.
            </p>
            
            <a href="{{ url('/') }}" class="bg-theme text-white px-10 py-4 md:px-12 md:py-5 rounded-full font-bold tracking-wider hover:bg-[#2a295c] hover:-translate-y-1 transition-all duration-300 shadow-[0_15px_30px_rgba(54,52,115,0.25)] text-sm md:text-base inline-block">
                KEMBALI KE BERANDA
            </a>
        </div>

    </div>

</body>
</html>
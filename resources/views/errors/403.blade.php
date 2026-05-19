<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak (403) - knote</title>
    
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
            background-color: #ffffff; 
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
                <path d="M150,50 C230,50 250,90 250,170 C250,270 150,350 150,350 C150,350 50,270 50,170 C50,90 70,50 150,50 Z" fill="none" class="stroke-theme" stroke-width="8" stroke-linejoin="round" />
                
                <path d="M 115 190 L 115 150 C 115 125, 185 125, 185 150 L 185 190" fill="none" class="stroke-theme" stroke-width="8" stroke-linecap="round" />
                
                <rect x="95" y="190" width="110" height="80" rx="12" class="fill-theme" />
                
                <circle cx="150" cy="220" r="10" fill="#ffffff" />
                <path d="M 145 220 L 140 245 L 160 245 L 155 220 Z" fill="#ffffff" />
            </svg>
        </div>

        <div class="w-full md:w-1/2 flex flex-col items-center text-center order-1 md:order-2">
            <h1 class="text-[8rem] sm:text-[10rem] md:text-[12rem] font-bold text-theme leading-none tracking-tighter mb-2 md:mb-0">
                403
            </h1>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-slate-800 mb-6 tracking-tight">
                Akses Ditolak
            </h2>
            <p class="text-slate-500 text-base md:text-lg max-w-[300px] md:max-w-md mx-auto mb-10 font-medium leading-relaxed">
                Waduh! Akun kamu tidak memiliki izin resmi atau token hak akses yang sah untuk membuka halaman internal <span class="text-theme font-bold">knote</span>.
            </p>
            
            <a href="{{ url('/') }}" class="bg-theme text-white px-10 py-4 md:px-12 md:py-5 rounded-full font-bold tracking-wider hover:bg-[#2a295c] hover:-translate-y-1 transition-all duration-300 shadow-[0_15px_30px_rgba(54,52,115,0.25)] text-sm md:text-base inline-block">
                KEMBALI KE BERANDA
            </a>
        </div>

    </div>

</body>
</html>
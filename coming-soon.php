<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Sistem Manajemen Data Pasien - Coming Soon</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#1275e2",
                        "background": "#f9f9ff",
                    },
                    fontFamily: {
                        "inter": ["Inter", "sans-serif"],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-background text-slate-900 min-h-screen">
    
    <header class="fixed top-0 w-full z-50 flex justify-between items-center px-6 h-16 bg-white shadow-sm border-b border-slate-200 font-inter antialiased">
        <div class="flex items-center gap-8">
            <span class="text-xl font-bold text-primary">Sistem Manajemen Data Pasien</span>
            <nav class="hidden md:flex gap-6">
                <a class="text-primary border-b-2 border-primary font-semibold pb-1" href="#">Dashboard</a>
                <a class="text-slate-600 hover:text-primary transition-colors" href="pasien.php">Pasien</a>
                <a class="text-slate-600 hover:text-primary transition-colors" href="#">Jadwal</a>
                <a class="text-slate-600 hover:text-primary transition-colors" href="#">Laporan</a>
            </nav>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-8 h-8 rounded-full overflow-hidden border border-slate-200">
                <img alt="User Avatar" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCLd2OnIEtLXFGsz7UnU190EHO3Y2adObjqz5lVZ2GwLUpotWzphqeFibFC3mOeEgKN-opXdV4rOgLv8M1ouxXY6PAWW8sJxK9dL6becBStLEDrUm2p2N-MDmYHqfr69SYiklpeUKEcW4nVrmR4dPduaN_7tp675umkcDX9AZuPXhb71a_4LhgWFuwuhdMCcbyoWyHE3yDpoXr7fylvQgAp_J1SPTwNW1Uelgy1BH_8JqDJjLIuXzb5AA9cG9Rum5UXcQZDHfpV"/>
            </div>
        </div>
    </header>

    <aside class="hidden md:flex flex-col fixed left-0 top-16 h-[calc(100vh-64px)] w-64 p-4 space-y-2 bg-slate-50 border-r border-slate-200 font-inter text-sm">
        <div class="mb-6 px-2">
            <h2 class="text-lg font-black text-primary uppercase tracking-tight">Sistem Pasien</h2>
            <p class="text-slate-500 text-xs">Admin Portal</p>
        </div>
        <div class="space-y-1">
            <a class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-primary font-bold rounded-xl hover:translate-x-1 transition-all duration-200" href="#">
                <span class="material-symbols-outlined">dashboard</span>
                Dashboard
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-slate-100 rounded-xl hover:translate-x-1 transition-all duration-200" href="pasien.php">
                <span class="material-symbols-outlined">person_add</span>
                Registrasi Pasien
            </a>
        </div>
    </aside>

    <main class="md:ml-64 pt-24 px-6 pb-12 flex items-center justify-center min-h-[calc(100vh-64px)]">
        <div class="text-center space-y-4 bg-white p-12 rounded-xl shadow-sm border border-slate-200 max-w-lg w-full">
            <span class="material-symbols-outlined text-6xl text-slate-300 block">construction</span>
            <h1 class="text-3xl font-black text-primary tracking-tight">Coming Soon!</h1>
            <p class="text-slate-500">Halaman atau fitur ini sedang dalam tahap pengembangan dan akan segera hadir.</p>
            <div class="pt-6">
                <a href="pasien.php" class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-bold rounded-lg shadow-md hover:brightness-110 active:scale-95 transition-all">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    Kembali ke Form Pasien
                </a>
            </div>
        </div>
    </main>
    
</body>
</html>
<?php
require 'config.php';

// Ambil semua data
$query = "SELECT * FROM pasien ORDER BY id DESC";
$result = mysqli_query($conn, $query);
$total_pasien = mysqli_num_rows($result);

// Logic untuk menarik data saat tombol Edit diklik
$is_edit = false;
$edit_id = ''; $edit_nama = ''; $edit_umur = ''; $edit_diagnosa = '';

if (isset($_GET['edit'])) {
    $is_edit = true;
    $edit_id = mysqli_real_escape_string($conn, $_GET['edit']);
    $q_edit = "SELECT * FROM pasien WHERE id = '$edit_id'";
    $res_edit = mysqli_query($conn, $q_edit);
    if ($row_edit = mysqli_fetch_assoc($res_edit)) {
        $edit_nama = $row_edit['nama'];
        $edit_umur = $row_edit['umur'];
        $edit_diagnosa = $row_edit['diagnosa'];
    }
}
?>
<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Sistem Manajemen Data Pasien</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "primary": "#1275e2",
              "tertiary": "#c55b00",
              "on-primary": "#ffffff",
              "surface-container": "#ecedf7",
              "inverse-primary": "#aac7ff",
              "surface-container-low": "#f2f3fd",
              "on-primary-container": "#fefcff",
              "on-secondary-container": "#405882",
              "on-error": "#ffffff",
              "on-secondary": "#ffffff",
              "background": "#f9f9ff",
              "surface-container-lowest": "#ffffff",
              "secondary-container": "#b7cfff",
              "on-tertiary": "#ffffff",
              "tertiary-fixed": "#ffdbc9",
              "surface-bright": "#f9f9ff",
              "secondary-fixed-dim": "#afc7f7",
              "surface-container-high": "#e6e8f1",
              "surface-variant": "#e0e2ec",
              "on-surface-variant": "#414753",
              "on-secondary-fixed-variant": "#2e4770",
              "error-container": "#ffdad6",
              "on-primary-fixed-variant": "#00458d",
              "surface-tint": "#1275e2",
              "outline-variant": "#c1c6d5",
              "primary-fixed": "#d6e3ff",
              "primary-container": "#0873df",
              "surface-dim": "#d8dae3",
              "secondary": "#5f78a3",
              "on-error-container": "#93000a",
              "outline": "#74777f",
              "primary-fixed-dim": "#aac7ff",
              "inverse-on-surface": "#eff0fa",
              "on-tertiary-fixed": "#321200",
              "on-tertiary-container": "#fffbff",
              "on-surface": "#181c22",
              "tertiary-container": "#bd5700",
              "on-secondary-fixed": "#001b3e",
              "secondary-fixed": "#d6e3ff",
              "on-tertiary-fixed-variant": "#763400",
              "on-background": "#181c22",
              "inverse-surface": "#2d3038",
              "tertiary-fixed-dim": "#ffb68c",
              "surface-container-highest": "#e0e2ec",
              "surface": "#f9f9ff",
              "on-primary-fixed": "#001b3e",
              "error": "#ba1a1a"
            },
            fontFamily: {
              "headline": ["Inter"],
              "body": ["Inter"],
              "label": ["Inter"]
            },
            borderRadius: {"DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "full": "9999px"},
          },
        },
      }
    </script>
    <style>
        /* CSS ZOOM 80% */
        body { 
            font-family: 'Inter', sans-serif; 
            zoom: 0.8; 
            -moz-transform: scale(0.8); 
            -moz-transform-origin: 0 0;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background text-on-background min-h-screen">

<header class="fixed top-0 w-full z-50 flex justify-between items-center px-6 h-16 bg-white dark:bg-slate-900 shadow-sm border-b border-slate-200 dark:border-slate-800 font-inter antialiased">
    <div class="flex items-center gap-8">
        <span class="text-xl font-bold text-primary dark:text-blue-400">Sistem Manajemen Data Pasien</span>
        <nav class="hidden md:flex gap-6">
            <a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-blue-300 transition-colors" href="coming-soon.php">Dashboard</a>
            <a class="text-primary dark:text-blue-400 border-b-2 border-primary font-semibold pb-1" href="pasien.php">Pasien</a>
            <a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-blue-300 transition-colors" href="coming-soon.php">Jadwal</a>
            <a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-blue-300 transition-colors" href="coming-soon.php">Laporan</a>
        </nav>
    </div>
    <div class="flex items-center gap-4">
        <button class="p-2 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-lg active:scale-95 transition-transform duration-150">
            <span class="material-symbols-outlined text-slate-600 dark:text-slate-400">notifications</span>
        </button>
        <button class="p-2 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-lg active:scale-95 transition-transform duration-150">
            <span class="material-symbols-outlined text-slate-600 dark:text-slate-400">settings</span>
        </button>
        <div class="w-8 h-8 rounded-full overflow-hidden border border-slate-200">
            <img alt="User Avatar" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCLd2OnIEtLXFGsz7UnU190EHO3Y2adObjqz5lVZ2GwLUpotWzphqeFibFC3mOeEgKN-opXdV4rOgLv8M1ouxXY6PAWW8sJxK9dL6becBStLEDrUm2p2N-MDmYHqfr69SYiklpeUKEcW4nVrmR4dPduaN_7tp675umkcDX9AZuPXhb71a_4LhgWFuwuhdMCcbyoWyHE3yDpoXr7fylvQgAp_J1SPTwNW1Uelgy1BH_8JqDJjLIuXzb5AA9cG9Rum5UXcQZDHfpV"/>
        </div>
    </div>
</header>

<aside class="hidden md:flex flex-col fixed left-0 top-16 h-[calc(100vh-64px)] w-64 p-4 space-y-2 bg-slate-50 dark:bg-slate-950 border-r border-slate-200 dark:border-slate-800 font-inter text-sm">
    <div class="mb-6 px-2">
        <h2 class="text-lg font-black text-primary dark:text-blue-400 uppercase tracking-tight">Sistem Pasien</h2>
        <p class="text-slate-500 text-xs">Admin Portal</p>
    </div>
    <div class="space-y-1">
        <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl hover:translate-x-1 transition-all duration-200" href="coming-soon.php">
            <span class="material-symbols-outlined">dashboard</span> Dashboard
        </a>
        <a class="flex items-center gap-3 px-4 py-3 bg-blue-50 dark:bg-blue-900/30 text-primary dark:text-blue-300 font-bold rounded-xl hover:translate-x-1 transition-all duration-200" href="pasien.php">
            <span class="material-symbols-outlined">person_add</span> Registrasi Pasien
        </a>
        <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl hover:translate-x-1 transition-all duration-200" href="coming-soon.php">
            <span class="material-symbols-outlined">clinical_notes</span> Rekam Medis
        </a>
        <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl hover:translate-x-1 transition-all duration-200" href="coming-soon.php">
            <span class="material-symbols-outlined">medication</span> Inventori Obat
        </a>
        <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl hover:translate-x-1 transition-all duration-200" href="coming-soon.php">
            <span class="material-symbols-outlined">payments</span> Administrasi
        </a>
    </div>
    <button class="mt-4 mx-2 bg-primary text-white py-3 px-4 rounded-xl font-bold shadow-md hover:brightness-110 active:scale-95 transition-all">
        Tambah Pasien Baru
    </button>
    <div class="mt-auto pt-4 border-t border-slate-200 dark:border-slate-800 space-y-1">
        <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl hover:translate-x-1 transition-all duration-200" href="#">
            <span class="material-symbols-outlined">help</span> Bantuan
        </a>
        <a class="flex items-center gap-3 px-4 py-3 text-error dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-xl hover:translate-x-1 transition-all duration-200" href="#">
            <span class="material-symbols-outlined">logout</span> Log Out
        </a>
    </div>
</aside>

<main class="md:ml-64 pt-24 px-6 pb-12">
    <div class="max-w-6xl mx-auto space-y-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-on-surface tracking-tight">Manajemen Pasien</h1>
                <p class="text-outline mt-1">Kelola informasi pasien dan rekam medis secara real-time.</p>
            </div>
            <div class="flex gap-2">
                <span class="px-3 py-1 bg-surface-container-high text-on-surface-variant text-xs font-semibold rounded-full flex items-center gap-1">
                    <span class="w-2 h-2 bg-green-500 rounded-full"></span> Sistem Online
                </span>
                <span class="px-3 py-1 bg-surface-container-high text-on-surface-variant text-xs font-semibold rounded-full flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">calendar_today</span> 24 Mei 2024
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            
            <div class="lg:col-span-4">
                <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden sticky top-24">
                    <div class="p-6 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/30">
                        <h3 class="font-bold text-lg text-primary flex items-center gap-2">
                            <span class="material-symbols-outlined"><?= $is_edit ? 'edit_note' : 'person_add_alt' ?></span>
                            <?= $is_edit ? 'Edit Data Pasien' : 'Input Pasien Baru' ?>
                        </h3>
                    </div>
                    
                    <form action="proses.php" method="POST" class="p-6 space-y-4">
                        <?php if($is_edit): ?>
                            <input type="hidden" name="id" value="<?= $edit_id ?>">
                        <?php endif; ?>

                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-outline uppercase tracking-wider">Nama Pasien</label>
                            <input name="nama" value="<?= htmlspecialchars($edit_nama) ?>" required class="w-full px-4 py-2.5 bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all placeholder:text-slate-400" placeholder="Contoh: Budi Santoso" type="text"/>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-outline uppercase tracking-wider">Umur</label>
                            <div class="relative">
                                <input name="umur" value="<?= htmlspecialchars($edit_umur) ?>" required class="w-full px-4 py-2.5 bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all" placeholder="0" type="number"/>
                                <span class="absolute right-4 top-2.5 text-slate-400 text-sm">Tahun</span>
                            </div>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-outline uppercase tracking-wider">Diagnosa</label>
                            <textarea name="diagnosa" required class="w-full px-4 py-2.5 bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all" placeholder="Deskripsi keluhan atau penyakit..." rows="3"><?= htmlspecialchars($edit_diagnosa) ?></textarea>
                        </div>
                        
                        <div class="pt-4 flex flex-col gap-3">
                            <?php if($is_edit): ?>
                                <button type="submit" name="update" class="w-full bg-primary hover:bg-primary-container text-white font-bold py-3 rounded-lg shadow-lg shadow-primary/20 flex items-center justify-center gap-2 transition-all active:scale-[0.98]">
                                    <span class="material-symbols-outlined">update</span> Update Data
                                </button>
                                <a href="pasien.php" class="w-full bg-surface-container-lowest border border-outline-variant hover:bg-surface-container-low text-on-surface-variant font-bold py-3 rounded-lg flex items-center justify-center gap-2 transition-all text-center">
                                    <span class="material-symbols-outlined">cancel</span> Batal Edit
                                </a>
                            <?php else: ?>
                                <button type="submit" name="tambah" class="w-full bg-primary hover:bg-primary-container text-white font-bold py-3 rounded-lg shadow-lg shadow-primary/20 flex items-center justify-center gap-2 transition-all active:scale-[0.98]">
                                    <span class="material-symbols-outlined">save</span> Tambah Data
                                </button>
                                <button type="reset" class="w-full bg-surface-container-lowest border border-outline-variant hover:bg-surface-container-low text-on-surface-variant font-bold py-3 rounded-lg flex items-center justify-center gap-2 transition-all">
                                    <span class="material-symbols-outlined">restart_alt</span> Reset Form
                                </button>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-8 space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-primary p-4 rounded-xl text-white shadow-lg shadow-blue-200">
                        <p class="text-blue-100 text-xs font-medium uppercase tracking-widest">Total Pasien</p>
                        <div class="flex items-center justify-between mt-1">
                            <span class="text-2xl font-black"><?= $total_pasien; ?></span>
                            <span class="material-symbols-outlined text-blue-200/50 text-3xl">groups</span>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                        <p class="text-slate-500 text-xs font-medium uppercase tracking-widest">Rawat Jalan</p>
                        <div class="flex items-center justify-between mt-1">
                            <span class="text-2xl font-black text-slate-800">42</span>
                            <span class="material-symbols-outlined text-slate-300 text-3xl">medical_services</span>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                        <p class="text-slate-500 text-xs font-medium uppercase tracking-widest">Selesai Hari Ini</p>
                        <div class="flex items-center justify-between mt-1">
                            <span class="text-2xl font-black text-slate-800">18</span>
                            <span class="material-symbols-outlined text-slate-300 text-3xl">check_circle</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                    <div class="p-5 flex items-center justify-between border-b border-slate-100 dark:border-slate-800">
                        <h3 class="font-bold text-slate-800 dark:text-white">Daftar Pasien Terkini</h3>
                        <div class="relative">
                            <input class="pl-9 pr-4 py-1.5 text-sm bg-slate-50 dark:bg-slate-800 border-none rounded-full focus:ring-1 focus:ring-primary w-48 md:w-64" placeholder="Cari pasien..." type="text"/>
                            <span class="material-symbols-outlined absolute left-3 top-1.5 text-slate-400 text-lg">search</span>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-slate-50/80 dark:bg-slate-800/50">
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Pasien</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Umur</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Diagnosa</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                <?php while($row = mysqli_fetch_assoc($result)) : ?>
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-blue-100 text-primary flex items-center justify-center font-bold text-xs">
                                                <?= strtoupper(substr($row['nama'], 0, 2)); ?>
                                            </div>
                                            <span class="font-semibold text-slate-700 dark:text-slate-200"><?= htmlspecialchars($row['nama']); ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center text-slate-600 dark:text-slate-400"><?= $row['umur']; ?> th</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 bg-amber-50 text-amber-700 text-[10px] font-bold rounded uppercase"><?= htmlspecialchars($row['diagnosa']); ?></span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="pasien.php?edit=<?= $row['id']; ?>" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors inline-block">
                                                <span class="material-symbols-outlined text-lg">edit</span>
                                            </a>
                                            <button onclick="showDeleteModal(<?= $row['id']; ?>)" type="button" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors inline-block">
                                                <span class="material-symbols-outlined text-lg">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endwhile; ?>

                                <?php if($total_pasien == 0): ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-slate-500">Belum ada data pasien.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                        <p class="text-xs text-slate-500 italic">Menampilkan <?= $total_pasien; ?> dari <?= $total_pasien; ?> pasien</p>
                        <div class="flex gap-1">
                            <button class="p-1 border border-slate-200 rounded-md hover:bg-slate-50"><span class="material-symbols-outlined text-sm">chevron_left</span></button>
                            <button class="p-1 border border-slate-200 rounded-md bg-primary text-white text-xs px-2 font-bold">1</button>
                            <button class="p-1 border border-slate-200 rounded-md hover:bg-slate-50 text-xs px-2">2</button>
                            <button class="p-1 border border-slate-200 rounded-md hover:bg-slate-50 text-xs px-2">3</button>
                            <button class="p-1 border border-slate-200 rounded-md hover:bg-slate-50"><span class="material-symbols-outlined text-sm">chevron_right</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<button class="md:hidden fixed bottom-6 right-6 w-14 h-14 bg-primary text-white rounded-full shadow-2xl flex items-center justify-center active:scale-90 transition-transform">
    <span class="material-symbols-outlined text-3xl">add</span>
</button>

<div id="deleteModal" style="zoom: 1.25;" class="fixed inset-0 z-[999] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm">
    <div class="bg-surface-container-lowest border border-outline-variant rounded-2xl shadow-2xl p-6 max-w-sm w-full mx-4 transform transition-all">
        <div class="flex flex-col items-center text-center gap-4">
            <div class="w-16 h-16 rounded-full bg-error-container text-on-error-container flex items-center justify-center">
                <span class="material-symbols-outlined text-4xl">delete_forever</span>
            </div>
            <div>
                <h3 class="font-black text-xl text-on-surface">Hapus Data Pasien?</h3>
                <p class="text-sm text-outline mt-2">Data rekam medis yang dihapus tidak dapat dikembalikan lagi. Apakah Anda yakin?</p>
            </div>
        </div>
        <div class="flex gap-3 justify-center mt-6 w-full">
            <button onclick="closeDeleteModal()" type="button" class="w-1/2 px-4 py-2.5 text-on-surface-variant font-bold bg-surface-container hover:bg-surface-container-high rounded-xl transition-colors">Batal</button>
            <a id="confirmDeleteBtn" href="#" class="w-1/2 px-4 py-2.5 bg-error hover:brightness-110 text-on-error font-bold rounded-xl transition-all text-center shadow-lg">Ya, Hapus</a>
        </div>
    </div>
</div>

<script>
    function showDeleteModal(id) {
        const modal = document.getElementById('deleteModal');
        const btn = document.getElementById('confirmDeleteBtn');
        btn.href = 'proses.php?hapus=' + id;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>

</body>
</html>
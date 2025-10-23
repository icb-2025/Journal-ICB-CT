Journal-ICB-CT
Sistem Manajemen Jurnal berbasis Laravel untuk Biologi Komputasional & Teknologi

📌 Ikhtisar
Journal-ICB-CT adalah sistem manajemen jurnal berbasis web yang dirancang untuk menerbitkan dan mengelola artikel penelitian dalam bidang Biologi Komputasional dan Teknologi (CT). Dibangun dengan Laravel dan MySQL, platform ini menyediakan alur kerja yang efisien untuk pengiriman artikel, penelaahan sejawat, dan publikasi.

Sistem ini mendukung tiga peran pengguna:

Super Admin (Akses penuh ke semua fitur)
Guru/Penelaah (Akses ke pengiriman, ulasan, dan laporan)
Siswa/Penulis (Mengirim artikel, melacak kemajuan, dan mengelola profil)
✨ Fitur Utama
✅ Kontrol Akses Multi-Peran

Super Admin: Kontrol sistem penuh (pengguna, pengaturan, log).
Guru/Penelaah: Akses ke Dashboard, Data Perusahaan, Data Siswa, Kategori, Laporan, dan Profil.
Siswa/Penulis: Akses ke Dashboard, Profil, Manajemen Pengguna, dan Pencatatan Aktivitas.
✅ Manajemen Artikel

Mengirim, meninjau, dan menerbitkan artikel.
Melacak status pengiriman (Tertunda, Dalam Tinjauan, Diterima, Ditolak).
✅ Dashboard Interaktif

Visualisasi data dengan Chart.js.
Notifikasi real-time melalui Pusher & Laravel Echo.
✅ UI Responsif

Dibangun dengan Tailwind CSS, Alpine.js, dan Font Awesome.
Pengiriman CDN yang dioptimalkan melalui Bunny Fonts, jsDelivr, Cloudflare, dan jQuery CDN.
✅ Keamanan & Kinerja

Autentikasi aman & izin berbasis peran.
Dihosting di Railway untuk skalabilitas.


🛠️ Teknologi yang Digunakan

| Kategori | Teknologi yang Digunakan |
|----------|--------------------------|
| Backend  | Laravel, PHP, MySQL |
| Frontend | Alpine.js, Tailwind CSS, jQuery |
| UI/UX    | Font Awesome, Bunny Fonts |
| Grafik   | Chart.js |
| Real-Time| Pusher, Laravel Echo |
| Notifikasi | SweetAlert |
| API      | Axios |
| Hosting  | Railway |
| CDN      | Cloudflare, Bunny, jsDelivr, jQuery CDN |


👥 Peran Pengguna & Izin

Super Admin
1.🔐 Akses sistem penuh
👥 Kelola pengguna (Guru & Siswa)

⚙️ Konfigurasi pengaturan sistem

📊 Lihat semua laporan & log

2.Guru/Penelaah
📂 Akses:
Dashboard
Data Perusahaan
Data Siswa
Kategori
Laporan
Profil
✏️ Meninjau & menyetujui/menolak pengiriman

3.Siswa/Penulis
📂 Akses:
Dashboard
Profil
Manajemen Pengguna (terbatas)
Pencatatan Aktivitas (input kegiatan)
📄 Mengirim & melacak artikel

🚀 Instalasi

1.Klon repositori
git clone https://github.com/icb-2025/Journal-ICB-CT.git
cd journal-icb-ct

2.Instal dependensi
composer install
npm install

3.Konfigurasi lingkungan
Salin .env.example ke .env
Atur kunci MySQL, Pusher, dan Cloudflare CDN.

4.Jalankan migrasi & seeding data dummy
php artisan migrate --seed

5.Mulai server pengembangan
php artisan serve
npm run dev

🔗 Demo Langsung
🌐 Situs Web: https://journal-icb-ct-production.up.railway.app

📧 Kontak
📧 Email: arifiputrafaqih@gmail.com
🔗 Pelacak Masalah: GitHub Issues

📜 Lisensi
-Berlisensi MIT. © 2025 Journal-ICB-CT

🎯 Peningkatan Masa Depan

-Pemeriksa plagiarisme berbasis AI
-Integrasi aplikasi seluler
-Integrasi Crossref DOI
🚀 Selamat Meneliti! 🎓📚

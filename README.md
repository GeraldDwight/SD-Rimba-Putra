# Sistem Informasi SD Rimba Putra 🏫

[![Live Demo](https://img.shields.io/badge/Live_Demo-Website-success?style=for-the-badge&logo=google-chrome)](https://sdrimbaputra.page.gd/?i=1)

Repositori ini berisi *source code* untuk Sistem Informasi SD Rimba Putra. Proyek ini dikembangkan sebagai tugas akhir (Skripsi) Program Studi Ilmu Komputer, Universitas Djuanda. 

Sistem ini dirancang untuk menjadi media informasi dan manajemen sekolah yang lebih terstruktur dan efektif dibandingkan penggunaan media sosial, serta mempermudah interaksi di lingkungan SD Rimba Putra.

## 🔗 Live Website
Sistem ini sudah berjalan secara langsung (*live*) dan dapat diakses melalui tautan berikut:
**[Kunjungi Website SD Rimba Putra](https://sdrimbaputra.page.gd/?i=1)**

---

## 💼 Peran & Tanggung Jawab (Full-Stack Developer Jobdesk)

Sebagai pengembang tunggal (*solo developer*) pada proyek ini, saya bertanggung jawab atas seluruh alur pengembangan sistem dari *backend* hingga *frontend*:

### ⚙️ Backend Engineering
* **Arsitektur Database:** Merancang skema relasi basis data (*ERD*) dan mengimplementasikan *migration* serta *seeder* menggunakan MySQL.
* **Logika Bisnis & MVC:** Mengembangkan arsitektur aplikasi berbasis MVC (*Model-View-Controller*) menggunakan Framework Laravel.
* **Autentikasi & Keamanan (RBAC):** Membangun sistem *Role-Based Access Control* (RBAC) untuk mengamankan hak akses 3 level pengguna secara fleksibel.
* **Manajemen Data (CRUD):** Mengembangkan API/Route backend untuk pengelolaan data master, pengumuman, modul akademik, dan akun pengguna.
* **Keamanan Aplikasi:** Menerapkan proteksi keamanan standar web seperti *CSRF protection*, *input sanitization*, dan *password hashing*.
* **Deployment & Hosting:** Melakukan konfigurasi *web server* dan *database deployment* hingga sistem dapat diakses publik.

### 🎨 Frontend Engineering
* **Desain UI/UX & Antarmuka:** Merancang tata letak *layout* yang responsif (*mobile-friendly*) menggunakan Blade Templating Engine dan CSS Framework.
* **Dashboard Multirole:** Membangun *dashboard* interaktif yang menyesuaikan tampilan berdasarkan peran *user* yang sedang *login*.
* **Integrasi Data:** Menghubungkan antarmuka *frontend* dengan logika *backend* untuk penyajian data dinamis (berita, pengumuman, dan jadwal).
* **Interaktivitas:** Mengimplementasikan JavaScript untuk penanganan form, validasi *client-side*, dan komponen antarmuka yang dinamis.

---

## 🚀 Fitur Utama
Sistem ini mencakup manajemen informasi sekolah dengan pembagian hak akses menjadi 3 level pengguna (*user roles*):
1. **Administrator:** Mengelola data master, konten website, pengumuman, dan akun pengguna.
2. **Guru:** Mengakses informasi akademik dan jadwal terkait kegiatan belajar mengajar.
3. **Siswa / Wali Murid:** Melihat informasi publik sekolah, pengumuman, dan transparansi akademik.

## 🛠️ Teknologi yang Digunakan
* **Language:** PHP 8.x, JavaScript (ES6), HTML5, CSS3
* **Framework:** Laravel
* **Database:** MySQL
* **Frontend Tools:** Blade Templating, Bootstrap / Tailwind CSS
* **Version Control & Tools:** Git, GitHub, VS Code


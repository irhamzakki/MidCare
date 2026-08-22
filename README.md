# MidCare - Platform Skrining & Manajemen Kesehatan Mental

MidCare adalah aplikasi web berbasis **Laravel** dan **Machine Learning (K-Means Clustering)** untuk melakukan skrining kesehatan mental, klasifikasi tingkat risiko responden, serta manajemen pasien bagi Admin dan Psikolog.

---

## 🚀 Fitur Utama

- **Skrining Mandiri (Publik & Pasien):** Kuesioner komprehensif evaluasi psikologis dan pola relasi pengasuhan.
- **Klasifikasi Otomatis (Machine Learning):** Analisis jawaban kuesioner menggunakan model *K-Means Clustering* (`predict.py`) untuk memetakan tingkat risiko (Stabil, Cukup Baik, Butuh Perhatian).
- **Panel Role-Based Access Control (RBAC):**
  - **Admin:** Manajemen pengguna (Admin, Psikolog, Pasien), artikel, materi edukasi, kuesioner, dataset, dan laporan.
  - **Psikolog:** Monitoring data pasien, analisis klaster responden, riwayat hasil skrining, catatan evaluasi, dan panduan rekomendasi intervensi.
  - **Pasien:** Dashboard personal, tes kesehatan mental mandiri, riwayat hasil tes, dan rekomendasi pemulihan.

---

## 🛠️ Prasyarat Sistem

Sebelum menjalankan proyek, pastikan perangkat Anda telah terpasang:
- **PHP** >= 8.2 (ekstensi: `pdo_mysql`, `mbstring`, `openssl`, `bcmath`, `curl`, dll.)
- **Composer** >= 2.0
- **Node.js** >= 18 & **NPM**
- **MySQL / MariaDB** (melalui Laragon, XAMPP, atau service mandiri)
- **Python** >= 3.8 (untuk modul AI/K-Means)

---

## 📦 Panduan Instalasi (Step-by-Step)

### 1. Clone Repository
```bash
git clone https://github.com/irhamzakki/MidCare.git
cd MidCare
```

### 2. Install Dependensi PHP (Composer)
```bash
composer install
```

### 3. Konfigurasi Environment (`.env`)
Salin file template `.env.example` menjadi `.env`:
```bash
# Windows PowerShell
copy .env.example .env

# Linux / macOS / Git Bash
cp .env.example .env
```

Generate application key:
```bash
php artisan key:generate
```

Pastikan konfigurasi database di file `.env` sudah sesuai dengan MySQL lokal Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=midcare
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Setup Database & Seeder Akun Default
Pastikan service MySQL Anda sudah aktif (misal klik **Start All** di Laragon/XAMPP). Buat database baru bernama `midcare`, lalu jalankan migrasi dan seeder:
```bash
php artisan migrate --seed
```

*(Opsional: Jika ingin menggunakan dataset kuesioner lengkap, Anda juga dapat mengimpor file `database/midcare.sql` ke database MySQL).*

#### 🔑 Akun Default untuk Login:
| Role | Email | Password |
|---|---|---|
| **Admin** | `admin@gmail.com` | `password` |
| **Psikolog** | `psikolog@gmail.com` | `password` |
| **Pasien** | `pasien@gmail.com` | `password` |

### 5. Setup Storage Symlink (Untuk Upload Gambar/Artikel)
```bash
php artisan storage:link
```

### 6. Install & Build Frontend Assets (Vite / TailwindCSS)
```bash
npm install
npm run build
```
*(Saat masa pengembangan, jalankan `npm run dev` untuk hot-reload).*

### 7. Setup Modul Machine Learning (Python Virtual Environment)
Buat virtual environment Python dan pasang dependensi yang dibutuhkan:

**Di Windows:**
```bash
python -m venv .venv
.venv\Scripts\pip install -r requirements.txt
```

**Di macOS / Linux:**
```bash
python3 -m venv .venv
.venv/bin/pip install -r requirements.txt
```

*(Catatan: Aplikasi secara otomatis mendeteksi folder `.venv` di direktori project. Jika Anda menggunakan Python global, pastikan library pada `requirements.txt` sudah terinstall: `pip install -r requirements.txt`)*.

---

## 🏃 Menjalankan Aplikasi

Jalankan server pengembangan Laravel:
```bash
php artisan serve
```

Buka browser dan akses:
👉 **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---

## 📁 Struktur Direktori Penting

```
MidCare/
├── app/                    # Controllers, Models, Middleware, Providers
├── config/                 # Konfigurasi aplikasi & database
├── database/
│   ├── migrations/         # Skema tabel database
│   ├── seeders/            # Seeder akun default (Admin, Psikolog, Pasien)
│   └── midcare.sql         # Backup dump database SQL
├── Kmeans/                 # Modul Machine Learning K-Means
│   ├── predict.py          # Script inferensi clustering
│   ├── kmeans_model.pkl    # Model K-Means terlatih
│   ├── scaler_model.pkl    # Standard scaler model
│   └── model_config.json   # Konfigurasi fitur & mapping label
├── public/                 # File publik & compiled assets
├── resources/
│   └── views/              # Template Blade (Admin, Psikolog, Pasien, Publik)
├── routes/                 # Routing web & otentikasi
├── requirements.txt        # Dependensi library Python
└── .env.example            # Template variabel lingkungan
```

---

## 🧪 Menjalankan Pengujian (Testing)

Untuk memastikan seluruh fungsi berjalan normal:
```bash
php artisan test
```

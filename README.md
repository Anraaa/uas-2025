# Moon Studio - Sistem Booking Studio Foto

Aplikasi web sistem booking studio foto berbasis **Laravel 12** dengan **Filament 3** admin panel, **Livewire 3** frontend, dan integrasi pembayaran **Midtrans**.

Dibuat sebagai tugas **UAS Pemrograman Web** oleh **Aqla Harun R J (20230801388)**.

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | PHP 8.2+, Laravel 12.x |
| Admin Panel | Filament 3.x, Spatie Permission + Shield |
| Frontend | Livewire 3.x, Blade, Tailwind CSS |
| Database | MariaDB 10.11 |
| API | RESTful (AES Encrypted + API Key) + Swagger Docs |
| Payment | Midtrans Snap (GoPay, VA BCA) + Transfer Manual |
| Infra | Docker Compose (PHP-FPM + Nginx + MariaDB) |
| Export | Maatwebsite Excel (laporan pemasukan) |

## Fitur

### Publik
- Halaman beranda dengan informasi studio
- Daftar studio dan fasilitas
- Halaman tentang (About)

### Client Panel (`/client`)
- Registrasi akun
- Booking studio dengan deteksi konflik jadwal
- Pembayaran via Midtrans (GoPay/VA BCA) atau transfer manual
- Cetak receipt booking

### Admin Panel (`/admin`)
- CRUD Studio, Booking, User
- Verifikasi pembayaran manual
- Laporan pemasukan (excel export)
- Manajemen role & permission
- Konfigurasi footer, logo, SEO, halaman
- Cek ketersediaan studio

### REST API (`/api/`)
- Endpoint CRUD Studio & Booking
- Autentikasi via API Key (header `X-API-KEY`)
- Response terenkripsi AES
- Dokumentasi Swagger di `/api/documentation`

## Persyaratan

- Docker & Docker Compose
- PHP 8.2+ (jika running tanpa Docker)
- Composer
- Node.js & npm (untuk asset frontend)

## Instalasi

### 1. Clone & Masuk ke Direktori

```bash
git clone git@github.com:Anraaa/uas-2025.git
cd uas-2025
```

### 2. Copy & Konfigurasi Environment

```bash
cp src/.env.example src/.env
```

Sesuaikan konfigurasi di `src/.env`:
- `APP_NAME`, `APP_URL`, `ASSET_URL`
- `DB_HOST=db`, `DB_DATABASE=uas`, `DB_USERNAME=root`, `DB_PASSWORD=p455w0rd`
- `API_KEY` (untuk API)
- `KEY_ENCRYPT` (untuk enkripsi API response)
- `MIDTRANS_SERVER_KEY`, `MIDTRANS_CLIENT_KEY`, `MIDTRANS_IS_PRODUCTION`

### 3. Generate App Key

```bash
docker compose run --rm php php artisan key:generate
```

### 4. Install Dependencies

```bash
docker compose run --rm php composer install --no-dev -o
docker compose run --rm php npm ci
```

### 5. Build Asset

```bash
docker compose run --rm php npm run build
```

### 6. Jalankan Container

```bash
docker compose up -d
```

### 7. Migrasi Database

```bash
docker compose exec php php artisan migrate --seed
```

### 8. Generate API Documentation

```bash
docker compose exec php php artisan l5-swagger:generate
```

Akses aplikasi di `https://uas.test` (pastikan host sudah diarahkan ke 127.0.0.1).

## Struktur Direktori

```
uas-2025/
├── .env                    # Environment Docker Compose
├── docker-compose.yml      # Orkestrasi container
├── nginx/                  # Konfigurasi Nginx + SSL
├── php/                    # Dockerfile & konfigurasi PHP
├── db/                     # Konfigurasi MariaDB
├── docs/                   # Dokumentasi BRD, SRS
└── src/                    # Aplikasi Laravel
    ├── app/
    │   ├── Http/Controllers/    # API Controllers
    │   ├── Http/Middleware/     # API Key Middleware
    │   ├── Livewire/            # Komponen Livewire
    │   ├── Filament/            # Panel Admin & Client
    │   ├── Models/              # Eloquent Models
    │   ├── Services/            # Booking Conflict Service
    │   └── Helper/              # Encryption Helper
    ├── database/migrations/     # 17 file migrasi
    ├── routes/
    │   ├── web.php              # Route publik + Midtrans webhook
    │   └── api.php              # Route API
    └── resources/views/         # Blade templates
```

## API Documentation

Dokumentasi API tersedia di `/api/documentation` setelah menjalankan `l5-swagger:generate`.

Semua endpoint API memerlukan header:
```
X-API-KEY: {api_key}
```

Response akan dienkripsi dalam format:
```json
{
  "data": "<encrypted_string>"
}
```

Gunakan endpoint `/api/studios/decrypt` atau `/api/bookings/decrypt` untuk mendekripsi response.

## Lisensi

MIT

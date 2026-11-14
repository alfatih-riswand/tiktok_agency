# TikTok Agency Monitoring — CodeIgniter 3 / PHP 8

Project starter untuk CI 3.1.13, PHP 8.x, MySQL. Modul yang disediakan:
- Login/logout, session, role admin/staff
- Dashboard KPI + Chart.js
- CRUD creator, agency, campaign, content, product
- Live monitoring records (data live harus berasal dari API/partner yang memberi izin)
- Report dengan filter tanggal
- TikTok OAuth Login Kit (authorization callback, token server-side)
- TikTok Display API profile/video sync
- Adapter TikTok Shop API dengan endpoint configurable (karena endpoint/region/scope tergantung approval partner)

## PENTING: batasan API
TikTok Display API standar menyediakan profil dasar dan daftar video milik user yang mengotorisasi aplikasi dengan scope yang disetujui. Data LIVE/GMV/orders/affiliate/shop analytics bukan otomatis tersedia dari Display API. Untuk itu diperlukan TikTok Shop Partner/Seller authorization, produk API yang disetujui, shop token, region dan scopes yang sesuai. Project ini tidak mengarang endpoint Shop: isi endpoint dan field mapping setelah mendapatkan dokumentasi partner milik akun Anda.
Referensi resmi:
- https://developers.tiktok.com/docs/en/display-api-overview
- https://developers.tiktok.com/doc/display-api-get-started
- https://developers.tiktok.com/docs/en/tiktok-api-scopes
- https://partner.tiktokshop.com/docv2

## Instalasi
1. Siapkan PHP 8.x, Apache, MySQL, ekstensi mysqli, curl, openssl.
2. Download CodeIgniter 3.1.13 dari https://codeigniter.com/download (CI3 adalah framework legacy; dokumentasi resminya menyebut PHP 5.6+ dan bukan target utama PHP 8. Perlu uji di versi PHP server Anda).
3. Extract CI3.1.13 ke folder project ini sehingga folder `system/` berada sejajar dengan `index.php` dan `application/`.
4. Salin/merge folder `application/` dari paket ini ke folder CI3.
5. Buat database `tiktok_agency`, import `database/tiktok_agency.sql`.
6. Edit `application/config/database.php`, `config.php`, `tiktok.php`.
7. Atur Apache DocumentRoot ke folder project; untuk produksi gunakan HTTPS.
8. Login awal: `admin@localhost` / `Admin123!` lalu segera ubah password.

## Konfigurasi TikTok
- Buat aplikasi di TikTok Developer Portal.
- Aktifkan Login Kit + Display API, set Redirect URI persis ke `https://domain-anda/index.php/auth/tiktok_callback`.
- Isi client key/secret dan scope yang benar-benar sudah disetujui di `application/config/tiktok.php`.
- Login sebagai admin, buka menu Integrasi API lalu klik Connect TikTok.
- Access/refresh token disimpan di database. Jangan expose token ke browser atau repository.
- Sinkronisasi video menggunakan `/v2/video/list/`. Token milik user yang mengotorisasi aplikasi diperlukan.
- Shop API diaktifkan hanya setelah akses TikTok Shop Partner/Seller API disetujui. Masukkan endpoint sesuai docs region dan partner Anda di `tiktok.php`. Endpoint kosong = fitur Shop API dinonaktifkan.

## Cron (opsional)
Jadwalkan pemanggilan endpoint sync yang dilindungi secret dari CLI atau buat cron internal. Jangan expose endpoint cron tanpa proteksi. Untuk tahap awal jalankan dari menu Integrasi API.

## Keamanan sebelum production
- Ganti password admin awal.
- Set encryption_key unik panjang.
- Gunakan HTTPS.
- Batasi akses database dan file config.
- Set cookie_secure TRUE pada HTTPS.
- Tambahkan rate limit/WAF dan backup database.
- Jangan menganggap metrik demo sebagai data TikTok asli.

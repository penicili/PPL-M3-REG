## Skenario Uji Dusk - EAD Library

Skenario pengujian end-to-end berbasis Laravel Dusk untuk aplikasi CRUD buku dengan autentikasi.

### Prasyarat

1. Database testing siap digunakan.
2. Browser driver untuk Dusk sudah dikonfigurasi.
3. Jalankan migration dan seed jika dibutuhkan.
4. Jalankan test dari root project.

### Daftar Skenario

| No | Skenario | Tujuan | Langkah | Ekspektasi |
| --- | --- | --- | --- | --- |
| 1 | Registrasi Berhasil | Memastikan user baru bisa register dan diarahkan ke dashboard buku. | 1. Buka halaman `/register`.<br>2. Isi nama, email unik, password, konfirmasi password.<br>3. Klik tombol `Register`. | 1. Berpindah ke path `/books`.<br>2. Muncul pesan `Registrasi berhasil.`.<br>3. Halaman menampilkan `Daftar Buku`. |
| 2 | Login Berhasil | Memastikan user terdaftar bisa login. | 1. Buka halaman `/login`.<br>2. Isi email dan password valid.<br>3. Klik tombol `Login`. | 1. Berpindah ke path `/books`.<br>2. Muncul pesan `Login berhasil.`.<br>3. Halaman menampilkan daftar buku. |
| 3 | Tambah Buku Berhasil | Memastikan alur create data buku berjalan. | 1. Login sebagai user valid.<br>2. Klik menu `Tambah Buku` pada navbar.<br>3. Isi form buku lengkap.<br>4. Klik `Simpan Buku`. | 1. Data buku tersimpan.<br>2. Muncul pesan `Buku berhasil ditambahkan.`.<br>3. Judul buku terlihat pada halaman hasil. |
| 4 | Lihat Detail Buku | Memastikan halaman detail bisa diakses melalui navigasi UI. | 1. Login sebagai user.<br>2. Klik menu `Tambah Buku`, isi form lalu klik `Simpan Buku`.<br>3. Klik tombol `Kembali` ke daftar buku.<br>4. Klik link `Detail` pada baris buku yang dimaksud. | 1. Judul buku tampil pada halaman detail.<br>2. Penulis buku tampil pada halaman detail. |
| 5 | Update Sengaja Gagal (Negatif) | Memvalidasi alur gagal update sesuai kebutuhan pengujian. | 1. Login sebagai user.<br>2. Klik menu `Tambah Buku`, isi form lalu klik `Simpan Buku`.<br>3. Pada halaman detail, klik tombol `Edit Buku`.<br>4. Ubah salah satu field lalu klik `Perbarui Buku`. | 1. Redirect kembali ke `/books` (dashboard).<br>2. Muncul flash error `Buku gagal diperbarui.`.<br>3. Data buku tidak berubah (judul lama tetap muncul, judul baru tidak muncul). |
| 6 | Hapus Buku Berhasil | Memastikan alur delete dengan konfirmasi berjalan. | 1. Login sebagai user.<br>2. Klik menu `Tambah Buku`, isi form lalu klik `Simpan Buku`.<br>3. Klik tombol `Kembali` ke halaman `/books`.<br>4. Klik tombol hapus (ikon trash) pada baris buku.<br>5. Konfirmasi dialog hapus. | 1. Muncul pesan `Buku berhasil dihapus.`.<br>2. Data buku tidak tampil lagi di tabel. |
| 7 | Logout Berhasil | Memastikan user bisa logout setelah login. | 1. Login menggunakan akun valid.<br>2. Buka menu user (ikon user) di navbar.<br>3. Klik tombol `Logout`. | 1. Redirect ke `/login`.<br>2. Muncul pesan `Logout berhasil.`. |

### Perintah Eksekusi

Menjalankan satu skenario tertentu:

```bash
php artisan dusk --filter=Test
```

Menjalankan seluruh skenario Dusk:

```bash
php artisan dusk
```

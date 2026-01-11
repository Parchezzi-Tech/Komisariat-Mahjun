# Dokumentasi Sistem Manajemen Anggota PMII

## Overview
Sistem ini telah dikustomisasi dengan Filament Admin Panel untuk manajemen database anggota PMII dengan fitur import/export Excel.

## Fitur Utama

### 1. **Data Anggota** (`/admin/anggotas`)
Resource lengkap untuk manajemen database anggota dengan field:
- NIM (unique)
- Nama
- Email & No. HP
- Jenis Kelamin
- Alamat
- Fakultas & Prodi
- Angkatan
- Status (Aktif/Non-Aktif/Alumni)
- Tanggal Masuk
- Foto
- Keterangan

**Fitur Utama:**
- ✅ CRUD lengkap (Create, Read, Update, Delete)
- ✅ Search & Filter (status, jenis kelamin, angkatan)
- ✅ **Import Excel** dengan validasi
- ✅ **Export Excel** bulk action
- ✅ **Download Template Excel** untuk import
- ✅ View/Edit/Delete per record
- ✅ Badge colorful untuk status dan gender

### 2. **Import Excel**
**Cara Pakai:**
1. Klik tombol **"Download Template Excel"** (hijau) di halaman Data Anggota
2. Isi template dengan data anggota (contoh sudah disediakan)
3. Klik tombol **"Import Excel"** (kuning)
4. Upload file Excel yang sudah diisi
5. Sistem akan validasi dan import otomatis

**Format Template:**
| nim | nama | email | no_hp | jenis_kelamin | alamat | fakultas | prodi | angkatan | status | tanggal_masuk | keterangan |
|-----|------|-------|-------|---------------|--------|----------|-------|----------|--------|---------------|------------|

**Validasi:**
- NIM harus unique
- Nama wajib diisi
- Jenis kelamin: Laki-laki atau Perempuan
- Status: Aktif, Non-Aktif, atau Alumni

### 3. **Export Excel**
**Cara Pakai:**
1. Di halaman Data Anggota, pilih data yang ingin di-export (bisa select multiple atau select all)
2. Klik dropdown bulk actions
3. Pilih **"Export"**
4. File Excel akan otomatis terdownload dengan nama `anggota-YYYY-MM-DD.xlsx`

### 4. **Dashboard Widgets**
Dashboard admin (`/admin`) menampilkan:
- **Stats Cards**: Total Anggota, Aktif, Baru Bulan Ini, Alumni, Gender Distribution
- **Chart**: Distribusi Anggota Per Angkatan (Bar Chart)
- **Quick Actions**: Link cepat ke Data Anggota, User Management, Roles

### 5. **User Management & Roles**
Tetap menggunakan fitur existing:
- User Management (`/admin/users`)
- Role & Permissions (`/admin/roles`)

## Akses

### Kredensial Admin
- Email: `admin@pmii.org`
- Password: `password`

### Menu Navigasi Filament
- Dashboard (Statistics & Charts)
- **Anggota** (Database Anggota - NEW!)
- Roles (Role Management)
- Users (User Management)

## Technical Stack

### Backend
- **Laravel 11**: Framework PHP
- **Filament v3**: Admin Panel
- **Spatie Laravel Permission**: Role & Permission Management
- **Laravel Excel (Maatwebsite)**: Import/Export functionality

### Database
- Table `anggotas` dengan 14+ fields
- Migration timestamp: `2026_01_11_114743_create_anggotas_table`
- Seeded dengan 8 data dummy

### Files Created/Modified

**Models & Migrations:**
- `app/Models/Anggota.php`
- `database/migrations/2026_01_11_114743_create_anggotas_table.php`
- `database/seeders/AnggotaSeeder.php`

**Filament Resources:**
- `app/Filament/Resources/AnggotaResource.php` (Main resource dengan form & table)
- `app/Filament/Resources/AnggotaResource/Pages/*.php` (List, Create, Edit pages)

**Widgets:**
- `app/Filament/Widgets/AnggotaStatsWidget.php` (6 stat cards)
- `app/Filament/Widgets/AnggotaChartWidget.php` (Bar chart angkatan)
- `app/Filament/Pages/Dashboard.php` (Custom dashboard page)
- `resources/views/filament/pages/dashboard.blade.php` (Custom view)

**Import/Export:**
- `app/Imports/AnggotaImport.php` (Excel import logic)
- `app/Http/Controllers/AnggotaImportController.php` (Template download & import handler)

**Routes:**
- `GET /anggota/template` - Download template Excel
- `POST /anggota/import` - Import handler (protected admin only)

**Vue Updates:**
- `resources/js/Pages/Dashboard/Admin.vue` - Added "Data Anggota" link

## Screenshot Locations

### Filament Admin Panel
- Dashboard: `/admin` (Shows stats & charts)
- Data Anggota: `/admin/anggotas` (Full CRUD with import/export buttons)
- Create Anggota: `/admin/anggotas/create`
- Edit Anggota: `/admin/anggotas/{id}/edit`

## Next Steps (Optional)

1. **Customize Chart**: Add more chart types (Pie, Line, dll)
2. **Advanced Filters**: Filter by fakultas, prodi, date range
3. **Bulk Import Validation**: Show detailed error report untuk import gagal
4. **Photo Upload**: Implement real photo upload functionality
5. **Export PDF**: Add PDF export alongside Excel
6. **API Integration**: Create REST API for mobile app
7. **Email Notifications**: Send email saat import selesai
8. **Backup Database**: Automated backup anggota data

## Notes
- Import Excel menggunakan heading row (baris pertama sebagai header)
- Export menggunakan `pxlrbt/filament-excel` package yang sudah terinstall
- Widgets auto-refresh data dari database
- Dashboard full responsive untuk mobile/tablet

---
**Created**: 11 Januari 2026
**Version**: 1.0

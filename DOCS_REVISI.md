# 🎨 REVISI SISTEM - Tema Custom & Generator Surat

## ✅ Yang Sudah Dikerjakan

### 1. **Custom Tema Panel Admin** (`/admin`)
- ✅ Warna primary: **Emerald Green** (bukan amber default)
- ✅ Font: **Inter** (modern sans-serif)
- ✅ Logo & Branding: "PMII Admin" dengan logo Mahbub Djunaidi
- ✅ Sidebar collapsible di desktop
- ✅ Navigation Groups:
  - **Data Management** (Anggota)
  - **User Management** (Users, Roles)
  - **System**
- ✅ Custom dashboard dengan quick action cards & widgets

### 2. **Custom Tema Panel PMII** (`/pmii`)
- ✅ Warna primary: **Indigo Blue** (berbeda dari admin)
- ✅ Font: **Inter**
- ✅ Logo & Branding: "Portal PMII" dengan logo Mahbub Djunaidi
- ✅ Sidebar collapsible di desktop
- ✅ Navigation Groups:
  - **Portal PMII**
  - **Administrasi** (Generator Surat)
  - **Laporan**
- ✅ Custom dashboard dengan widgets statistik

### 3. **Generator Surat Otomatis** 🆕 (`/pmii/surats`)

#### Fitur Utama:
- ✅ **5 Jenis Surat**:
  - Surat Tugas
  - Surat Keterangan
  - Surat Undangan
  - Surat Rekomendasi
  - Surat Pengantar

- ✅ **Form Builder**:
  - Jenis Surat (dropdown)
  - Nomor Surat (auto-generated)
  - Tanggal Surat
  - Perihal
  - Kepada (textarea)
  - Isi Surat (Rich Text Editor dengan toolbar)
  - Penandatangan (nama + jabatan)
  - **Upload Tanda Tangan Digital** (PNG/JPG)
  - Status (Draft/Final/Terkirim)
  - Keterangan

- ✅ **Auto-Generate Nomor Surat**:
  - Format: `001/PMII-MAHBUB/ST/2026`
  - Increment otomatis per tahun
  - Kode jenis surat: ST (Tugas), SK (Keterangan), SU (Undangan), SR (Rekomendasi), SP (Pengantar)

- ✅ **Generate PDF**:
  - Template profesional dengan kop surat
  - Header: Logo & nama organisasi
  - Body: Nomor, perihal, kepada, isi lengkap
  - Footer: Tanda tangan digital + nama penandatangan
  - Format A4 portrait
  - Styling: Times New Roman, margin proper

- ✅ **Table dengan Badges**:
  - Badge berwarna per jenis surat
  - Badge status (Draft/Final/Terkirim)
  - Search & Filter
  - Action: View, Edit, Delete, Generate PDF

### 4. **Dashboard PMII Custom**
- ✅ Welcome card dengan icon & deskripsi
- ✅ 3 Quick Action Cards:
  1. **Buat Surat Baru** → Create form
  2. **Arsip Surat** → List surat
  3. **Data Anggota** → Link ke panel admin
- ✅ 2 Widgets:
  - **Surat Stats**: Total, Draft, Final, Terkirim, Bulan Ini
  - **Anggota Stats**: Total, Aktif, Alumni

### 5. **Database & Migration**
- ✅ Table `surats` dengan 15+ fields
- ✅ Relationship: Surat belongsTo User (creator)
- ✅ Seeder: 3 contoh surat (Tugas, Keterangan, Undangan)

---

## 🎨 Perbedaan Visual Kedua Panel

| Aspek | Admin Panel (`/admin`) | PMII Panel (`/pmii`) |
|-------|----------------------|---------------------|
| **Warna Primary** | Emerald Green | Indigo Blue |
| **Branding** | "PMII Admin" | "Portal PMII" |
| **Navigation** | Data Management, User Management | Portal PMII, Administrasi |
| **Focus** | Database anggota, user, roles | Generator surat, administrasi |

---

## 📝 Cara Menggunakan Generator Surat

### A. Buat Surat Baru
1. Login ke `/pmii` (semua user bisa akses)
2. Klik **"Generator Surat"** di sidebar atau **"Buat Surat Baru"** di dashboard
3. Pilih **Jenis Surat**
4. Isi form:
   - Perihal
   - Kepada (contoh: "Yth. Bapak/Ibu Kepala Desa")
   - Isi Surat (gunakan rich editor: bold, list, dll)
   - Nama & Jabatan Penandatangan
   - **Upload Tanda Tangan** (gambar PNG/JPG dengan background transparan)
5. Pilih status: Draft atau Final
6. Klik **"Create"**
7. Nomor surat otomatis dibuat (contoh: `001/PMII-MAHBUB/ST/2026`)

### B. Generate PDF
1. Di halaman list surat, klik tombol **"Generate PDF"** (hijau)
2. PDF otomatis terbuka di tab baru
3. PDF berisi:
   - Kop surat dengan logo
   - Nomor & perihal
   - Isi lengkap
   - Tanda tangan digital (jika diupload)
   - Nama & jabatan penandatangan

### C. Tips Tanda Tangan Digital
- Gunakan gambar PNG dengan background transparan
- Ukuran ideal: 300x100 px
- Foto tanda tangan asli di kertas putih
- Edit dengan tool online (remove.bg) untuk hapus background
- Upload ke field "Tanda Tangan Digital"

---

## 🔐 Akses & Permission

### Panel Admin (`/admin`)
- **Akses**: Admin role only
- **Fitur**:
  - Data Anggota (CRUD + Import/Export Excel)
  - User Management
  - Role & Permissions

### Panel PMII (`/pmii`)
- **Akses**: Semua user authenticated (admin, kader, pmii)
- **Fitur**:
  - Generator Surat (CRUD + Generate PDF)
  - Dashboard statistik surat & anggota
  - Akses ke data anggota (read-only via link)

---

## 📁 File Struktur

### Backend Files
**Models & Migrations:**
- `app/Models/Surat.php`
- `database/migrations/2026_01_11_120530_create_surats_table.php`
- `database/seeders/SuratSeeder.php`

**Filament PMII Resources:**
- `app/Filament/Pmii/Resources/SuratResource.php`
- `app/Filament/Pmii/Resources/SuratResource/Pages/*.php` (List, Create, View, Edit)
- `app/Filament/Pmii/Pages/Dashboard.php`
- `app/Filament/Pmii/Widgets/SuratStatsWidget.php`
- `app/Filament/Pmii/Widgets/AnggotaStatsWidget.php`

**PDF Generation:**
- `app/Http/Controllers/SuratPdfController.php`
- `resources/views/pdf/surat.blade.php`

**Panel Providers (Tema):**
- `app/Providers/Filament/AdminPanelProvider.php` (Emerald theme)
- `app/Providers/Filament/PmiiPanelProvider.php` (Indigo theme)

**Views:**
- `resources/views/filament/pages/dashboard.blade.php` (Admin dashboard)
- `resources/views/filament/pmii/pages/dashboard.blade.php` (PMII dashboard)

### Routes
- `GET /surat/{surat}/pdf` - Generate PDF surat

---

## 🎯 Contoh Surat yang Sudah Ada

Setelah seeding, akan ada 3 surat contoh:

1. **Surat Tugas** - `001/PMII-MAHBUB/ST/2026`
   - Perihal: Penugasan Koordinator Kegiatan Ramadhan
   - Status: Final

2. **Surat Keterangan** - `002/PMII-MAHBUB/SK/2026`
   - Perihal: Surat Keterangan Aktif Berorganisasi
   - Status: Final

3. **Surat Undangan** - `003/PMII-MAHBUB/SU/2026`
   - Perihal: Undangan Rapat Kerja Tahunan 2026
   - Status: Draft

---

## 🚀 Testing

### Login ke Panel PMII
```
Email: kader@pmii.org
Password: password
```

### Login ke Panel Admin
```
Email: admin@pmii.org
Password: password
```

### Test Flow Generator Surat:
1. Login ke `/pmii`
2. Lihat dashboard → Stats widget surat
3. Klik "Generator Surat" → List 3 surat contoh
4. Klik "Generate PDF" pada salah satu surat
5. PDF terbuka dengan format profesional
6. Klik "Buat Surat Baru"
7. Isi form lengkap
8. Generate PDF hasil surat baru

---

## 📦 Package Baru yang Diinstall

- **barryvdh/laravel-dompdf** v3.1.1 - Generate PDF dari Blade view

---

## 🎨 Screenshot Locations

### Panel Admin (Emerald Theme)
- `/admin` - Dashboard hijau dengan stats anggota
- `/admin/anggotas` - Data anggota dengan import/export

### Panel PMII (Indigo Theme)
- `/pmii` - Dashboard biru dengan quick actions surat
- `/pmii/surats` - Generator surat list
- `/pmii/surats/create` - Form buat surat
- `/surat/{id}/pdf` - Preview PDF surat

---

**Updated**: 11 Januari 2026, 19:15 WIB
**Version**: 2.0 - Custom Themes & Generator Surat

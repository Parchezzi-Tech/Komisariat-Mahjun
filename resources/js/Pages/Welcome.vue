<script setup>
import { onMounted, ref } from 'vue'
import Lenis from 'lenis'
import { ChevronDown, ArrowRight, Users, BookOpen, Quote, MapPin, Phone, Mail, Instagram, Facebook, Youtube, Send, Target, Eye } from 'lucide-vue-next'

// Artikel state - akan diambil dari database
const artikels = ref([])
const isLoadingArtikel = ref(true)

// Simulate loading artikel from database (replace with actual API call)
const loadArtikels = async () => {
  isLoadingArtikel.value = true
  await new Promise(resolve => setTimeout(resolve, 1500))
  artikels.value = []
  isLoadingArtikel.value = false
}

onMounted(() => {
  loadArtikels()
  
  const lenis = new Lenis({
    duration: 2,
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    smooth: true,
  })
  const raf = (time) => {
    lenis.raf(time)
    requestAnimationFrame(raf)
  }
  requestAnimationFrame(raf)
})
</script>

<template>
  <!-- NAVBAR -->
  <nav class="fixed top-0 left-0 right-0 z-50 bg-slate-900/95 backdrop-blur-md border-b border-amber-500/20">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-4">
        <img src="/images/logo_mahbub.jpg" alt="Logo Komisariat Mahbub Djunaidi" class="w-11 h-11 rounded-full object-cover border-2 border-amber-500" />
        <div>
          <span class="text-amber-400 font-bold text-lg">PMII Komisariat</span>
          <span class="block text-slate-400 text-sm">Mahbub Djunaidi</span>
        </div>
      </div>
      <div class="hidden md:flex items-center gap-8">
        <a href="#sejarah" class="text-slate-300 hover:text-amber-400 transition font-medium">Sejarah</a>
        <a href="#tokoh" class="text-slate-300 hover:text-amber-400 transition font-medium">Tokoh</a>
        <a href="#artikel" class="text-slate-300 hover:text-amber-400 transition font-medium">Artikel</a>
        <a href="#kontak" class="text-slate-300 hover:text-amber-400 transition font-medium">Kontak</a>
        <a href="/admin" class="px-6 py-2.5 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-900 font-semibold rounded-lg transition shadow-lg shadow-amber-500/25">
          Portal Kader
        </a>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section class="relative min-h-screen flex items-center justify-center bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950">
    <!-- Subtle gradient orb -->
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-amber-500/5 rounded-full blur-3xl" />
    
    <!-- Background Logo - subtle -->
    <img src="/images/Logo_PMII.png" alt="Logo PMII" class="absolute opacity-[0.02] w-[500px] h-[500px] object-contain" />
    
    <div class="relative z-10 text-center px-8 max-w-4xl mx-auto pt-20">
      <!-- Logo Komisariat -->
      <div class="mb-10 animate-fade-in">
        <img src="/images/logo_mahbub.jpg" alt="Logo Komisariat Mahbub Djunaidi" class="w-32 h-32 md:w-40 md:h-40 rounded-full mx-auto object-cover border-4 border-amber-500 shadow-xl" />
      </div>
      
      <p class="text-lg text-amber-400 font-medium tracking-wider uppercase mb-4 animate-fade-in">
        PMII Komisariat
      </p>
      
      <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold tracking-tight leading-none mb-6 animate-fade-in animation-delay-300">
        <span class="text-amber-400">MAHBUB</span>
        <br>
        <span class="text-slate-200">DJUNAIDI</span>
      </h1>
      
      <p class="text-lg md:text-xl text-slate-400 max-w-2xl mx-auto mb-12 animate-fade-in animation-delay-700">
        Universitas Bhayangkara Jakarta Raya — Wadah kaderisasi intelektual, spiritual, dan sosial mahasiswa Islam
      </p>
      
      <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in animation-delay-1000">
        <a href="/admin" class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-900 text-lg font-semibold rounded-xl transition-all shadow-lg shadow-amber-500/25 hover:shadow-amber-500/40">
          Portal Kader
          <ArrowRight class="w-5 h-5" />
        </a>
        <a href="#sejarah" class="inline-flex items-center justify-center gap-3 px-8 py-4 border-2 border-slate-700 hover:border-amber-500/50 text-slate-300 hover:text-amber-400 text-lg font-semibold rounded-xl transition-all">
          Pelajari Lebih
        </a>
      </div>
      
      <div class="mt-20 animate-fade-in animation-delay-1400">
        <ChevronDown class="w-8 h-8 text-slate-500 mx-auto animate-bounce" />
      </div>
    </div>
  </section>

  <!-- SEJARAH KOMISARIAT -->
  <section id="sejarah" class="py-24 bg-slate-900">
    <div class="max-w-6xl mx-auto px-8">
      <div class="text-center mb-16">
        <p class="text-amber-400 font-medium uppercase tracking-wider mb-3">Perjalanan Kami</p>
        <h2 class="text-4xl md:text-5xl font-bold text-slate-100 mb-4">Sejarah Komisariat</h2>
        <p class="text-slate-400 text-lg max-w-2xl mx-auto">
          Perjalanan PMII Komisariat Mahbub Djunaidi dalam mencetak kader-kader militan
        </p>
      </div>
      
      <!-- Timeline cards -->
      <div class="grid md:grid-cols-3 gap-6">
        <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-8 hover:border-amber-500/30 transition-all duration-300">
          <div class="text-5xl font-bold text-amber-400 mb-4">2017</div>
          <div class="w-12 h-1 bg-amber-500 mb-4 rounded-full" />
          <h3 class="text-xl font-semibold text-slate-100 mb-3">Lahirnya Komisariat</h3>
          <p class="text-slate-400">Berdiri resmi sebagai Komisariat PMII Mahbub Djunaidi di Universitas Bhayangkara Jakarta Raya</p>
        </div>
        
        <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-8 hover:border-amber-500/30 transition-all duration-300 md:mt-8">
          <div class="text-5xl font-bold text-amber-400 mb-4">2023</div>
          <div class="w-12 h-1 bg-amber-500 mb-4 rounded-full" />
          <h3 class="text-xl font-semibold text-slate-100 mb-3">Pertumbuhan Pesat</h3>
          <p class="text-slate-400">Menjadi komisariat dengan kader aktif yang terus berkembang dan berkontribusi</p>
        </div>
        
        <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-8 hover:border-amber-500/30 transition-all duration-300">
          <div class="text-5xl font-bold text-amber-400 mb-4">2026</div>
          <div class="w-12 h-1 bg-amber-500 mb-4 rounded-full" />
          <h3 class="text-xl font-semibold text-slate-100 mb-3">Era Digital</h3>
          <p class="text-slate-400">Meluncurkan platform digital untuk mendukung kaderisasi dan syiar organisasi</p>
        </div>
      </div>
    </div>
  </section>

  <!-- SIAPA MAHBUB DJUNAIDI -->
  <section id="tokoh" class="py-24 bg-slate-950">
    <div class="max-w-6xl mx-auto px-8 grid md:grid-cols-2 gap-16 items-center">
      <!-- Foto Tokoh -->
      <div class="order-2 md:order-1">
        <div class="relative">
          <img 
            src="/images/poto_tokoh_mahbub.jpg" 
            alt="Mahbub Djunaidi - Pendiri PMII" 
            class="rounded-2xl w-full h-[480px] object-cover shadow-2xl"
          />
          <!-- Badge -->
          <div class="absolute bottom-4 right-4 bg-amber-500 text-slate-900 px-5 py-2 rounded-lg font-semibold">
            1931 - 1987
          </div>
        </div>
      </div>
      
      <!-- Bio Content -->
      <div class="order-1 md:order-2">
        <p class="text-amber-400 font-medium uppercase tracking-wider mb-3">Tokoh Inspirasi</p>
        <h2 class="text-4xl md:text-5xl font-bold mb-8">
          <span class="text-amber-400">Siapa</span>
          <br>
          <span class="text-slate-100">Mahbub Djunaidi?</span>
        </h2>
        
        <div class="space-y-5 text-slate-300 text-lg leading-relaxed">
          <p>
            <strong class="text-amber-400">Mahbub Djunaidi</strong> (1931-1987) adalah salah satu tokoh pendiri PMII yang lahir di Sumenep, Madura. Beliau dikenal sebagai jurnalis, budayawan, dan kolumnis yang kritis dan jenaka.
          </p>
          <p>
            Bersama 19 tokoh lainnya, Mahbub Djunaidi turut mendirikan <strong class="text-amber-400">Pergerakan Mahasiswa Islam Indonesia (PMII)</strong> pada tanggal 17 April 1960 di Surabaya.
          </p>
        </div>
        
        <blockquote class="mt-8 bg-slate-800/50 border-l-4 border-amber-500 rounded-r-xl p-6">
          <p class="text-xl text-slate-200 italic leading-relaxed">
            "Jangan pernah takut bermimpi besar. Karena mimpi besar itulah yang membuat kita tetap bergerak."
          </p>
          <p class="text-amber-500 mt-3 font-medium">— Mahbub Djunaidi</p>
        </blockquote>
      </div>
    </div>
  </section>

  <!-- VISI MISI -->
  <section class="py-24 bg-slate-900">
    <div class="max-w-6xl mx-auto px-8">
      <div class="text-center mb-16">
        <p class="text-amber-400 font-medium uppercase tracking-wider mb-3">Tujuan Kami</p>
        <h2 class="text-4xl md:text-5xl font-bold text-slate-100">Visi & Misi</h2>
      </div>
      
      <div class="grid md:grid-cols-2 gap-8">
        <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-10 hover:border-amber-500/30 transition-all">
          <div class="flex items-center gap-4 mb-6">
            <div class="w-14 h-14 bg-amber-500 rounded-xl flex items-center justify-center">
              <Eye class="w-7 h-7 text-slate-900" />
            </div>
            <h3 class="text-2xl font-bold text-amber-400">Visi</h3>
          </div>
          <p class="text-slate-300 text-lg leading-relaxed">
            Menjadi komisariat yang unggul dalam melahirkan kader-kader intelektual, religius, dan berjiwa sosial tinggi yang siap berkontribusi untuk umat, bangsa, dan negara.
          </p>
        </div>
        
        <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-10 hover:border-amber-500/30 transition-all">
          <div class="flex items-center gap-4 mb-6">
            <div class="w-14 h-14 bg-amber-500 rounded-xl flex items-center justify-center">
              <Target class="w-7 h-7 text-slate-900" />
            </div>
            <h3 class="text-2xl font-bold text-amber-400">Misi</h3>
          </div>
          <ul class="text-slate-300 text-lg leading-relaxed space-y-3">
            <li class="flex items-start gap-3">
              <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mt-2.5 flex-shrink-0" />
              Melaksanakan kaderisasi yang berkualitas dan berkelanjutan
            </li>
            <li class="flex items-start gap-3">
              <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mt-2.5 flex-shrink-0" />
              Mengembangkan tradisi intelektual dan keislaman
            </li>
            <li class="flex items-start gap-3">
              <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mt-2.5 flex-shrink-0" />
              Membangun jaringan dan kerjasama yang luas
            </li>
            <li class="flex items-start gap-3">
              <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mt-2.5 flex-shrink-0" />
              Berkhidmah kepada masyarakat secara konsisten
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- ARTIKEL TERBARU -->
  <section id="artikel" class="py-24 bg-slate-950">
    <div class="max-w-6xl mx-auto px-8">
      <div class="flex items-center justify-between mb-12">
        <div>
          <p class="text-amber-400 font-medium uppercase tracking-wider mb-3">Karya Intelektual</p>
          <h2 class="text-4xl md:text-5xl font-bold text-slate-100">Tulisan Kader</h2>
        </div>
        <a href="/admin" class="hidden md:flex items-center gap-2 px-5 py-2.5 border border-slate-700 hover:border-amber-500/50 text-slate-300 hover:text-amber-400 rounded-lg transition-all">
          Lihat Semua <ArrowRight class="w-4 h-4" />
        </a>
      </div>
      
      <!-- Loading State -->
      <div v-if="isLoadingArtikel" class="flex flex-col items-center justify-center py-16">
        <div class="relative">
          <div class="w-16 h-16 border-4 border-slate-700 rounded-full" />
          <div class="absolute inset-0 w-16 h-16 border-4 border-transparent border-t-amber-500 rounded-full animate-spin" />
        </div>
        <p class="text-slate-400 mt-6">Memuat tulisan kader...</p>
      </div>
      
      <!-- Empty State -->
      <div v-else-if="artikels.length === 0" class="text-center py-16 bg-slate-800/30 border border-slate-700/50 rounded-2xl">
        <BookOpen class="w-16 h-16 text-slate-600 mx-auto mb-4" />
        <h3 class="text-xl font-semibold text-slate-200 mb-2">Belum Ada Tulisan</h3>
        <p class="text-slate-400 max-w-md mx-auto mb-6">
          Tulisan dari kader-kader Komisariat Mahbub Djunaidi akan segera hadir.
        </p>
        <a href="/admin" class="inline-flex items-center gap-2 px-6 py-3 bg-amber-500 hover:bg-amber-400 text-slate-900 font-semibold rounded-lg transition">
          <BookOpen class="w-5 h-5" />
          Tulis Artikel
        </a>
      </div>
      
      <!-- Articles Grid (when data exists) -->
      <div v-else class="grid md:grid-cols-3 gap-6">
        <article v-for="artikel in artikels" :key="artikel.id" class="bg-slate-800/50 border border-slate-700/50 rounded-2xl overflow-hidden hover:border-amber-500/30 transition-all cursor-pointer group">
          <div class="h-48 bg-slate-800 flex items-center justify-center">
            <BookOpen class="w-12 h-12 text-slate-600 group-hover:text-amber-500/50 transition" />
          </div>
          <div class="p-6">
            <span class="text-amber-500 text-sm font-medium uppercase">{{ artikel.category }}</span>
            <h3 class="text-xl font-semibold text-slate-100 mt-2 group-hover:text-amber-400 transition">{{ artikel.title }}</h3>
            <p class="text-slate-400 mt-3 text-sm line-clamp-2">{{ artikel.excerpt }}</p>
            <div class="flex items-center gap-3 mt-5 pt-5 border-t border-slate-700/50">
              <div class="w-8 h-8 rounded-full bg-amber-500 flex items-center justify-center text-slate-900 font-semibold text-sm">{{ artikel.author?.charAt(0) }}</div>
              <div>
                <p class="text-slate-200 text-sm font-medium">{{ artikel.author }}</p>
                <p class="text-slate-500 text-xs">{{ artikel.date }}</p>
              </div>
            </div>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- KONTAK -->
  <section id="kontak" class="py-24 bg-slate-900">
    <div class="max-w-6xl mx-auto px-8">
      <div class="text-center mb-12">
        <p class="text-amber-400 font-medium uppercase tracking-wider mb-3">Terhubung</p>
        <h2 class="text-4xl md:text-5xl font-bold text-slate-100 mb-4">Hubungi Kami</h2>
        <p class="text-slate-400 text-lg max-w-2xl mx-auto">Bergabung dan berkontribusi bersama Komisariat Mahbub Djunaidi</p>
      </div>
      
      <!-- Contact Cards -->
      <div class="grid md:grid-cols-3 gap-6 mb-12">
        <a href="https://maps.google.com" target="_blank" class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-8 hover:border-amber-500/30 transition-all group">
          <div class="w-14 h-14 bg-amber-500 rounded-xl flex items-center justify-center mb-5">
            <MapPin class="w-7 h-7 text-slate-900" />
          </div>
          <h3 class="text-lg font-semibold text-slate-100 mb-2">Lokasi</h3>
          <p class="text-slate-400 text-sm mb-3">Universitas Bhayangkara Jakarta Raya, Bekasi, Jawa Barat</p>
          <span class="text-amber-500 text-sm font-medium group-hover:text-amber-400 flex items-center gap-1">
            Lihat Maps <ArrowRight class="w-4 h-4" />
          </span>
        </a>
        
        <a href="tel:+62xxxxxxxxxx" class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-8 hover:border-amber-500/30 transition-all group">
          <div class="w-14 h-14 bg-amber-500 rounded-xl flex items-center justify-center mb-5">
            <Phone class="w-7 h-7 text-slate-900" />
          </div>
          <h3 class="text-lg font-semibold text-slate-100 mb-2">Telepon</h3>
          <p class="text-slate-400 text-sm mb-3">Hubungi kami untuk informasi lebih lanjut</p>
          <span class="text-amber-500 text-sm font-medium group-hover:text-amber-400">+62 xxx-xxxx-xxxx</span>
        </a>
        
        <a href="mailto:komisariat.mahbubdjunaidi@gmail.com" class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-8 hover:border-amber-500/30 transition-all group">
          <div class="w-14 h-14 bg-amber-500 rounded-xl flex items-center justify-center mb-5">
            <Mail class="w-7 h-7 text-slate-900" />
          </div>
          <h3 class="text-lg font-semibold text-slate-100 mb-2">Email</h3>
          <p class="text-slate-400 text-sm mb-3">Kirim pertanyaan atau proposal</p>
          <span class="text-amber-500 text-sm font-medium group-hover:text-amber-400 flex items-center gap-1">
            Tulis Email <Send class="w-4 h-4" />
          </span>
        </a>
      </div>
      
      <!-- Social Media -->
      <div class="bg-slate-800/30 border border-slate-700/50 rounded-2xl p-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
          <div>
            <h3 class="text-xl font-semibold text-slate-100 mb-1">Ikuti Media Sosial Kami</h3>
            <p class="text-slate-400">Dapatkan update kegiatan terbaru</p>
          </div>
          <div class="flex gap-4">
            <a href="#" class="flex items-center gap-2 px-5 py-3 bg-slate-700/50 hover:bg-pink-500/10 border border-slate-600 hover:border-pink-500/50 rounded-xl transition-all">
              <Instagram class="w-5 h-5 text-pink-400" />
              <span class="text-slate-200 font-medium">Instagram</span>
            </a>
            <a href="#" class="flex items-center gap-2 px-5 py-3 bg-slate-700/50 hover:bg-blue-500/10 border border-slate-600 hover:border-blue-500/50 rounded-xl transition-all">
              <Facebook class="w-5 h-5 text-blue-400" />
              <span class="text-slate-200 font-medium">Facebook</span>
            </a>
            <a href="#" class="flex items-center gap-2 px-5 py-3 bg-slate-700/50 hover:bg-red-500/10 border border-slate-600 hover:border-red-500/50 rounded-xl transition-all">
              <Youtube class="w-5 h-5 text-red-400" />
              <span class="text-slate-200 font-medium">YouTube</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="py-12 bg-slate-950 border-t border-slate-800">
    <div class="max-w-6xl mx-auto px-8">
      <div class="grid md:grid-cols-3 gap-10 mb-10">
        <!-- Logo & Info -->
        <div>
          <div class="flex items-center gap-3 mb-4">
            <img src="/images/logo_mahbub.jpg" alt="Logo Komisariat" class="w-12 h-12 rounded-full object-cover border-2 border-amber-500" />
            <div>
              <span class="text-amber-400 font-bold">PMII Komisariat</span>
              <span class="block text-slate-500 text-sm">Mahbub Djunaidi</span>
            </div>
          </div>
          <p class="text-slate-500 text-sm leading-relaxed">
            Organisasi pergerakan mahasiswa Islam yang berdiri di bawah naungan NU, berkhidmah untuk umat, bangsa, dan negara.
          </p>
        </div>
        
        <!-- Quick Links -->
        <div>
          <h4 class="text-slate-200 font-semibold mb-4">Navigasi</h4>
          <ul class="space-y-2">
            <li><a href="#sejarah" class="text-slate-500 hover:text-amber-400 transition text-sm">Sejarah</a></li>
            <li><a href="#tokoh" class="text-slate-500 hover:text-amber-400 transition text-sm">Tokoh</a></li>
            <li><a href="#artikel" class="text-slate-500 hover:text-amber-400 transition text-sm">Artikel</a></li>
            <li><a href="#kontak" class="text-slate-500 hover:text-amber-400 transition text-sm">Kontak</a></li>
            <li><a href="/admin" class="text-slate-500 hover:text-amber-400 transition text-sm">Portal Kader</a></li>
          </ul>
        </div>
        
        <!-- Semboyan -->
        <div>
          <h4 class="text-slate-200 font-semibold mb-4">Semboyan</h4>
          <div class="bg-slate-800/50 border border-slate-700/50 rounded-xl p-5">
            <p class="text-amber-400 italic font-medium">"Dzikir, Fikir, Amal Soleh"</p>
            <p class="text-slate-500 text-sm mt-2">Fondasi spiritual, intelektual, dan aksi nyata kader PMII</p>
          </div>
          <div class="flex items-center gap-3 mt-4">
            <img src="/images/Logo_PMII.png" alt="Logo PMII" class="w-8 h-8 object-contain opacity-60" />
            <span class="text-slate-600 text-sm">PMII - 17 April 1960</span>
          </div>
        </div>
      </div>
      
      <div class="border-t border-slate-800 pt-6 flex flex-col md:flex-row items-center justify-between gap-4">
        <p class="text-slate-600 text-sm">
          © 2026 PMII Komisariat Mahbub Djunaidi - Universitas Bhayangkara Jakarta Raya
        </p>
        <p class="text-slate-700 text-xs">
          Dibangun dengan khidmah 💛
        </p>
      </div>
    </div>
  </footer>
</template>

<style scoped>
@keyframes fade-in {
  from { opacity: 0; transform: translateY(30px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
  animation: fade-in 0.8s ease-out forwards;
  opacity: 0;
}
.animation-delay-300 { animation-delay: 0.3s; }
.animation-delay-700 { animation-delay: 0.7s; }
.animation-delay-1000 { animation-delay: 1s; }
.animation-delay-1400 { animation-delay: 1.4s; }

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>

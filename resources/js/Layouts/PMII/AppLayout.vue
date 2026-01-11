<script setup>
import { Head } from '@inertiajs/vue3'
</script>

<template>
  <div class="min-h-screen bg-gray-50 dark:bg-black font-cairo">
    <Head title="PMII Mahbub Djunaidi" />
    
    <!-- Navbar Fixed -->
    <nav class="fixed top-0 w-full z-50 bg-white/90 dark:bg-black/90 backdrop-blur border-b border-green-600/30">
      <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-4">
          <img src="/storage/logo-pmii.png" alt="PMII" class="h-12 rounded-full shadow-lg">
          <div>
            <h1 class="text-xl font-bold text-green-700 dark:text-green-400">PMII Mahbub Djunaidi</h1>
            <p class="text-xs text-gray-600 dark:text-gray-400">Universitas Bhayangkara Jakarta Raya</p>
          </div>
        </div>
        <div class="text-xs font-bold text-green-600">
          Bergerak Bersama Umat • Mengabdi Bersama Rakyat
        </div>
      </div>
    </nav>

    <main class="pt-20">
      <slot />
    </main>
  </div>
</template>
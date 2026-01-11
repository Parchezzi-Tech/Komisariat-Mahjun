<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'
import { Lock, Mail, Eye, EyeOff, ShieldCheck, LogIn } from 'lucide-vue-next'

defineProps({
    canResetPassword: Boolean,
    status: String,
})

const form = useForm({
    email: '',
    password: '',
    remember: false,
})

const showPassword = ref(false)

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    })
}
</script>

<template>
  <Head title="Login - PMII Komisariat" />

  <div class="min-h-screen bg-slate-950 text-slate-100 flex">
    <!-- Left: Brand -->
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
      <div class="absolute inset-0 bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950" />
      <div class="absolute -top-24 -left-24 w-[520px] h-[520px] bg-amber-500/10 rounded-full blur-3xl" />
      <div class="absolute bottom-0 right-0 w-[520px] h-[520px] bg-amber-500/5 rounded-full blur-3xl" />
      </div>
      <div class="relative z-10 p-12 flex flex-col justify-between w-full">
        <div class="flex items-center gap-4">
          <img src="/images/logo_mahbub.jpg" alt="Logo Komisariat" class="w-12 h-12 rounded-full object-cover border-2 border-amber-500" />
          <div>
            <div class="text-amber-400 font-bold">PMII Komisariat</div>
            <div class="text-slate-400 text-sm">Mahbub Djunaidi</div>
          </div>
        </div>
        </div>

        <div>
          <h1 class="text-4xl font-bold leading-tight">
            <span class="text-amber-400">Portal</span> Kader & Anggota
          </h1>
          <p class="mt-4 text-slate-400 max-w-md">
            Masuk untuk mengakses dashboard sesuai peran Anda.
          </p>
        </div>
    </div>
  <div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-amber-950 flex items-center justify-center px-4 py-8">
    <!-- Background pattern -->
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_120%,rgba(251,191,36,0.1),transparent)] pointer-events-none"></div>
    
    <div class="w-full max-w-md relative">
      <!-- Logo & Header -->
      <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 shadow-2xl shadow-amber-500/30 mb-6">
          <img src="/images/logo_mahbub.jpg" alt="Logo" class="w-16 h-16 rounded-xl object-cover" />
        </div>
        <h1 class="text-3xl font-bold text-white mb-2">Selamat Datang</h1>
        <p class="text-slate-400">PMII Komisariat Mahbub Djunaidi</p>
      </div>

      <!-- Login Card -->
      <div class="bg-slate-900/80 backdrop-blur-xl border border-slate-800/50 rounded-2xl shadow-2xl p-8">
        <!-- Status Message -->
        <div v-if="status" class="mb-6 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm">
          {{ status }}
        </div>

        <form @submit.prevent="submit" class="space-y-6">
          <!-- Email -->
          <div>
            <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <Mail class="h-5 w-5 text-slate-500" />
              </div>
              <input
                id="email"
                v-model="form.email"
                type="email"
                required
                autofocus
                autocomplete="username"
                class="block w-full pl-12 pr-4 py-3 bg-slate-950/50 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition"
                :class="{ 'border-red-500 focus:ring-red-500': form.errors.email }"
                placeholder="email@example.com"
              />
            </div>
            <p v-if="form.errors.email" class="mt-2 text-sm text-red-400">{{ form.errors.email }}</p>
          </div>

          <!-- Password -->
          <div>
            <label for="password" class="block text-sm font-medium text-slate-300 mb-2">Password</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <Lock class="h-5 w-5 text-slate-500" />
              </div>
              <input
                id="password"
                v-model="form.password"
                :type="showPassword ? 'text' : 'password'"
                required
                autocomplete="current-password"
                class="block w-full pl-12 pr-12 py-3 bg-slate-950/50 border border-slate-800 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition"
                :class="{ 'border-red-500 focus:ring-red-500': form.errors.password }"
                placeholder="••••••••"
              />
              <button
                type="button"
                @click="showPassword = !showPassword"
                class="absolute inset-y-0 right-0 pr-4 flex items-center"
              >
                <Eye v-if="!showPassword" class="h-5 w-5 text-slate-500 hover:text-slate-400 transition" />
                <EyeOff v-else class="h-5 w-5 text-slate-500 hover:text-slate-400 transition" />
              </button>
            </div>
            <p v-if="form.errors.password" class="mt-2 text-sm text-red-400">{{ form.errors.password }}</p>
          </div>

          <!-- Remember & Forgot -->
          <div class="flex items-center justify-between">
            <label class="flex items-center">
              <input
                v-model="form.remember"
                type="checkbox"
                class="w-4 h-4 rounded border-slate-700 bg-slate-950/50 text-amber-500 focus:ring-amber-500 focus:ring-offset-0"
              />
              <span class="ml-2 text-sm text-slate-400">Ingat saya</span>
            </label>

            <Link
              v-if="canResetPassword"
              :href="route('password.request')"
              class="text-sm text-amber-400 hover:text-amber-300 transition"
            >
              Lupa password?
            </Link>
          </div>

          <!-- Submit Button -->
          <button
            type="submit"
            :disabled="form.processing"
            class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 disabled:opacity-50 disabled:cursor-not-allowed text-slate-900 font-semibold rounded-xl shadow-lg shadow-amber-500/30 hover:shadow-amber-500/50 transition-all duration-200"
          >
            <LogIn class="w-5 h-5" />
            <span>{{ form.processing ? 'Masuk...' : 'Masuk' }}</span>
          </button>

          <div class="text-center">
            <Link href="/" class="text-sm text-slate-500 hover:text-slate-300 transition">Kembali ke Beranda</Link>
          </div>
        </form>

        <!-- Info Footer -->
        <div class="mt-6 pt-6 border-t border-slate-800">
          <p class="text-center text-sm text-slate-500">
            <ShieldCheck class="inline w-4 h-4 mr-1" />
            Akses terbatas untuk anggota terdaftar
          </p>
        </div>
      </div>

      <!-- Bottom Info -->
      <p class="text-center text-sm text-slate-500 mt-6">
        © 2026 PMII Komisariat Mahbub Djunaidi
      </p>
    </div>
  </div>
</template>

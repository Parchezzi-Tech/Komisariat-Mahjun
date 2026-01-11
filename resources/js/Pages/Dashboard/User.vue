<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3'
import { ArrowRight, LayoutDashboard, LogOut, Shield, Home, Users, Calendar, BookOpen, Award, TrendingUp, Activity, Bell } from 'lucide-vue-next'

const page = usePage()
const user = page.props.auth?.user

// Check if user has admin role
const hasAdminRole = user?.roles?.some(role => role.name === 'admin')
const hasKaderRole = user?.roles?.some(role => role.name === 'kader')

const stats = [
  { label: 'Status', value: hasAdminRole ? 'Admin' : 'Kader', icon: Shield, color: 'amber' },
  { label: 'Akses Panel', value: hasAdminRole ? 'Full' : 'Terbatas', icon: Activity, color: 'emerald' },
  { label: 'Role', value: user?.roles?.[0]?.name || 'User', icon: Award, color: 'blue' },
]

const quickActions = hasAdminRole ? [
  { title: 'Panel Admin', desc: 'Kelola sistem & data', href: '/admin', icon: LayoutDashboard, color: 'amber' },
  { title: 'Panel PMII', desc: 'Portal khusus PMII', href: '/pmii', icon: Users, color: 'emerald' },
  { title: 'User Management', desc: 'Kelola data user', href: '/admin/users', icon: Shield, color: 'blue' },
] : [
  { title: 'Portal PMII', desc: 'Portal khusus kader', href: '/pmii', icon: LayoutDashboard, color: 'amber' },
  { title: 'Dashboard', desc: 'Lihat statistik', href: '/dashboard', icon: TrendingUp, color: 'emerald' },
]
</script>

<template>
  <Head title="Dashboard" />

  <div class="min-h-screen bg-slate-950 text-slate-100">
    <!-- Header -->
    <div class="bg-gradient-to-r from-slate-900 to-slate-950 border-b border-slate-800">
      <div class="max-w-7xl mx-auto px-6 py-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
          <div class="flex items-center gap-4">
            <img src="/images/logo_mahbub.jpg" alt="Logo Komisariat" class="w-14 h-14 rounded-xl object-cover border-2 border-amber-500 shadow-lg shadow-amber-500/20" />
            <div>
              <h1 class="text-2xl font-bold">Dashboard</h1>
              <p class="text-slate-400 text-sm">Selamat datang, <span class="text-amber-400 font-medium">{{ user?.name }}</span></p>
            </div>
          </div>

          <div class="flex items-center gap-3">
            <Link href="/" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-800 bg-slate-900/50 hover:border-amber-500/30 text-slate-200 transition">
              <Home class="w-4 h-4" />
              <span class="hidden sm:inline">Beranda</span>
            </Link>

            <Link
              :href="route('logout')"
              method="post"
              as="button"
              class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-800 hover:border-red-500/30 text-slate-200 transition"
            >
              <LogOut class="w-4 h-4" />
              <span class="hidden sm:inline">Logout</span>
            </Link>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-8">
      <!-- Stats Grid -->
      <div class="grid md:grid-cols-3 gap-6 mb-8">
        <div v-for="stat in stats" :key="stat.label" class="bg-slate-900/50 border border-slate-800 rounded-2xl p-6 hover:border-amber-500/30 transition">
          <div class="flex items-center gap-4">
            <div :class="[
              'w-12 h-12 rounded-xl flex items-center justify-center',
              stat.color === 'amber' ? 'bg-amber-500/10 text-amber-400' :
              stat.color === 'emerald' ? 'bg-emerald-500/10 text-emerald-400' :
              'bg-blue-500/10 text-blue-400'
            ]">
              <component :is="stat.icon" class="w-6 h-6" />
            </div>
            <div>
              <div class="text-2xl font-bold">{{ stat.value }}</div>
              <div class="text-slate-400 text-sm">{{ stat.label }}</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Welcome Card -->
      <div class="bg-gradient-to-r from-amber-500/10 to-amber-600/5 border border-amber-500/20 rounded-2xl p-6 mb-8">
        <div class="flex items-start gap-4">
          <div class="w-12 h-12 rounded-xl bg-amber-500 flex items-center justify-center flex-shrink-0">
            <TrendingUp class="w-6 h-6 text-slate-900" />
          </div>
          <div class="flex-1">
            <h2 class="text-xl font-semibold text-white mb-2">Portal Terintegrasi</h2>
            <p class="text-slate-300 text-sm leading-relaxed">
              {{ hasAdminRole 
                ? 'Anda memiliki akses penuh untuk mengelola sistem dan data. Gunakan panel admin untuk manajemen user, role, dan konten.' 
                : 'Selamat datang di portal kader. Akses fitur dan layanan yang tersedia untuk Anda.' 
              }}
            </p>
          </div>
        </div>
      </div>

      <!-- Quick Actions -->
      <div>
        <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
          <LayoutDashboard class="w-5 h-5 text-amber-400" />
          Akses Cepat
        </h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          <a 
            v-for="action in quickActions" 
            :key="action.title"
            :href="action.href" 
            class="group bg-slate-900/50 border border-slate-800 rounded-2xl p-6 hover:border-amber-500/30 hover:bg-slate-900/80 transition-all"
          >
            <div class="flex items-start gap-4">
              <div :class="[
                'w-12 h-12 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform',
                action.color === 'amber' ? 'bg-amber-500/10 text-amber-400' :
                action.color === 'emerald' ? 'bg-emerald-500/10 text-emerald-400' :
                'bg-blue-500/10 text-blue-400'
              ]">
                <component :is="action.icon" class="w-6 h-6" />
              </div>
              <div class="flex-1">
                <h3 class="font-semibold text-white mb-1">{{ action.title }}</h3>
                <p class="text-slate-400 text-sm">{{ action.desc }}</p>
              </div>
              <ArrowRight class="w-5 h-5 text-slate-600 group-hover:text-amber-400 group-hover:translate-x-1 transition-all" />
            </div>
          </a>
        </div>
      </div>

      <!-- Info Section -->
      <div class="mt-8 bg-slate-900/30 border border-slate-800/50 rounded-2xl p-6">
        <div class="flex items-center gap-3 text-slate-400 text-sm">
          <Bell class="w-5 h-5 text-amber-400" />
          <p>
            Informasi akun: <span class="text-slate-300">{{ user?.email }}</span>
            <span v-if="user?.email_verified_at" class="ml-2 text-emerald-400">• Terverifikasi</span>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

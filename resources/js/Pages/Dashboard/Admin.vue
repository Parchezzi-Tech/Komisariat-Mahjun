<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3'
import { ArrowRight, LogOut, ShieldCheck, Settings, Home, Users, Database, Lock, Shield, BarChart3, FileText, Activity } from 'lucide-vue-next'

const page = usePage()
const user = page.props.auth?.user

const adminStats = [
  { label: 'Total Users', value: '-', icon: Users, color: 'blue' },
  { label: 'Data Anggota', value: '-', icon: Database, color: 'emerald' },
  { label: 'System Health', value: 'Optimal', icon: BarChart3, color: 'amber' },
]

const adminPanels = [
  { 
    title: 'Panel Admin', 
    desc: 'Kelola user, role, dan permission melalui Filament',
    href: '/admin', 
    icon: Settings, 
    color: 'amber',
    badge: 'Primary'
  },
  { 
    title: 'Panel PMII', 
    desc: 'Panel terpisah untuk manajemen data PMII',
    href: '/pmii', 
    icon: Shield, 
    color: 'emerald',
    badge: 'Secondary'
  },
]

const adminTools = [
  { title: 'Data Anggota', desc: 'Kelola database anggota', icon: Users, href: '/admin/anggotas' },
  { title: 'User Management', desc: 'Kelola akun pengguna', icon: Users, href: '/admin/users' },
  { title: 'Role & Permissions', desc: 'Atur hak akses', icon: Lock, href: '/admin/roles' },
  { title: 'Dashboard Filament', desc: 'Panel utama Filament', icon: Settings, href: '/admin' },
]
</script>

<template>
  <Head title="Admin Dashboard" />

  <div class="min-h-screen bg-slate-950 text-slate-100">
    <!-- Header -->
    <div class="bg-gradient-to-r from-amber-600/10 via-slate-900 to-slate-950 border-b border-amber-500/20">
      <div class="max-w-7xl mx-auto px-6 py-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
          <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center shadow-lg shadow-amber-500/30">
              <ShieldCheck class="w-8 h-8 text-slate-900" />
            </div>
            <div>
              <h1 class="text-2xl font-bold">Admin Dashboard</h1>
              <p class="text-slate-400 text-sm">Masuk sebagai <span class="text-amber-400 font-medium">{{ user?.name }}</span></p>
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
        <div v-for="stat in adminStats" :key="stat.label" class="bg-slate-900/50 border border-slate-800 rounded-2xl p-6 hover:border-amber-500/30 transition">
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

      <!-- Admin Panels -->
      <div class="mb-8">
        <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
          <Database class="w-5 h-5 text-amber-400" />
          Panel Filament
        </h2>
        <div class="grid md:grid-cols-2 gap-6">
          <a 
            v-for="panel in adminPanels" 
            :key="panel.title"
            :href="panel.href" 
            class="group relative bg-gradient-to-br from-slate-900/80 to-slate-900/50 border border-slate-800 rounded-2xl p-8 hover:border-amber-500/30 hover:shadow-xl hover:shadow-amber-500/5 transition-all"
          >
            <div class="absolute top-4 right-4">
              <span class="px-3 py-1 text-xs font-medium rounded-full bg-amber-500/10 text-amber-400 border border-amber-500/20">
                {{ panel.badge }}
              </span>
            </div>
            <div class="flex items-start gap-4 mb-4">
              <div :class="[
                'w-14 h-14 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform',
                panel.color === 'amber' ? 'bg-gradient-to-br from-amber-500 to-amber-600 shadow-lg shadow-amber-500/30' :
                'bg-gradient-to-br from-emerald-500 to-emerald-600 shadow-lg shadow-emerald-500/30'
              ]">
                <component :is="panel.icon" class="w-7 h-7 text-slate-900" />
              </div>
              <div class="flex-1">
                <h3 class="text-xl font-semibold text-white mb-2">{{ panel.title }}</h3>
                <p class="text-slate-400 text-sm leading-relaxed">{{ panel.desc }}</p>
              </div>
            </div>
            <div class="flex items-center gap-2 text-amber-400 font-medium text-sm group-hover:gap-3 transition-all">
              <span>Buka Panel</span>
              <ArrowRight class="w-4 h-4" />
            </div>
          </a>
        </div>
      </div>

      <!-- Quick Tools -->
      <div>
        <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
          <Settings class="w-5 h-5 text-amber-400" />
          Admin Tools
        </h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
          <a 
            v-for="tool in adminTools" 
            :key="tool.title"
            :href="tool.href" 
            class="group bg-slate-900/50 border border-slate-800 rounded-xl p-5 hover:border-amber-500/30 hover:bg-slate-900/80 transition-all"
          >
            <component :is="tool.icon" class="w-8 h-8 text-amber-400 mb-3 group-hover:scale-110 transition-transform" />
            <h3 class="font-semibold text-white text-sm mb-1">{{ tool.title }}</h3>
            <p class="text-slate-500 text-xs">{{ tool.desc }}</p>
          </a>
        </div>
      </div>

      <!-- System Info -->
      <div class="mt-8 grid md:grid-cols-2 gap-6">
        <div class="bg-slate-900/30 border border-slate-800/50 rounded-2xl p-6">
          <h3 class="font-semibold mb-3 flex items-center gap-2">
            <Shield class="w-5 h-5 text-emerald-400" />
            <span>Admin Access</span>
          </h3>
          <p class="text-slate-400 text-sm">Anda memiliki hak akses penuh untuk mengelola seluruh sistem.</p>
        </div>
        <div class="bg-slate-900/30 border border-slate-800/50 rounded-2xl p-6">
          <h3 class="font-semibold mb-3 flex items-center gap-2">
            <Activity class="w-5 h-5 text-amber-400" />
            <span>Akun Info</span>
          </h3>
          <p class="text-slate-400 text-sm">{{ user?.email }} <span class="text-emerald-400">• Admin</span></p>
        </div>
      </div>
    </div>
  </div>
</template>

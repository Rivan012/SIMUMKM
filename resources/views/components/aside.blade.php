<aside id="sidebar"
    class="fixed left-0 top-0 h-screen w-64 bg-slate-900 text-slate-300 z-50 transform -translate-x-full lg:translate-x-0 sidebar-transition flex flex-col border-r border-slate-800">
    <!-- Logo Section -->
    <div class="p-6 flex items-center gap-3">
        <div
            class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-indigo-500/20">
            <i data-lucide="store" class="w-6 h-6"></i>
        </div>
        <div>
            <h1 class="text-xl font-bold text-white tracking-tight">SimUMKM</h1>
            <p class="text-[10px] text-slate-500 uppercase tracking-widest font-semibold">Management System</p>
        </div>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 px-4 space-y-1 overflow-y-auto mt-4">
        <p class="text-[10px] font-bold text-slate-500 px-4 py-2 uppercase tracking-widest">Master</p>
        <x-navigation href="web-settings" icon="layout-dashboard">
            Web Settings
        </x-navigation>
        <p class="text-[10px] font-bold text-slate-500 px-4 py-2 uppercase tracking-widest">Main Menu</p>

        <x-navigation href="dashboard" icon="layout-dashboard">
            Dashboard
        </x-navigation>


    </nav>

    <!-- Profile / Logout -->
    <div class="p-4 border-t border-slate-800">
        <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-800/50">
            <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white">
                <i data-lucide="user" class="w-6 h-6"></i>
            </div>
            <div class="overflow-hidden">
                <p class="text-sm font-semibold text-white truncate">Admin SimUMKM</p>
                <p class="text-xs text-slate-500 truncate">Super Admin</p>
            </div>
        </div>
        <button onclick="handleLogout()"
            class="w-full flex items-center justify-center gap-2 mt-3 py-2 text-xs text-rose-400 hover:bg-rose-500/10 rounded-lg transition-colors">
            <i data-lucide="log-out" class="w-4 h-4"></i>
            <span>Keluar Aplikasi</span>
        </button>
    </div>
</aside>
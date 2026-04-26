<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$webConfig->name ?? ''}}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $webConfig->logo) }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
    <link rel="stylesheet" href="{{asset('css/global.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }

        .sidebar-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .hidden-view {
            display: none !important;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
    </style>
</head>

<body class="text-slate-800">
    <div id="dashboard-section">
        <!-- Mobile Overlay -->
        <div id="mobile-overlay" class="fixed inset-0 bg-slate-900/50 z-40 hidden lg:hidden"></div>
        <main class="lg:ml-64 min-h-screen sidebar-transition">

            <x-aside />
            <x-header />
            {{ $slot }}
    </div>
    </main>
    <!-- Footer -->
    <footer class="p-6 text-center text-xs text-slate-400 border-t border-slate-200">
        &copy; 2024 SimUMKM Management System.
    </footer>
    </main>
    </div>

    <script>
        // Inisialisasi Ikon Lucide
        lucide.createIcons();

        // const dashboardSection = document.getElementById('dashboard-section');



        // SIDEBAR LOGIC
        const sidebar = document.getElementById('sidebar');
        const mobileToggle = document.getElementById('mobile-toggle');
        const mobileOverlay = document.getElementById('mobile-overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            mobileOverlay.classList.toggle('hidden');
        }

        mobileToggle.addEventListener('click', toggleSidebar);
        mobileOverlay.addEventListener('click', toggleSidebar);

        // CHARTS LOGIC
        let growthChart, categoryChart;

        function initCharts() {
            // Avoid multiple instantiations
            if (growthChart) growthChart.destroy();
            if (categoryChart) categoryChart.destroy();

            const growthCtx = document.getElementById('growthChart').getContext('2d');
            growthChart = new Chart(growthCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                    datasets: [{
                        label: 'UMKM Baru',
                        data: [120, 190, 150, 280, 220, 350],
                        borderColor: '#4f46e5',
                        backgroundColor: 'rgba(79, 70, 229, 0.1)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } }
                }
            });

            const categoryCtx = document.getElementById('categoryChart').getContext('2d');
            categoryChart = new Chart(categoryCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Kuliner', 'Fashion', 'Jasa', 'Lainnya'],
                    datasets: [{
                        data: [45, 25, 20, 10],
                        backgroundColor: ['#4f46e5', '#10b981', '#f59e0b', '#94a3b8'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: { legend: { position: 'bottom' } }
                }
            });
        }
        function addSocialRow() {
            const container = document.getElementById('social-container');

            const html = `
        <div class="social-row grid grid-cols-1 sm:grid-cols-7 gap-4 items-center">

            <div class="sm:col-span-2">
                <select class="w-full px-4 py-2.5 bg-slate-50 border rounded-xl text-sm">
                    <option value="instagram">Instagram</option>
                    <option value="facebook">Facebook</option>
                    <option value="twitter">Twitter / X</option>
                    <option value="youtube">YouTube</option>
                </select>
            </div>

            <div class="sm:col-span-4">
                <input type="text" placeholder="https://..."
                    class="w-full px-4 py-2.5 bg-slate-50 border rounded-xl text-sm">
            </div>

            <div class="sm:col-span-1 flex justify-end">
                <button type="button" onclick="this.closest('.social-row').remove()"
                    class="p-2 text-rose-500 hover:bg-rose-50 rounded-lg">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                </button>
            </div>

        </div>
    `;

            container.insertAdjacentHTML('beforeend', html);
            lucide.createIcons();
        }

        document.getElementById('settings-form').addEventListener('submit', function () {
            const rows = document.querySelectorAll('.social-row');

            const data = Array.from(rows)
                .map(row => ({
                    platform: row.querySelector('select').value,
                    url: row.querySelector('input').value
                }))
                .filter(item => item.url.trim() !== '');

            document.getElementById('social_media').value = JSON.stringify(data);
        });
    </script>
    <div id="toast"
        class="fixed bottom-6 right-6 z-[200] transform translate-y-20 opacity-0 transition-all duration-300 bg-slate-900 text-white px-6 py-4 rounded-2xl shadow-2xl text-sm font-medium">
    </div>
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                showToast("{{ session('success') }}", 'success');
            });
        </script>

    @endif
    <script>
        lucide.createIcons();


        // Toast Helper
        function showToast(msg, type = 'success') {
            const toast = document.getElementById('toast');

            toast.innerText = msg;

            toast.className = "fixed bottom-6 right-6 z-[200] px-6 py-4 rounded-2xl shadow-2xl text-sm font-medium transition-all duration-300";

            if (type === 'error') {
                toast.classList.add('bg-rose-600', 'text-white');
            } else {
                toast.classList.add('bg-emerald-600', 'text-white');
            }

            toast.classList.remove('translate-y-20', 'opacity-0');

            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 3000);
        }
    </script>
</body>

</html>
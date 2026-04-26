<div id="{{ $id }}"
    class="modal fixed inset-0 z-[100] bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-3xl shadow-2xl overflow-hidden">

        <!-- Header -->
        <div class="p-6 border-b flex justify-between items-center">
            <h3 class="font-bold text-slate-800">{{ $title }}</h3>
            <button onclick="closeModal('{{ $id }}')">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <!-- Form -->
        <form id="{{ $formId }}" action="{{ $action }}" method="POST" {{ $attributes->merge(['class' => 'p-6 space-y-3']) }}>
            @csrf
            {!! $method ?? '' !!}

            {{ $slot }}

            <div class="flex gap-3 pt-4">
                <button type="button" onclick="closeModal('{{ $id }}')"
                    class="flex-1 bg-slate-100 py-3 rounded-xl font-bold text-sm">
                    Batal
                </button>

                <button type="submit" class="flex-1 bg-indigo-600 text-white py-3 rounded-xl font-bold text-sm">
                    {{ $button ?? 'Simpan' }}
                </button>
            </div>
        </form>

    </div>
</div>
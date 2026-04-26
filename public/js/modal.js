// ===============================
// MODAL ENGINE
// ===============================

function openModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;

    modal.classList.remove('hidden');
    modal.classList.add('active');
}

function closeModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;

    modal.classList.remove('active');
    modal.classList.add('hidden');

    resetModal(modal); // 🔥 reset saat close
}

// reset form & state
function resetModal(modal) {
    const form = modal.querySelector('form');
    if (!form) return;

    form.reset();

    // hapus method PUT/PATCH
    const methodField = form.querySelector('#method-field');
    if (methodField) methodField.innerHTML = "";

    // reset title
    const title = modal.querySelector('#modal-title');
    if (title) title.innerText = "Tambah Data";
}


// klik luar modal = close
document.addEventListener('click', function (e) {
    document.querySelectorAll('.modal.active').forEach(modal => {
        if (e.target === modal) {
            closeModal(modal.id);
        }
    });
});

// ESC = close modal
document.addEventListener('keydown', function (e) {
    if (e.key === "Escape") {
        document.querySelectorAll('.modal.active').forEach(m => {
            closeModal(m.id);
        });
    }
});


// ===============================
// CATEGORY HANDLER (CREATE)
// ===============================

function openCreateModal() {
    openModal('category-modal');

    const form = document.getElementById('category-form');
    if (!form) return;

    form.action = "/kategori";
    form.reset();

    setMethod('POST');
    setTitle('Tambah Kategori');
}


// ===============================
// CATEGORY HANDLER (EDIT)
// ===============================

function openEditModal(id, name, slug) {
    openModal('category-modal');

    const form = document.getElementById('category-form');
    if (!form) return;

    form.action = `/kategori/${id}`;

    // 🔥 isi value secara reusable (pakai name)
    const fields = {
        name: name
    };

    Object.keys(fields).forEach(key => {
        const input = form.querySelector(`[name="${key}"]`);
        if (input) {
            input.value = fields[key] ?? '';
        } else {
            console.warn(`Input dengan name="${key}" tidak ditemukan`);
        }
    });

    setMethod('PUT');
    setTitle('Edit Kategori');
}


// ===============================
// HELPERS
// ===============================

function setMethod(method) {
    const field = document.getElementById('method-field');
    if (!field) return;

    field.innerHTML =
        (method === 'PUT' || method === 'PATCH')
            ? `<input type="hidden" name="_method" value="${method}">`
            : "";
}

function setTitle(text) {
    const el = document.getElementById('modal-title');
    if (el) el.innerText = text;
}

// ===============================
// Produk HANDLER (CREATE)
// ===============================

function openProdukModal() {
    openModal('produk-modal');

    const form = document.getElementById('produk-form');
    if (!form) return;

    form.action = "/admin/produk";
    form.reset();

    setMethod('POST');
    setTitle('Tambah Produk');
}
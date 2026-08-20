<x-app-layout>
    <style>
        .admin-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc, #e0f2fe, #eef2ff);
            padding: 40px 24px;
            font-family: 'Segoe UI', sans-serif;
            transition: all 0.3s ease;
        }

        /* PERBAIKAN UTAMA: Menggeser konten agar pas di sebelah kanan sidebar fixed */
        @media (min-width: 640px) {
            .admin-page {
                margin-left: 280px;
                padding: 40px 40px;
            }
        }

        .admin-container {
            max-width: 1200px;
            margin: auto;
        }

        .hero-card {
            background: linear-gradient(135deg, #0f172a, #1e3a8a, #0891b2);
            color: white;
            padding: 36px;
            border-radius: 30px;
            margin-bottom: 28px;
            box-shadow: 0 25px 60px rgba(15, 23, 42, .25);
        }

        .hero-card h1 {
            font-size: 38px;
            font-weight: 900;
            margin-bottom: 10px;
        }

        .hero-card p {
            color: #dbeafe;
            line-height: 1.7;
            max-width: 760px;
        }

        .top-action {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .search-box {
            background: white;
            border-radius: 18px;
            padding: 14px 18px;
            border: 1px solid #e2e8f0;
            width: 320px;
            outline: none;
            box-shadow: 0 12px 28px rgba(15, 23, 42, .06);
        }

        .btn-primary {
            border: none;
            background: linear-gradient(135deg, #06b6d4, #2563eb);
            color: white;
            padding: 14px 22px;
            border-radius: 18px;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 14px 30px rgba(37, 99, 235, .25);
        }

        .table-card {
            background: white;
            border-radius: 28px;
            overflow-x: auto;
            border: 1px solid #e2e8f0;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .08);
        }

        .table-header {
            padding: 26px;
            border-bottom: 1px solid #e2e8f0;
        }

        .table-header h2 {
            font-size: 24px;
            color: #0f172a;
            font-weight: 900;
        }

        .table-header p {
            color: #64748b;
            margin-top: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1050px;
        }

        th {
            background: #f8fafc;
            color: #334155;
            padding: 18px 20px;
            text-align: left;
            font-size: 14px;
            font-weight: 900;
            white-space: nowrap;
        }

        td {
            padding: 20px;
            border-top: 1px solid #e2e8f0;
            color: #1e293b;
            vertical-align: middle;
            font-size: 15px;
        }

        .patient-info {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 210px;
        }

        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: linear-gradient(135deg, #06b6d4, #2563eb);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 16px;
            flex-shrink: 0;
        }

        .patient-info strong {
            color: #0f172a;
            display: block;
        }

        .patient-info small {
            display: block;
            color: #64748b;
            margin-top: 3px;
        }

        .badge {
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
            display: inline-block;
        }

        .badge-green {
            background: #dcfce7;
            color: #15803d;
        }

        .badge-yellow {
            background: #fef3c7;
            color: #b45309;
        }

        .badge-red {
            background: #fee2e2;
            color: #b91c1c;
        }

        .action-btn {
            padding: 9px 13px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 800;
            margin-right: 6px;
            display: inline-block;
        }

        .detail { background: #e0f2fe; color: #0369a1; }
        .screening { background: #f0fdf4; color: #166534; }
        .edit { background: #fef3c7; color: #b45309; }
        .delete { background: #fee2e2; color: #b91c1c; }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .form-group label {
            display: block;
            font-weight: 700;
            color: #334155;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border-radius: 16px;
            border: 1px solid #cbd5e1;
            outline: none;
        }

        .form-control:focus {
            border-color: #0891b2;
            box-shadow: 0 0 0 4px rgba(8, 145, 178, .12);
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15,23,42,.6);
            backdrop-filter: blur(5px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .modal-content {
            background: white;
            width: 700px;
            max-width: 95%;
            border-radius: 28px;
            padding: 30px;
            animation: modalShow .3s ease;
        }

        @keyframes modalShow {
            from { opacity: 0; transform: translateY(25px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .modal-header h2 {
            font-size: 26px;
            font-weight: 900;
            color: #0f172a;
        }

        .close-btn {
            border: none;
            background: #fee2e2;
            color: #b91c1c;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            cursor: pointer;
        }

        .modal-footer {
            margin-top: 25px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn-cancel {
            border: none;
            background: #e2e8f0;
            color: #334155;
            padding: 12px 20px;
            border-radius: 14px;
            font-weight: 700;
            cursor: pointer;
        }

        @media (max-width: 900px) {
            .form-grid { grid-template-columns: 1fr; }
            .hero-card h1 { font-size: 30px; }
            .search-box { width: 100%; }
        }
    </style>

    <div class="admin-page">
        <div class="admin-container">

            <div class="hero-card">
                <h1>Kelola Data Edukasi</h1>
                <p>
                    Halaman ini digunakan admin untuk menambahkan, melihat, mengubah,
                    dan mengelola konten edukasi yang ditampilkan kepada pengguna.
                </p>
            </div>

            <div class="top-action">
                <input type="text" class="search-box" placeholder="Cari judul edukasi...">
                <button type="button" class="btn-primary" onclick="openModal()">
                    + Tambah Edukasi
                </button>
            </div>

            <div class="table-card">
                <div class="table-header">
                    <h2>Data Edukasi</h2>
                    <p>Daftar konten edukasi yang tersedia pada sistem MindCare.</p>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Ringkasan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($edukasis as $index => $edukasi)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="patient-info">
                                        <span class="avatar">
                                            {{ strtoupper(substr($edukasi->judul, 0, 1)) }}
                                        </span>
                                        <div>
                                            <strong>{{ $edukasi->judul }}</strong>
                                            <small>{{ $edukasi->kategori }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $edukasi->kategori }}</td>
                                <td>{{ Str::limit($edukasi->ringkasan ?? $edukasi->narasi, 80) }}</td>
                                <td>
                                    @if($edukasi->status == 'aktif')
                                        <span class="badge badge-green">Aktif</span>
                                    @else
                                        <span class="badge badge-yellow">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-wrapper" style="display:flex; gap:8px; align-items:center;">
                                        <button
                                            type="button"
                                            class="action-btn detail"
                                            onclick="openDetailModal(
                                                '{{ addslashes($edukasi->judul) }}',
                                                '{{ addslashes($edukasi->kategori) }}',
                                                '{{ addslashes($edukasi->ringkasan ?? '') }}',
                                                `{{ addslashes($edukasi->narasi) }}`,
                                                '{{ addslashes($edukasi->status) }}'
                                            )">
                                            Detail
                                        </button>

                                        <button 
                                            type="button" 
                                            class="action-btn edit"
                                            onclick="openEditModal(
                                                '{{ $edukasi->id }}',
                                                '{{ addslashes($edukasi->judul) }}',
                                                '{{ addslashes($edukasi->kategori) }}',
                                                '{{ addslashes($edukasi->ringkasan ?? '') }}',
                                                `{{ addslashes($edukasi->narasi) }}`,
                                                '{{ addslashes($edukasi->status) }}',
                                                '{{ addslashes($edukasi->icon ?? '') }}'
                                            )">
                                            Edit
                                        </button>

                                        <form method="POST" action="{{ route('Admin.Edukasi.destroy', $edukasi->id) }}" onsubmit="return confirm('Yakin ingin menghapus data edukasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align:center; padding:40px; color:#64748b;">
                                    Belum ada data edukasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Modal Tambah Edukasi -->
    <div id="modalPasien" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Tambah Edukasi Baru</h2>
                <button type="button" class="close-btn" onclick="closeModal()">✕</button>
            </div>

            <form method="POST" action="{{ route('Admin.Edukasi.store') }}">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label>Judul Edukasi</label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkan judul edukasi" required>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" name="kategori" class="form-control" placeholder="Contoh: Kesehatan Mental" required>
                    </div>

                    <div class="form-group">
                        <label>Ringkasan</label>
                        <input type="text" name="ringkasan" class="form-control" placeholder="Masukkan ringkasan singkat">
                    </div>

                    <div class="form-group">
                        <label>Isi Narasi</label>
                        <textarea name="narasi" class="form-control" rows="4" placeholder="Masukkan isi edukasi" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Icon</label>
                        <input type="text" name="icon" class="form-control" placeholder="Contoh: heart">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                    <button type="submit" class="btn-primary">Simpan Edukasi</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Edukasi -->
    <div id="modalEdit" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Data Edukasi</h2>
                <button type="button" class="close-btn" onclick="closeEditModal()">✕</button>
            </div>

            <form id="formEditEdukasi" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="form-grid">
                    <div class="form-group">
                        <label>Judul Edukasi</label>
                        <input type="text" id="edit_judul" name="judul" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" id="edit_kategori" name="kategori" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Ringkasan</label>
                        <input type="text" id="edit_ringkasan" name="ringkasan" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Isi Narasi</label>
                        <textarea id="edit_narasi" name="narasi" class="form-control" rows="5" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select id="edit_status" name="status" class="form-control">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Icon</label>
                        <input type="text" id="edit_icon" name="icon" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeEditModal()">Batal</button>
                    <button type="submit" class="btn-primary">Perbarui Edukasi</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Detail Edukasi -->
    <div id="modalDetail" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Detail Edukasi</h2>
                <button type="button" class="close-btn" onclick="closeDetailModal()">✕</button>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label>Judul Edukasi</label>
                    <input type="text" id="detail_judul" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" id="detail_kategori" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Ringkasan</label>
                    <input type="text" id="detail_ringkasan" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <input type="text" id="detail_status" class="form-control" readonly>
                </div>
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label>Isi Narasi</label>
                    <textarea id="detail_narasi" class="form-control" rows="6" readonly></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeDetailModal()">Tutup</button>
            </div>
        </div>
    </div>

    <script>
    function openModal() {
        document.getElementById('modalPasien').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('modalPasien').style.display = 'none';
    }

    function openDetailModal(judul, kategori, ringkasan, narasi, status) {
        document.getElementById('detail_judul').value = judul;
        document.getElementById('detail_kategori').value = kategori;
        document.getElementById('detail_ringkasan').value = ringkasan;
        document.getElementById('detail_narasi').value = narasi;
        document.getElementById('detail_status').value = status;

        document.getElementById('modalDetail').style.display = 'flex';
    }

    function closeDetailModal() {
        document.getElementById('modalDetail').style.display = 'none';
    }

    function openEditModal(id, judul, kategori, ringkasan, narasi, status, icon) {
        document.getElementById('formEditEdukasi').action = '{{ url("/admin/Edukasi/Edukasi") }}/' + id;
        document.getElementById('edit_judul').value = judul;
        document.getElementById('edit_kategori').value = kategori;
        document.getElementById('edit_ringkasan').value = ringkasan;
        document.getElementById('edit_narasi').value = narasi;
        document.getElementById('edit_status').value = status;
        document.getElementById('edit_icon').value = icon;

        document.getElementById('modalEdit').style.display = 'flex';
    }

    function closeEditModal() {
        document.getElementById('modalEdit').style.display = 'none';
    }

    window.onclick = function(event) {
        let modal = document.getElementById('modalPasien');
        let modalEdit = document.getElementById('modalEdit');
        let modalDetail = document.getElementById('modalDetail');
        if (event.target == modal) {
            modal.style.display = "none";
        }
        if (event.target == modalEdit) {
            modalEdit.style.display = "none";
        }
        if (event.target == modalDetail) {
            modalDetail.style.display = "none";
        }
    }
    </script>
</x-app-layout>
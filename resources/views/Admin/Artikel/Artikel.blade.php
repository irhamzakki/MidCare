<x-app-layout>
    <style>
        .admin-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc, #e0f2fe, #eef2ff);
            padding: 40px 24px;
            font-family: 'Segoe UI', sans-serif;
            transition: all 0.3s ease;
        }

        /* PERBAIKAN UTAMA: Menggeser konten agar pas di sebelah kanan sidebar fixed pada layar komputer */
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
            max-width: 800px;
        }

        .success-alert {
            background: #dcfce7;
            color: #15803d;
            padding: 16px 20px;
            border-radius: 16px;
            margin-bottom: 20px;
            font-weight: 800;
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
            width: 340px;
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

        .btn-primary:hover {
            transform: translateY(-2px);
        }

        .btn-cancel {
            border: none;
            background: #e2e8f0;
            color: #334155;
            padding: 12px 20px;
            border-radius: 14px;
            font-weight: 800;
            cursor: pointer;
            text-decoration: none;
        }

        .table-card {
            background: white;
            border-radius: 30px;
            overflow-x: auto; /* Memastikan tabel aman digeser di layar kecil */
            border: 1px solid #e2e8f0;
            box-shadow: 0 20px 45px rgba(15, 23, 42, .08);
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
            min-width: 950px;
        }

        th {
            text-align: left;
            padding: 16px 24px;
            background: #f8fafc;
            color: #475569;
            font-size: 14px;
            white-space: nowrap;
        }

        td {
            padding: 18px 24px;
            border-top: 1px solid #e2e8f0;
            color: #334155;
            vertical-align: middle;
        }

        .artikel-info {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 300px;
        }

        .artikel-img {
            width: 76px;
            height: 56px;
            border-radius: 14px;
            object-fit: cover;
            background: #e2e8f0;
            flex-shrink: 0;
        }

        .title-text {
            font-weight: 900;
            color: #0f172a;
            margin-bottom: 5px;
        }

        .desc-text {
            color: #64748b;
            line-height: 1.5;
            font-size: 14px;
        }

        .badge {
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 800;
            display: inline-block;
            white-space: nowrap;
        }

        .badge-blue {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .badge-green {
            background: #dcfce7;
            color: #15803d;
        }

        .badge-yellow {
            background: #fef3c7;
            color: #b45309;
        }

        .action-wrapper {
            display: flex;
            gap: 8px;
            flex-wrap: nowrap;
        }

        .action-btn {
            padding: 9px 13px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 800;
            display: inline-block;
            border: none;
            cursor: pointer;
            white-space: nowrap;
        }

        .detail {
            background: #e0f2fe;
            color: #0369a1;
        }

        .edit {
            background: #fef3c7;
            color: #b45309;
        }

        .delete {
            background: #fee2e2;
            color: #b91c1c;
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .65);
            backdrop-filter: blur(6px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            padding: 20px;
        }

        .modal-content {
            background: white;
            width: 650px;
            max-width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            border-radius: 30px;
            box-shadow: 0 30px 80px rgba(0,0,0,.20);
        }

        @keyframes modalShow {
            from {
                opacity: 0;
                transform: translateY(28px) scale(.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
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
            width: 42px;
            height: 42px;
            border-radius: 14px;
            cursor: pointer;
            font-weight: 900;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .form-group.full {
            grid-column: span 1;
        }

        .form-wrapper {
            max-width: 600px;
            margin: auto;
            padding: 30px;
        }

        .form-group label {
            display: block;
            font-weight: 800;
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
            font-size: 14px;
        }

        textarea.form-control {
            min-height: 180px;
            max-height: 350px;
        }

        .form-control:focus {
            border-color: #0891b2;
            box-shadow: 0 0 0 4px rgba(8, 145, 178, .12);
        }

        .upload-box {
            text-align: center;
            padding: 30px;
            border: 1px dashed #cbd5e1;
            border-radius: 16px;
        }

        .upload-box input {
            margin-top: 15px;
        }

        .modal-footer {
            margin-top: 25px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        @media (max-width: 900px) {
            .search-box {
                width: 100%;
            }

            .hero-card h1 {
                font-size: 30px;
            }
        }
    </style>

    <div class="admin-page">
        <div class="admin-container">

            <div class="hero-card">
                <h1>Kelola Artikel Kesehatan Mental</h1>
                <p>
                    Halaman ini digunakan admin untuk menambahkan, melihat, dan mengelola artikel
                    seputar kesehatan mental, self-care, stres, kecemasan, konseling, dan dukungan psikologis.
                </p>
            </div>

            @if (session('success'))
                <div class="success-alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="top-action">
                <input type="text" class="search-box" placeholder="Cari judul artikel...">

                <button type="button" class="btn-primary" onclick="openModal()">
                    + Tambah Artikel
                </button>
            </div>

            <div class="table-card">
                <div class="table-header">
                    <h2>Daftar Artikel</h2>
                    <p>Data artikel kesehatan mental yang tersedia dalam sistem.</p>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Artikel</th>
                            <th>Kategori</th>
                            <th>Ringkasan</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($artikels as $index => $artikel)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td>
                                    <div class="artikel-info">
                                        @if ($artikel->gambar)
                                            <img src="{{ asset('storage/' . $artikel->gambar) }}" class="artikel-img" alt="Gambar Artikel">
                                        @else
                                            <div class="artikel-img"></div>
                                        @endif

                                        <div>
                                            <div class="title-text">
                                                {{ $artikel->judul }}
                                            </div>
                                            <div class="desc-text">
                                                {{ Str::limit($artikel->isi, 70) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="badge badge-blue">
                                        {{ $artikel->kategori }}
                                    </span>
                                </td>

                                <td class="desc-text">
                                    {{ $artikel->ringkasan ?? '-' }}
                                </td>

                                <td>
                                    <span class="badge {{ $artikel->status == 'Publish' ? 'badge-green' : 'badge-yellow' }}">
                                        {{ $artikel->status }}
                                    </span>
                                </td>

                                <td>
                                    {{ $artikel->created_at->format('d M Y') }}
                                </td>

                                <td>
                                    <div class="action-wrapper">
                                        <button
                                            type="button"
                                            class="action-btn detail"
                                            onclick="openDetailModal(
                                                '{{ addslashes($artikel->judul) }}',
                                                '{{ addslashes($artikel->kategori) }}',
                                                '{{ addslashes($artikel->ringkasan) }}',
                                                `{{ addslashes($artikel->isi) }}`,
                                                '{{ addslashes($artikel->status) }}'
                                            )">
                                            Detail
                                        </button>

                                        <button type="button" class="action-btn edit">
                                            Edit
                                        </button>

                                        <form method="POST" action="#" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
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
                                <td colspan="7" style="text-align:center; padding:30px;">
                                    Belum ada data artikel.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Modal Tambah Artikel -->
    <div id="modalArtikel" class="modal-overlay">
        <div class="modal-content">
            <div class="form-wrapper">
                <div class="modal-header">
                    <h2>Tambah Artikel</h2>
                    <button type="button" class="close-btn" onclick="closeModal()">✕</button>
                </div>

                <form method="POST" action="{{ route('Admin.Artikel.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group full">
                            <label>Judul Artikel</label>
                            <input type="text" name="judul" class="form-control" placeholder="Contoh: Cara Mengelola Stres pada Remaja" required>
                        </div>

                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori" class="form-control" required>
                                <option value="">Pilih kategori</option>
                                <option value="Mental Health">Mental Health</option>
                                <option value="Stres">Stres</option>
                                <option value="Kecemasan">Kecemasan</option>
                                <option value="Self Care">Self Care</option>
                                <option value="Konseling">Konseling</option>
                                <option value="Dukungan Sosial">Dukungan Sosial</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Status Artikel</label>
                            <select name="status" class="form-control" required>
                                <option value="Publish">Publish</option>
                                <option value="Draft">Draft</option>
                            </select>
                        </div>

                        <div class="form-group full">
                            <label>Ringkasan Artikel</label>
                            <input type="text" name="ringkasan" class="form-control" placeholder="Tulis ringkasan singkat artikel">
                        </div>

                        <div class="form-group full">
                            <label>Isi Artikel</label>
                            <textarea name="isi" class="form-control" placeholder="Tulis isi artikel kesehatan mental di sini..." required></textarea>
                        </div>

                        <div class="form-group full">
                            <label>Gambar Artikel</label>
                            <div class="upload-box">
                                <strong>Upload Gambar Artikel</strong>
                                <p style="color:#64748b; margin-top:6px;">
                                    Format disarankan: JPG, PNG, WEBP. Ukuran maksimal 2MB.
                                </p>
                                <input type="file" name="gambar" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                        <button type="submit" class="btn-primary">Simpan Artikel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Detail Artikel -->
    <div id="modalDetail" class="modal-overlay">
        <div class="modal-content">
            <div class="form-wrapper" style="padding: 30px;">
                <div class="modal-header">
                    <h2>Detail Artikel</h2>
                    <button type="button" class="close-btn" onclick="closeDetailModal()">✕</button>
                </div>

                <div class="form-grid">
                    <div class="form-group full">
                        <label>Judul Artikel</label>
                        <input id="detail_judul" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <input id="detail_kategori" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <input id="detail_status" class="form-control" readonly>
                    </div>

                    <div class="form-group full">
                        <label>Ringkasan</label>
                        <input id="detail_ringkasan" class="form-control" readonly>
                    </div>

                    <div class="form-group full">
                        <label>Isi Artikel</label>
                        <textarea id="detail_isi" class="form-control" readonly></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeDetailModal()">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('modalArtikel').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('modalArtikel').style.display = 'none';
        }

        function openDetailModal(judul, kategori, ringkasan, isi, status) {
            document.getElementById('detail_judul').value = judul;
            document.getElementById('detail_kategori').value = kategori;
            document.getElementById('detail_ringkasan').value = ringkasan;
            document.getElementById('detail_isi').value = isi;
            document.getElementById('detail_status').value = status;

            document.getElementById('modalDetail').style.display = 'flex';
        }

        function closeDetailModal() {
            document.getElementById('modalDetail').style.display = 'none';
        }

        window.onclick = function(event) {
            let modalArtikel = document.getElementById('modalArtikel');
            let modalDetail = document.getElementById('modalDetail');

            if (event.target === modalArtikel) {
                modalArtikel.style.display = 'none';
            }

            if (event.target === modalDetail) {
                modalDetail.style.display = 'none';
            }
        }
    </script>
</x-app-layout>
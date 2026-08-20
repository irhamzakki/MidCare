<x-app-layout>
    <style>
        .dataset-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 24px;
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            box-sizing: border-box;
        }

        @media (min-width: 1024px) {
            .dataset-page {
                padding-left: 296px;
                padding-right: 36px;
                padding-top: 32px;
                padding-bottom: 40px;
            }
        }

        .dataset-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 24px;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            letter-spacing: -0.025em;
        }

        .page-header p {
            color: #64748b;
            font-size: 14px;
            margin-top: 4px;
        }

        .table-card {
            background: white;
            border-radius: 22px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            min-width: 800px;
        }

        th {
            background: #f8fafc;
            padding: 14px 18px;
            text-align: left;
            font-weight: 700;
            color: #475569;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
        }

        td {
            padding: 14px 18px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            white-space: nowrap;
        }
    </style>

    <div class="dataset-page">
        <div class="dataset-container">
            <div class="page-header">
                <h1>Dataset Fitur Responden</h1>
                <p>Data mentah 54 variabel fitur responden yang digunakan pada pemrosesan klasterisasi K-Means</p>
            </div>

            <div class="table-card">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Usia</th>
                            <th>Gender</th>
                            <th>Orang Tua</th>
                            <th>Rasional</th>
                            <th>Emosional</th>
                            <th>Agresif</th>
                            <th>Tenang</th>
                            <th>Tanggal Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataset as $index => $row)
                            <tr>
                                <td>{{ $dataset->firstItem() + $index }}</td>
                                <td><strong>{{ $row->nama ?? '-' }}</strong></td>
                                <td>{{ $row->usia ?? '-' }}</td>
                                <td>{{ $row->jenis_kelamin ?? '-' }}</td>
                                <td>{{ $row->orangtua ?? '-' }}</td>
                                <td>{{ $row->rasional ?? '-' }}</td>
                                <td>{{ $row->emosional ?? '-' }}</td>
                                <td>{{ $row->agresif ?? '-' }}</td>
                                <td>{{ $row->tenang_saat_emosi ?? '-' }}</td>
                                <td>{{ $row->created_at ? $row->created_at->format('d/m/Y') : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" style="text-align:center; padding:30px; color:#94a3b8;">
                                    Belum ada data fitur responden.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 20px;">
                {{ $dataset->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

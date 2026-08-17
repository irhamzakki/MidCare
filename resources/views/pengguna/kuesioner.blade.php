<x-app-layout>
    <style>
        .admin-page{
            min-height:100vh;
            background:linear-gradient(135deg,#f8fafc,#e0f2fe,#eef2ff);
            padding:40px 24px;
            font-family:'Segoe UI',sans-serif;
        }

        @media(min-width:640px){
            .admin-page{
                margin-left:280px;
                padding:40px;
            }
        }

        .admin-container{
            max-width:1200px;
            margin:auto;
        }

        .hero-card{
            background:linear-gradient(135deg,#0f172a,#1e3a8a,#0891b2);
            color:white;
            padding:36px;
            border-radius:28px;
            margin-bottom:28px;
            box-shadow:0 20px 50px rgba(0,0,0,.18);
        }

        .hero-card h1{
            font-size:36px;
            font-weight:800;
            margin-bottom:10px;
        }

        .hero-card p{
            color:#dbeafe;
            line-height:1.7;
        }

        .top-action{
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:18px;
            flex-wrap:wrap;
            margin-bottom:24px;
        }

        .search-box{
            width:320px;
            padding:14px 18px;
            border-radius:16px;
            border:1px solid #cbd5e1;
            background:white;
            outline:none;
            box-shadow:0 10px 25px rgba(0,0,0,.05);
        }

        .table-card{
            background:white;
            border-radius:24px;
            overflow-x:auto;
            border:1px solid #e2e8f0;
            box-shadow:0 15px 40px rgba(15,23,42,.08);
        }

        .table-header{
            padding:24px;
            border-bottom:1px solid #e2e8f0;
        }

        .table-header h2{
            font-size:24px;
            font-weight:800;
            color:#0f172a;
        }

        .table-header p{
            color:#64748b;
            margin-top:6px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            min-width:1100px;
        }

        th{
            background:#f8fafc;
            padding:18px;
            text-align:left;
            font-size:14px;
            font-weight:700;
            color:#334155;
        }

        td{
            padding:18px;
            border-top:1px solid #e2e8f0;
            color:#1e293b;
            vertical-align:middle;
        }

        .patient-info{
            display:flex;
            align-items:center;
            gap:12px;
        }

        .avatar{
            width:48px;
            height:48px;
            border-radius:14px;
            background:linear-gradient(135deg,#06b6d4,#2563eb);
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:bold;
        }

        .badge{
            padding:7px 14px;
            border-radius:999px;
            font-size:13px;
            font-weight:700;
        }

        .badge-green{
            background:#dcfce7;
            color:#15803d;
        }

        .badge-yellow{
            background:#fef3c7;
            color:#b45309;
        }

        .badge-red{
            background:#fee2e2;
            color:#b91c1c;
        }

        .action-btn{
            display:inline-block;
            padding:8px 12px;
            border-radius:10px;
            text-decoration:none;
            font-size:13px;
            font-weight:700;
            margin-right:6px;
            border:none;
            cursor:pointer;
        }

        .detail{
            background:#e0f2fe;
            color:#0369a1;
        }

        .edit{
            background:#fef3c7;
            color:#b45309;
        }

        .delete{
            background:#fee2e2;
            color:#b91c1c;
        }

        @media(max-width:900px){
            .search-box{
                width:100%;
            }

            .hero-card h1{
                font-size:30px;
            }
        }
    </style>

    <div class="admin-page">

        <div class="admin-container">

            {{-- Hero --}}
            <div class="hero-card">
                <h1>Kelola Data Kuesioner</h1>

                <p>
                    Halaman ini menampilkan seluruh data hasil pengisian
                    kuesioner pengguna yang tersimpan pada tabel
                    <strong>fitur_pengguna</strong> dan digunakan sebagai
                    dasar proses screening kesehatan mental MindCare.
                </p>
            </div>

            {{-- Search --}}
            <div class="top-action">
                <input type="text"
                       id="searchInput"
                       class="search-box"
                       placeholder="Cari nama responden...">
            </div>

            {{-- Table --}}
            <div class="table-card">

                <div class="table-header">
                    <h2>Data Kuesioner</h2>
                    <p>Daftar responden yang telah mengisi kuesioner.</p>
                </div>

                <table id="kuesionerTable">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Usia</th>
                            <th>Jenis Kelamin</th>
                            <th>Orang Tua</th>
                            <th>Tanggal Isi</th>
                        </tr>
                    <tbody>

    @forelse($fiturPengguna as $index => $data)

        <tr>

            {{-- No --}}
            <td>
                {{ $index + 1 }}
            </td>

            {{-- Nama --}}
            <td>
                <div class="patient-info">

                    <div class="avatar">
                        {{ strtoupper(substr($data->nama ?? 'U', 0, 1)) }}
                    </div>

                    <div>
                        <strong>{{ $data->nama ?? '-' }}</strong>
                    </div>

                </div>
            </td>

            {{-- Usia --}}
            <td>
                {{ $data->usia ?? '-' }} tahun
            </td>

            {{-- Jenis Kelamin --}}
            <td>
                {{ $data->jenis_kelamin ?? '-' }}
            </td>

            {{-- Orang Tua --}}
            <td>
                {{ $data->orangtua ?? '-' }}
            </td>

            

            {{-- Tanggal --}}
            <td>
                {{ $data->created_at
                    ? $data->created_at->format('d-m-Y H:i')
                    : '-' }}
            </td>

        </tr>

    @empty

        <tr>

            <td colspan="9"
                style="text-align:center;padding:30px;color:#64748b;">

                Belum ada data pengguna pada tabel
                <strong>fitur_pengguna</strong>.

            </td>

        </tr>

    @endforelse

</tbody>

                        

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <script>

        document.getElementById("searchInput")
        .addEventListener("keyup",function(){

            let value=this.value.toLowerCase();

            let rows=document.querySelectorAll("#kuesionerTable tbody tr");

            rows.forEach(row=>{

                let nama=row.cells[1]?.innerText.toLowerCase() || "";

                row.style.display=nama.includes(value)?"":"none";

            });

        });

    </script>

</x-app-layout>
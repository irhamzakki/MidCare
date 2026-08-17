<form action="{{ route('admin.pasien.store') }}" method="POST">

@csrf


<label>Nama Pasien</label>
<input type="text" name="nama">


<label>Email Login</label>
<input type="email" name="email">


<label>Tanggal Lahir</label>
<input type="date" name="tanggal_lahir">


<label>Jenis Kelamin</label>

<select name="jenis_kelamin">

<option value="Laki-laki">
Laki-laki
</option>

<option value="Perempuan">
Perempuan
</option>

</select>


<label>No HP</label>
<input name="no_hp">


<label>Alamat</label>
<textarea name="alamat"></textarea>



<button>
Simpan Pasien
</button>


</form>
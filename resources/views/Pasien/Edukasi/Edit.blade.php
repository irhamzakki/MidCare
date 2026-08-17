<!-- Modal Edit -->
<div id="modalEdit" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Edit Edukasi</h2>
            <button type="button" class="close-btn" onclick="closeEditModal()">✕</button>
        </div>

        <form id="formEdit" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label>Judul Edukasi</label>
                    <input type="text" name="judul" id="edit_judul" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori" id="edit_kategori" class="form-control" required>
                        <option value="">Pilih kategori</option>
                        <option value="Dasar">Dasar</option>
                        <option value="Risiko">Risiko</option>
                        <option value="Dukungan">Dukungan</option>
                        <option value="Tips">Tips</option>
                        <option value="Konseling">Konseling</option>
                    </select>
                </div>

                <div class="form-group full">
                    <label>Ringkasan Singkat</label>
                    <input type="text" name="ringkasan" id="edit_ringkasan" class="form-control">
                </div>

                <div class="form-group full">
                    <label>Narasi Edukasi</label>
                    <textarea name="narasi" id="edit_narasi" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="edit_status" class="form-control" required>
                        <option value="Aktif">Aktif</option>
                        <option value="Draft">Draft</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Icon / Emoji</label>
                    <input type="text" name="icon" id="edit_icon" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeEditModal()">Batal</button>
                <button type="submit" class="btn-primary">Update Edukasi</button>
            </div>
        </form>
    </div>
</div>
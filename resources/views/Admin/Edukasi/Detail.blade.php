<!-- Modal Detail -->
<div id="modalDetail" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Detail Edukasi</h2>
            <button type="button" class="close-btn" onclick="closeDetailModal()">✕</button>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label>Icon</label>
                <input id="detail_icon" class="form-control" readonly>
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <input id="detail_kategori" class="form-control" readonly>
            </div>

            <div class="form-group full">
                <label>Judul</label>
                <input id="detail_judul" class="form-control" readonly>
            </div>

            <div class="form-group full">
                <label>Ringkasan</label>
                <input id="detail_ringkasan" class="form-control" readonly>
            </div>

            <div class="form-group full">
                <label>Narasi</label>
                <textarea id="detail_narasi" class="form-control" readonly></textarea>
            </div>

            <div class="form-group">
                <label>Status</label>
                <input id="detail_status" class="form-control" readonly>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn-cancel" onclick="closeDetailModal()">Tutup</button>
        </div>
    </div>
</div>
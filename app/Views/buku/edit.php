<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>

<style>
    .form-card {
        max-width: 720px;
        margin: 0 auto;
    }
    .form-card .card-body {
        padding: 2rem;
    }
    .form-label {
        font-weight: 600;
        color: #2d2d2d;
    }
    .form-control, .form-select {
        border-radius: 12px;
        padding: 12px 16px;
        border: 2px solid #e0e0e0;
        transition: border-color 0.2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #4a3aff;
        box-shadow: 0 0 0 0.2rem rgba(74, 58, 255, 0.1);
    }
    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #dc3545;
    }
    .invalid-feedback {
        font-size: 0.85rem;
    }
    .btn-submit {
        padding: 12px 32px;
        font-size: 1.1rem;
        border-radius: 12px;
    }
    .cover-preview {
        width: 120px;
        height: 160px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px dashed #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        font-size: 0.9rem;
    }
    .cover-preview img {
        border-radius: 6px;
    }
</style>

<div class="form-card">
    <div class="card shadow">
        <div class="card-header bg-white border-bottom-0">
            <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Buku</h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('buku/update/' . $buku['id']) ?>" method="post" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="judul" class="form-label">Judul Buku</label>
                        <input type="text" class="form-control <?= $validation->hasError('judul') ? 'is-invalid' : '' ?>"
                               id="judul" name="judul" value="<?= old('judul', $buku['judul']) ?>" placeholder="Masukkan judul buku">
                        <div class="invalid-feedback"><?= $validation->getError('judul') ?></div>
                    </div>

                    <div class="col-md-6">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" class="form-control <?= $validation->hasError('penulis') ? 'is-invalid' : '' ?>"
                               id="penulis" name="penulis" value="<?= old('penulis', $buku['penulis']) ?>" placeholder="Masukkan nama penulis">
                        <div class="invalid-feedback"><?= $validation->getError('penulis') ?></div>
                    </div>

                    <div class="col-md-6">
                        <label for="kategori" class="form-label">Kategori</label>
                        <input type="text" class="form-control <?= $validation->hasError('kategori') ? 'is-invalid' : '' ?>"
                               id="kategori" name="kategori" value="<?= old('kategori', $buku['kategori']) ?>" placeholder="Masukkan kategori">
                        <div class="invalid-feedback"><?= $validation->getError('kategori') ?></div>
                    </div>

                    <div class="col-md-6">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control <?= $validation->hasError('tahun_terbit') ? 'is-invalid' : '' ?>"
                               id="tahun_terbit" name="tahun_terbit" value="<?= old('tahun_terbit', $buku['tahun_terbit']) ?>" placeholder="YYYY" min="1900" max="2026">
                        <div class="invalid-feedback"><?= $validation->getError('tahun_terbit') ?></div>
                    </div>

                    <div class="col-md-6">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input type="text" class="form-control <?= $validation->hasError('penerbit') ? 'is-invalid' : '' ?>"
                               id="penerbit" name="penerbit" value="<?= old('penerbit', $buku['penerbit']) ?>" placeholder="Masukkan nama penerbit">
                        <div class="invalid-feedback"><?= $validation->getError('penerbit') ?></div>
                    </div>

                    <div class="col-md-6">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control <?= $validation->hasError('stok') ? 'is-invalid' : '' ?>"
                               id="stok" name="stok" value="<?= old('stok', $buku['stok']) ?>" placeholder="0" min="0">
                        <div class="invalid-feedback"><?= $validation->getError('stok') ?></div>
                    </div>

                    <div class="col-12">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control <?= $validation->hasError('deskripsi') ? 'is-invalid' : '' ?>"
                                  id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan deskripsi atau sinopsis buku..."><?= old('deskripsi', $buku['deskripsi']) ?></textarea>
                        <div class="invalid-feedback"><?= $validation->getError('deskripsi') ?></div>
                    </div>

                    <div class="col-12">
                        <label for="cover" class="form-label">Foto Cover (opsional)</label>
                        <input type="file" class="form-control <?= $validation->hasError('cover') ? 'is-invalid' : '' ?>"
                               id="cover" name="cover" accept=".jpg,.jpeg,.png,.webp">
                        <div class="invalid-feedback"><?= $validation->getError('cover') ?></div>
                        <div class="mt-2">
                            <div class="cover-preview">
                                <?php if ($buku['cover']): ?>
                                    <img src="<?= base_url($buku['cover']) ?>" alt="cover">
                                <?php else: ?>
                                    <i class="bi bi-image me-1"></i> Preview
                                <?php endif; ?>
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" id="remove_cover" name="remove_cover">
                                <label class="form-check-label" for="remove_cover">Hapus cover</label>
                            </div>
                        </div>
                        <small class="text-muted">Format: JPG, JPEG, PNG, WEBP • Maks 2 MB</small>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <a href="<?= base_url('buku') ?>" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-arrow-left me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary btn-submit">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('cover').addEventListener('change', function(e) {
        const preview = document.querySelector('.cover-preview');
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                preview.innerHTML = `<img src="${event.target.result}" style="width: 100%; height: 100%; object-fit: cover;">`;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

<?= $this->endSection() ?>

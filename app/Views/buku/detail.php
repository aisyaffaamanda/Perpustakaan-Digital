<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">
                <h4><?= esc($buku['judul']) ?></h4>
            </div>
            <div class="card-body">
                <?php if ($buku['cover']): ?>
                    <img src="<?= base_url($buku['cover']) ?>" alt="cover" class="img-fluid rounded mb-4" style="max-height: 300px;">
                <?php else: ?>
                    <div class="text-center text-muted py-5">Tidak ada foto cover</div>
                <?php endif; ?>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Penulis</strong><br>
                            <?= esc($buku['penulis']) ?>
                        </div>
                        <div class="mb-3">
                            <strong>Kategori</strong><br>
                            <?= esc($buku['kategori']) ?>
                        </div>
                        <div class="mb-3">
                            <strong>Tahun Terbit</strong><br>
                            <?= esc($buku['tahun_terbit']) ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Penerbit</strong><br>
                            <?= esc($buku['penerbit']) ?>
                        </div>
                        <div class="mb-3">
                            <strong>Stok</strong><br>
                            <span class="badge bg-<?= $buku['stok'] > 0 ? 'success' : 'danger' ?> fs-5"><?= $buku['stok'] ?></span>
                        </div>
                        <div class="mb-3">
                            <strong>Deskripsi</strong><br>
                            <p class="text-secondary"><?= esc($buku['deskripsi'] ?? 'Tidak ada deskripsi.') ?></p>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex gap-2">
                    <a href="<?= base_url('buku') ?>" class="btn btn-secondary">Kembali ke Daftar</a>
                    <a href="<?= base_url('buku/edit/' . $buku['id']) ?>" class="btn btn-warning">Edit Buku</a>
                    <a href="<?= base_url('buku/delete/' . $buku['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">Hapus Buku</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

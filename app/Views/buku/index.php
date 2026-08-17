<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>

<style>
    .buku-card {
        transition: all 0.3s ease;
    }
    .buku-card:hover {
        transform: translateY(-6px);
    }
    .buku-cover {
        height: 180px;
        object-fit: cover;
        border-radius: 12px 12px 0 0;
    }
    .buku-cover-placeholder {
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #e8eaff, #d4d8ff);
        border-radius: 12px 12px 0 0;
        color: #4a3aff;
        font-size: 3rem;
    }
    .buku-info {
        padding: 1.25rem;
    }
    .buku-title {
        font-weight: 700;
        color: #2d2d2d;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .buku-meta {
        font-size: 0.85rem;
        color: #6c757d;
    }
    .search-input {
        border-radius: 12px;
        padding: 12px 18px;
        border: 2px solid #e0e0e0;
        transition: border-color 0.2s;
    }
    .search-input:focus {
        border-color: #4a3aff;
        box-shadow: 0 0 0 0.2rem rgba(74, 58, 255, 0.1);
    }
    .pagination .page-link {
        border-radius: 8px;
        margin: 0 2px;
        border: none;
        color: #4a3aff;
    }
    .pagination .page-item.active .page-link {
        background-color: #4a3aff;
        border-color: #4a3aff;
    }
    .pagination .page-item.disabled .page-link {
        color: #adb5bd;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h3 class="fw-bold mb-0"><i class="bi bi-collection me-2"></i>Daftar Buku</h3>
    <a href="<?= base_url('buku/create') ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Buku
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="get" class="search-form mx-auto">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0" style="border-radius: 12px 0 0 12px;">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" name="q" class="form-control border-start-0 search-input"
                       placeholder="Cari judul, penulis, atau kategori..."
                       value="<?= esc($keyword ?? '') ?>">
                <button type="submit" class="btn btn-primary" style="border-radius: 0 12px 12px 0;">
                    Cari
                </button>
            </div>
        </form>
    </div>
</div>

<?php if (empty($buku)): ?>
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
            <h4 class="mt-3 text-muted">Tidak ada data buku</h4>
            <p class="text-muted"><?= $keyword ? 'Coba ubah kata pencarian Anda.' : 'Klik tombol Tambah Buku untuk menambahkan data baru.' ?></p>
            <?php if ($keyword): ?>
                <a href="<?= base_url('buku') ?>" class="btn btn-outline-primary mt-2">Reset Pencarian</a>
            <?php else: ?>
                <a href="<?= base_url('buku/create') ?>" class="btn btn-primary mt-2">Tambah Buku Pertama</a>
 <?php endif; ?>
        </div>
    </div>
<?php else: ?>

    <!-- Desktop: Table -->
    <div class="card d-none d-lg-block">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th style="width: 60px;">Cover</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Kategori</th>
                            <th>Tahun</th>
                            <th>Stok</th>
                            <th style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($buku as $b): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <?php if ($b['cover']): ?>
                                        <img src="<?= base_url($b['cover']) ?>" alt="cover" class="rounded" style="width: 40px; height: 55px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="d-flex align-items-center justify-content-center bg-light rounded" style="width: 40px; height: 55px;">
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td><strong><?= esc($b['judul']) ?></strong></td>
                                <td><?= esc($b['penulis']) ?></td>
                                <td><span class="badge bg-light text-dark"><?= esc($b['kategori']) ?></span></td>
                                <td>
                <?= esc($b['tahun_terbit']) ?></td>
                                <td>
                                    <?php if ($b['stok'] > 0): ?>
                                        <span class="badge bg-success"><?= $b['stok'] ?> </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Habis</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('buku/detail/' . $b['id']) ?>" class="btn btn-sm btn-outline-primary" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="<?= base_url('buku/edit/' . $b['id']) ?>" class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?= base_url('buku/delete/' . $b['id']) ?>" class="btn btn-sm btn-outline-danger" title="Hapus"
                                       onclick="return confirm('Yakin hapus buku ini?')">
                                        <i class="bi bi-trash"></i>
</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0 py-3">
            <?= $pager->links() ?>
        </div>
    </div>

    <!-- Mobile: Cards -->
    <div class="d-lg-none">
        <div class="row g-3">
            <?php foreach ($buku as $b): ?>
                <div class="col-12 col-sm-6">
                    <div class="card buku-card h-100">
                        <?php if ($b['cover']): ?>
                            <img src="<?= base_url($b['cover']) ?>" alt="cover" class="buku-cover">
                        <?php else: ?>
                            <div class="buku-cover-placeholder">
                                <i class="bi bi-journal-bookmark"></i>
                            </div>
                        <?php endif; ?>
                        <div class="buku-info">
                            <h5 class="buku-title"><?= esc($b['judul']) ?></h5>
                            <p class="buku-meta mb-1"><i class="bi bi-person me-1"></i><?= esc($b['penulis']) ?></p>
                            <p class="buku-meta mb-2"><i class="bi bi-tag me-1"></i><?= esc($b['kategori']) ?> • <?= esc($b['tahun_terbit']) ?></p>
                            <?php if ($b['stok'] > 0): ?>
                                <span class="badge bg-success mb-2"><?= $b['stok'] ?> eksemplar</span>
                            <?php else: ?>
                                <span class="badge bg-danger mb-2">Habis</span>
                            <?php endif; ?>
                            <div class="btn-group w-100 mt-1" role="group">
                                <a href="<?= base_url('buku/detail/' . $b['id']) ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?= base_url('buku/edit/' . $b['id']) ?>" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?= base_url('buku/delete/' . $b['id']) ?>" class="btn btn-sm btn-outline-danger"
                                   onclick="return confirm('Yakin hapus buku ini?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-4">
            <?= $pager->links() ?>
        </div>
    </div>

<?php endif; ?>

<?= $this->endSection() ?>

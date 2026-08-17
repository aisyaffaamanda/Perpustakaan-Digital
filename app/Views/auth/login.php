<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>

<style>
    .login-card {
        max-width: 420px;
        margin: 0 auto;
        margin-top: 6vh;
    }
    .login-card .card-body {
        padding: 2.5rem;
    }
    .login-card h2 {
        font-weight: 700;
        color: #2d2d2d;
    }
    .login-card .form-control {
        border-radius: 12px;
        padding: 12px 16px;
    }
    .login-card .btn-primary {
        width: 100%;
        padding: 14px;
        font-size: 1.1rem;
    }
</style>

<div class="login-card">
    <div class="card shadow">
        <div class="card-body">
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center mb-3"
                     style="width: 64px; height: 64px; background: linear-gradient(135deg, #4a3aff, #6b5bff); border-radius: 16px;">
                    <i class="bi bi-book-half text-white" style="font-size: 1.8rem;"></i>
                </div>
                <h2>Login</h2>
                <p class="text-muted">Perpustakaan Digital</p>
            </div>

            <form action="<?= base_url('login') ?>" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control <?= $validation->hasError('username') ? 'is-invalid' : '' ?>"
                           id="username" name="username" value="<?= old('username') ?>" placeholder="Masukkan username">
                    <div class="invalid-feedback"><?= $validation->getError('username') ?></div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : '' ?>"
                           id="password" name="password" placeholder="Masukkan password">
                    <div class="invalid-feedback"><?= $validation->getError('password') ?></div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Login
                </button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

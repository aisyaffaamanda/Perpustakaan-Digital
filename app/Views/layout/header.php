<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Perpustakaan Digital') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary: #4a3aff;
        }
        body {
            background: linear-gradient(135deg, #f5f6fa 0%, #e4e8f0 100%);
            font-family: 'Segoe UI', system-ui, sans-serif;
        }
        .navbar {
            background: linear-gradient(90deg, #4a3aff, #6b5bff);
            box-shadow: 0 4px 20px rgba(74, 58, 255, 0.2);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12);
        }
        .btn-primary {
            background: linear-gradient(135deg, #4a3aff, #6b5bff);
            border: none;
            border-radius: 12px;
            font-weight: 600;
            padding: 12px 28px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(74, 58, 255, 0.3);
        }
        .table {
            border-radius: 12px;
            overflow: hidden;
        }
        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #2d2d2d;
        }
        .table tr:hover {
            background-color: #f8f9fa;
        }
        .alert {
            border-radius: 12px;
            border: none;
        }
        .search-form {
            max-width: 420px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('buku') ?>">
                <i class="bi bi-book-half"></i> Perpustakaan Digital
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <span class="nav-link text-light me-4">
                            <i class="bi bi-person-circle"></i> <?= esc(session()->get('username') ?? 'Tamu') ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="<?= base_url('logout') ?>" onclick="return confirm('Yakin logout?')">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </div>

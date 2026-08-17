<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Buku extends BaseController
{
    protected $bukuModel;
    protected $helpers = ['form', 'url', 'text'];

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('q');
        $perPage = 10;

        $data = [
            'title'   => 'Daftar Buku — Perpustakaan Digital',
            'buku'    => $this->bukuModel->searchBuku($keyword)->paginate($perPage),
            'pager'   => $this->bukuModel->pager,
            'keyword' => $keyword,
            'perPage' => $perPage,
        ];

        return view('buku/index', $data);
    }

    public function detail($id)
    {
        $buku = $this->bukuModel->find($id);

        if (!$buku) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Buku tidak ditemukan.');
        }

        $data = [
            'title' => $buku['judul'] . ' — Detail Buku',
            'buku'  => $buku,
        ];

        return view('buku/detail', $data);
    }

    public function create()
    {
        $data = [
            'title'      => 'Tambah Buku — Perpustakaan Digital',
            'validation' => \Config\Services::validation(),
        ];

        return view('buku/create', $data);
    }

    public function store()
    {
        $rules = $this->bukuModel->getValidationRules();
        // Only validate cover if a file is uploaded
        $rules['cover'] = 'permit_empty|uploaded[cover]|is_image[cover]|max_size[cover,2048]|ext_in[cover,jpg,jpeg,png,webp]';

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Periksa kembali form Anda.');
        }

        $cover = $this->request->getFile('cover');
        $coverPath = null;

        if ($cover && $cover->isValid() && !$cover->hasMoved()) {
            $newName = $cover->getRandomName();
            $cover->move(FCPATH . 'uploads/covers', $newName);
            $coverPath = 'uploads/covers/' . $newName;
        }

        $this->bukuModel->save([
            'judul'        => $this->request->getPost('judul'),
            'penulis'      => $this->request->getPost('penulis'),
            'kategori'     => $this->request->getPost('kategori'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'penerbit'     => $this->request->getPost('penerbit'),
            'stok'         => $this->request->getPost('stok'),
            'deskripsi'    => $this->request->getPost('deskripsi'),
            'cover'        => $coverPath,
        ]);

        return redirect()->to(base_url('buku'))->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $buku = $this->bukuModel->find($id);

        if (!$buku) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Buku tidak ditemukan.');
        }

        $data = [
            'title'      => 'Edit Buku — Perpustakaan Digital',
            'buku'       => $buku,
            'validation' => \Config\Services::validation(),
        ];

        return view('buku/edit', $data);
    }

    public function update($id)
    {
        $buku = $this->bukuModel->find($id);
        if (!$buku) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Buku tidak ditemukan.');
        }

        $rules = $this->bukuModel->getValidationRules();
        $rules['cover'] = 'permit_empty|is_image[cover]|max_size[cover,2048]|ext_in[cover,jpg,jpeg,png,webp]';

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Periksa kembali form Anda.');
        }

        $cover = $this->request->getFile('cover');
        $coverPath = $buku['cover'];

        if ($this->request->getPost('remove_cover')) {
            if ($buku['cover'] && file_exists(FCPATH . $buku['cover'])) {
                unlink(FCPATH . $buku['cover']);
            }
            $coverPath = null;
        }

        if ($cover && $cover->isValid() && !$cover->hasMoved()) {
            $newName = $cover->getRandomName();
            $cover->move(FCPATH . 'uploads/covers', $newName);
            if ($buku['cover'] && file_exists(FCPATH . $buku['cover'])) {
                unlink(FCPATH . $buku['cover']);
            }
            $coverPath = 'uploads/covers/' . $newName;
        }

        $this->bukuModel->save([
            'id'           => $id,
            'judul'        => $this->request->getPost('judul'),
            'penulis'      => $this->request->getPost('penulis'),
            'kategori'     => $this->request->getPost('kategori'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'penerbit'     => $this->request->getPost('penerbit'),
            'stok'         => $this->request->getPost('stok'),
            'deskripsi'    => $this->request->getPost('deskripsi'),
            'cover'        => $coverPath,
        ]);

        return redirect()->to(base_url('buku'))->with('success', 'Buku berhasil diperbarui.');
    }

    public function delete($id)
    {
        $buku = $this->bukuModel->find($id);
        if (!$buku) {
            return redirect()->to(base_url('buku'))->with('error', 'Buku tidak ditemukan.');
        }

        if ($buku['cover'] && file_exists(FCPATH . $buku['cover'])) {
            unlink(FCPATH . $buku['cover']);
        }

        $this->bukuModel->delete($id);

        return redirect()->to(base_url('buku'))->with('success', 'Buku berhasil dihapus.');
    }
}

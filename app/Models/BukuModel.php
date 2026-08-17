<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul', 'penulis', 'kategori', 'tahun_terbit', 'penerbit', 'stok', 'deskripsi', 'cover'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'judul'        => 'required|min_length[3]|max_length[150]',
        'penulis'      => 'required|max_length[100]',
        'kategori'     => 'required|max_length[50]',
        'tahun_terbit' => 'required|valid_date[Y]',
        'penerbit'     => 'required|max_length[100]',
        'stok'         => 'required|integer|greater_than_equal_to[0]',
        'deskripsi'    => 'permit_empty',
    ];

    protected $validationMessages = [
        'judul' => [
            'required'   => 'Judul buku wajib diisi.',
            'min_length' => 'Judul minimal 3 karakter.',
            'max_length' => 'Judul maksimal 150 karakter.',
        ],
        'penulis' => [
            'required'   => 'Penulis wajib diisi.',
            'max_length' => 'Penulis maksimal 100 karakter.',
        ],
        'kategori' => [
            'required'   => 'Kategori wajib diisi.',
            'max_length' => 'Kategori maksimal 50 karakter.',
        ],
        'tahun_terbit' => [
            'required'   => 'Tahun terbit wajib diisi.',
            'valid_date' => 'Format tahun tidak valid.',
        ],
        'penerbit' => [
            'required'   => 'Penerbit wajib diisi.',
            'max_length' => 'Penerbit maksimal 100 karakter.',
        ],
        'stok' => [
            'required'              => 'Stok wajib diisi.',
            'integer'               => 'Stok harus angka.',
            'greater_than_equal_to' => 'Stok minimal 0.',
        ],
    ];

    protected $skipValidation = false;

    public function searchBuku(?string $keyword = null)
    {
        if ($keyword) {
            return $this->groupStart()
                        ->like('judul', $keyword)
                        ->orLike('penulis', $keyword)
                        ->orLike('kategori', $keyword)
                        ->groupEnd();
        }
        return $this;
    }
}

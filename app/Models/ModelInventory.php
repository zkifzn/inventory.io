<?php

use Codeigniter\Model;

class ModelInventory extends Model
{
    Protected $table = 'inventory';
    Protected $allowedFields = ['id_barang', 'kd_barang', 'nama_barang', 'qty', 'harga_barang', 'status'];
}
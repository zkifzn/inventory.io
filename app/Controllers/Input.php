<?php

namespace App\Controllers;
use App\Models\ModelInventory;

class Input extends BaseController
{

    public function index()
    {

    	echo view('inc/header');
        //return view('input_barang', $data);
        echo view('input_barang');
        echo view('inc/footer');
    }

    public function insert_inventory(){

    	$db  = \Config\Database::connect();

    	$data = ['kd_barang' => $this->request->getVar('kode_barang'), 
                 'nama_barang' => $this->request->getVar('nama_barang'), 
                 'qty' => $this->request->getVar('qty'), 
                 'harga_barang' => $this->request->getVar('harga_barang'), 
                 'status' => $this->request->getVar('status')];

        
        $exc_query = $db->table('inventory');

        $exc_query->insert($data);

        if ($exc_query) {
        	echo "<script>
              alert('Data berhasil disimpan');
             window.location.href = 'http://localhost:8080'
                </script>";
        }else{
        	echo "<script>
              alert('Data gagal disimpan');
             window.location.href = 'http://localhost:8080'
                </script>";
        }
    }

    public function edit_inventory(){

    	$db  = \Config\Database::connect();

    	$sql = "UPDATE `inventory` SET `id_barang` = ".$this->request->getVar('id_barang').", `kd_barang` = '".$this->request->getVar('kode_barang')."', `nama_barang` = '".$this->request->getVar('nama_barang')."', `qty` = '".$this->request->getVar('qty')."', `harga_barang` = '".$this->request->getVar('harga_barang')."', `status` = '".$this->request->getVar('status')."' WHERE `inventory`.`id_barang` = ".$this->request->getVar('id_barang').";";
    	//echo $sql;

		$exc_query = $db->query($sql);
		//var_dump($exc_query);
		//exit;
    	// $data = ['kd_barang' => $this->request->getVar('kode_barang'), 
     //             'nama_barang' => $this->request->getVar('nama_barang'), 
     //             'qty' => $this->request->getVar('qty'), 
     //             'harga_barang' => $this->request->getVar('harga_barang'), 
     //             'status' => $this->request->getVar('status') ];

        
     //    $builder = $db->table('inventory');

     //    $builder->insert($data);

        if ($exc_query) {
        	echo "<script>
              alert('Data berhasil diubah');
             window.location.href = 'http://localhost:8080'
                </script>";
        }else{
        	echo "<script>
              alert('Data gagal diubah');
             window.location.href = 'http://localhost:8080'
                </script>";
        }
    }

    public function delete_inventory(){

    	$db  = \Config\Database::connect();

    	$sql = "DELETE FROM `inventory` WHERE `inventory`.`id_barang` = ".$this->request->getVar('id_barang')."";
		$exc_query = $db->query($sql);

    	// $data = ['kd_barang' => $this->request->getVar('kode_barang'), 
     //             'nama_barang' => $this->request->getVar('nama_barang'), 
     //             'qty' => $this->request->getVar('qty'), 
     //             'harga_barang' => $this->request->getVar('harga_barang'), 
     //             'status' => $this->request->getVar('status') ];

        
     //    $builder = $db->table('inventory');

     //    $builder->insert($data);

        if ($exc_query) {
        	echo "<script>
              alert('Data berhasil dihapus');
             window.location.href = 'http://localhost:8080'
                </script>";
        }else{
        	echo "<script>
              alert('Data gagal dihapus');
             window.location.href = 'http://localhost:8080'
                </script>";
        }
    }

}

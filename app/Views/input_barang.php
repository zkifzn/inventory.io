<?php
    $db      = \Config\Database::connect();


    $query_total = "SELECT COUNT(*) as total FROM `inventory`;";
    $exc_query_total = $db->query($query_total);
    $total_inv = $exc_query_total->getResult();
    $total_inv_ = $total_inv[0]->total;

    if ($total_inv_ < 0) {
        $total = "00";
    }else{
        if ($total_inv_ < 10) {
            $total = "0".$total_inv_+1;
        }else{
            $total = $total_inv_+1;
        }
    }

    //echo $total;

    $date = date('Y-m-d');
    $date_ = explode("-", $date);
    $date_thn = substr($date_[0], 2,2);
    $kd_brg = $date_[1].'.'.$date_[2].$date_thn.'.'.$total;
    //echo $kd_brg;
?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
            include "inc/menu.php";
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php
                    include "inc/sub_menu.php";
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="row">

                        <div class="col-lg-8">

                            <!-- Circle Buttons -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Form Input</h6>
                                </div>
                                <div class="card-body">
                                    <form class="user" action="<?php echo site_url('Input/insert_inventory')?>" method="POST">
                                        <table class="table">
                                            <tr>
                                                <td>Kode Barang</td>
                                                <td>:</td>
                                                <td>
                                                    <input type="text" name="kode_barang" class="form-control form-control-user" id="exampleInputEmail"
                                                placeholder="Kode Barang" value="<?=$kd_brg?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nama Barang</td>
                                                <td>:</td>
                                                <td>
                                                    <input type="text" name="nama_barang" class="form-control form-control-user" id="exampleInputEmail"
                                                placeholder="Nama Barang">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Qty</td>
                                                <td>:</td>
                                                <td>
                                                    <select name="qty" class="form-control-user">
                                                        <?php
                                                            for ($i=1; $i <= 20; $i++) { 
                                                        ?>
                                                            <option value="<?=$i?>"><?=$i?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Harga Barang</td>
                                                <td>:</td>
                                                <td>
                                                    <input type="text" name="harga_barang" class="form-control form-control-user" id="exampleInputEmail"
                                                placeholder="Harga Barang">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>:</td>
                                                <td>
                                                    <select name="status" class="form-control-user">
                                                        <option value="1">1. Aktif</option>
                                                        <option value="2">2. Tidak Aktif</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                        <button name="simpan" type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                                    </form>

                                </br>
                                <hr/>
                                </br>

                                <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th><center>No.</center></th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Qty</th>
                                            <th>Harga Barang</th>
                                            <th>Status</th>
                                            <th><center>#</center></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th><center>No.</center></th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Qty</th>
                                            <th>Harga Barang</th>
                                            <th>Status</th>
                                            <th><center>#</center></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php

                                            $sql_data = "SELECT * FROM `inventory`";
                                            $exc_query_data = $db->query($sql_data);
                                            $data_inv = $exc_query_data->getResult();

                                            $i_ = 0;
                                            foreach ($data_inv as $data) {
                                            $i_++;
                                        ?>
                                        <tr>
                                            <td><center><?=$i_?>.</center></td>
                                            <td><?=$data->kd_barang?></td>
                                            <td><?=$data->nama_barang?></td>
                                            <td><?=$data->qty?></td>
                                            <td><?=$data->harga_barang?></td>
                                            <td>
                                                <center>
                                                    <?php
                                                        if ($data->status == 1) {
                                                    ?>
                                                        <i class="fa fa-check" style="color: green"></i></br>
                                                        (Aktif)
                                                    <?php
                                                        }else{
                                                    ?>
                                                        <i class="fa fa-exclamation-triangle" style="color: red"></i></br>
                                                        (Tidak Aktif)
                                                    <?php
                                                        }
                                                    ?>
                                                </center>
                                            </td>
                                            <td><center><button name="simpan" type="submit" class="btn btn-primary" data-toggle="modal" data-target="#edit_inv<?=$i_?>"><i class="fa fa-edit"></i>&nbsp;Edit</button>&nbsp;<button name="simpan" type="submit" class="btn btn-danger" data-toggle="modal" data-target="#hapus_inv<?=$i_?>"><i class="fa fa-trash"></i>&nbsp;Hapus</button></center></td>
                                        </tr>

                                        <!-- Modal -->
                                          <div class="modal fade" id="edit_inv<?=$i_?>" role="dialog">
                                            <div class="modal-dialog">
                                            
                                              <!-- Modal content-->
                                              <div class="modal-content">
                                                <form method="POST" action="<?php echo site_url('Input/edit_inventory')?>">
                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                      <h4 class="modal-title"></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <center>
                                                            <b><p style="font-size: 20px">Edit Inventory</p></b>
                                                        </center>
                                                    </br>
                                                      <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Kode Barang</label>
                                                        <input type="text" name="kode_barang" class="form-control form-control-user" id="exampleInputEmail"
                                                placeholder="Kode Barang" value="<?=$data->kd_barang?>">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Nama Barang</label>
                                                        <input type="text" name="nama_barang" class="form-control form-control-user" id="exampleInputEmail"
                                                placeholder="Nama Barang" value="<?=$data->nama_barang?>">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Qty : </label>
                                                        <select name="qty" class="form-control-user">
                                                            <?php
                                                                for ($i=1; $i <= 20; $i++) { 
                                                            ?>
                                                                <option value="<?=$i?>" <?=$data->qty == $i?"selected='selected'":"";?> ><?=$i?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Harga Barang</label>
                                                        <input type="text" name="harga_barang" class="form-control form-control-user" id="exampleInputEmail"
                                                placeholder="Harga Barang" value="<?=$data->harga_barang?>">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Status : </label>
                                                        <select name="status" class="form-control-user">
                                                            <option value="1" <?=$data->status == 1?"selected='selected'":"";?> >1. Aktif</option>
                                                            <option value="2" <?=$data->status == 2?"selected='selected'":"";?> >2. Tidak Aktif</option>
                                                        </select>
                                                      </div>
                                                    </div>
                                                    <input type="hidden" name="id_barang" value="<?=$data->id_barang?>">
                                                    <div class="modal-footer">
                                                        <button name="edit" type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp;Edit</button>
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                              </div>
                                              
                                            </div>
                                          </div>

                                        <!-- Modal -->
                                          <div class="modal fade" id="hapus_inv<?=$i_?>" role="dialog">
                                            <div class="modal-dialog">
                                            
                                              <!-- Modal content-->
                                              <div class="modal-content">
                                                <form method="POST" action="<?php echo site_url('Input/delete_inventory')?>">
                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                      <h4 class="modal-title"></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                      <p>Anda yakin ingin menghapus data inventory <b>(<?=$data->nama_barang?>)</b> ini ?</p>
                                                    </div>
                                                    <input type="hidden" name="id_barang" value="<?=$data->id_barang?>">
                                                    <div class="modal-footer">
                                                        <button name="hapus" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                              </div>
                                              
                                            </div>
                                          </div>

                                          <?php
                                            }
                                          ?>
                                    </tbody>
                                </table>
                            </div>

                                </div>
                            </div>

                    

                    <!-- Content Row -->
                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer> -->
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    
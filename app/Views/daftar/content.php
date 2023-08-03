<?php
echo $this->extend('template/index');
echo $this->section('content');
?>
<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" ><?php echo $title_card; ?> </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                if (session()->getFlashdata('success')) {
                  ?>
                    <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    <h5><i class="icon fas fa-check"> </i> Success</h5>
                    <?php echo session()->getFlashdata('success'); ?>
                    </div>
                  <?php
                }
                ?>

              <table class="table">
                  <thead>
                    <tr>
                      <th>Kode</th>
                      <th>Jenis Laundry</th>
                      <th>Harga/Kg</th>
                      <th>Lama Pengambilan</th>
                      <th>Act</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($data_daftar as $r){
                      ?>
                        <tr>
                          <td><?php echo $r['kdjenis']; ?> </td>
                          <td><?php echo $r['jenis']; ?> </td>
                          <td><?php echo $r['harga']; ?> </td>
                          <td><?php echo $r['hari']; ?> </td>
                          <td>
                            <a class="btn btn-xs btn-info" href="<?php echo base_url(); ?>/daftar/edit/<?php echo $r['kdjenis']; ?>"><i class="fa-solid fa-edit"></i></a>
                          </td>
                          </tr>
                          <?php
                    }
                    ?>
                  </tbody>
                </table>

              </div>
              <!-- /.card-body -->
            </div>
      </div>
<?php
echo $this->endSection() ;
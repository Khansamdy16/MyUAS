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

               <a class="btn btn-sm btn-primary" href ="<?php echo base_url(); ?>/laundry/tambah"><i class="fa-solid fa-plus"></i> Tambah Laundry </a>
              <table class="table">
                  <thead>
                    <tr>
                      <th>No. Urut</th>
                      <th>Tanggal Masuk</th>
                      <th>Nama</th>
                      <th>Asrama</th>
                      <th>Jenis</th>
                      <th>Harga/Kg</th>
                      <th>Berat (Kg)</th>
                      <th>Total Harga</th>
                      <th>Petugas</th>
                      <th>Tanggal Pengambilan</th>
                      <th>Act</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($data_laundry as $r){
                      ?>
                        <tr>
                          <td><?php echo $r['nourut']; ?> </td>
                          <td><?php echo $r['tanggal']; ?> </td>
                          <td><?php echo $r['nama']; ?> </td>
                          <td><?php echo $r['asrama']; ?> </td>
                          <td><?php echo $r['jenis']; ?> </td>
                          <td><?php echo $r['harga']; ?> </td>
                          <td><?php echo $r['berat']; ?> </td>
                          <td><?php echo $r['totalharga']; ?> </td>
                          <td><?php echo $r['petugas']; ?> </td>
                          <td><?php echo $r['tanggal2'];  ?> </td>
                          <td>
                            <a class="btn btn-xs btn-info" href="<?php echo base_url(); ?>/laundry/edit/<?php echo $r['nourut']; ?>"><i class="fa-solid fa-edit"></i></a>
                            <a class="btn btn-xs btn-danger" href="#" onclick="return hapusConfig(<?php echo $r['nourut']; ?> );"><i class="fa-solid fa-trash"></i></a>
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
      <script>
        function hapusConfig(id){
          Swal.fire({
            title: 'Anda yakin akan menghapus data ini?',
            text: "Data akan dihapus secara permanen",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus'
          }).then((result) => {
            if (result.isConfirmed) { 
              window.location.href='<?php echo base_url(); ?>/laundry/hapus/'+ id ;
            }
          }) 
        }
      </script>
<?php
echo $this->endSection() ;
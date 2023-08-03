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
                <form action="<?php echo $action; ?>" method="post">
                <div class="card-body">
                    <?php if (validation_errors()) {
                        ?>
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    <h5><i class="icon fas fa-ban"> </i> Alert!</h5>
                    <?php echo validation_list_errors() ?>
                    </div>
                    <?php
                    }
                    ?>

                <?php
                if (session()->getFlashdata('error')) {
                  ?>
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    <h5><i class="icon fas fa-warning"> </i> Error</h5>
                    <?php echo session()->getFlashdata('error'); ?>
                    </div>
                  <?php
                }
                ?>
                     
                <?php echo csrf_field() ?>
                <?php
                if (current_url(true)->getSegment(2) == 'edit'){
                ?>
                <input type="hidden" name="param" id="param" value="<?php echo $edit_data['nourut']; ?>">
                <?php
                }
                ?>
                <div class="form-group">
                    <label for="nourut">No. Urut</label>
                    <input type="text" name="nourut" id="nourut" value="<?php echo empty(set_value('nourut')) ? (empty($edit_data['nourut']) ? "":$edit_data['nourut']) : set_value('nourut'); ?>" class="form-control"> 
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal Masuk</label>
                    <input type="date" name="tanggal" id="tanggal" value="<?php echo empty(set_value('tanggal')) ? (empty($edit_data['tanggal']) ? date('Y-m-d'):$edit_data['tanggal']) : set_value('tanggal'); ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" value="<?php echo empty(set_value('nama')) ? (empty($edit_data['nama']) ? "":$edit_data['nama']) : set_value('nama'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="asrama">Asrama</label>
                    <input type="text" name="asrama" id="asrama" value="<?php echo empty(set_value('asrama')) ? (empty($edit_data['asrama']) ? "":$edit_data['asrama']) : set_value('asrama'); ?>" class="form-control">
                </div>
                <div class="form-group">
                  <label for="jenis" >Kategori</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="" tabindex="-1" aria-hidden="true" name="jenis" id="jenis" value="<?php echo empty(set_value('jenis')) ? (empty($edit_data['jenis']) ? "":$edit_data['jenis']) : set_value('jenis'); ?>">
                    <option data-select2-id="jenis">Cuci Basah</option>
                    <option data-select2-id="jenis">Cuci Kering</option>
                    <option data-select2-id="jenis">Cuci Setrika</option>
                    <option data-select2-id="jenis">Setrika</option>
                  </select>
                </div>
                <div class="form-group">
                    <label for="harga">Harga/Kg</label>
                    <input type="text" name="harga" id="harga" value="<?php echo empty(set_value('harga')) ? (empty($edit_data['harga']) ? "":$edit_data['harga']) : set_value('harga'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="berat">Berat (Kg)</label>
                    <input type="text" name="berat" id="berat" value="<?php echo empty(set_value('berat')) ? (empty($edit_data['berat']) ? "":$edit_data['berat']) : set_value('berat'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="totalharga">Total Harga</label>
                    <input type="text" name="totalharga" id="totalharga" value="<?php echo empty(set_value('totalharga')) ? (empty($edit_data['totalharga']) ? "":$edit_data['totalharga']) : set_value('totalharga'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="petugas">Petugas</label>
                    <input type="text" name="petugas" id="petugas" value="<?php echo empty(set_value('petugas')) ? (empty($edit_data['petugas']) ? "":$edit_data['petugas']) : set_value('petugas'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tanggal2">Tanggal Pengambilan</label>
                    <input type="date" name="tanggal2" id="tanggal2" value="<?php echo empty(set_value('tanggal2')) ? (empty($edit_data['tanggal2']) ? "":$edit_data['tanggal2']) : set_value('tanggal2'); ?>" class="form-control">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Simpan</button>
            </div>
            </form>
        </div>     
    </div>
</div>
<?php
echo $this->endSection(); 
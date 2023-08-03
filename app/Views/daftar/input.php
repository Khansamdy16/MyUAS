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
                <input type="hidden" name="param" id="param" value="<?php echo $edit_data['kdjenis']; ?>">
                <?php
                }
                ?>
                <div class="form-group">
                    <label for="kdjenis">Kode</label>
                    <input type="text" name="kdjenis" id="kdjenis" value="<?php echo empty(set_value('kdjenis')) ? (empty($edit_data['kdjenis']) ? "":$edit_data['kdjenis']) : set_value('kdjenis'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="jenis">Jenis Laundry</label>
                    <input type="text" name="jenis" id="jenis" value="<?php echo empty(set_value('jenis')) ? (empty($edit_data['jenis']) ? "":$edit_data['jenis']) : set_value('jenis'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" name="harga" id="harga" value="<?php echo empty(set_value('harga')) ? (empty($edit_data['harga']) ? "":$edit_data['harga']) : set_value('harga'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="hari">Lama Pengambilan</label>
                    <input type="text" name="hari" id="hari" value="<?php echo empty(set_value('hari')) ? (empty($edit_data['hari']) ? "":$edit_data['hari']) : set_value('hari'); ?>" class="form-control">
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
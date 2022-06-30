 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?=$provider->nama_provider?> </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Beranda</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('admin/provider')?>">Provider</a></li>
              <li class="breadcrumb-item active"><?=$provider->nama_provider?>  </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
         <div class="card"> 
              <!-- /.card-header -->
              <div class="card-body">

                   <?= form_open_multipart('admin/prosesprovider/') ?> 
                                                 
                            <fieldset> 
                                <div class="form-group">
                                    <div class="form-line">
                                         <div class="row">
                                            <div class="col-md-4">
                                                 <label class="control-label">Foto</label><br>
                                                 <img src="<?=base_url()?>/assets/<?=$provider->logo?>" width="100%"> 
                                                 <input type="file" name="foto" class="form-control"  >
                                                 
                                             </div> 
                                             <div class="col-md-8">
                                                 <label class="control-label">ID Provider</label>
                                                 <input type="text" name="id_provider" class="form-control" placeholder="Masukkan Kode provider" readonly  required value="<?=$provider->id_provider?>" >
                                                 <br>
                                                  <label class="control-label">Nama Provider</label>
                                                 <input type="text" name="nama_provider" class="form-control" placeholder="Masukkan Nama Provider"  required value="<?=$provider->nama_provider?>"  >
                                                 <br>
                                                 <label class="control-label">Keterangan</label>
                                                 <textarea class="form-control" name="keterangan" placeholder="Masukkan Keterangan" ><?=$provider->keterangan?></textarea>
                                             </div>  
                                             
                                         </div> 

                                   </div>
                                 </div>
 
                                
                            </fieldset>  
                                      
                              
                            <input  type="submit" class="btn bg-blue btn-block text-white"  name="edit" value="Edit">  <br><br>
                             <?php echo form_close() ?> 
              </div> 
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div>
 
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Form Tambah Provider</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Beranda</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('admin/Provider')?>">Provider</a></li>
              <li class="breadcrumb-item active">Form Tambah Provider</li>
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
                                             <div class="col-md-6">
                                                 <label class="control-label">Nama Provider</label>
                                                 <input type="text" name="nama_provider" class="form-control" placeholder="Masukkan Nama Provider"  required  >
                                                 
                                             </div> 
                                             
                                             <div class="col-md-6">
                                                 <label class="control-label">Logo</label>
                                                 <input type="file" name="foto" class="form-control"  required >
                                                 
                                             </div> 
                                         </div> 

                                   </div>
                                 </div>
 
                                <div class="form-group">

                                    <div class="form-line">
                                        <div class="row">
                                             <div class="col-md-12">
                                                 <label class="control-label">Keterangan</label>
                                                 <textarea class="form-control" name="keterangan" placeholder="Masukkan Keterangan" ></textarea>
                                                 
                                             </div> 
                                         </div> 
                                   </div>
                                 </div>
                            </fieldset>  
                                        
                                      
                              
                            <input  type="submit" class="btn bg-blue btn-block "  name="tambah" value="Tambah">  <br><br>
                             <?php echo form_close() ?> 
              </div> 
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div>
 
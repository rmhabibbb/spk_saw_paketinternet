 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Provider</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Beranda</a></li>
              <li class="breadcrumb-item active">Provider</li>
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

                  <a    href="<?=base_url('admin/prosesprovider')?>"><button class="btn bg-blue text-white">Tambah Provider</button></a>
                  <br><br>

              <table class="table table-flush " id="datatable-basic">
                    <thead>
                        <tr>   
                            <th>ID Provider</th> 
                            <th>Foto</th> 
                            <th>Nama Provider</th> 
                            <th>Keterangan</th>  
                            <th>Aksi</th>
                        </tr>
                    </thead> 
                    <tbody>
                      <?php $i = 1; foreach ($list_provider as $row): ?> 
                          <tr>    
                              <td><?=$row->id_provider?>  </td> 
                              <td><img src="<?=base_url()?>/assets/<?=$row->logo?>" width="100px">  </td> 
                              <td><?=$row->nama_provider?>  </td>  
                              <td style="white-space:normal" ><?=$row->keterangan?>  </td>  
                               
                               <td>
                                  <a href="<?=base_url('admin/provider/'.$row->id_provider)?>"> 
                                    <button class="btn bg-blue text-white">
                                      Lihat Detail
                                    </button>
                                  </a>

                                  <a data-toggle="modal" data-target="#delete-<?=$row->id_provider?>"  href=""><button class="btn bg-red  text-white">Hapus</button></a>
                               </td>        
                          </tr>
                      <?php endforeach; ?>
                    </tbody>
                </table> 
              </div> 
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div>


<?php $i = 1; foreach ($list_provider as $row): ?> 
 <div class="modal fade" id="delete-<?=$row->id_provider?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>Hapus data provider?</center></h4> 
                            <center><span style="color :red"><i>Semua data yang terkait dengan [<?=$row->nama_provider?>]  akan dihapus.</i></span></center>
                        </div>
                        <div class="modal-body"> 
                       
                         <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                        <form action="<?= base_url('admin/prosesprovider')?>" method="Post" > 
                                        <input type="hidden" value="<?=$row->id_provider?>" name="id_provider">  
                                        <input  type="submit" class="btn bg-red btn-block "  name="hapus" value="Ya">
                                         
                                    </div>
                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                          <button type="button"  class="btn bg-green btn-block" data-dismiss="modal">Tidak</button>
                                    </div>
                            <?php echo form_close() ?> 
                                </div>
                        </div> 
                    </div>
                </div>
    </div>
<?php endforeach; ?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Paket Internet</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Beranda</a></li>
              <li class="breadcrumb-item active">Paket Internet</li>
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

                <a data-toggle="modal" data-target="#tambah"  href=""><button class="btn bg-blue text-white">Tambah Paket Internet</button></a>
                  <br><br>

              <table class="table table-flush " id="datatable-basic">
                    <thead>
                        <tr>   
                            <th>No</th> 
                            <th>Nama Paket</th>
                            <th>Provider</th>  

                            <?php $i = 1; foreach ($list_kriteria as $row): ?> 
                                  <th><?=$row->nama_kriteria?></th>  
                            <?php endforeach; ?>
                            <th>Aksi</th>
                        </tr>
                    </thead> 
                    <tbody>
                      <?php $i = 1; foreach ($list_paket as $row): ?> 
                          <tr>    
                              <td><?=$i++?>  </td>  
                              <td style="white-space:normal" ><?=$row->nama_paket?></td>  
                              <td style="white-space:normal"><?= $this->Provider_m->get_row(['id_provider' => $row->id_provider])->nama_provider ?></td>  
                              <?php 
                              foreach ($list_kriteria as $row2): ?>  <td style="white-space:normal">
                                <?php 
                                if ($this->Penilaian_m->get_num_row(['id_paket' => $row->id_paket,'id_kriteria' => $row2->id_kriteria]) == 0) {
                                  echo "-";
                                }else{

                                  $bobot = $this->Penilaian_m->get_row(['id_paket' => $row->id_paket,'id_kriteria' => $row2->id_kriteria])->id_bobot;
                                  ?>
                                  <?=$this->Bobot_m->get_row(['id_bobot' => $bobot])->keterangan?>
                                  <?php 
                                } ?>
                                </td>  
                                  
                            <?php  endforeach; ?>
                               <td>
                                  
                                  <a data-toggle="modal" data-target="#edit-<?=$row->id_paket?>"  href=""><button class="btn btn-block bg-blue text-white">Edit</button></a>
                                  <br>
                                  <a data-toggle="modal" data-target="#delete-<?=$row->id_paket?>"  href=""><button class="btn btn-block bg-red text-white">Hapus</button></a>
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



<div class="modal fade" id="tambah">
        <div class="modal-dialog tambah">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Form Tambah Paket Internet</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form action="<?= base_url('admin/prosespaket')?>" method="Post"  >   

                            <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                                <tbody>
                                    
                                     <tr>
                                         <th style="width: 30%">
                                              Nama Paket
                                         </th>
                                         <td> 
                                          
                                            
                                            <input type="text" class="form-control" name="nama_paket"  required autofocus  >

                                         </td>
                                     </tr> 
                                     <tr>
                                         <th style="width: 30%">
                                              Nama Provider
                                         </th>
                                         <td> 
                                          
                                            
                                            <select class="form-control"  required name="id_provider">
                                            <option value="">- Pilih -</option>  
                                              <?php foreach ($list_provider as $row2): ?>  
                                                <option value="<?=$row2->id_provider?>"><?=$row2->nama_provider?></option> 
                                              <?php endforeach; ?> 
                                         </select> 

                                         </td>
                                     </tr> 
                                    <?php $i= 1; foreach ($list_kriteria as $row): ?>  

                            <?php if ($row->id_kriteria != 7) { ?> 
                                <tr>
                                    <th><?=$row->nama_kriteria?></th>
                                    <td>
                                        <select class="form-control"  required name="kriteria_<?=$row->id_kriteria?>">
                                            <option value="">- Pilih -</option> 
                                            <?php $list_param = $this->Bobot_m->get(['id_kriteria' => $row->id_kriteria]);?>
                                              <?php foreach ($list_param as $row2): ?>  
                                                <option value="<?=$row2->id_bobot?>"><?=$row2->keterangan?></option> 
                                              <?php endforeach; ?> 
                                         </select> 
                                    </td>
                                </tr>
                                <?php } endforeach; ?>
                                </tbody> 
                            </table>       
                        <input  type="submit" class="btn bg-blue text-white btn-block "  name="tambah" value="Simpan">  <br><br>
                  
                            <?php echo form_close() ?> 
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


<?php $i = 1; foreach ($list_paket as $row): ?>

<div class="modal fade" id="edit-<?=$row->id_paket?>">
        <div class="modal-dialog edit-<?=$row->id_paket?>">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Form Edit Spesifikasi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form action="<?= base_url('admin/prosespaket')?>" method="Post"  >   
              <input type="hidden" name="id_paket" value="<?=$row->id_paket?>">
                            <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                                <tbody>
                                    
                                     <tr>
                                         <th style="width: 30%">
                                              Nama Paket
                                         </th>
                                         <td> 
                                          
                                            
                                            <input type="text" class="form-control" name="nama_paket"  required autofocus value="<?=$row->nama_paket?>"  >

                                         </td>
                                     </tr> 
                                     <tr>
                                         <th style="width: 30%">
                                              Nama Provider
                                         </th>
                                         <td> 
                                          
                                            
                                            <select class="form-control"  required name="id_provider">
                                              <option value="<?=$row->id_provider?>"><?=$this->Provider_m->get_row(['id_provider' => $row->id_provider])->nama_provider?></option> 
                                              <?php foreach ($list_provider as $row2): ?>  
                                                <?php if ($row2->id_provider != $row->id_provider) { ?> 
                                                <option value="<?=$row2->id_provider?>"><?=$row2->nama_provider?></option> 
                                              <?php } endforeach; ?> 
                                         </select> 

                                         </td>
                                     </tr> 
                                    <?php $i= 1; foreach ($list_kriteria as $row2): ?>  
 
                                <tr>
                                    <th><?=$row2->nama_kriteria?></th>
                                    <td>
                                        <select class="form-control"  required name="kriteria_<?=$row2->id_kriteria?>">
                                           
                                             <?php 
                                             if ( $this->Penilaian_m->get_row(['id_kriteria' => $row2->id_kriteria, 'id_paket' => $row->id_paket]) == 0) { ?>

                                                <option value="">Pilih</option> 
                                             <?php }else{ 
                                             $nilaix = $this->Penilaian_m->get_row(['id_kriteria' => $row2->id_kriteria, 'id_paket' => $row->id_paket])->id_bobot; ?> ?>
                                             <option value="<?=$nilaix?>"><?=$this->Bobot_m->get_row(['id_bobot' => $nilaix])->keterangan?></option> 

                                           <?php } ?>
                                            
                                            <?php $list_param = $this->Bobot_m->get(['id_kriteria' => $row2->id_kriteria]);?>
                                              <?php foreach ($list_param as $row2): ?> 
                                              <?php if ($row2->id_bobot != $nilaix) { ?>
                                                <option value="<?=$row2->id_bobot?>"><?=$row2->keterangan?></option> 
                                              <?php } endforeach; ?> 

                                         </select> 
                                    </td>
                                </tr>
                                <?php   endforeach; ?>
                                </tbody> 
                            </table>       
                        <input  type="submit" class="btn bg-blue btn-block text-white"  name="edit" value="Simpan">  <br><br>
                  
                            <?php echo form_close() ?> 
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


<?php endforeach; ?>
<?php $i = 1; foreach ($list_paket as $row): ?>

<div class="modal fade" id="delete-<?=$row->id_paket?>">
        <div class="modal-dialog delete-<?=$row->id_paket?>">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hapus Paket : <?=$row->nama_paket?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                        <form action="<?= base_url('admin/prosespaket')?>" method="Post" > 
                                        <input type="hidden" value="<?=$row->id_paket?>" name="id_paket">  
                                        <input  type="submit" class="btn bg-red btn-block "  name="hapus" value="Ya">
                                         
                                    </div>
                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                          <button type="button"  class="btn bg-green btn-block text-white" data-dismiss="modal">Tidak</button>
                                    </div>
                            <?php echo form_close() ?> 
                                </div>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 
<?php endforeach; ?>



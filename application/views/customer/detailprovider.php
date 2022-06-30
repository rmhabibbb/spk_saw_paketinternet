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
              <li class="breadcrumb-item"><a href="<?=base_url('customer')?>">Beranda</a></li> 
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
                            <fieldset> 
                                <div class="form-group">
                                    <div class="form-line">
                                         <div class="row">
                                            <div class="col-md-4"> 
                                                 <img src="<?=base_url()?>/assets/<?=$provider->logo?>" width="100%">  
                                                 
                                             </div> 
                                             <div class="col-md-8">
                                                  
                                                  <label class="control-label">Nama Provider</label>
                                                 <p> <?=$provider->nama_provider?> </p>
                                                 <br>
                                                 <label class="control-label">Keterangan</label>
                                                 <p><?=$provider->keterangan?></p>
                                             </div>  
                                             
                                         </div> 

                                   </div>
                                 </div>
 
                                
                            </fieldset>  
                            <hr>
                            <h4>Daftar Paket</h4>
                            <table id="example1" class="table table-bordered table-striped"> 
                    <thead>
                        <tr>   
                            <th>No</th> 
                            <th>Nama Paket</th> 

                            <?php $i = 1; foreach ($list_kriteria as $row): ?> 
                                  <th><?=$row->nama_kriteria?></th>  
                            <?php  endforeach; ?> 
                        </tr>
                    </thead> 
                    <tbody>
                      <?php $i = 1; foreach ($list_paket as $row): ?> 
                          <tr>    
                              <td><?=$i++?>  </td>  
                              <td><a href="<?=base_url('customer/paket/'.$row->id_paket)?>"> 
                                  <?=$row->nama_paket?></td>   
                                </a>
                              <?php 
                               foreach ($list_kriteria as $row2): ?>  <td>
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
 
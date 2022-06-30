 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?=$paket->nama_paket?> </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('customer')?>">Beranda</a></li> 
              <li class="breadcrumb-item active"><?=$paket->nama_paket?>  </li>
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
                                             <div class="col-md-8">
                                                 
                            <table id="example1" class="table table-bordered  "> 
                              <tr>
                                <th>Nama Paket</th>
                                <td><?=$paket->nama_paket?></td>
                              </tr>
                               <?php 
                               foreach ($list_kriteria as $row2): ?>  <tr> <th><?=$row2->nama_kriteria?></th><td>
                                <?php 
                                if ($this->Penilaian_m->get_num_row(['id_paket' => $paket->id_paket,'id_kriteria' => $row2->id_kriteria]) == 0) {
                                  echo "-";
                                }else{

                                  $bobot = $this->Penilaian_m->get_row(['id_paket' => $paket->id_paket,'id_kriteria' => $row2->id_kriteria])->id_bobot;
                                  ?>
                                  <?=$this->Bobot_m->get_row(['id_bobot' => $bobot])->keterangan?>
                                  <?php 
                                } ?>
                                </td>  
                                  </tr>
                            <?php  endforeach; ?>
                              
                              <tr>
                                <th>Provider</th>
                                <td>
                                  <?=$provider->nama_provider?> (<a  href="<?=base_url('customer/provider/'.$paket->id_provider)?>" >Lihat Semua Paket</a>)
                                </td>
                              </tr>
                              
                            </table>
                                             </div>  
                                             
                                         </div> 

                                   </div>
                                 </div>
 
                                
                            </fieldset>    
              </div> 
      </div> 
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div>
 
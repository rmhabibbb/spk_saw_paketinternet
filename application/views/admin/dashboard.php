    <!-- Header -->
    <!-- Header -->
    <div class="header   pb-6 bg-primary"  >
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7"> 
              <h6 class="h2 text-white d-inline-block mb-0">Beranda</h6>
             
            </div> 

             
          </div>
        </div>
        <?= $this->session->flashdata('msg2') ?>
      </div>
    </div>
    <!-- Page content -->
    <div class="content">
      <div class="container-fluid">
      
        <div class="card"> 
              
              <div class="card-body">
              
                              <div class="table-responsive">
              <table class="table table-flush" id="datatable-basic">
                                          <thead>
                                              <tr>   
                                                  <th>Peringkat</th> 
                                                  <th>Foto </th>
                                                  <th>Provider </th>
                                                  <th>Nama Paket </th> 
                                                  <th>Nilai</th>   
                                              </tr>
                                          </thead> 
                                          <tbody>
                                            <?php $i = 1; foreach ($list_paket as $row): ?> 
                                            <?php $paket = $this->Paket_m->get_row(['id_paket' => $row['id_paket']]); ?>
                                            <?php $provider = $this->Provider_m->get_row(['id_provider' => $paket->id_provider]); ?>
                                                <tr>   
                                                    <td><?=$i++?> </td>  
                                                    <td><img src="<?=base_url()?>/assets/<?=$provider->logo?>" width="100px">  </td> 
                                                    <td><a href="<?=base_url('admin/provider/'.$provider->id_provider)?>"><?=$provider->nama_provider?></a> </td>  
                                                    <td> <?=$paket->nama_paket?> </td>  
                                                    <td><?= $row['nilai_akhir'] ?>  </td>  
                                                     
                                                </tr>
                                            <?php endforeach; ?>
                                          </tbody>
                                      </table>  
                                  </div>
                                <hr>
            </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
   
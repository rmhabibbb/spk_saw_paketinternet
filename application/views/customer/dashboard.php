 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Beranda</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Beranda</a></li> 
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
              <div class="card-header">
                Daftar Paket Internet
              </div>
              <div class="card-body">

                  <?php if ($index_p == 0): ?> 
                      <button type="button" class="btn btn-primary btn-sm">Semua</button> 
                  <?php else: ?>
                    <a href="<?= base_url('customer')?>"> 
                      <button type="button" class="btn btn-outline-primary btn-sm">Semua</button>
                    </a>
                  <?php endif; ?> 
                <a data-toggle="modal" data-target="#tambah"  href=""><button class="btn btn-primary btn-sm">Cari Paket Internet </button></a>
                  <br><br>
                 
                              <div class="table-responsive">
              <table class="table table-flush" id="datatable-basic">
                                          <thead>
                                              <tr>   
                                                  <th>No.</th>  
                                                  <th>Provider </th>
                                                  <th>Nama Paket </th> 
                                                  <th>Aksi</th>   
                                              </tr>
                                          </thead> 
                                          <tbody>
                                            <?php $i = 1; foreach ($list_paket as $row): ?> 
                                            <?php $paket = $this->Paket_m->get_row(['id_paket' => $row['id_paket']]); ?>
                                            <?php $provider = $this->Provider_m->get_row(['id_provider' => $paket->id_provider]); ?>
                                                <tr>   
                                                    <td><?=$i++?> </td>  
                                                    <td>
                                                      <a style="text-decoration: none; color:black" href="<?=base_url('customer/provider/'.$paket->id_provider)?>" >
                                                      <center>
                                                        <img src="<?=base_url()?>/assets/<?=$provider->logo?>" width="100px"> <br>
                                                      <b><?=$provider->nama_provider?> </b>
                                                      </center>
                                                      </a>
                                                  </td>  
                                                    <td> <?=$paket->nama_paket?> </td>  
                                                    <td>
                                                      <a href="<?=base_url('customer/paket/'.$paket->id_paket)?>"> 
                                                        <button class="btn bg-blue text-white">
                                                          Lihat Detail
                                                        </button>
                                                      </a>
                                                    </td>  
                                                     
                                                </tr>
                                            <?php endforeach; ?>
                                          </tbody>
                                      </table>  
                                  </div>
                                <hr>
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
              <h4 class="modal-title">Cari Paket Internet</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form action="<?= base_url('customer/index')?>" method="Post"  >   

                            <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                                <tbody>
                                    
                                 
                                    <?php $i= 1; foreach ($list_kriteria as $row): ?>  
 
                                <tr>
                                    <th><?=$row->nama_kriteria?></th>
                                    <td>
                                        <select class="form-control"  name="c<?=$row->id_kriteria?>">
                                            <option value="">- Pilih -</option> 
                                            <?php $list_param = $this->Bobot_m->get(['id_kriteria' => $row->id_kriteria]);?>
                                              <?php foreach ($list_param as $row2): ?>  
                                                <option value="<?=$row2->id_bobot?>"><?=$row2->keterangan?></option> 
                                              <?php endforeach; ?> 
                                         </select> 
                                    </td>
                                </tr>
                                <?php  endforeach; ?>
                                </tbody> 
                            </table>       
                        <input  type="submit" class="btn bg-blue btn-block text-white "  name="cari" value="Cari">  <br><br>
                  
                            <?php echo form_close() ?> 
            </div> 
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

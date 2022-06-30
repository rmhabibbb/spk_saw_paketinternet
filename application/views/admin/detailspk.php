 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
            <?= $this->session->flashdata('msg') ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Detail Perhitungan SAW</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Beranda</a></li> 
              <li class="breadcrumb-item active">Detail Perhitungan SAW</li>
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
                <h3>1. Nilai Awal</h3>
                              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped"> 
                                          <thead>
                                              <tr>    
                                                  <th>Nama Paket </th>

                                            <?php $i = 1; foreach ($list_kriteria as $row): ?> 
                                                  <th><?=$row->nama_kriteria?></th>  
                                            <?php endforeach; ?>
                                              </tr>
                                          </thead> 
                                          <tbody>
                                            <?php $i = 1; foreach ($nilai_awal as $row): ?>  
                                            <?php $paket = $this->Paket_m->get_row(['id_paket' => $row['id_paket']]); ?>
                                                <tr>    
                                                    <td><?=$paket->nama_paket?>    </td>  
                                                    <?php $x = 0; foreach ($list_kriteria as $row2): ?> 
                                                    <td><?=$row['nilai'][$x++]?>  </td>  
                                                  <?php endforeach; ?> 
                                                     
                                                </tr>
                                            <?php endforeach; ?>
                                          </tbody>
                                      </table>  
                                  </div>
                                <hr>

                              <h3>2. Normalisasi Matrik R</h3>
                              <div class="table-responsive">
                <table id="example3" class="table table-bordered table-striped"> 
                                          <thead>
                                              <tr>    
                                                  <th>Nama paket </th>
                                                  <?php $i = 1; foreach ($list_kriteria as $row): ?> 
                                                  <th><?=$row->nama_kriteria?></th>  
                                            <?php endforeach; ?> 
                                              </tr>
                                          </thead> 
                                          <tbody>
                                            <?php $i = 1; foreach ($matrik_r as $row): ?>  
                                            <?php $paket = $this->Paket_m->get_row(['id_paket' => $row['id_paket']]); ?>
                                                <tr>    
                                                    <td><?=$paket->nama_paket?>    </td>  
                                                    <?php $x = 0; foreach ($list_kriteria as $row2): ?> 
                                                    <td><?=$row['nilai'][$x++]?>  </td>  
                                                  <?php endforeach; ?> 
                                                     
                                                </tr>
                                            <?php endforeach; ?>
                                          </tbody>
                                      </table>  
                                  </div>
                                <hr>
                              <h3>3. Hasil Akhir</h3>
                                <div class="table-responsive">
                                  <table id="example4" class="table table-bordered table-striped"> 
                                          <thead>
                                              <tr>    
                                                  <th>Kode paket </th>
                                                  <th>Nama paket </th> 
                                                  <th>Nilai Akhir</th>   
                                              </tr>
                                          </thead> 
                                          <tbody>
                                            <?php $i = 1; foreach ($list_paket as $row): ?> 
                                            <?php $paket = $this->Paket_m->get_row(['id_paket' => $row['id_paket']]); ?>
                                                <tr>    
                                                    
                                                    <td><?=$paket->id_paket?>   </td>
                                                    <td><?=$paket->nama_paket?>    </td>  
                                                    <td><?= $row['nilai_akhir'] ?>  </td>  
                                                     
                                                </tr>
                                            <?php endforeach; ?>
                                          </tbody>
                                      </table>  
                                  </div>
                                  <hr>
                              <h3>4. Perangkingan</h3>
                                <div class="table-responsive">
                                  <table id="example4" class="table table-bordered table-striped"> 
                                          <thead>
                                              <tr>      
                                                  <th>Peringkat</th>  
                                                  <th>Kode paket </th>
                                                  <th>Nama paket </th>  
                                              </tr>
                                          </thead> 
                                          <tbody>
                                            <?php $i = 1; foreach ($list_paket as $row): ?> 
                                            <?php $paket = $this->Paket_m->get_row(['id_paket' => $row['id_paket']]); ?>
                                                <tr>    
                                                    <td><?=$i++?></td>
                                                    <td><?=$paket->id_paket?>   </td>
                                                    <td><?=$paket->nama_paket?>    </td>   
                                                     
                                                </tr>
                                            <?php endforeach; ?>
                                          </tbody>
                                      </table>  
                                  </div>
          </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div>
 
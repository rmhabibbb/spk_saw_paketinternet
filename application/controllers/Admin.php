<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  
        $this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role'); 
          if (!$this->data['email'] || ($this->data['id_role'] != 1))
          {
            $this->flashmsg('<i class="glyphicon glyphicon-remove"></i> Anda harus login terlebih dahulu', 'danger');
            redirect('login');
            exit;
          }  
    
    $this->load->model('login_m'); 
    $this->load->model('register_m');   
    $this->load->model('Bobot_m');   
    $this->load->model('Customer_m');         
    $this->load->model('Kriteria_m');   
    $this->load->model('Paket_m');   
    $this->load->model('Penilaian_m');    
    $this->load->model('Provider_m');      
    
    $this->data['profil'] = $this->login_m->get_row(['email' =>$this->data['email'] ]); 
     
    date_default_timezone_set("Asia/Jakarta");


  }

public function index()
{ 
    
      $saw = $this->Paket_m->saw();

      $this->data['list_paket'] = $saw['hasil_akhir'];
      $this->data['title']  = 'Beranda'; 
      $this->data['index'] = 0;
      $this->data['content'] = 'admin/dashboard';
      $this->template($this->data,'admin');
}

// KELOLA SPK
 

    public function detailspk(){
      $saw = $this->Paket_m->saw();
      $this->data['list_kriteria'] = $this->Kriteria_m->get();  
      $this->data['nilai_awal'] = $saw['nilai_awal'];  
      $this->data['matrik_r'] = $saw['matrik_r']; 
      $this->data['list_paket'] = $saw['hasil'];
      $this->data['title']  = 'Detail Hasil SPK. Metode SAW';
      $this->data['index'] = 7;
      $this->data['content'] = 'admin/detailspk';
      $this->template($this->data,'admin');
    }
// KELOLA SPK

// KELOLA KRITERA ----------------------------------------------------------------------------

    public function kriteria(){
      if ($this->POST('tambah')) {     
        $data = [   
          'nama_kriteria' => $this->POST('nama_kriteria') , 
          'bobot_vektor' => $this->POST('bobot') , 
          'tipe' => $this->POST('tipe') , 
          'email' => $this->data['profil']->email
        ];
        $this->Kriteria_m->insert($data); 
        $id = $this->Kriteria_m->get_row(['nama_kriteria' => $this->POST('nama_kriteria')])->id_kriteria; 

        $this->flashmsg('KRITERA BERHASIL DITAMBAH!', 'success');
        redirect('admin/kriteria/'.$id);
        exit();    
      }  

      if ($this->POST('edit')) { 
        $data = [    
          'nama_kriteria' => $this->POST('nama_kriteria') , 
          'bobot_vektor' => $this->POST('bobot') , 
          'tipe' => $this->POST('tipe') , 
          'email' => $this->data['profil']->email
        ];

        $this->Kriteria_m->update($this->POST('id_kriteria'),$data);

        $this->flashmsg('DATA BERHASIL TERSIMPAN!', 'success');
        redirect('admin/kriteria/'.$this->POST('id_kriteria'));
        exit();    
      } 

      if ($this->POST('hapus')) { 
        $id_kriteria = $this->POST('id_kriteria'); 
        $this->Kriteria_m->delete($id_kriteria); 
        $this->flashmsg('Kriteria berhasil dihapus!', 'success');
        redirect('admin/kriteria/');
        exit();    
      } 
       

      if ($this->uri->segment(3)) {
        if ($this->Kriteria_m->get_num_row(['id_kriteria' => $this->uri->segment(3)]) == 1) {
          $this->data['kriteria'] = $this->Kriteria_m->get_row(['id_kriteria' => $this->uri->segment(3)]);   
          $this->data['list_sub'] = $this->Bobot_m->get(['id_kriteria' => $this->uri->segment(3) ]);     
 
           
          $this->data['title']  = 'Kelola Kriteria - '.$this->data['kriteria']->nama_kriteria .'';
          $this->data['index'] = 4;
          $this->data['content'] = 'admin/detailkriteria';
          $this->template($this->data,'admin'); 
        }else {
          redirect('sekretariat/kriteria');
          exit();
        }
      }

     
      else {
        $this->data['list_kriteria'] = $this->Kriteria_m->get();  


        $this->data['title']  = 'Kelola Data Kriteria';
        $this->data['index'] = 4;
        $this->data['content'] = 'admin/kriteria';
        $this->template($this->data,'admin');
      }
    } 

    public function bobot(){
      if ($this->POST('tambah')) {   
        $data = [   
          'keterangan' => $this->POST('ket'), 
          'nilai' => $this->POST('nilai'),
          'id_kriteria' => $this->POST('id_kriteria') 
        ];
        $this->Bobot_m->insert($data);
 
        $this->flashmsg('BOBOT KRITERA BERHASIL DITAMBAH!', 'success');
        redirect('admin/kriteria/'. $this->POST('id_kriteria'));
        exit();    
      }  

      if ($this->POST('edit')) { 
         $data = [   
          'keterangan' => $this->POST('ket'), 
          'nilai' => $this->POST('nilai') 
        ];

        $this->Bobot_m->update($this->POST('id_bobot'),$data);

        $this->flashmsg('DATA BERHASIL TERSIMPAN!', 'success');
        redirect('admin/kriteria/'.$this->POST('id_kriteria'));
        exit();    
      } 

      if ($this->POST('hapus')) {   
        $this->Bobot_m->delete($this->POST('id_bobot'));
        $this->flashmsg('DATA BOBOT KRITERA BERHASIL DIHAPUS!', 'success');
        redirect('admin/kriteria/'.$this->POST('id_kriteria'));
        exit();    
      }  
    } 
     
// KELOLA KRITERIA ---------------------------------------------------------------------
 

// KELOLA LAPTOP 

    public function provider(){
      

      if ($this->uri->segment(3)) {
        $kd = $this->uri->segment(3);
        $this->data['provider'] = $this->Provider_m->get_row(['id_provider' => $kd]);   
        $this->data['list_kriteria'] = $this->Kriteria_m->get();  
        $this->data['title']  = $this->data['provider']->nama_provider .' - Kelola Data Provider';
        $this->data['index'] = 2;
        $this->data['content'] = 'admin/detailprovider';
        $this->template($this->data,'admin');
      }else{
        $this->data['list_provider'] = $this->Provider_m->get();  
        $this->data['title']  = 'Kelola Data Provider';
        $this->data['index'] = 2;
        $this->data['content'] = 'admin/provider';
        $this->template($this->data,'admin');
      }
      
      
    } 

    public function prosesprovider(){


      if ($this->POST('tambah')) {
         


        if ($_FILES['foto']['name'] !== '') { 
          $files = $_FILES['foto'];
          $_FILES['foto']['name'] = $files['name'];
          $_FILES['foto']['type'] = $files['type'];
          $_FILES['foto']['tmp_name'] = $files['tmp_name'];
          $_FILES['foto']['size'] = $files['size'];

          $id_foto = rand(1,9);
          for ($j=1; $j <= 11 ; $j++) {
            $id_foto .= rand(0,9);
          } 
          $this->upload($id_foto, 'provider/','foto');   
        }
 

        $data = [  
          'nama_provider' => $this->POST('nama_provider'),  
          'keterangan' => $this->POST('keterangan'),   
          'logo' => 'provider/'.$id_foto.'.jpg'
        ];

        $this->Provider_m->insert($data); 
        $id = $this->db->insert_id();

        $this->flashmsg('Data provider berhasil ditambah!', 'success');
        redirect('admin/provider/'.$id);
        exit();

      }

      if ($this->POST('edit')) {
        $id_provider = $this->POST('id_provider');  
         
        $fotolama = $this->Provider_m->get_row(['id_provider' => $id_provider])->logo;
        if ($_FILES['foto']['name'] !== '') { 
          $files = $_FILES['foto'];
          $_FILES['foto']['name'] = $files['name'];
          $_FILES['foto']['type'] = $files['type'];
          $_FILES['foto']['tmp_name'] = $files['tmp_name'];
          $_FILES['foto']['size'] = $files['size'];

          $id_foto = rand(1,9);
          for ($j=1; $j <= 11 ; $j++) {
            $id_foto .= rand(0,9);
          } 
          @unlink(realpath(APPPATH . '../assets/' . $fotolama));
          $this->upload($id_foto, 'provider/','foto');    
          $this->Provider_m->update($id_provider,['logo' => 'provider/'.$id_foto.'.jpg']);

        }
 

        $data = [ 
          'nama_provider' => $this->POST('nama_provider'),  
          'keterangan' => $this->POST('keterangan')
        ];

        $this->Provider_m->update($id_provider,$data);
 
        $this->flashmsg('Data provider berhasil disimpan!', 'success');
        redirect('admin/provider/'.$id_provider);
        exit();

      }

      if ($this->POST('hapus')) {
        $fotolama = $this->Provider_m->get_row(['id_provider' => $this->POST('id_provider')])->logo;
        @unlink(realpath(APPPATH . '../assets/' . $fotolama));
        $this->Provider_m->delete($this->POST('id_provider'));
        $this->flashmsg('Data provider berhasil dihapus!', 'success');
        redirect('admin/provider');
        exit();

      } 

 
      $this->data['title']  = 'Tambah Data Provider';
      $this->data['index'] = 2;
      $this->data['content'] = 'admin/form-tambahprovider';
      $this->template($this->data,'admin');
      
    } 
// KELOLA LAPTOP 



// KELOLA Spesifikasi 

    public function paket(){ 
 
        $this->data['list_paket'] = $this->Paket_m->get();  
        $this->data['list_provider'] = $this->Provider_m->get();  
        $this->data['list_kriteria'] = $this->Kriteria_m->get();  
        $this->data['title']  = 'Kelola Data Paket';
        $this->data['index'] = 3;
        $this->data['content'] = 'admin/paket';
        $this->template($this->data,'admin');
   
    } 

    public function prosespaket(){


      if ($this->POST('tambah')) {

        $data = [ 
          'nama_paket' => $this->POST('nama_paket'),
          'id_provider' => $this->POST('id_provider'),
          'kecepatan' => $this->Bobot_m->get_row(['id_bobot' => $this->POST('kriteria_1')])->keterangan, 
          'harga' => $this->Bobot_m->get_row(['id_bobot' => $this->POST('kriteria_2')])->keterangan,
          'kualitas' => $this->Bobot_m->get_row(['id_bobot' => $this->POST('kriteria_3')])->keterangan,
          'kuota' => $this->Bobot_m->get_row(['id_bobot' => $this->POST('kriteria_4')])->keterangan  
        ];

        $this->Paket_m->insert($data);
        $id = $this->db->insert_id();


        $list_kriteria = $this->Kriteria_m->get();

        foreach ($list_kriteria as $v) { 
            $data = [
              'id_kriteria' => $v->id_kriteria,
              'id_paket' => $id,
              'id_bobot' => $this->POST('kriteria_'.$v->id_kriteria)
            ];
            $this->Penilaian_m->insert($data); 
        }
 

      

        $this->flashmsg('Data Paket internet berhasil ditambah!', 'success');
        redirect('admin/paket/');
        exit();

      }

      if ($this->POST('edit')) {
        $id = $this->POST('id_paket');
        $data = [ 
          'nama_paket' => $this->POST('nama_paket'),
          'id_provider' => $this->POST('id_provider'),
          'kecepatan' => $this->Bobot_m->get_row(['id_bobot' => $this->POST('kriteria_1')])->keterangan, 
          'harga' => $this->Bobot_m->get_row(['id_bobot' => $this->POST('kriteria_2')])->keterangan,
          'kualitas' => $this->Bobot_m->get_row(['id_bobot' => $this->POST('kriteria_3')])->keterangan,
          'kuota' => $this->Bobot_m->get_row(['id_bobot' => $this->POST('kriteria_4')])->keterangan  
        ];

        $this->Paket_m->update($id,$data); 

        $this->Penilaian_m->delete_by(['id_paket' => $id]);
        $list_kriteria = $this->Kriteria_m->get();

        foreach ($list_kriteria as $v) { 
            $data = [
              'id_kriteria' => $v->id_kriteria,
              'id_paket' => $id,
              'id_bobot' => $this->POST('kriteria_'.$v->id_kriteria)
            ];
            $this->Penilaian_m->insert($data); 
        }
        

        $this->flashmsg('Data paket berhasil disimpan!', 'success');
        redirect('admin/paket/');
        exit();

      }
  
      if ($this->POST('hapus')) {
        $this->Paket_m->delete($this->POST('id_paket'));
        $this->flashmsg('Data paket berhasil dihapus!', 'success');
        redirect('admin/paket');
        exit();

      } 
      $this->data['title']  = 'Tambah Data Spesifikasi';
      $this->data['index'] = 3;
      $this->data['content'] = 'admin/form-tambahspek';
      $this->template($this->data,'admin');
      
    } 
// KELOLA Spesifikasi 

// Kelola Customer 
    public function customer(){
      
 
        $this->data['list_customer'] = $this->Customer_m->get();   
        $this->data['title']  = 'Kelola Data Customer_m';
        $this->data['index'] = 5;
        $this->data['content'] = 'admin/customer';
        $this->template($this->data,'admin');
   
    } 

// Kelola Customer 


  // -----------------------------------------------------------------------------------------------------------------
       public function profil(){
       
        $this->data['title']  = 'Profil';
        $this->data['index'] = 7;
        $this->data['content'] = 'admin/profil';
        $this->template($this->data,'admin');
     }
    public function proses_edit_profil(){
      if ($this->POST('edit')) {
      
          if ($this->login_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) { 
            $this->flashmsg('Email telah digunakan!', 'warning');
            redirect('admin/profil');
            exit();
          }
          $this->login_m->update($this->POST('email_x'),['email' => $this->POST('email')]);    
          $user_session = [
            'email' => $this->POST('email'),  
          ];
          $this->session->set_userdata($user_session);
 
  
          $this->flashmsg('PROFIL BERHASIL DISIMPAN!', 'success');
          redirect('admin/profil');
          exit();

          }

        elseif ($this->POST('uploadfoto')) {
           if ($_FILES['foto']['name'] !== '') { 
              $files = $_FILES['foto'];
              $_FILES['foto']['name'] = $files['name'];
              $_FILES['foto']['type'] = $files['type'];
              $_FILES['foto']['tmp_name'] = $files['tmp_name'];
              $_FILES['foto']['size'] = $files['size'];

              $id_foto = rand(1,9);
              for ($j=1; $j <= 11 ; $j++) {
                $id_foto .= rand(0,9);
              } 

              if ($this->data['profil']->foto != 'foto/default.jpg' && $this->data['profil']->foto != 'foto/default-l.jpg' && $this->data['profil']->foto != 'foto/default-p.jpg') {
                @unlink(realpath(APPPATH . '../assets/' . $this->data['profil']->foto));
              }
              $this->upload($id_foto, 'foto/','foto');    
              $this->login_m->update($this->data['profil']->email,['foto' => 'foto/'.$id_foto.'.jpg']);
              $this->flashmsg('Foto Profil berhasil diupload!', 'success');
              redirect('admin/profil');
              exit();
            }else{
              redirect('admin/profil');
              exit(); 
            }
         } 
        elseif ($this->POST('hapusfoto')) { 
 
              @unlink(realpath(APPPATH . '../assets/' . $this->data['profil']->foto)); 
              $this->login_m->update($this->data['profil']->email,['foto' => 'foto/default.jpg']);
              $this->flashmsg('Foto Profil berhasil dihapus!', 'success');
              redirect('admin/profil');
              exit();
            
         } 
          elseif ($this->POST('edit2')) { 
            $data = [ 
              'password' => md5($this->POST('pass1')) 
            ];
            
            $this->login_m->update($this->data['email'],$data);
        
            $this->flashmsg('PASSWORD BARU TELAH TERSIMPAN!', 'success');
            redirect('admin/profil');
            exit();    
          }  

          else{

          redirect('admin/profil');
          exit();
          }

    }
 

    public function cekpasslama(){ echo $this->login_m->cekpasslama($this->data['email'],$this->input->post('pass')); } 
    public function cekpass(){ echo $this->login_m->cek_password_length($this->input->post('pass1')); }
    public function cekpass2(){ echo $this->login_m->cek_passwords($this->input->post('pass1'),$this->input->post('pass2')); }

 
}

 ?>

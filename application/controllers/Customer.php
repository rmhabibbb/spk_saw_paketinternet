<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Customer extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  
        $this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role'); 
          if (!$this->data['email'] || ($this->data['id_role'] != 2))
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
    
    $this->data['akun'] = $this->login_m->get_row(['email' =>$this->data['email'] ]); 
    $this->data['profil'] = $this->Customer_m->get_row(['email' =>$this->data['email'] ]); 
     
    date_default_timezone_set("Asia/Jakarta");


  }

public function index()
{ 

      $this->data['list_kriteria'] = $this->Kriteria_m->get(); 
      $saw = $this->Paket_m->saw();
      if ($this->POST('cari')) {
        $c1 = $this->POST('c1'); 
        $c2 = $this->POST('c2');
        $c3 = $this->POST('c3');
        $c4 = $this->POST('c4');

        $temp = array();
        foreach ($saw['hasil_akhir'] as $a) {
          $nilai = array();
          for ($i=1; $i <=4 ; $i++) { 
             $penilaian = $this->Penilaian_m->get_row(['id_paket' => $a['id_paket'], 'id_kriteria' => $i]);
              
              array_push($nilai, $penilaian->id_bobot);

          }

          $data = [ 
            'poin' => 0,
            'id_paket' => $a['id_paket'],
            'nilai' => $nilai
          ];

          array_push($temp, $data);
        }



        
 
        for ($i=0; $i < sizeof($temp) ; $i++) {  
          for ($j=1; $j <= sizeof($this->data['list_kriteria']) ; $j++) { 
              if ($temp[$i]['nilai'][$j-1] == $this->POST('c'.$j)) {
                $temp[$i]['poin']++;
              }
            }
            
        } 

        rsort($temp);
        $this->data['list_paket'] = $temp; 
        $this->data['index_p'] = 1;
      }else{

        $this->data['list_paket'] = $saw['hasil_akhir'];
        $this->data['index_p'] = 0;
      }
      

      $this->data['title']  = 'Beranda'; 
      $this->data['index'] = 0;
      $this->data['content'] = 'customer/dashboard';
      $this->template($this->data,'customer');
}

// KELOLA SPK
    public function spk(){
      
      $saw = $this->Laptop_m->saw();

      $this->data['list_laptop'] = $saw['hasil_akhir'];
      $this->data['title']  = 'Hasil SPK. Metode SAW';
      $this->data['index'] = 1;
      $this->data['content'] = 'customer/spk';
      $this->template($this->data,'customer');
    }

    
// KELOLA SPK
  
 
   public function provider(){
      

      if ($this->uri->segment(3)) {
        $kd = $this->uri->segment(3);
        $this->data['provider'] = $this->Provider_m->get_row(['id_provider' => $kd]);     
        $this->data['list_kriteria'] = $this->Kriteria_m->get();  
        $this->data['list_paket'] = $this->Paket_m->get(['id_provider' => $kd]);  
        $this->data['title']  = $this->data['provider']->nama_provider ;
        $this->data['index'] = 2;
        $this->data['content'] = 'customer/detailprovider';
        $this->template($this->data,'customer');
      }else{
        redirect('customer');
        exit();
      }
      
      
    } 
    public function paket(){
      

      if ($this->uri->segment(3)) {
        $kd = $this->uri->segment(3);
        $this->data['paket'] = $this->Paket_m->get_row(['id_paket' => $kd]);    
        $this->data['list_kriteria'] = $this->Kriteria_m->get();  
        $this->data['provider'] = $this->Provider_m->get_row(['id_provider' => $this->data['paket']->id_provider]);     
        $this->data['title']  = $this->data['paket']->nama_paket ;
        $this->data['index'] = 0;
        $this->data['content'] = 'customer/detailpaket';
        $this->template($this->data,'customer');
      }else{
        redirect('customer');
        exit();
      }
      
      
    } 


  // -----------------------------------------------------------------------------------------------------------------
       public function profil(){
       
        $this->data['title']  = 'Profil';
        $this->data['index'] = 6;
        $this->data['content'] = 'customer/profil';
        $this->template($this->data,'customer');
     }
    public function proses_edit_profil(){
      if ($this->POST('edit')) {
      
          if ($this->login_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) { 
            $this->flashmsg('Email telah digunakan!', 'warning');
            redirect('customer/profil');
            exit();
          }

          if ($this->data['akun']->foto == 'foto/default-l.jpg' || $this->data['akun']->foto == 'foto/default-p.jpg') {
            if ($this->POST('jk') == "Perempuan") {
              $this->login_m->update($this->POST('email'),['foto' => 'foto/default-p.jpg']); 
            }else{ 
              $this->login_m->update($this->POST('email'),['foto' => 'foto/default-l.jpg']); 
            } 
          }

          
          $this->login_m->update($this->POST('email_x'),['email' => $this->POST('email')]);    
          $user_session = [
            'email' => $this->POST('email'),  
          ];
          $this->session->set_userdata($user_session);
           
           $data = [ 
            'nama_customer' => $this->POST('nama_customer'),
            'jk' => $this->POST('jk'), 
            'no_hp' => $this->POST('no_hp') 
          ];

          $this->Customer_m->update($this->POST('id_customer') , $data);

  
         $this->flashmsg('PROFIL BERHASIL DISIMPAN!', 'success');
          redirect('customer/profil');
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

              if ($this->data['akun']->foto != 'foto/default.jpg' && $this->data['akun']->foto != 'foto/default-l.jpg' && $this->data['akun']->foto != 'foto/default-p.jpg') {
                @unlink(realpath(APPPATH . '../assets/' . $this->data['akun']->foto));
              }
              $this->upload($id_foto, 'foto/','foto');    
              $this->login_m->update($this->data['profil']->email,['foto' => 'foto/'.$id_foto.'.jpg']);
              $this->flashmsg('Foto Profil berhasil diupload!', 'success');
              redirect('customer/profil');
              exit();
            }else{
              redirect('customer/profil');
              exit(); 
            }
         } 
        elseif ($this->POST('hapusfoto')) { 
 
              @unlink(realpath(APPPATH . '../assets/' . $this->data['profil']->foto)); 
              if ($this->data['profil']->jk == "Perempuan") {
                $foto = 'foto/default-p.jpg';
              }else{ 
                $foto = 'foto/default-l.jpg';
              }
              $this->login_m->update($this->data['profil']->email,['foto' => $foto]);
              $this->flashmsg('Foto Profil berhasil dihapus!', 'success');
              redirect('customer/profil');
              exit();
            
         } 
          elseif ($this->POST('edit2')) { 
            $data = [ 
              'password' => md5($this->POST('pass1')) 
            ];
            
            $this->login_m->update($this->data['email'],$data);
        
            $this->flashmsg('PASSWORD BARU TELAH TERSIMPAN!', 'success');
            redirect('customer/profil');
            exit();    
          }  

          else{

          redirect('customer/profil');
          exit();
          }

    }
 

    public function cekpasslama(){ echo $this->login_m->cekpasslama($this->data['email'],$this->input->post('pass')); } 
    public function cekpass(){ echo $this->login_m->cek_password_length($this->input->post('pass1')); }
    public function cekpass2(){ echo $this->login_m->cek_passwords($this->input->post('pass1'),$this->input->post('pass2')); }

 
}

 ?>

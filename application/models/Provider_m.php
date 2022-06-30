<?php 
class Provider_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_provider';
    $this->data['table_name'] = 'provider';
  }
}

 ?>

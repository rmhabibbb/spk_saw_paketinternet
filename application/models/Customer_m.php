<?php 
class Customer_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_customer';
    $this->data['table_name'] = 'customer';
  }
}

 ?>

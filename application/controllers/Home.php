<?php
defined('BASEPATH') OR exit('Ação não permitida');


class Home extends CI_Controller{


   /*=============================================
   =            Verificar se o usuário está logado    =
   =============================================*/
   
    public function __construct(){

    	parent::__construct();

    	if(!$this->ion_auth->logged_in()){
          redirect('login'); 
    	}

    }  

   
   /*=====  End of Section comment block  ======*/
   

    public function index(){

        $data = array(
            'titulo' => 'Home'
        );

        $this->load->view('layout/header', $data);
        $this->load->view('home/index');
        $this->load->view('layout/footer');
    }
}
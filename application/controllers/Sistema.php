<?php
defined('BASEPATH') or exit('Ação não permitida');



class Sistema extends CI_Controller{

   
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


  /*=============================================
  =            tela de listagem           =
  =============================================*/

  public function index(){

  	$data = array(
  		'titulo' => 'Editar Informações do sistema',
  		'sub_titulo' => 'Chegou a hora de editar as informações do sistema',
  		'icone_view' => 'ik ik-settings',
  		'sistema' => $this->core_model->get_by_id('sistema',array('sistema_id' => 1)),

        'scripts' => array(
          'plugins/mask/jquery.mask.min.js',
          'plugins/mask/custom.js'
        ),

  	);

          //visualizar os dados
          // echo '<pre>';
           // print_r($data['sistema']);
          // exit();

  	$this->load->view('layout/header', $data);
  	$this->load->view('sistema/index');
  	$this->load->view('layout/footer');
  }


}
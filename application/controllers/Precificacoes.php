<?php
defined('BASEPATH') or exit('Ação não permitida');


class Precificacoes extends CI_Controller
{

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
  		'titulo' => 'Precificações cadastradas',
  		'sub_titulo' => 'Chegou a hora de listar as precificações cadastradas no banco de dados',
  		'icone_view' => 'fas fa-dollar-sign',
  		'precificacoes'  => $this->core_model->get_all('precificacoes'),

  		'styles' => array(
  			'plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
  		),

  		'scripts' => array(
  			'plugins/datatables.net/js/jquery.dataTables.min.js',
  			'plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
  			'plugins/datatables.net/js/estacionamento.js'
  		),

  	);

    //visualizar os dados
    // echo '<pre>';
   //  print_r($data['precificacoes']);
    // exit();

  	$this->load->view('layout/header', $data);
  	$this->load->view('precificacoes/index');
  	$this->load->view('layout/footer');
  }


}
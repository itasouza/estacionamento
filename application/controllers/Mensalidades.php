<?php
defined('BASEPATH') or exit('Ação não permitida');



class Mensalidades extends CI_Controller{

  /*=============================================
   =            Verificar se o usuário está logado    =
   =============================================*/
   
   public function __construct(){

     parent::__construct();

     if(!$this->ion_auth->logged_in()){
      redirect('login'); 
    }


    $this->load->model('mensalidades_model');

  }  


  /*=====  End of Section comment block  ======*/


  /*=============================================
  =            tela de listagem           =
  =============================================*/

  public function index(){

  	$data = array(
  		'titulo' => 'Mensalidades cadastradas',
  		'sub_titulo' => 'Chegou a hora de listar as mensalidades cadastradas no banco de dados',
  		'icone_view' => 'fas fa-hand-holding-usd',
  		'mensalidades'  => $this->mensalidades_model->get_all(),

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
    // print_r($data['mensalidades']);
    // exit();

  	$this->load->view('layout/header', $data);
  	$this->load->view('mensalidades/index');
  	$this->load->view('layout/footer');
  }



}
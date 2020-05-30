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


  /*=============================================
  =            tela de cadastro / edição           =
  =============================================*/

  public function core($mensalidade_id){


    if(!$mensalidade_id){

        //cadastrando

    }else{

       /*=============================================
       =            Edição       =
       =============================================*/
      if(!$this->core_model->get_by_id('mensalidades',array('mensalidade_id' => $mensalidade_id))){
         $this->session->set_flashdata('error','Mensalidade não encontrada');
         redirect($this->router->fetch_class());


        }else{

              $this->form_validation->set_rules('mensalidade_precificacao_id','Categoria', 'trim|required|max_length[50]');



              if($this->form_validation->run()){
                  
                $data = elements(
                  array(
                    'mensalidade_precificacao_id',
                    'mensalidade_valor_mensalidade',
                    'mensalidade_mensalista_dia_vencimento',
                    'mensalidade_status',
                  ),$this->input->post()
                );



                $data['mensalidade_mensalista_id'] = $this->input->post('mensalidade_mensalista_hidden_id');
                $data['mensalidade_precificacao_id'] = $this->input->post('mensalidade_precificacao_hidden_id');

                if($data['mensalidade_status'] == 1){

                  $data['mensalidade_data_pagamento'] = date('Y-m-d H:i:s');

                }

               // echo '<pre>'; 
               // print_r($this->input->post());
               // exit();

                $data = html_escape($data);   
                $this->core_model->update('mensalidades',$data,array('mensalidade_id' => $mensalidade_id));
                $this->session->set_flashdata('sucesso','Dados salvos com sucesso');
                redirect($this->router->fetch_class());


              }else{


                 $data = array(
                  'titulo' => 'Editar mensalidade',
                  'sub_titulo' => 'Chegou a hora de editar a mensalidade',
                  'icone_view' => 'fas fa-hand-holding-usd',
                  'texto_modal' => 'Os dados estão corretos? </br></br> Depois de salva só será possivel alterar a "Categoria" e a "Situação"',
                  'valor_btn'   => 'Salvar',
                  'mensalidade'  => $this->core_model->get_by_id('mensalidades',array('mensalidade_id'=> 1)),
                  'precificacoes' => $this->core_model->get_all('precificacoes',array('precificacao_ativa'=> 1)),
                  'mensalistas'   => $this->core_model->get_all('mensalistas',array(' mensalista_ativo'=> 1)),

                  'styles' => array(
                    'plugins/select2/dist/css/select2.min.css',
                  ),

                  'scripts' => array(
                    'plugins/select2/dist/js/select2.min.js',
                    'js/mensalidades/mensalidades.js',
                    'plugins/mask/jquery.mask.min.js',
                    
                  ),

                );

                //visualizar os dados
                // echo '<pre>'; 
                 //print_r($data['mensalidade']);
                // exit();

                // echo '<pre>'; 
                // print_r($data['precificacoes']);
                // exit();
                // echo '<pre>'; 
                // print_r($data['mensalistas']);
                // exit();


                 $this->load->view('layout/header', $data);
                 $this->load->view('mensalidades/core');
                 $this->load->view('layout/footer');

              }

        }

    }

    
  }

}
<?php
defined('BASEPATH') or exit('Ação não permitida');



class Mensalistas extends CI_Controller{

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
  		'titulo' => 'Mensalistas cadastrados',
  		'sub_titulo' => 'Chegou a hora de listar os mensalistas cadastrados no banco de dados',
  		'icone_view' => 'fas fa-users',
  		'mensalistas'  => $this->core_model->get_all('mensalistas'),

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
     //echo '<pre>';
     //print_r($data['mensalistas']);
     //exit();

  	$this->load->view('layout/header', $data);
  	$this->load->view('mensalistas/index');
  	$this->load->view('layout/footer');
  }

   

  public function core($mensalista_id = NULL){


    if(!$mensalista_id){

        /*=============================================
        =            cadastro            =
        =============================================*/
        
        
        
        /*=====  End of Section comment block  ======*/
        

    }else{
   
       /*=============================================
       =            Edição       =
       =============================================*/
       
      if(!$this->core_model->get_by_id('mensalistas',array('mensalista_id' => $mensalista_id))){
         $this->session->set_flashdata('error','Mensalista não encontrada');
         redirect($this->router->fetch_class());

       }else{

          //editando
         $this->form_validation->set_rules('mensalista_nome','mome do mensalista', 'trim|required|min_length[4]|max_length[30]');
         $this->form_validation->set_rules('mensalista_sobrenome','Sobrenome do mensalista', 'trim|required|min_length[4]|max_length[30]');

          if($this->form_validation->run()){


			 echo '<pre>';
			 print_r($this->input->post());
			 exit();

/*
            [mensalista_nome] => Lucio
            [mensalista_sobrenome] => Souza
            [mensalista_data_nascimento] => 2020-03-13
            [mensalista_cpf] => 359.731.420-19
            [mensalista_rg] => 334.44644-12
            [mensalista_email] => lucio@gmail.com
            [mensalista_telefone_fixo] => 
            [mensalista_telefone_movel] => (41) 9999-9999
            [mensalista_cep] => 80530-000
            [mensalista_endereco] => Rua de Curitiba
            [mensalista_numero_endereco] => 45
            [mensalista_bairro] => Centro
            [mensalista_cidade] => Curitiba
            [mensalista_estado] => PR
            [mensalista_complemento] => 
            [mensalista_ativo] => 1
            [mensalista_dia_vencimento] => 31
            [mensalista_obs] => 
*/


               /*
               $data = elements(
                  array(
                    'forma_pagamento_nome',
                    'forma_pagamento_ativa',
                  ), $this->input->post()
               );
               */

               //$data = html_escape($data);
               //$this->core_model->update('mensalistas',$data,array('mensalista_id' => $mensalista_id));
               //$this->session->set_flashdata('sucesso','Dados salvos com sucesso');
               //redirect($this->router->fetch_class());

            }else{

            	$data = array(
            		'titulo' => 'Editar Mensalistas',
            		'sub_titulo' => 'Chegou a hora de editar os mensalistas cadastrados no banco de dados',
            		'icone_view' => 'fas fa-users',
            		'mensalista'  => $this->core_model->get_by_id('mensalistas',array('mensalista_id' => $mensalista_id)),

				    'styles' => array(
				        'dist/css/bootstrap-datepicker/bootstrap-datepicker.min.css'		
				    ),

		  			'scripts' => array(
		  				'plugins/mask/jquery.mask.min.js',
		  				'plugins/mask/custom.js',
		  				'plugins/bootstrap-datepicker/bootstrap-datepicker.min.js',
		  				'plugins/bootstrap-datepicker/data-customizada.js',
		  			),

            	);

				    //visualizar os dados
				    // echo '<pre>';
				    // print_r($data['mensalistas']);
				    // exit();

            	$this->load->view('layout/header', $data);
            	$this->load->view('mensalistas/core');
            	$this->load->view('layout/footer');


            }


          }


       }       
       
       /*=====  End of Section comment block  ======*/

    }


  }



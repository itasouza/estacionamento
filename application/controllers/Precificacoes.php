<?php
defined('BASEPATH') or exit('Ação não permitida');


class Precificacoes extends CI_Controller{

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


 /*=============================================
 =            Cadastro e edição           =
 =============================================*/
 

 public function core($precificacao_id = NULL){


 	if(!$precificacao_id){

	    	//cadastrando

 			$this->form_validation->set_rules('precificacao_categoria','Categoria', 'trim|required|min_length[4]|max_length[30]|is_unique[precificacoes.precificacao_categoria]');
 			$this->form_validation->set_rules('precificacao_valor_hora','Valor Hora', 'trim|required|max_length[50]');
 			$this->form_validation->set_rules('precificacao_valor_mensalidade','Valor mensalidade', 'trim|required|max_length[50]');
 			$this->form_validation->set_rules('precificacao_numero_vagas','Número vagas', 'trim|required|integer|greater_than[0]');

 			if($this->form_validation->run()){

 				$data = elements(
 					array(
 						'precificacao_categoria',
 						'precificacao_valor_hora',
 						'precificacao_valor_mensalidade',
 						'precificacao_numero_vagas',
 						'precificacao_ativa',
 					),$this->input->post()
 				);

 				$data = html_escape($data);   

                //gravar dados
 				//echo '<pre>';
 				//print_r($data);
 				//exit();

 				$this->core_model->insert('precificacoes',$data);
 				$this->session->set_flashdata('sucesso','Dados salvos com sucesso');
 				redirect($this->router->fetch_class());


 			}else{

             //erro de validação
 				$data = array(
 					'titulo' => 'Cadastrar Precificação',
 					'sub_titulo' => 'Chegou a hora de cadastrar precificação',
 					'icone_view' => 'fas fa-dollar-sign',
 					'precificacao'  => $this->core_model->get_by_id('precificacoes',array('precificacao_id' => $precificacao_id)),

 					'scripts' => array(
 						'plugins/mask/jquery.mask.min.js',
 						'plugins/mask/custom.js'
 					),

 				);

				    //visualizar os dados
				   // echo '<pre>';
				    // print_r($data['precificacao']);
				    // exit();

 				$this->load->view('layout/header', $data);
 				$this->load->view('precificacoes/core');
 				$this->load->view('layout/footer');
 			}



 	}else{

	    	//atualizando
 		if(!$this->core_model->get_by_id('precificacoes',array('precificacao_id' => $precificacao_id))){
 			$this->session->set_flashdata('error','Precificação não encontrada');
 			redirect($this->router->fetch_class());

 		}else{

 			$this->form_validation->set_rules('precificacao_categoria','Categoria', 'trim|required|min_length[4]|max_length[30]|callback_precificacao_check');
 			$this->form_validation->set_rules('precificacao_valor_hora','Valor Hora', 'trim|required|max_length[50]');
 			$this->form_validation->set_rules('precificacao_valor_mensalidade','Valor mensalidade', 'trim|required|max_length[50]');
 			$this->form_validation->set_rules('precificacao_numero_vagas','Número vagas', 'trim|required|integer|greater_than[0]');

 			if($this->form_validation->run()){


 				$precificacao_ativa = $this->input->post('precificacao_ativa');
 				if($precificacao_ativa == 0){

 					if($this->db->table_exists('estacionar')){

 						if($this->core_model->get_by_id('estacionar',array('estacionar_precificacao_id' => $precificacao_ativa,'estacionar_status' => 0 ))){
 							$this->session->set_flashdata('error','Está categoria está sendo utlizada em estacionar');
 							redirect($this->router->fetch_class());
 						}
 					}
 				};

 				$data = elements(
 					array(
 						'precificacao_categoria',
 						'precificacao_valor_hora',
 						'precificacao_valor_mensalidade',
 						'precificacao_numero_vagas',
 						'precificacao_ativa',
 					),$this->input->post()
 				);

 				$data = html_escape($data);   

                //gravar dados
 				//echo '<pre>';
 				//print_r($data);
 				//exit();

 				$this->core_model->update('precificacoes',$data,array('precificacao_id' => $precificacao_id));
 				$this->session->set_flashdata('sucesso','Dados salvos com sucesso');
 				redirect($this->router->fetch_class());



 			}else{

             //erro de validação
 				$data = array(
 					'titulo' => 'Editar Precificação',
 					'sub_titulo' => 'Chegou a hora de editar a precificação',
 					'icone_view' => 'fas fa-dollar-sign',
 					'precificacao'  => $this->core_model->get_by_id('precificacoes',array('precificacao_id' => $precificacao_id)),

 					'scripts' => array(
 						'plugins/mask/jquery.mask.min.js',
 						'plugins/mask/custom.js'
 					),

 				);

				    //visualizar os dados
				   // echo '<pre>';
				    // print_r($data['precificacao']);
				    // exit();

 				$this->load->view('layout/header', $data);
 				$this->load->view('precificacoes/core');
 				$this->load->view('layout/footer');
 			}


 		}

 	}

 }

 
 /*=====  End of Section comment block  ======*/
 


/*=============================================
= validação usando callback   =
=============================================*/


    //verificar se o email já existe 
  public function precificacao_check($precificacao_categoria){

      $precificacao_id = $this->input->post('precificacao_id');
      
      if($this->core_model->get_by_id('precificacao',array('precificacao_categoria' => $precificacao_categoria, 'precificacao_id !=' => $precificacao_id ))){
         $this->form_validation->set_message('precificacao_check','Essa categoria já existe');
         return FALSE;
      }else{
        return TRUE;
      }
  }
 

  /*=====  End of Section comment block  ======*/



  /*=============================================
  =           Excluir registro           =
  =============================================*/
  

  public function del($precificacao_id = NULL){

  	if(!$this->core_model->get_by_id('precificacoes',array('precificacao_id' => $precificacao_id))){
  		$this->session->set_flashdata('error','Precificação não encontrada');
  		redirect($this->router->fetch_class());
  	}

   	if($this->core_model->get_by_id('precificacoes',array('precificacao_id' => $precificacao_id, 'precificacao_ativa =' => 1))){
  		$this->session->set_flashdata('error','Precificação ativa não pode ser excluida');
  		redirect($this->router->fetch_class());
  	} 

  	$this->core_model->delete('precificacoes',array('precificacao_id' => $precificacao_id));
  	$this->session->set_flashdata('sucesso','Dado excluido com sucesso');
  	redirect($this->router->fetch_class());

  }
  
  
  /*=====  End of Section comment block  ======*/
  


}
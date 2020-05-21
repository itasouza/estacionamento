<?php
defined('BASEPATH') or exit('Ação não permitida');


class Login extends CI_Controller{

   
   /*=============================================
   =           tele de login           =
   =============================================*/

   public function index(){

    $data = array(
       'titulo' => 'Login',
    );

    $this->load->view('layout/header', $data);
    $this->load->view('login/index');
    $this->load->view('layout/footer');

   }

  /*=====  End of Section comment block  ======*/

  /*=============================================
  =            Função para logar o usuário          =
  =============================================*/

   public function auth(){
     
     $identity = html_escape($this->input->post('email'));  
     $password = html_escape($this->input->post('password'));  
     $remember = FALSE;
     if($this->ion_auth->login($identity,$password,$remember)){

        $this->session->set_flashdata('sucesso','Seja bem vindo (a)!');
     	redirect('/');

     }else{

        $this->session->set_flashdata('error','Verifique seu e-mail ou senha');
     	redirect($this->router->fetch_class()); 
     }

   }
  
  
  /*=====  End of Section comment block  ======*/
  

 /*=============================================
 =            Função para deslogar usuário         =
 =============================================*/
 
  public function logout(){
  	
  	$this->ion_auth->logout();
  	redirect($this->router->fetch_class()); 

  }
 
 /*=====  End of Section comment block  ======*/
 

}
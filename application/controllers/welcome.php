<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	function loadEditor(){
		$this->load->library('ckfinder');
		$this->ckfinder->BasePath = '/demo_ckfinder/trunk/assets/ckfinder/' ;
		return $this->ckfinder->Create();
	}
	
	function phpinfo(){
		phpinfo();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
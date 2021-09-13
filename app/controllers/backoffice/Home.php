<?php
/**
 * Project:    mmn.dev
 * File:       Home.php
 * Author:     Felipe Medeiros
 * Createt at: 09/06/2016 - 06:41
 */

class Home extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->user)
			redirect('backoffice/login');

		$idioma = "pt-br";
		if(!empty($_COOKIE['idioma']))
		{
			$idioma = $_COOKIE['idioma'];
		}

		$file = substr(APPPATH, 0, strlen(APPPATH)-4);
		$path = $file."langs/backoffice/".$idioma.".php";
		include($path);

		$this->params['module_name'] = $lang['home'];
		$this->breadcrumbs->push($this->params['module_name'], '/backoffice/home');
	}
	public function index()
	{
		$idioma = "pt-br";
		if(!empty($_COOKIE['idioma']))
		{
			$idioma = $_COOKIE['idioma'];
		}

		$file = substr(APPPATH, 0, strlen(APPPATH)-4);
		$path = $file."langs/backoffice/".$idioma.".php";
		include($path);

		
		if ($this->input->post()){
		$data = $this->input->post();
		if (!in_array($data['position'], array('auto','left','right')))
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['pos_invalida']));
		else{
			$this->session->set_flashdata('message', array('type' => 'success', 'text' => $lang['alt_ok']));
			$update = User::find($this->user->id);
			$update->position = $data['position'];
			$update->save();
			$this->user->position = $data['position']; // ATUALIZA NA TELA
			}
		}
		
		
		$this->params['page_name'] = $lang['dashboard'];
		$this->breadcrumbs->push($this->params['page_name'], '/backoffice/home/index');
		$this->content_view	= 'backoffice/home/index';

		$this->params['sponsored']		= User::count([
			'conditions'	=> [
				'enroller = ?',
				$this->user->id
			]
		]);
		$this->params['l_sponsored']	= User::all([
			'conditions' => [
				'enroller = ?',
				$this->user->id
			],
			'limit' => 5,
			'order' => 'id desc'
		]);
		
		
		$getuser = User::find([
			'limit' => 1,
			'order' => 'id desc'
		]);
		
		if($getuser->gender == 'male') $sex = 'o';
		else $sex = 'a';

		$this->params['alerthome'] = '<h3>'.$lang['boas_vindas'].' <img src="'.base_url('assets/images/flags').'/'.$getuser->country.'.png"> '.$getuser->firstname.' '.$getuser->lastname.'!</h3>';

		$this->params['investido'] = Invoice::find_by_sql("SELECT sum(`sum`)  as `value` FROM `invoices` WHERE `user_id`='".$this->user->id."' AND `status`='paid' AND `type`='buy' AND `days` < '75'")[0]->value;
		$this->params['diario'] = number_format((($this->params['investido'] * 1) / 100), 2, '.', '');
	}
}
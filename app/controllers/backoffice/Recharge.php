<?php
/**
 * Project:    mmn.dev
 * File:       Support.php
 * Author:     Felipe Medeiros
 * Createt at: 09/06/2016 - 06:41
 */
class Recharge extends MY_Controller
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

		$this->params['module_name'] = 'Recarregar Saldo';
		$module_name = $lang['recarregar_saldo'];
		$this->breadcrumbs->push($module_name, '/backoffice/recharge');
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

		if ($this->input->post())
		{
			$data = $this->input->post();
			
			$contagem = Invoice::find_by_sql("SELECT count(`id`)  as `value` FROM `invoices` WHERE `user_id`='".$this->user->id."' AND `date` >= '".date('Y-m-d H:i:s', time() - (60 * 30))."' order by id desc")[0]->value;
			
			$return = ['success' => FALSE];
			if (empty($data['value']))
				$return['message'] = $lang['aviso1'];
			elseif (!is_numeric($data['value']))
				$return['message'] = $lang['aviso1'];
			elseif ($data['value'] <= 0)
				$return['message'] = $lang['aviso1'];
			elseif ($data['value'] < $this->settings->min_recharge)
				$return['message'] = $lang['aviso2'].' '.display_money($this->settings->min_recharge)."!";
			elseif ($data['value'] > 1000000)
				$return['message'] = $lang['aviso1'];
			elseif ($contagem >= 5)
				$return['message'] = $lang['aviso3'];
			else
			{

				$invoice = array();
				$invoice['user_id'] 	= $this->user->id;
				$invoice['type'] 		= 'buy';
				$invoice['date'] 		= date('Y-m-d H:i:s');
				$invoice['sum']			= $data['value'];
				$invoice['status']		= 'open';
				//$invoice['avatar_id']	= $data['avatar'];

				$ped = Invoice::create($invoice);

			if ($ped->id  > 0){
			
				$invitem = array();
				$invitem['invoice_id']		= $ped->id;
				$invitem['name']			= $lang['investimento'];
				$invitem['description']		= "-";
				$invitem['value']			= $data['value'];
				$invitem['amount']			= 1;
				//$invitem['plan_id']			= $dadosplan->id;
				InvoicesItem::create($invitem);

				$return['success']	= TRUE;
				$return['message'] = $lang['msg_pedido'];
				$return['redirect']	= site_url('backoffice/invoices/view/'.$ped->id);
			} else {
				$return['message'] = $lang['erro1'];
			}

		}
		
		exit(json_encode($return));
	} else {
		$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['erro1']));
		redirect('backoffice/home');	
		}
	}
	/*public function index()
	{

		if ($this->input->post())
		{
			$data = $this->input->post();


			if (empty($data['plan']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Escolha um pacote de recarga!'));
			elseif (empty($data['avatar']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Escolha um avatar!'));
			elseif (!is_numeric($data['plan']) || Plan::count(array('conditions' => array('id = ?', $data['plan']))) != 1)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Escolha um pacote de recarga!'));
			elseif (!is_numeric($data['avatar']) || Avataravaible::count(array('conditions' => array('id = ?', $data['avatar']))) != 1)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Escolha um avatar!'));
			elseif (Avatar::count(array('conditions' => array('avatar_id = ? and user_id = ?', $data['avatar'], $this->user->id))) > 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Você já possui este avatar!'));
			else
			{

				$dadosplan = Plan::find(array('conditions' => array('id = ?', $data['plan'])));

				$invoice = array();
				$invoice['user_id'] 	= $this->user->id;
				$invoice['type'] 		= 'recharge';
				$invoice['date'] 		= date('Y-m-d H:i:s');
				$invoice['sum']			= $dadosplan->value;
				$invoice['status']		= 'open';
				$invoice['avatar_id']	= $data['avatar'];

				$ped = Invoice::create($invoice);

			if ($ped->id  > 0){
			
				$invitem = array();
				$invitem['invoice_id']		= $ped->id;
				$invitem['name']			= $dadosplan->name;
				$invitem['description']		= $dadosplan->description;
				$invitem['value']			= $dadosplan->value;
				$invitem['amount']			= 1;
				$invitem['plan_id']			= $dadosplan->id;
				InvoicesItem::create($invitem);

				$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Pedido realizado!'));	
				redirect('backoffice/invoices/view/'.$ped->id);	
				exit;			
			} else {
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Algum problema ocorreu!'));
			}

		}
	}

		$this->params['page_name'] = 'Recarregar Saldo';
		$this->breadcrumbs->push($this->params['page_name'], '/backoffice/recharge');
		$this->content_view	= 'backoffice/recharge/index';

		$this->params['plans']	= Plan::all([
			'conditions' => [
				'status = ?',
				'Y'
			],
			'order' => 'value asc'
		]);

		$this->params['avatars']	= Avataravaible::all([
			'conditions' => [
				'geral = ?',
				'N'
			],
			'order' => 'rand()'
		]);

	}*/
}
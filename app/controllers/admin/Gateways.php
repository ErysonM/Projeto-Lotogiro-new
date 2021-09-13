<?php
class Gateways extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->admin)
			redirect('admin/login');

		$this->params['module_name']	= 'Gateways de Pagamento';
		$this->breadcrumbs->push($this->params['module_name'], '/admin/gateways');
	}
	public function index()
	{

		$this->params['page_name']	= 'Gateways Disponiveis';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/gateways');
		$this->content_view				= 'admin/gateways/gateways';

		$this->params['settings']		= Setting::first();

	}

	public function paypal()
	{

			if ($this->input->post()){
			$data = $this->input->post();
			if (!in_array($data['paypal_currency'], array('$', 'R$', '€')))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o simbolo da moeda!'));
			elseif (empty($data['paypal_email']) AND $data['paypal'] == 'Y')
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o e-mail do PayPal!'));
			else {
				if($data['paypal'] != 'Y') $data['paypal'] = 'N';
				$update = Setting::first();
				$update->paypal = $data['paypal'];
				$update->paypal_email = $data['paypal_email'];
				$update->paypal_currency = $data['paypal_currency'];
				$update->save();
				$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Informações alteradas com sucesso!'));
			}
			redirect('admin/gateways/paypal');
			exit;
		}

		$this->params['page_name']	= 'PayPal';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/gateways/paypal');
		$this->content_view				= 'admin/gateways/paypal';

		$this->params['settings']		= Setting::first();
	
	}

	public function bcash()
	{

			if ($this->input->post()){
			$data = $this->input->post();
			if (empty($data['bcash_email']) AND $data['bcash'] == 'Y')
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o e-mail do BCash!'));
			elseif (empty($data['bcash_token']) AND $data['bcash'] == 'Y')
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o token do BCash!'));
			else {
				if($data['bcash'] != 'Y') $data['bcash'] = 'N';
				$update = Setting::first();
				$update->bcash = $data['bcash'];
				$update->bcash_email = $data['bcash_email'];
				$update->bcash_token = $data['bcash_token'];
				$update->save();
				$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Informações alteradas com sucesso!'));
			}
			redirect('admin/gateways/bcash');
			exit;
		}

		$this->params['page_name']	= 'BCash';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/gateways/bcash');
		$this->content_view				= 'admin/gateways/bcash';

		$this->params['settings']		= Setting::first();
	
	}

	public function mistermoney()
	{

			if ($this->input->post()){
			$data = $this->input->post();
			if (empty($data['mistermoney_instrucoes']) AND $data['mistermoney'] == 'Y')
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha as instruções!'));
			else {
				if($data['mistermoney'] != 'Y') $data['mistermoney'] = 'N';
				$update = Setting::first();
				$update->mistermoney = $data['mistermoney'];
				$update->mistermoney_instrucoes = $data['mistermoney_instrucoes'];
				$update->save();
				$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Informações alteradas com sucesso!'));
			}
			redirect('admin/gateways/mistermoney');
			exit;
		}

		$this->params['page_name']	= 'Mister Money';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/gateways/mistermoney');
		$this->content_view				= 'admin/gateways/mister_money';

		$this->params['settings']		= Setting::first();
	
	}

	public function transferencia()
	{

			if ($this->input->post()){
			$data = $this->input->post();
			if (empty($data['transferencia_instrucoes']) AND $data['transferencia'] == 'Y')
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha as instruções!'));
			else {
				if($data['transferencia'] != 'Y') $data['transferencia'] = 'N';
				$update = Setting::first();
				$update->transferencia = $data['transferencia'];
				$update->transferencia_instrucoes = $data['transferencia_instrucoes'];
				$update->save();
				$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Informações alteradas com sucesso!'));
			}
			redirect('admin/gateways/transferencia');
			exit;
		}

		$this->params['page_name']	= 'Transferência Bancária';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/gateways/transferencia');
		$this->content_view				= 'admin/gateways/bank_transfer';

		$this->params['settings']		= Setting::first();
	
	}

	public function boleto()
	{

		$this->params['page_name']	= 'Boleto Bancário';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/gateways/boleto');
		$this->content_view				= 'admin/gateways/boleto';

		$this->params['settings']		= Setting::first();

	}

	public function bitcoin()
	{

			if ($this->input->post()){
			$data = $this->input->post();
			if (empty($data['bitcoin_token']) AND $data['bitcoin'] == 'Y')
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o TOKEN!'));
			elseif (empty($data['bitcoin_appid']) AND $data['bitcoin'] == 'Y')
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o APP ID!'));
			elseif (empty($data['bitcoin_callbackpass']) AND $data['bitcoin'] == 'Y')
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o Callback Password!'));
			elseif (empty($data['bitcoin_notifyemail']) AND $data['bitcoin'] == 'Y')
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o e-mail de notificação!'));
			else {
				if($data['bitcoin'] != 'Y') $data['bitcoin'] = 'N';
				$update = Setting::first();
				$update->bitcoin = $data['bitcoin'];
				$update->bitcoin_token = $data['bitcoin_token'];
				$update->bitcoin_notifyemail = $data['bitcoin_notifyemail'];
				$update->bitcoin_callbackpass = $data['bitcoin_callbackpass'];
				$update->bitcoin_appid = $data['bitcoin_appid'];
				$update->save();
				$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Informações alteradas com sucesso!'));
			}
			redirect('admin/gateways/bitcoin');
			exit;
		}

		$this->params['page_name']	= 'Bitcoin';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/gateways/bitcoin');
		$this->content_view				= 'admin/gateways/bitcoin';

		$this->params['settings']		= Setting::first();

	}
}
<?php
class System extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->admin)
			redirect('admin/login');

		$this->params['module_name']	= 'Sistema';
		$this->breadcrumbs->push($this->params['module_name'], '/admin/system');
	}
	public function index() {

			if ($this->input->post()){
			$data = $this->input->post();
			$data['min_withdrawal'] = grava_money($data['min_withdrawal']);
			$data['min_recharge'] = grava_money($data['min_recharge']);
			$data['transfer_min'] = grava_money($data['transfer_min']);
			$data['dolar'] = grava_money($data['dolar']);
			
			if (empty($data['company_name']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o nome da empresa!'));
			elseif (empty($data['company_email']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o e-mail da empresa!'));
			elseif (empty($data['currency']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o simbolo da moeda!'));
			elseif (!in_array($data['date_format'], array('Y/m/d', 'm/d/Y', 'd/m/Y','d.m.Y','d-m-Y')))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o formato da data!'));
			elseif (!in_array($data['date_time_format'], array('g:i a', 'g:i A', 'H:i')))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o formato da hora!'));
			elseif (!in_array($data['money_format'], array('1','2','3','4')))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o formato do valor!'));
			elseif (!in_array($data['money_currency_position'], array('1','2')))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha a posição do simbolo!'));
			elseif (empty($data['visits']) && $data['visits'] != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o numero de visitantes!'));
			elseif (empty($data['registers']) && $data['registers'] != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o numero de registros!'));
			elseif (empty($data['bet']) && $data['bet'] != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o numero de partidas!'));
			elseif (empty($data['min_withdrawal']) && $data['min_withdrawal'] != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o saque minimo!'));
			elseif (empty($data['min_recharge']) && $data['min_recharge'] != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha a recarga minima!'));
			elseif (empty($data['transfer_min']) && $data['transfer_min'] != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha a transferencia minima!'));
			elseif (empty($data['transfer_percent']) && $data['transfer_percent'] != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha a % sob a transferencia!'));
			elseif (empty($data['withdrawal_percent']) && $data['withdrawal_percent'] != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha a % sob o saque!'));
			elseif (empty($data['dolar']) && $data['dolar'] != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o valor do dolar!'));
			else {

				if($data['maintenance'] != 'Y') $data['maintenance'] = 'N';
				if($data['lock_login'] != 'Y') $data['lock_login'] = 'N';
				if($data['lock_register'] != 'Y') $data['lock_register'] = 'N';
				if($data['lock_withdrawal'] != 'Y') $data['lock_withdrawal'] = 'N';
				if($data['lock_transfer'] != 'Y') $data['lock_transfer'] = 'N';
				if($data['lock_payout'] != 'Y') $data['lock_payout'] = 'N';

				$update = Setting::first();
				$update->company_name = $data['company_name'];
				$update->company_email = $data['company_email'];
				$update->maintenance = $data['maintenance'];
				$update->lock_login = $data['lock_login'];
				$update->lock_register = $data['lock_register'];
				$update->lock_withdrawal = $data['lock_withdrawal'];
				$update->lock_payout = $data['lock_payout'];
				$update->currency = $data['currency'];
				$update->date_format = $data['date_format'];
				$update->date_time_format = $data['date_time_format'];
				$update->money_format = $data['money_format'];
				$update->money_currency_position = $data['money_currency_position'];
				$update->visits = $data['visits'];
				$update->registers = $data['registers'];
				$update->bet = $data['bet'];
				$update->min_withdrawal = $data['min_withdrawal'];
				$update->min_recharge = $data['min_recharge'];
				$update->lock_transfer = $data['lock_transfer'];
				$update->transfer_percent = $data['transfer_percent'];
				$update->withdrawal_percent = $data['withdrawal_percent'];
				$update->transfer_min = $data['transfer_min'];
				$update->dolar = $data['dolar'];
				$update->save();
				$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Informações alteradas com sucesso!'));
			}
			redirect('admin/system/index');
			exit;
		}

		$this->params['page_name']	= 'Configurações';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/system');
		$this->content_view				= 'admin/settings/system';

		$this->params['settings']		= Setting::first();
	}
	public function users()
	{
		$this->params['page_name'] = 'Lista de administradores';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/system/users');
		$this->content_view	= 'admin/settings/all';

		$this->params['admins']	= Admin::all();
	}
	public function usercreate()
	{
			if ($this->input->post()){
			$data = $this->input->post();
			if (empty($data['email']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o e-mail!'));
			elseif (empty($data['password']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha a senha!'));
			elseif (empty($data['repassword']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha a senha!'));
			elseif ($data['password'] != $data['repassword'])
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'As senhas não conferem!'));	
			elseif (!in_array($data['status'], array('Y', 'N')))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o status!'));
			elseif (empty($data['firstname']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o nome!'));
			elseif (empty($data['lastname']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o sobrenome!'));
			elseif (Admin::count(array('conditions' => array('email' => $data['email']))) > 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'E-mail já em uso! Tente outro.'));
			else {
			$data['create_date'] = date('Y-m-d H:i:s');
			$data['last_editor'] = $this->admin->id;
			unset($data['repassword']);
			$data['password'] = $this->encrypt->encode($data['password']);

			if (Admin::create($data)) 
				$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Administrador adicionado!'));					
			else 
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Algum problema ocorreu!'));

			redirect('admin/system/users');
			exit;
			}
		}
		
		$this->params['page_name'] = 'Novo Administrador';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/system/usercreate');
		$this->content_view	= 'admin/settings/create';
	}
	public function useredit($id = FALSE)
	{

			if (!$id || !is_numeric($id) || !($admin = Admin::find_by_id($id)))
			redirect('admin/system/users');

			if ($this->input->post()){
			$data = $this->input->post();
			if (empty($data['email']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o e-mail!'));
			elseif (($data['password'] != $data['repassword']) AND (!empty($data['password']) OR !empty($data['repassword'])))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'As senhas não conferem!'));	
			elseif (!in_array($data['status'], array('Y', 'N')))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o status!'));
			elseif (empty($data['firstname']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o nome!'));
			elseif (empty($data['lastname']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o sobrenome!'));
			elseif (Admin::count(array('conditions' => array('email' => $data['email']))) > 0 AND $data['email'] != $admin->email)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'E-mail já em uso! Tente outro.'));
			elseif (($data['status']  == N) AND ($id == $this->admin->id))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Você não pode inativar si proprio!'));
			else {
			$admin->email = $data['email'];
			$admin->status = $data['status'];
			$admin->firstname = $data['firstname'];
			$admin->lastname = $data['lastname'];
			$admin->last_edit = date('Y-m-d H:i:s');
			$admin->last_editor = $this->admin->id;
			if ($data['password'] == $data['repassword'] AND !empty($data['password']) AND !empty($data['repassword'])){
			$admin->password = $this->encrypt->encode($data['password']);
			}
			if ($admin->save()) 
				$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Administrador alterado!'));
			else 
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Algum problema ocorreu!'));

			redirect('admin/system/useredit/' .$id);
			exit;
			}
		}

		$this->params['admin']	= $admin;
		$this->params['lasteditor']	= Admin::find_by_id($admin->last_editor);

		$this->params['page_name'] = 'Alterar Administrador';
		$this->breadcrumbs->push($this->params['page_name'] . ' - ' . $admin->firstname . ' '.$admin->lastname, '/admin/system/useredit/' . $id);
		$this->content_view	= 'admin/settings/edit';
	}
	public function userdelete($id = FALSE)
	{
		if (!$id || !is_numeric($id) || !($adminis = Admin::find_by_id($id)))
			redirect('admin/system/users');

		if($id == $this->admin->id) {
			$this->session->set_flashdata('message', ['text' => 'Você não pode deletar si proprio!', 'type' => 'error']);
		} else {

		if ($adminis->delete())
			$this->session->set_flashdata('message', ['text' => 'Administrador excluido!', 'type' => 'success']);
		else
			$this->session->set_flashdata('message', ['text' => 'Houve algum problema!', 'type' => 'error']);

	}

		redirect('admin/system/users');
	}
	public function plans()
	{
		$this->params['page_name'] = 'Lista de Planos';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/system/plans');
		$this->content_view	= 'admin/settings/plans';

		$this->params['plans']	= Plan::all();
	}
	public function plancreate()
	{
			if ($this->input->post()){
			$data = $this->input->post();
			$data['value'] = grava_money($data['value']);
			
			if (empty($data['name']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o nome!'));
			elseif (empty($data['description']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha a a descrição!'));
			elseif (empty($data['value']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o valor!'));	
			elseif (!in_array($data['status'], array('Y', 'N')))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o status!'));
			else {
				
			$data['create_date'] = date('Y-m-d H:i:s');
			$data['last_editor'] = $this->admin->id;
			$data['value'] = grava_money($data['value']);

			if (Plan::create($data)) 
				$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Plano adicionado!'));					
			else 
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Algum problema ocorreu!'));

			redirect('admin/system/plans');
			exit;
			}
		}
		
		$this->params['page_name'] = 'Novo Plano';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/system/plancreate');
		$this->content_view	= 'admin/settings/plancreate';
	}
	public function planedit($id = FALSE)
	{

			if (!$id || !is_numeric($id) || !($plan = Plan::find_by_id($id)))
			redirect('admin/system/plans');

			if ($this->input->post()){
			$data = $this->input->post();
			$data['value']  = grava_money($data['value']);
			$data['old_value'] = grava_money($data['old_value']);
			
			if (empty($data['name']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o nome!'));
			elseif (!in_array($data['status'], array('Y', 'N')))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o status!'));
			elseif (empty($data['description']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha a descrição!'));
			elseif (empty($data['value']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o valor!'));
			elseif (empty($data['old_value']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o valor antigo!'));
			else {
				
			$plan->name = $data['name'];
			$plan->status = $data['status'];
			$plan->description = $data['description'];
			$plan->value = $data['value'];
			$plan->old_value = $data['old_value'];
			$plan->last_edit = date('Y-m-d H:i:s');
			$plan->last_editor = $this->admin->id;

			if ($plan->save()) 
				$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Plano alterado!'));
			else 
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Algum problema ocorreu!'));

			redirect('admin/system/planedit/' .$id);
			exit;
			}
		}

		$this->params['plan']	= $plan;
		$this->params['lasteditor']	= Admin::find_by_id($plan->last_editor);

		$this->params['page_name'] = 'Alterar Plano';
		$this->breadcrumbs->push($this->params['page_name'] . ' - ' . $admin->name, '/admin/system/planedit/' . $id);
		$this->content_view	= 'admin/settings/planedit';
	}
	public function plandelete($id = FALSE)
	{
		if (!$id || !is_numeric($id) || !($plan = Plan::find_by_id($id)))
			redirect('admin/system/plans');

		if ($plan->delete())
			$this->session->set_flashdata('message', ['text' => 'Plano excluido!', 'type' => 'success']);
		else
			$this->session->set_flashdata('message', ['text' => 'Houve algum problema!', 'type' => 'error']);

		redirect('admin/system/plans');
	}
}
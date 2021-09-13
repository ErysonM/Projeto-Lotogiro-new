<?php
class Users extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->admin)
			redirect('admin/login');

		$this->params['module_name'] = 'Usuários';
		$this->breadcrumbs->push($this->params['module_name'], '/admin/users');
	}
	public function index()
	{
		$this->params['page_name'] = 'Lista';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/users/index');
		$this->content_view = 'admin/users/index';

		$firstday_in_month					= strtotime(date('Y') . "-" . date('m') . "-01");
		$this->params['users_total']		= User::count();
		$this->params['users_active']		= User::count(array('conditions' => array('status = ?', 'active')));
		$this->params['users_month']		= User::count(array('conditions' => array('UNIX_TIMESTAMP(`create_date`) <= ? and UNIX_TIMESTAMP(`create_date`) >= ?', time(), $firstday_in_month)));

		$this->params['users']	= User::all();
	}
	public function view($id = FALSE)
	{
		if (!$id || !is_numeric($id) || !($user = User::find_by_id($id)))
			redirect('admin/users');

		$this->params['sponsored']	= User::all(array('conditions' => array('enroller = ?', $user->id)));
		$this->params['invoices']	= Invoice::all(array('conditions' => array('user_id = ?', $user->id)));
		$this->params['withdrawals']= Withdrawal::all(array('conditions' => array('user_id = ?', $user->id)));
		$this->params['user']		= $user;

		$this->params['page_name'] = 'Ver';
		$this->breadcrumbs->push($this->params['page_name'] . ' - ' . $user->firstname . ' ' . $user->lastname, '/admin/users/view/' . $id);
		$this->content_view			= 'admin/users/view';
	}
	public function edit($id = FALSE)
	{
		if (!$id || !is_numeric($id) || !($user = User::find_by_id($id)))
			redirect('admin/users');

		if ($this->input->post())
		{
			$data = $this->input->post();

			//if (!check_cpf($data['cpf']))
				//$this->session->set_flashdata('message', ['text' => 'Informe um CPF válido!', 'type' => 'error']);
			//elseif (User::count(array('conditions' => array('cpf' => $data['cpf']))) != 0 && $data['cpf'] != $user->cpf)
				//$this->session->set_flashdata('message', ['text' => 'Já existe um cadastro para este CPF!', 'type' => 'error']);
			//elseif (calc_age($data['birthday']) < 18)
				//$this->session->set_flashdata('message', ['text' => 'Para se cadastrar você deve ter 18+ anos!', 'type' => 'error']);
			if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
				$this->session->set_flashdata('message', ['text' => 'Informe um email válido!', 'type' => 'error']);
			elseif (User::count(array('conditions' => array('email' => $data['email']))) != 0 && $data['email'] != $user->email)
				$this->session->set_flashdata('message', ['text' => 'Este email já esta em uso!', 'type' => 'error']);
			elseif (!empty($data['password']) && $data['password'] != $data['confirm_password'])
				$this->session->set_flashdata('message', ['text' => 'As senhas não conferem!', 'type' => 'error']);
			elseif (!empty($data['password']) && strlen($data['password']) < 6)
				$this->session->set_flashdata('message', ['text' => 'A senha deve ter no minimo 6 caracteres!', 'type' => 'error']);
			//elseif (empty($data['phone']) && empty($data['mobilephone']))
				//$this->session->set_flashdata('message', ['text' => 'É necessario informar ao menos um telefone para contato!', 'type' => 'error']);
			else
			{
				unset($data['confirm_password']);
				if (!empty($data['password'])) $data['password'] = $this->encrypt->encode($data['password']);
				else unset($data['password']);

				list($bday, $bmonth, $byear)	= explode('/', $data['birthday']);
				$birthday						= mktime(0, 0, 0, $bmonth, $bday, $byear);
				$data['birthday']				= date('Y-m-d', $birthday);

				foreach ($data as $key => $value)
					$user->{$key} = $value;
				if ($user->save())
					$this->session->set_flashdata('message', ['text' => 'As informações foram salvas com sucesso!', 'type' => 'success']);
				else
					$this->session->set_flashdata('message', ['text' => 'Não foi possível aplicar as alterações!', 'type' => 'error']);
			}
			redirect('admin/users/edit/' . $user->id);
			exit;
		}

		$this->params['user']		= $user;
		$this->params['sponsor']	= User::find_by_id($user->enroller);

		$this->params['page_name'] = 'Editar';
		$this->breadcrumbs->push($this->params['page_name'] . ' - ' . $user->firstname . ' ' . $user->lastname, '/admin/users/edit/' . $id);
		$this->content_view			= 'admin/users/edit';
	}
	public function backoffice($id = FALSE)
	{
		if (!$id || !is_numeric($id) || !($user = User::find_by_id($id)))
			redirect('admin/users');

		$this->session->set_userdata('user', $user->id);
		redirect('backoffice');
	}
	public function link($id = FALSE)
	{
		if (!$id || !is_numeric($id) || !($user = User::find_by_id($id)))
			redirect('admin/users');

		$user->link = '';
		if ($user->save())
			$this->session->set_flashdata('message', ['text' => 'Agora o associado pode escolher um novo link de indicação!', 'type' => 'success']);
		else
			$this->session->set_flashdata('message', ['text' => 'Houve algum problema!', 'type' => 'error']);

		redirect('admin/users/view/' . $id);
	}
	public function ban($id = FALSE)
	{
		if (!$id || !is_numeric($id) || !($user = User::find_by_id($id)))
			redirect('admin/users');

		$data = $this->input->post();
		$user->banned = $data['ban'];
		$user->ban_description = $data['ban_description'];
		if ($user->save()) {
		if($data['ban'] == 'Y') $this->session->set_flashdata('message', ['text' => 'Usuário bloqueado!', 'type' => 'success']);
		else $this->session->set_flashdata('message', ['text' => 'Usuário desbloqueado!', 'type' => 'success']);
		} else {
			$this->session->set_flashdata('message', ['text' => 'Houve algum problema!', 'type' => 'error']);
		}

		redirect('admin/users/view/' . $id);
	}
	public function balance($id = FALSE)
	{
		if (!$id || !is_numeric($id) || !($user = User::find_by_id($id)))
			redirect('admin/users');

		if ($this->input->post())
		{
			$data = $this->input->post();
			$data['value'] = grava_money($data['value']);

			if (!in_array($data['type'], array('credit', 'debit')))
				$this->session->set_flashdata('message', ['text' => 'Selecione o tipo.', 'type' => 'error']);
			elseif (!is_numeric($data['value']) || $data['value'] <= 0)
				$this->session->set_flashdata('message', ['text' => 'Você deve informar um valor maior que 0.', 'type' => 'error']);
			elseif (empty($data['description']) || strlen(trim($data['description'])) < 10 || strlen(trim($data['description'])) > 120)
				$this->session->set_flashdata('message', ['text' => 'A descrição deve ter de 10 à 120 caracteres.', 'type' => 'error']);
			else
			{
				if ($data['type'] == 'credit')
					$user->balance += $data['value'];
				elseif ($data['type'] == 'debit')
					$user->balance -= $data['value'];
				$user->save();

				$insert = array();
				$insert['user_id']		= $user->id;
				$insert['type']			= $data['type'];
				$insert['value']		= $data['value'];
				$insert['description']	= $data['description'];
				$insert['date']			= date('Y-m-d H:i:s');
				$insert['subtype']		= 'other';
				Extract::create($insert);

				$this->session->set_flashdata('message', ['text' => 'A ação foi concluida com exito', 'type' => 'success']);
			}
		}
		redirect('admin/users/view/' . $id);
	}
}
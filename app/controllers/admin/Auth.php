<?php
class Auth extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->theme_view = 'admin/theme/auth';
		$this->params['module_name'] = 'Auth';
	}
	
	public function index() { redirect('admin/login'); }

	public function login()
	{
		if ($this->input->post())
		{
			$email		= $this->input->post('email');
			$password	= $this->input->post('password');
			$return = ['success' => FALSE];
			if (empty($email) || empty($password))
				$return['message'] = 'Preencha todos os campos!';
			elseif (!($admin = Admin::find(['conditions' => ['email = ?', $email]])))
				$return['message'] = 'E-mail e/ou senha invalido(s)!';
			elseif ($password != $this->encrypt->decode($admin->password))
				$return['message'] = 'E-mail e/ou senha invalido(s)!';
			elseif ($admin->status != 'Y')
				$return['message'] = 'A conta está inativa no sistema!';
			else
			{
				$this->session->set_userdata('admin', $admin->id);
				$return['success']	= TRUE;
				$return['message']	= 'Aguarde enquanto redirecionamos você!';
				$return['redirect']	= site_url('admin/home');
			}
			exit(json_encode($return));
		}
		$this->params['page_name']	= 'Acesso';
		$this->content_view			= 'admin/auth/login';
	}
	
	public function forgot($token = FALSE)
	{
		if ($token)
		{
			if (!($admin = Admin::find(['conditions' => ['token_forgot = ?', $token]])) || $admin->token_forgot_timestamp < time())
				$this->session->set_flashdata('message', ['title' => 'Token Invalido!', 'text' => 'O token informado é invalido ou ja expirou!', 'type' => 'error']);
			else
			{
				# Gerar nova senha
				$new_password = substr(str_shuffle(strtolower(sha1(rand() . time() . "nekdotlggjaoudlpqwejvlfk"))), 0, 8);

				# Salvar nova senha
				$admin->password					= $this->encrypt->encode($new_password);
				$admin->token_forgot				= '';
				$admin->token_forgot_timestamp	= 0;
				$admin->save();

				# Enviar email com nova senha
				$this->load->library('parser');
				$this->email->from($this->settings->company_email, $this->settings->company);
				$this->email->reply_to($this->settings->company_email, $this->settings->company);
				$this->email->to($admin->email);
				$this->email->subject('Nova senha');
				$parse_data = array(
					'password'	=> $new_password,
					'link'		=> site_url('admin/login'),
					'logo'		=> $this->settings->company_name,
					'logo_dark'	=> $this->settings->company_name,
					'company'	=> $this->settings->company_name
				);
				$email = read_file(APPPATH . 'views/templates/email_pw_reset.html');
				$message = $this->parser->parse_string($email, $parse_data);
				$this->email->message($message);
				$this->email->send();

				$this->session->set_flashdata('message', ['title' => 'Nova Senha', 'text' => 'Uma senha temporaria foi criada e enviada para seu E-mail!', 'type' => 'success']);
			}
			redirect('admin/login');
		}
		else
		{
			if ($this->input->post())
			{
				$email = $this->input->post('email');
				$return = ['success' => FALSE];
				if (empty($email))
					$return['message'] = 'Preencha todos os campos!';
				elseif (!($admin = Admin::find(array('conditions' => array('email = ?', $email)))))
					$return['message'] = 'Empreendedor não localizado!';
				else
				{
					$timestamp = time();
					# Gerar token baseado com o timestamp atual
					$token = md5($timestamp);

					# Atualiza informações
					$admin->token_forgot				= $token;
					$admin->token_forgot_timestamp	= $timestamp;
					$admin->save();

					# Enviar email
					$this->load->library('parser');
					$this->email->from($this->settings->company_email, $this->settings->company_name);
					$this->email->reply_to($this->settings->company_email, $this->settings->company_name);
					$this->email->to($admin->email);
					$this->email->subject('Esqueceu sua senha');
					$parse_data = array(
						'link'		=> site_url('admin/forgot/' . $token),
						'logo'		=> $this->settings->company_name,
						'logo_dark'	=> $this->settings->company_name,
						'company'	=> $this->settings->company_name
					);
					$email = read_file(APPPATH . 'views/templates/email_pw_reset_link.html');
					$message = $this->parser->parse_string($email, $parse_data);
					$this->email->message($message);
					$this->email->send();

					$return['success']	= TRUE;
					$return['message']	= 'Para prosseguir com a recuperação de senha, siga as instruções enviadas para seu E-mail!';
					$return['redirect']	= site_url('admin/login');
				}
				exit(json_encode($return));
			}
			$this->params['page_name']	= 'Recuperar Conta';
			$this->content_view			= 'admin/auth/forgot';
		}
	}
	
	public function logout()
	{
		if ($this->session->userdata('admin'))
			$this->session->unset_userdata('admin');

		redirect('admin/login');
	}
}
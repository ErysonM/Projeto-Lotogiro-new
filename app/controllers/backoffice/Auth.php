<?php
/**
 * Project:    mmn.dev
 * File:       Auth.php
 * Author:     Felipe Medeiros
 * Createt at: 09/06/2016 - 07:31
 */
class Auth extends MY_Controller
{
	/**
	 * Auth constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->theme_view = 'backoffice/theme/auth';
		$this->params['module_name'] = 'Auth';
	}

	/**
	 * Index Page
	 */
	public function index() { redirect('backoffice/login'); }

	/**
	 * Login Page
	 */
	public function login()
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
			$email		= $this->input->post('email');
			$password	= $this->input->post('password');
			$return = ['success' => FALSE];
			if (empty($email) || empty($password))
				$return['message'] = $lang['preencha_todos_campos'];
			elseif (!($user = User::find(['conditions' => ['email = ?', $email]])))
				$return['message'] = $lang['email_senha_invalido'];
			elseif ($password != $this->encrypt->decode($user->password))
				$return['message'] = $lang['email_senha_invalido'];
			elseif ($user->banned == 'Y')
				$return['message'] = $lang['conta_bloqueada'];
			elseif ($this->settings->lock_login == 'Y')
			$return['message'] = $lang['acesso_fechado'];
			elseif ($this->settings->maintenance == 'Y')
			$return['message'] = $lang['estamos_manutencao'];
			else
			{
				
				/*$cookie = array(
				'name' => 'userid',
				'value' => $user->id,
				'expire' => time()+(365*24*60*60),
				);
				$this->input->set_cookie($cookie);*/
				
				
				//$user->last_login = date("Y-m-d H:i:s");
				//$user->last_login = date("d/m/Y H:i:s");
				$user->save();
							
							
				$this->session->set_userdata('user', $user->id);   
				$return['success']	= TRUE;
				$return['message']	= $lang['agurade_redir'];
				$return['redirect']	= site_url('backoffice/home');
			}
			exit(json_encode($return));
		}
		$this->params['page_name']	= 'Access';
		$this->content_view			= 'backoffice/auth/login';
	}

	public function logout()
	{
		if ($this->session->userdata('user'))
			$this->session->unset_userdata('user');

		redirect('backoffice/login');
	}

	public function forgot($token = FALSE)
	{
		$idioma = "pt-br";
		if(!empty($_COOKIE['idioma']))
		{
			$idioma = $_COOKIE['idioma'];
		}

		$file = substr(APPPATH, 0, strlen(APPPATH)-4);
		$path = $file."langs/backoffice/".$idioma.".php";
		include($path);

		if ($token)
		{
			if (!($user = User::find(['conditions' => ['token_forgot = ?', $token]])) || $user->token_forgot_timestamp < time())
				$this->session->set_flashdata('message', ['title' => $lang['token_inv'], 'text' => $lang['token_invalido'], 'type' => 'error']);
			else
			{
				# Gerar nova senha
				$new_password = substr(str_shuffle(strtolower(sha1(rand() . time() . "nekdotlggjaoudlpqwejvlfk"))), 0, 8);

				# Salvar nova senha
				$user->password					= $this->encrypt->encode($new_password);
				$user->token_forgot				= '';
				$user->token_forgot_timestamp	= 0;
				$user->save();

				# Enviar email com nova senha
				$this->load->library('parser');
				$this->email->from($this->settings->company_email, $this->settings->company_name);
				$this->email->reply_to($this->settings->company_email, $this->settings->company_name);
				$this->email->to($user->email);
				$this->email->subject($lang['nova_senha']);
				$parse_data = array(
					'password'	=> $new_password,
					'link'		=> site_url('backoffice/login'),
					'logo'		=> $this->settings->company_name,
					'logo_dark'	=> $this->settings->company_name,
					'company'	=> $this->settings->company_name
				);
				$email = read_file(APPPATH . 'views/templates/email_pw_reset.html');
				$message = $this->parser->parse_string($email, $parse_data);
				$this->email->message($message);
				$this->email->send();

				$this->session->set_flashdata('message', ['title' => $lang['nova_senha'], 'text' => $lang['senha_temporaria'], 'type' => 'success']);
			}
			redirect('backoffice/login');
		}
		else
		{
			if ($this->input->post())
			{
				$email = $this->input->post('email');
				$return = ['success' => FALSE];
				if (empty($email))
					$return['message'] = $lang['preencha_todos_campos'];
				elseif (!($user = User::find(array('conditions' => array('email = ?', $email)))))
					$return['message'] = $lang['empreendedor_nao_localizado'];
				else
				{
					$time = time();
					$timestamp = $time + 3600; //uma hora pra alterar a senha.
					# Gerar token baseado com o timestamp atual
					$token = md5($timestamp);

					# Atualiza informações
					$user->token_forgot				= $token;
					$user->token_forgot_timestamp	= $timestamp;
					$user->save();

					# Enviar email
					$this->load->library('parser');
					$this->email->from($this->settings->company_email, $this->settings->company_name);
					$this->email->reply_to($this->settings->company_email, $this->settings->company_name);
					$this->email->to($user->email);
					$this->email->subject($lang['esqueceu_sua_senha2']);
					$parse_data = array(
						'link'		=> site_url('backoffice/forgot/' . $token),
						'logo'		=> $this->settings->company_name,
						'logo_dark'	=> $this->settings->company_name,
						'company'	=> $this->settings->company_name
					);
					$email = read_file(APPPATH . 'views/templates/email_pw_reset_link.html');
					$message = $this->parser->parse_string($email, $parse_data);
					$this->email->message($message);
					$this->email->send();

					$return['success']	= TRUE;
					$return['message']	= $lang['siga_instrucoes'];
					$return['redirect']	= site_url('backoffice/login');
				}
				exit(json_encode($return));
			}
			$this->params['page_name']	= 'Retrieve account';
			$this->content_view			= 'backoffice/auth/forgot';
		}
	}
	
	public function sponsor($id = FALSE)
	{
		$idioma = "pt-br";
		if(!empty($_COOKIE['idioma']))
		{
			$idioma = $_COOKIE['idioma'];
		}

		$file = substr(APPPATH, 0, strlen(APPPATH)-4);
		$path = $file."langs/backoffice/".$idioma.".php";
		include($path);
		
		if(empty($id)) $id = mt_rand(1,2);
		
		if (!($sponsor = User::find(array('conditions'	=> array('id = ? or link = ?', $id, $id)))))
		{
			$this->session->set_flashdata('message', array(
				'type'	=> 'error',
				'title'	=> $lang['erro_ops'],
				'text'	=> $lang['link_invalido']
			));
			redirect('backoffice/login');
		} else
		{
			if ($this->input->post())
			{
				$return['success'] = FALSE;
				if ($sponsor->status != 'active' OR $sponsor->banned != 'N')
					$return['message']	= $lang['patrocinador_nao_qual'];
				else
				{
					$data	= $this->input->post();
					if ($this->settings->lock_register == 'Y')
						$return['message']	= $lang['nao_aceita_novos_registros'];
					/*elseif (!check_cpf($data['cpf']))
						$return['message']	= 'Informe um CPF válido!';*/
					/*elseif (User::count(array('conditions' => array('cpf' => $data['cpf']))) != 0)
						$return['message']	= 'Já existe um cadastro para este CPF!';*/
					/*elseif (calc_age($data['birthday']) < 18)
						$return['message']	= 'Para se cadastrar você deve ter 18+ anos!';*/
					elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
						$return['message']	= $lang['informe_email_valido'];
					elseif (User::count(array('conditions' => array('email' => $data['email']))) != 0)
						$return['message']	= $lang['email_em_uso'];
					elseif ($data['password'] != $data['confirm_password'])
						$return['message']	= $lang['senhas_nao_conferem'];
					elseif (strlen($data['password']) < 6)
						$return['message']	= $lang['senha_min_car'];
					elseif (Countrie::count(array('conditions' => array('code = ?', $data['country']))) != 1)
						$return['message']	= $lang['pais_inexistente'];
					else
					{
						unset($data['confirm_password']);
						$password = $data['password'];
						$data['password']		= $this->encrypt->encode($data['password']);
						$data['create_date']	= date('Y-m-d H:i:s');

						list($bday, $bmonth, $byear)	= explode('/', $data['birthday']);
						$birthday				= mktime(0, 0, 0, $bmonth, $bday, $byear);
						$data['birthday']		= date('Y-m-d', $birthday);

						$data['enroller']		= $sponsor->id;
						if (User::create($data))
						{
							
							$updatevisit = Setting::find(1);
							$updatevisit->registers += 1;
							$updatevisit->real_registers += 1;
							$updatevisit->save();
							$return['success']	= TRUE;
							$return['message']	= $lang['parabens_novo_associado'];
							
							
							# Enviar email com nova senha
							$this->load->library('parser');
							$this->email->from($this->settings->company_email, $this->settings->company_name);
							$this->email->reply_to($this->settings->company_email, $this->settings->company_name);
							$this->email->to($data['email']);
							$this->email->subject($lang['dados_acesso']);
							$parse_data = array(
								'fullname'	=> trim($data['firstname'].' '.$data['lastname']),
								'password'	=> $password,
								'email'		=> $data['email'],
								'link'		=> site_url('backoffice/login'),
								'logo'		=> $this->settings->company_name,
								'logo_dark'	=> $this->settings->company_name,
								'company'	=> $this->settings->company_name
							);
							$email = read_file(APPPATH . 'views/templates/email_credentials.html');
							$message = $this->parser->parse_string($email, $parse_data);
							$this->email->message($message);
							$this->email->send();
							
							
							
							$return['redirect']	= site_url('backoffice/login');							
						} else
							$return['message']	= $lang['tivemos_problema'];
					}
				}
				exit(json_encode($return));
			}


			$this->params['sponsor'] = $sponsor;
			$this->params['page_name']	= 'Register';
			$this->content_view	= 'backoffice/auth/sponsor';
			
			$query = Countrie::all(['order' => 'name asc']);
			$loadinfo = array();
			foreach ($query as $row) {
				$code = $row->code;
				$loadinfo[$code] = $row->name;
			}
			
			$this->params['options'] = $loadinfo;
		
		}
	}
}
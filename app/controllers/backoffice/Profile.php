<?php
/**
 * Project:    mmn.dev
 * File:       Profile.php
 * Author:     Felipe Medeiros
 * Createt at: 09/06/2016 - 06:41
 */
class Profile extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->user)
			redirect('backoffice/login');

		$this->params['module_name'] = 'Perfil';
		$this->breadcrumbs->push($this->params['module_name'], '/backoffice/profile');
	}
	public function index(){ redirect('backoffice/home'); }
	
	public function view($id = FALSE)
	{
		if (!$id || !($profile = User::find(['conditions' => ['id = ?', $id]])))
		{
			$this->session->set_flashdata('message', ['text' => 'Usuário não encontrado!', 'type' => 'error']);
			redirect('backoffice/home');
		}

		$this->params['header_button']	= '<div class="btn-group heading-btn">
			<a href="' . site_url('backoffice/home') . '" class="btn bg-teal btn-labeled">
				<b><i class="icon-circle-left2"></i></b>
				Voltar
			</a>
		</div>';

		$this->params['page_name']		= "ID #".$profile->id." - ".$profile->firstname." ".$profile->lastname;
		$this->breadcrumbs->push($this->params['page_name'], '/backoffice/profile/' . $profile->id);
		$this->params['profile']		= $profile;
		$this->content_view				= 'backoffice/profile/view';
	}
}
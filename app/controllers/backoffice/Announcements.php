<?php
/**
 * Project:    mmn.dev
 * File:       Announcements.php
 * Author:     Felipe Medeiros
 * Createt at: 09/06/2016 - 06:41
 */
class Announcements extends MY_Controller
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

		$this->params['module_name'] = 'Comunicados';
		$module_name = $lang['comunicados'];
		$this->breadcrumbs->push($module_name, '/backoffice/announcements');
	}
	public function index($page = 0)
	{
		$idioma = "pt-br";
		if(!empty($_COOKIE['idioma']))
		{
			$idioma = $_COOKIE['idioma'];
		}

		$file = substr(APPPATH, 0, strlen(APPPATH)-4);
		$path = $file."langs/backoffice/".$idioma.".php";
		include($path);

		$this->params['page_name'] = 'Lista';
		$page_name = $lang['lista'];
		$this->breadcrumbs->push($page_name, '/backoffice/announcements/index');
		$this->content_view	= 'backoffice/announcements/index';

		$this->load->library('pagination');
		$config['base_url']		= site_url('backoffice/announcements');
		$config['total_rows']	= Announcement::count();
		$config['per_page']		= 6;
		$config["uri_segment"]	= 3;
		$config['display_pages']	= FALSE;
		$config['full_tag_open'] = '<ul class="pager">';
		$config['full_tag_close'] = '</ul>';
		$config['next_tag_open'] = '<li class="next">';
		$config['next_link'] = $lang['proxima'].' <i class="icon-arrow-right15"></i>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="previous">';
		$config['prev_link'] = '<i class="icon-arrow-left15"></i> '.$lang['anterior'];
		$config['prev_tag_close'] = '</li>';
		$this->pagination->initialize($config);

		$this->params['paginator']		= $this->pagination->create_links();
		$this->params['announcements']	= Announcement::all(array('order' => 'date desc', 'offset' => $page, 'limit' => $config['per_page']));
	}
	public function view($slug = FALSE)
	{
		$idioma = "pt-br";
		if(!empty($_COOKIE['idioma']))
		{
			$idioma = $_COOKIE['idioma'];
		}

		$file = substr(APPPATH, 0, strlen(APPPATH)-4);
		$path = $file."langs/backoffice/".$idioma.".php";
		include($path);
		
		if (!$slug || !($announcement = Announcement::find(['conditions' => ['slug = ?', $slug]])))
		{
			$this->session->set_flashdata('message', ['text' => $lang['msg_informativo'], 'type' => 'error']);
			redirect('backoffice/announcements');
		}

		$this->params['header_button']	= '<div class="btn-group heading-btn">
			<a href="' . site_url('backoffice/announcements') . '" class="btn bg-teal btn-labeled">
				<b><i class="icon-circle-left2"></i></b>'.
				$lang['voltar']
			.'</a>
		</div>';

		$this->params['page_name']		= $announcement->title;
		$this->breadcrumbs->push($this->params['page_name'], '/backoffice/announcements/view/' . $announcement->slug);
		$this->params['announcement']	= $announcement;
		$this->content_view				= 'backoffice/announcements/view';
	}
}
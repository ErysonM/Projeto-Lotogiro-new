<?php
/**
 * Author:      Felipe Medeiros
 * File:        Tree.php
 * Created in:  24/06/2016 - 14:46
 */
class Tree extends MY_Controller
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

		$this->params['module_name'] = 'Rede';
		$module_name = $lang['rede'];
		$this->breadcrumbs->push($module_name, '/backoffice/tree');
	}
	public function index() { redirect('backoffice/tree/my_indicated'); }
	
	public function my_indicated()
	{
		$idioma = "pt-br";
		if(!empty($_COOKIE['idioma']))
		{
			$idioma = $_COOKIE['idioma'];
		}

		$file = substr(APPPATH, 0, strlen(APPPATH)-4);
		$path = $file."langs/backoffice/".$idioma.".php";
		include($path);

		$this->params['page_name'] = 'Meus indicados';
		$page_name = $lang['meus_indicados'];
		$this->breadcrumbs->push($page_name, '/backoffice/tree/my_indicated');
		$this->content_view	= 'backoffice/tree/my_indicated';

		$this->params['indicated']	= User::all(['conditions' => ['enroller = ?', $this->user->id]]);
	}

	public function linear()
	{
		$idioma = "pt-br";
		if(!empty($_COOKIE['idioma']))
		{
			$idioma = $_COOKIE['idioma'];
		}

		$file = substr(APPPATH, 0, strlen(APPPATH)-4);
		$path = $file."langs/backoffice/".$idioma.".php";
		include($path);

		$this->params['page_name'] = 'Rede linear';
		$page_name = $lang['rede_linear'];
		$this->breadcrumbs->push($page_name, '/backoffice/tree/linear');
		$this->content_view	= 'backoffice/tree/linear';
	}

	public function binary($id = FALSE)
	{
	    if (!$id)	$id = $this->user->id;
		if (!($top = User::find(['conditions' => ['id = ?', $id]])))
			redirect('backoffice/tree/binary');

		$idioma = "pt-br";
		if(!empty($_COOKIE['idioma']))
		{
			$idioma = $_COOKIE['idioma'];
		}

		$file = substr(APPPATH, 0, strlen(APPPATH)-4);
		$path = $file."langs/backoffice/".$idioma.".php";
		include($path);

		$this->params['page_name'] = 'Árvore Binária';
		$page_name = $lang['arvore_binaria'];
		$this->breadcrumbs->push($page_name, '/backoffice/tree/binary');
		$this->content_view	= 'backoffice/tree/binary';
		
		$this->params['top'] = $top;
	}
}
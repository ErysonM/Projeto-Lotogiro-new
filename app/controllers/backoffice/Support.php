<?php
/**
 * Project:    mmn.dev
 * File:       Support.php
 * Author:     Felipe Medeiros
 * Createt at: 09/06/2016 - 06:41
 */
class Support extends MY_Controller
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

		$this->params['module_name'] = 'Suporte';
		$module_name = $lang['suporte'];
		$this->breadcrumbs->push($module_name, '/backoffice/support');
	}
	public function faq()
	{
		$idioma = "pt-br";
		if(!empty($_COOKIE['idioma']))
		{
			$idioma = $_COOKIE['idioma'];
		}

		$file = substr(APPPATH, 0, strlen(APPPATH)-4);
		$path = $file."langs/backoffice/".$idioma.".php";
		include($path);	

		$this->params['page_name'] = 'F.A.Q';
		$page_name = $lang['faq'];
		$this->breadcrumbs->push($page_name, '/backoffice/support/faq');
		$this->content_view	= 'backoffice/support/faq';

		$this->params['faqs']	= Faq::all([
			'order' => 'number asc'
		]);
	}
	public function ads()
	{
		$idioma = "pt-br";
		if(!empty($_COOKIE['idioma']))
		{
			$idioma = $_COOKIE['idioma'];
		}

		$file = substr(APPPATH, 0, strlen(APPPATH)-4);
		$path = $file."langs/backoffice/".$idioma.".php";
		include($path);

		$this->params['page_name'] = 'Material de Apoio';
		$page_name = $lang['material_apoio'];
		$this->breadcrumbs->push($page_name, '/backoffice/support/ads');
		$this->content_view	= 'backoffice/support/ads';

	}
}
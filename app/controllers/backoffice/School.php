<?php
/**
 * Project:    mmn.dev
 * File:       School.php
 * Author:     Felipe Medeiros
 * Createt at: 09/06/2016 - 06:41
 */
class School extends MY_Controller
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

		$this->params['module_name'] = 'Cursos';
		$module_name = $lang['cursos'];
		$this->breadcrumbs->push($module_name, '/backoffice/school');
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

		$this->params['page_name'] = 'E-Books/Audiobooks';
		$page_name = $lang['ebooks_audiobooks'];
		$this->breadcrumbs->push($page_name, '/backoffice/school/index');
		$this->content_view	= 'backoffice/school/index';
	}
}
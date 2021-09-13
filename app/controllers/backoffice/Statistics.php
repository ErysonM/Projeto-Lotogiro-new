<?php
/**
 * Project:    mmn.dev
 * File:       Statistics.php
 * Author:     Felipe Medeiros
 * Createt at: 09/06/2016 - 06:41
 */
class Statistics extends MY_Controller
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
		
		$this->params['module_name'] = 'Estatisticas';
		$module_name = $lang['estatisticas'];
		$this->breadcrumbs->push($module_name, '/backoffice/statistics');
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

		$this->params['page_name'] = 'Geral';
		$page_name = $lang['geral'];
		$this->breadcrumbs->push($page_name, '/backoffice/statistics/index');
		$this->content_view	= 'backoffice/statistics/index';

		$this->params['invoices'] = Invoice::all([
			'limit' => 5,
			'order' => 'id desc'
		]);
		$this->params['withdrawals'] = Withdrawal::all([
			'limit' => 5,
			'order' => 'id desc'
		]);
		$this->params['users'] = User::all([
			'limit' => 5,
			'order' => 'id desc'
		]);
	}
}
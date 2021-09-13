<?php
/**
 * Project:    mmn.dev
 * File:       Support.php
 * Author:     Felipe Medeiros
 * Createt at: 09/06/2016 - 06:41
 */
class Gamecenter extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->user)
			redirect('backoffice/login');

		$this->params['module_name'] = 'Gamecenter';
		$this->breadcrumbs->push($this->params['module_name'], '/backoffice/gamecenter');
	}
	public function index()
	{
		$this->params['page_name'] = 'Gamecenter';
		$this->breadcrumbs->push($this->params['page_name'], '/backoffice/gamecenter');
		$this->content_view	= 'backoffice/gamecenter/index';
	}
}
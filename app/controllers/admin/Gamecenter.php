<?php
use App\Libraries\Datatables;

class GameCenter extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->admin)
			redirect('admin/login');

		$this->params['module_name'] = 'Controle de Jogos';
		$this->breadcrumbs->push($this->params['module_name'], '/admin/gamecenter');
	}
	public function index()
	{
		$this->params['page_name'] = 'Configuarções';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/gamecenter/index');
		$this->content_view	= 'admin/gamecenter/index';
	}
}
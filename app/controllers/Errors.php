<?php
class Errors extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function error_404()
	{
		$this->params['page_name']	= 'Página não encontrada!';
		$this->theme_view			= 'errors/layout';
		$this->content_view			= 'errors/404';
	}
}
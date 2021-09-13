<?php
/**
 * Project:    mmn.dev
 * File:       MY_Controller.php
 * Author:     Felipe Medeiros
 * Createt at: 26/05/2016 - 23:58
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class MY_Controller
 */
class MY_Controller extends CI_Controller
{
	/**
	 * Theme functionality
	 * @var bool|string
	 */
	protected	$theme_view		= FALSE,
				$content_view	= FALSE,
				$params			= [];

	/**
	 * Global vars
	 * @var bool
	 */
	public	$settings	= FALSE,
			$admin		= FALSE,
			$user		= FALSE;
	
	/**
	 * MY_Controller constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		# Load settings
		$this->settings = Setting::first();
		if($this->settings->maintenance == 'Y' AND $this->session->userdata('user')){ $this->session->unset_userdata('user'); }
		if ($this->uri->segment(1) == 'admin')
		{
			$this->theme_view	= 'admin/theme/application';
			$this->admin		= $this->session->userdata('admin') ? Admin::find_by_id($this->session->userdata('admin')) : FALSE;
			$this->contcomu 	= $this->session->userdata('admin') ? Announcement::count() : FALSE; 
			$this->saquesopen 	= $this->session->userdata('admin') ? Withdrawal::find_by_sql("SELECT count(`id`) AS `sum` FROM `withdrawals` WHERE `status` = 'open'")[0]->sum : FALSE;

			$this->breadcrumbs->push('<i class="icon-home4 position-left"></i>', '/admin');
		}
		elseif ($this->uri->segment(1) == 'backoffice')
		{
			$this->theme_view	= 'backoffice/theme/application';
			$this->user			= $this->session->userdata('user') ? User::find_by_id($this->session->userdata('user')) : FALSE;
			$this->contcomu 	= $this->session->userdata('user') ? Announcement::count() : FALSE; 

			$this->breadcrumbs->push('<i class="icon-home4 position-left"></i>', '/backoffice');
		}
	}

	/**
	 * @param $output
	 */
	public function _output($output)
	{
		# Set the default content view
		if($this->content_view !== FALSE && empty($this->content_view))
			$this->content_view = $this->router->class . '/' . $this->router->method;

		# Render the content view
		$this->params['yield'] = file_exists(APPPATH . 'views/' . $this->content_view . EXT) ? $this->load->view($this->content_view, $this->params, TRUE) : FALSE;

		# Render the theme
		if($this->theme_view)
			echo $this->load->view($this->theme_view, $this->params, TRUE);
		else 
			echo $this->params['yield'];
		
		echo $output;
	}
}

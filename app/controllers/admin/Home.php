<?php
class Home extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->admin)
			redirect('admin/login');

		$this->params['module_name'] = 'Home';
		$this->breadcrumbs->push($this->params['module_name'], '/admin/home');
	}
	public function index()
	{
		$this->params['page_name'] = 'Dashboard';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/home/index');
		$this->content_view = 'admin/home/index';

		$this->params['members']	= User::count();

		$start_month	= date('Y-m', strtotime('-6 months')) . '-01';
		$end_month		= date('Y-m-d');
		$this->params['members_graph']			= User::find_by_sql("SELECT COUNT(`id`) AS `amount`, DATE_FORMAT(`create_date`, '%Y-%m') AS `date_formatted` FROM `users` WHERE DATE_FORMAT(`create_date`, '%Y-%m-%d') BETWEEN '{$start_month}' AND '{$end_month}' GROUP BY SUBSTR(`date_formatted` ,1 ,7)");

		//$this->params['plans_graph']	= User::find_by_sql("SELECT COUNT(`u`.`id`) AS `amount`, `u`.`plan_id`,`p`.`name` FROM `users` AS `u` LEFT JOIN `plans` AS `p` ON `u`.`plan_id` = `p`.`id` GROUP BY `p`.`id`");

		$this->params['last_logins']	= User::all([
			'conditions'	=> [
				'last_login != ?',
				'0000-00-00 00:00:00'
			],
			'limit' => 5, 
			'order' => 'last_login desc']);
			
		$this->params['last_members']	= User::all(['limit' => 5, 'order' => 'create_date desc']);

		$this->params['revenues']	= Invoice::find_by_sql("SELECT SUM(`sum`) AS `value` FROM `invoices` WHERE `status` = 'paid'")[0]->value;
		$this->params['expenses']	= Extract::find_by_sql("SELECT SUM(`value`) AS `sum` FROM `extracts` WHERE `type` = 'credit' AND `subtype` = 'bonus'")[0]->sum;
		$this->params['balance']	= $this->params['revenues'] - $this->params['expenses'];
	}
}
<?php
class Welcome extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->theme_view = 'welcome/home';
		
		$this->params['jogadores'] = $this->settings->registers;
		
		$this->params['visitantes'] = $this->settings->visits;
		
		$this->params['jogos'] = $this->settings->bet;
		
		$entrada = Invoice::find_by_sql("SELECT SUM(`sum`) AS `value` FROM `invoices` WHERE `status` = 'paid'")[0]->value;
		
		$this->params['entrada'] =  + $entrada;
		
		$this->params['saida'] = (($this->params['entrada'] / 100) * 20) ;
		
		$uentrada = Invoice::find_by_sql("SELECT `sum` AS `value` FROM `invoices` WHERE `status` = 'paid' order by id desc")[0]->value;
		
		$this->params['uentrada'] = $uentrada;
		
		$usaida = Withdrawal::find_by_sql("SELECT `value` FROM `withdrawals` order by id desc")[0]->value;
		
		$this->params['usaida'] = $usaida;
		
		$online = User::find_by_sql("SELECT count(`id`)  as `value` FROM `users` WHERE `last_activity` >= '".date('Y-m-d H:i:s', time() - (60 * 30))."' order by id desc")[0]->value;
		
		$this->params['onlines'] =  $online + mt_rand(50,60);
		
		$updatevisit = Setting::First();
		$updatevisit->visits += 1;
		$updatevisit->real_visits += 1;
		$updatevisit->save();
		
		$this->params['module_name'] = 'Home';
	}
}
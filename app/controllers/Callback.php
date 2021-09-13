<?php
class Callback extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index() { exit; }

	public function paypal() { echo 'paypal'; }

	public function bcash() { echo 'bcash'; }

	public function bitcoin() { 
		if (empty($_POST['order_id']))
			exit;
		
		echo 'Pedido #' . $_POST['order_id'] . ' - Status: ' . $_POST['status'] . '<br />';
	
		if (!($invoice = Invoice::find_by_id($_POST['order_id'])))
			exit('Pedido n existe ou n numerico!');
	
		$invoice = Invoice::find_by_id($_POST['order_id']);
		$invoice->btc_required		= $_POST['btc_amount'];
		$invoice->btc_paid			= $_POST['receive_amount'];
		$invoice->btc_payment_id	= $_POST['id'];
		$invoice->status_btc		= $_POST['status'];
		$invoice->save();

		if($_POST['status'] == 'paid' && $_POST['price'] >= $invoice->sum && $invoice->status == 'open')
		{
			/* Roda bonus e faz ações que tem que fazer nesse sistema */
			$this->load->helper('invoice_paid');
			$payment_method = 'bitcoin';
			invoice_paid($invoice->id, $payment_method);
			echo 'Pedido liberado com sucesso!';
		}
	}
}
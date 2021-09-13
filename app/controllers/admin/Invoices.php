<?php
class Invoices extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->admin)
			redirect('admin/login');

		$this->params['module_name']	= 'Faturas';
		$this->breadcrumbs->push($this->params['module_name'], '/admin/invoices');
	}
	
	public function index() { redirect('admin/invoices/all'); }
	
	public function all()
	{
		$this->params['invoices']	= Invoice::all();
		$this->params['abertos']	= Invoice::find_by_sql("SELECT SUM(`sum`) AS `value` FROM `invoices` WHERE `status` = 'open'")[0]->value;
		$this->params['pagos']	= Invoice::find_by_sql("SELECT SUM(`sum`) AS `value` FROM `invoices` WHERE `status` = 'paid'")[0]->value;
		$this->params['cancelados']	= Invoice::find_by_sql("SELECT SUM(`sum`) AS `value` FROM `invoices` WHERE `status` = 'canceled'")[0]->value;
		$this->params['vencido']	= Invoice::find_by_sql("SELECT SUM(`sum`) AS `value` FROM `invoices` WHERE `status` = 'overdue'")[0]->value;

		$this->params['page_name']	= 'Lista';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/invoices/all');

		$this->content_view = 'admin/invoices/all';
	}
	public function view($id = FALSE)
	{
		if (!is_numeric($id) || Invoice::count(array('conditions' => array('id = ?', $id))) != 1)
			redirect('admin/invoices');

		$invoice	= Invoice::find(array('conditions' => array('id = ?', $id)));
		$this->params['invoice'] = $invoice;

		$user		= User::find(array('conditions' => array('id = ?', $invoice->user_id)));
		$this->params['user'] = $user;

		$comprovant = Comprovant::all(array('conditions' => array('invoice_id = ?', $invoice->id)));
		$this->params['comprovants'] = $comprovant;

		$this->params['page_name']	= 'Ver fatura';
		$this->breadcrumbs->push('Fatura Nº' . $invoice->id, '/admin/invoices/view/' . $invoice->id);

		$this->content_view = 'admin/invoices/view';
	}
	public function paid($id = FALSE)
	{
		if (!is_numeric($id) || Invoice::count(array('conditions' => array('id = ?', $id))) != 1)
			redirect('admin/invoices');

		$invoice	= Invoice::find(array('conditions' => array('id = ?', $id)));
		if ($invoice->status != 'open')
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Esta fatura não esta aberta!'));
		else
		{
			// Roda bonus e faz ações que tem que fazer nesse sistema 
			$this->load->helper('invoice_paid');
			$payment_method = '';
			invoice_paid($id, $payment_method);

			$invoice->last_att = date('Y-m-d H:i:s');
			$invoice->last_editor = $this->admin->id;
			$invoice->save();
		}
		redirect('admin/invoices/view/' . $invoice->id);
	}
	public function cancel($id = FALSE)
	{
		if (!is_numeric($id) || Invoice::count(array('conditions' => array('id = ?', $id))) != 1)
			redirect('admin/invoices');

		$invoice	= Invoice::find(array('conditions' => array('id = ?', $id)));
		if ($invoice->status != 'open')
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Esta fatura não esta aberta!'));
		else 
		{
			$invoice->last_att = date('Y-m-d H:i:s');
			$invoice->last_editor = $this->admin->id;
			$invoice->status = 'canceled';
			$invoice->save();

			$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Fatura cancelada com sucesso!'));
		}
		redirect('admin/invoices/view/' . $invoice->id);
	}
}
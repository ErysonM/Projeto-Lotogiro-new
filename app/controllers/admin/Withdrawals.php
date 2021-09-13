<?php
class Withdrawals extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->admin)
			redirect('admin/login');

		$this->params['module_name'] = 'Gerenciar saques';
		$this->breadcrumbs->push($this->params['module_name'], '/admin/withdrawals');
	}
	
	public function index() { redirect('admin/withdrawals/all'); }
	
	public function all()
	{
		$this->params['withdrawals']	= Withdrawal::all();
		$this->params['abertos']	= Withdrawal::find_by_sql("SELECT SUM(`value`) AS `sum` FROM `withdrawals` WHERE `status` = 'open'")[0]->sum;
		$this->params['pagos']	= Withdrawal::find_by_sql("SELECT SUM(`value`) AS `sum` FROM `withdrawals` WHERE `status` = 'paid'")[0]->sum;
		$this->params['cancelados']	= Withdrawal::find_by_sql("SELECT SUM(`value`) AS `sum` FROM `withdrawals` WHERE `status` = 'cancel'")[0]->sum;
		$this->params['estornados']	= Withdrawal::find_by_sql("SELECT SUM(`value`) AS `sum` FROM `withdrawals` WHERE `status` = 'chargeback'")[0]->sum;
		$this->params['taxas']	= Withdrawal::find_by_sql("SELECT SUM(`tax`) AS `sum` FROM `withdrawals` WHERE `status` = 'paid'")[0]->sum;
		
		$this->params['page_name'] = 'Lista';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/withdrawals/all');
		$this->content_view	= 'admin/withdrawals/all';
	}
	public function view($id = FALSE)
	{
		if (!$id || !is_numeric($id) || !($withdrawal = Withdrawal::find_by_id($id))) redirect('admin/withdrawals/all');

		$this->params['header_button']	= '<div class="btn-group heading-btn">
			<a href="' . site_url('admin/withdrawals/all') . '" class="btn bg-teal btn-labeled">
				<b><i class="icon-circle-left2"></i></b>
				Voltar
			</a>
		</div>';

		$this->params['page_name'] = 'Saque #'.$id;
		$this->breadcrumbs->push($this->params['page_name'], '/admin/withdrawals/view/'.$id);

		$this->params['withdrawal'] = $withdrawal;
		$this->params['beneficiario'] = User::find_by_id($withdrawal->user_id);
		$this->params['bank'] = Bank::find_by_code($withdrawal->bank_code);
		$this->content_view	= 'admin/withdrawals/view';
	}
	public function paid($id = FALSE)
	{
		if (!is_numeric($id) || Withdrawal::count(array('conditions' => array('id = ?', $id))) != 1)
			redirect('admin/withdrawals/all');

		$withdrawal	= Withdrawal::find(array('conditions' => array('id = ?', $id)));
		if ($withdrawal->status != 'open' AND $withdrawal->status != 'chargeback')
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Este saque não pode ser pago!'));
		else
		{
			if($withdrawal->status == 'open'){
			/* Atualizar saldos */
			$update = User::find($withdrawal->user_id);
			$update->balance_reserved -= ($withdrawal->value + $withdrawal->tax);
			$update->save();
			}

			$withdrawal->status = 'paid';
			$withdrawal->last_update = date('Y-m-d H:i:s');
			$withdrawal->payment_date = date('Y-m-d H:i:s');
			$withdrawal->last_edit = date('Y-m-d H:i:s');
			$withdrawal->last_editor = $this->admin->id;
			$withdrawal->save();
		}
		redirect('admin/withdrawals/view/' . $id);
  }
	public function cancel($id = FALSE)
	{
		if (!is_numeric($id) || Withdrawal::count(array('conditions' => array('id = ?', $id))) != 1)
			redirect('admin/withdrawals/all');

		$withdrawal	= Withdrawal::find(array('conditions' => array('id = ?', $id)));
		if ($withdrawal->status == 'cancel')
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Este saque não pode ser cancelado!'));
		else
		{
			/* Atualizar saldos */
			$update = User::find($withdrawal->user_id);
			$update->balance += ($withdrawal->value + $withdrawal->tax);
			if($withdrawal->status == 'open') $update->balance_reserved -= ($withdrawal->value + $withdrawal->tax);
			$update->save();

			/* Adicionar ao extrato */
			$insert = array();
			$insert['user_id']		= $withdrawal->user_id;
			$insert['date']			= date('Y-m-d H:i:s');
			$insert['value']		= $withdrawal->value;
			$insert['description']	= 'Estorno Solicitação de saque';
			$insert['type']			= 'credit';
			$insert['subtype']		= 'withdrawal';
			Extract::create($insert);

			if($withdrawal->tax > 0){
			/* Adicionar ao extrato */
			$insert = array();
			$insert['user_id']		= $withdrawal->user_id;
			$insert['date']			= date('Y-m-d H:i:s');
			$insert['value']		= $withdrawal->tax;
			$insert['description']	= 'Estorno Taxa solicitação de saque';
			$insert['type']			= 'credit';
			$insert['subtype']		= 'withdrawal';
			Extract::create($insert);
			}

			$withdrawal->status = 'cancel';
			$withdrawal->last_update = date('Y-m-d H:i:s');
			$withdrawal->last_edit = date('Y-m-d H:i:s');
			$withdrawal->last_editor = $this->admin->id;
			$withdrawal->save();
		}
		redirect('admin/withdrawals/view/' . $id);
  }
	public function chargeback($id = FALSE)
	{
		if (!is_numeric($id) || Withdrawal::count(array('conditions' => array('id = ?', $id))) != 1)
			redirect('admin/withdrawals/all');

		$withdrawal	= Withdrawal::find(array('conditions' => array('id = ?', $id)));
		if ($withdrawal->status != 'paid')
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Este saque não pode ser estornado!'));
		else
		{

			$withdrawal->status = 'chargeback';
			$withdrawal->last_update = date('Y-m-d H:i:s');
			$withdrawal->last_edit = date('Y-m-d H:i:s');
			$withdrawal->last_editor = $this->admin->id;
			$withdrawal->save();
		}
		redirect('admin/withdrawals/view/' . $id);
  }
}
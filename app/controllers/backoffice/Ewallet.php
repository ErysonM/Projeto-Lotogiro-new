<?php

/**
* Author:      Felipe Medeiros
* File:        Ewallet.php
* Created in:  24/06/2016 - 18:06
*/
class Ewallet extends MY_Controller
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

	$this->params['module_name'] = 'Financeiro';
	$module_name = $lang['financeiro'];
	$this->breadcrumbs->push($module_name, '/backoffice/ewallet');
}

public function index(){ redirect('backoffice/ewallet/withdrawal'); }

public function extract($year = FALSE, $month = FALSE)
{
	$idioma = "pt-br";
	if(!empty($_COOKIE['idioma']))
	{
		$idioma = $_COOKIE['idioma'];
	}

	$file = substr(APPPATH, 0, strlen(APPPATH)-4);
	$path = $file."langs/backoffice/".$idioma.".php";
	include($path);

	$this->params['page_name'] = 'Extrato mensal';
	$page_name = $lang['extrato_mensal'];
	$this->breadcrumbs->push($page_name, '/backoffice/ewallet/extract');
	$this->content_view	= 'backoffice/ewallet/extract';

	if (!$year)		$year	= date('Y');
	$this->params['year']	= $year;
	if (!$month)	$month	= date('m');
	$this->params['month']	= $month;

	$start_date	= $year . '-' . $month . '-01 00:00:00';
	$end_date	= $year . '-' . $month . '-' . days_in_month($month) . ' 23:59:59';

	$this->params['credits']	= Extract::find_by_sql("SELECT SUM(`value`) AS `value` FROM `extracts` WHERE `type` = 'credit' AND `user_id` = '{$this->user->id}' AND `date` BETWEEN '{$start_date}' AND '{$end_date}'")[0]->value;
	$this->params['debits']		= Extract::find_by_sql("SELECT SUM(`value`) AS `value` FROM `extracts` WHERE `type` = 'debit' AND `user_id` = '{$this->user->id}' AND `date` BETWEEN '{$start_date}' AND '{$end_date}'")[0]->value;
	$this->params['losts']		= Extract::find_by_sql("SELECT SUM(`value`) AS `value` FROM `extracts` WHERE `type` = 'lost' AND `user_id` = '{$this->user->id}' AND `date` BETWEEN '{$start_date}' AND '{$end_date}'")[0]->value;
	$this->params['balance']	= $this->params['credits'] - $this->params['debits'];
	$this->params['extracts']	= Extract::find_by_sql("SELECT * FROM `extracts` WHERE `user_id` = '{$this->user->id}' AND `date` BETWEEN '{$start_date}' AND '{$end_date}' ORDER BY `date` ASC");
}

public function withdrawal()
{
	$idioma = "pt-br";
	if(!empty($_COOKIE['idioma']))
	{
		$idioma = $_COOKIE['idioma'];
	}

	$file = substr(APPPATH, 0, strlen(APPPATH)-4);
	$path = $file."langs/backoffice/".$idioma.".php";
	include($path);

	if ($this->input->post())
	{
		$data = $this->input->post();

		$data['amount'] = grava_money($data['amount']);


		$creditswithdrawal	= Extract::find_by_sql("SELECT SUM(`value`) AS `value` FROM `extracts` WHERE `type` = 'credit' AND  `subtype` != 'recharge' AND `user_id` = '{$this->user->id}'")[0]->value;

		$debitswithdrawal	= Extract::find_by_sql("SELECT SUM(`value`) AS `value` FROM `extracts` WHERE `type` = 'debit' AND `user_id` = '{$this->user->id}'")[0]->value;

		$calculo = $creditswithdrawal - $debitswithdrawal;
		if($calculo <= 0) $calculo = 0;

		#### CALCULO NECESSARIO APENAS DEVIDO A QUESTÃO DE PODER SACAR O PROPRIO SALDO RECARREGADO.

		if ($this->settings->lock_withdrawal == 'Y')
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['saque_des']));
		elseif ($data['amount'] < $this->settings->min_withdrawal)
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['saque_minimo'].' ' . display_money($this->settings->min_withdrawal) . '!'));
		elseif (empty($data['type']))
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['forma_recebimento']));	
		elseif (!in_array($data['type'], array('transferencia', 'bitcoin')))
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['forma_recebimento']));		
		elseif ($data['amount'] > $this->user->balance)
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['saldo_insuficiente']));
		elseif ($data['amount'] > $calculo)
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['saldo_insuficiente']));
		elseif ((empty($this->user->bank_agency) OR empty($this->user->bank_account)) AND $data['type'] == 'transferencia')
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['preencha_dados_bancarios']));
		elseif (empty($this->user->bitcoin_address) AND $data['type'] == 'bitcoin')
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['preencha_carteira_bitcoin']));
		else
		{

			$tax = (($data['amount'] * $this->settings->withdrawal_percent) / 100);
			$tax = number_format($tax, 2, '.', '');

			$valuelesstax = $data['amount'] - $tax;
			$valuelesstax = number_format($valuelesstax, 2, '.', '');


			/* Adicionar solicitação de saque */
			$insert = array();
			$insert['user_id']				= $this->user->id;
			$insert['date']					= date('Y-m-d H:i:s');
			$insert['value']				= $valuelesstax;
			$insert['tax']					= $tax;
			$insert['bank_code']			= $this->user->bank_code;
			$insert['bank_agency']			= $this->user->bank_agency . ' - ' . $this->user->bank_agency_digit;
			$insert['bank_account']			= $this->user->bank_account . ' - ' . $this->user->bank_account_digit;
			$insert['bank_account_type']	= $this->user->bank_account_type;
			$insert['gateway']				= $data['type'];
			$insert['bank_account_type']	= $this->user->bank_account_type;
			$insert['bitcoin_address']		= $this->user->bitcoin_address;
			Withdrawal::create($insert);

			/* Adicionar ao extrato */
			$insert = array();
			$insert['user_id']		= $this->user->id;
			$insert['date']			= date('Y-m-d H:i:s');
			$insert['value']		= $valuelesstax;
			$insert['description']	= $lang['solicitacao_saque'];
			$insert['type']			= 'debit';
			$insert['subtype']		= 'withdrawal';
			Extract::create($insert);

			/* Adicionar ao extrato */
			$insert = array();
			$insert['user_id']		= $this->user->id;
			$insert['date']			= date('Y-m-d H:i:s');
			$insert['value']		= $tax;
			$insert['description']	= $lang['taxa_sol_saque'];
			$insert['type']			= 'debit';
			$insert['subtype']		= 'withdrawal';
			Extract::create($insert);

			/* Atualizar saldos */
			$update = User::find($this->user->id);
			$update->balance -= $data['amount'];
			$update->balance_reserved += $data['amount'];
			$update->save();

			$this->session->set_flashdata('message', array('type' => 'success', 'text' => $lang['solicitacao_ok']));
		}

		redirect('backoffice/ewallet/withdrawal');
		exit;
	}

	$this->params['page_name'] = 'Solicitações de saque';
	$page_name = $lang['solicitacoes_saque'];
	$this->breadcrumbs->push($page_name, '/backoffice/ewallet/withdrawal');
	$this->params['withdrawals'] = Withdrawal::all(array('conditions' => array('user_id = ?', $this->user->id)));

	$this->params['creditswithdrawal']	= Extract::find_by_sql("SELECT SUM(`value`) AS `value` FROM `extracts` WHERE `type` = 'credit' AND  `subtype` != 'recharge' AND `user_id` = '{$this->user->id}'")[0]->value;

	$this->params['debitswithdrawal']	= Extract::find_by_sql("SELECT SUM(`value`) AS `value` FROM `extracts` WHERE `type` = 'debit' AND `user_id` = '{$this->user->id}'")[0]->value;

	$this->content_view	= 'backoffice/ewallet/withdrawal';
}

public function view($id = FALSE)
{
	if (!$id || !is_numeric($id) || !($withdrawal = Withdrawal::find(array('conditions' => array('id = ? and user_id = ?', $id, $this->user->id))))) redirect('backoffice/ewallet/withdrawal');

	$idioma = "pt-br";
	if(!empty($_COOKIE['idioma']))
	{
		$idioma = $_COOKIE['idioma'];
	}

	$file = substr(APPPATH, 0, strlen(APPPATH)-4);
	$path = $file."langs/backoffice/".$idioma.".php";
	include($path);

	$this->params['header_button']	= '<div class="btn-group heading-btn">
	<a href="' . site_url('backoffice/ewallet/withdrawal') . '" class="btn bg-teal btn-labeled">
	<b><i class="icon-circle-left2"></i></b>'.
	$lang['voltar']
	.'</a>
	</div>';

	$this->params['page_name'] = $lang['saque'].' #'.$id;
	$this->breadcrumbs->push($this->params['page_name'], '/backoffice/ewallet/view/'.$id);

	$this->params['withdrawal'] = $withdrawal;
	$this->params['beneficiario'] = User::find_by_id($withdrawal->user_id);
	$this->params['bank'] = Bank::find_by_code($withdrawal->bank_code);
	$this->content_view	= 'backoffice/ewallet/view';
}

public function transfer()
{
	$idioma = "pt-br";
	if(!empty($_COOKIE['idioma']))
	{
		$idioma = $_COOKIE['idioma'];
	}

	$file = substr(APPPATH, 0, strlen(APPPATH)-4);
	$path = $file."langs/backoffice/".$idioma.".php";
	include($path);

	if ($this->input->post())
	{
		$data = $this->input->post();

		$valorcru = grava_money($data['amount']);

		$calculo = (($valorcru * $this->settings->transfer_percent) / 100);

		$valorcheio = $calculo + $valorcru;

		if ($this->settings->lock_transfer == 'Y')
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['transferencia_des']));
		elseif ($valorcheio < $this->settings->transfer_min)
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['transferencia_minimo'].' ' . display_money($this->settings->transfer_min) . '!'));
		elseif (empty($data['id_to']))
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['digite_id_dest']));	
		elseif (empty($data['msg']))
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['digite_referencia']));		
		elseif ($valorcheio > $this->user->balance)
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['saldo_insuficiente']));
		elseif (User::count(array('conditions' => array('id' => $data['id_to']))) == 0)
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['id_dest_inexistente']));
		elseif ($data['password'] != $this->encrypt->decode($this->user->password))
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['senha_incorreta']));
		elseif ($data['id_to'] == $this->user->id)
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['transferir_proprio']));
		else
		{
			/* Adicionar  transferencia */
			$insert = array();
			$insert['id_from']			= $this->user->id;
			$insert['id_to']			= $data['id_to'];
			$insert['date']				= date('Y-m-d H:i:s');
			$insert['valuefull']		= $valorcheio;
			$insert['valuewithdisc']	= $valorcru;
			$insert['valuedisc']		= $calculo;
			$insert['percentdisc']		= $this->settings->transfer_percent;
			$insert['msg']				= $data['msg'];
			$pgid = Transfer::create($insert);

			$transferid = $pgid->id;

			/* Adicionar ao extrato */
			$insert = array();
			$insert['user_id']		= $this->user->id;
			$insert['date']			= date('Y-m-d H:i:s');
			$insert['value']		= $valorcheio;
			$insert['description']	= $lang['transferencia'].'.';
			$insert['type']			= 'debit';
			$insert['subtype']		= 'transfer';
			$insert['transfer_id']  = $transferid;
			Extract::create($insert);

			$insert = array();
			$insert['user_id']		= $data['id_to'];
			$insert['date']			= date('Y-m-d H:i:s');
			$insert['value']		= $valorcru;
			$insert['description']	= $lang['transferencia'].'.';
			$insert['type']			= 'credit';
			$insert['subtype']		= 'transfer';
			$insert['transfer_id']  = $transferid;
			Extract::create($insert);

			/* Atualizar saldos */
			$update = User::find($this->user->id);
			$update->balance -= $valorcheio;
			$update->save();

			$update = User::find($data['id_to']);
			if($update->first_recharge == 'N' AND $update->status == 'inactive') $update->status = 'active';
			$update->balance += $valorcru;
			$update->save();

			$this->session->set_flashdata('message', array('type' => 'success', 'text' => $lang['transferencia_ok']));
		}

		redirect('backoffice/ewallet/transfer');
		exit;
	}

	$this->params['page_name'] = 'Transferir Saldo';
	$page_name = $lang['transferir_saldo'];
	$this->breadcrumbs->push($page_name, '/backoffice/ewallet/transfer');

	$this->params['transfers'] = Transfer::find_by_sql("SELECT * FROM `transfers` WHERE (`id_from` = '{$this->user->id}' OR  `id_to` = '{$this->user->id}')"); 


	Transfer::all(array('conditions' => array('id_from = ?', $this->user->id)));
	$this->content_view	= 'backoffice/ewallet/transfer';
}

public function payout()
{
	$idioma = "pt-br";
	if(!empty($_COOKIE['idioma']))
	{
		$idioma = $_COOKIE['idioma'];
	}

	$file = substr(APPPATH, 0, strlen(APPPATH)-4);
	$path = $file."langs/backoffice/".$idioma.".php";
	include($path);

	if ($this->input->post())
	{
		$data = $this->input->post();

		$value = grava_money($data['value']);

		if ($this->settings->lock_payout == 'Y')
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['faturas_des']));
		elseif (empty($data['invoice_id']))
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['digite_num_fatura']));	
		elseif (empty($data['msg']))
		$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['digite_referencia']));		
		elseif ($value > $this->user->balance)
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['saldo_insuficiente']));
		elseif (!($invoice = Invoice::find(['conditions' => ['id = ?', $data['invoice_id']]])))
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['fatura_inexistente']));
		elseif ($data['password'] != $this->encrypt->decode($this->user->password))
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['senha_incorreta']));
		elseif ($invoice->sum != $value)
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['valor_fatura_div']));
		elseif ($invoice->status != 'open')
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['fatura_nao_aberta']));
		else
		{

			/* Adicionar pagamento de fatura */
			$insert = array();
			$insert['user_id']			= $this->user->id;
			$insert['owner_id']			= $invoice->user_id;
			$insert['invoice_id']		= $data['invoice_id'];
			$insert['date']				= date('Y-m-d H:i:s');
			$insert['value']			= $value;
			$insert['msg']				= $data['msg'];
			$pgid = Payout::create($insert);

			$payoutid = $pgid->id;

			/* Adicionar ao extrato */
			$insert = array();
			$insert['user_id']		= $this->user->id;
			$insert['date']			= date('Y-m-d H:i:s');
			$insert['value']		= $value;
			$insert['description']	= $lang['pagar_faturas'].'.';
			$insert['type']			= 'debit';
			$insert['subtype']		= 'payment';
			$insert['transfer_id']  = $payoutid;
			Extract::create($insert);

			/* Atualizar saldos */
			$update = User::find($this->user->id);
			$update->balance -= $value;
			$update->save();


			/* Roda bonus e faz ações que tem que fazer nesse sistema */
			$this->load->helper('invoice_paid');
			$payment_method = 'payout';
			invoice_paid($data['invoice_id'], $payment_method);


			$this->session->set_flashdata('message', array('type' => 'success', 'text' => $lang['fatura_ok']));
		}

		redirect('backoffice/ewallet/payout');
		exit;
	}

	$this->params['page_name'] = 'Pagar Faturas';
	$page_name = $lang['pagar_faturas'];
	$this->breadcrumbs->push($page_name, '/backoffice/ewallet/payout');

	$this->params['payouts'] = Payout::all(array('conditions' => array('user_id = ?', $this->user->id)));
	$this->content_view	= 'backoffice/ewallet/payout';
}

}
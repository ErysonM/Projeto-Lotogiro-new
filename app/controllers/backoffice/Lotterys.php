<?php
/**
 * Project:    mmn.dev
 * File:       Lotterys.php
 * Author:     Felipe Medeiros
 * Createt at: 09/06/2016 - 06:41
 */
class Lotterys extends MY_Controller
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

		$this->params['module_name'] = 'Loterias';
		$module_name = $lang['loterias'];
		$this->breadcrumbs->push($module_name, '/backoffice/lotterys');
	}
	public function index()
	{
		$idioma = "pt-br";
		if(!empty($_COOKIE['idioma']))
		{
			$idioma = $_COOKIE['idioma'];
		}

		$file = substr(APPPATH, 0, strlen(APPPATH)-4);
		$path = $file."langs/backoffice/".$idioma.".php";
		include($path);

		$this->params['page_name'] = 'Geral';
		$page_name = $lang['geral'];
		$this->breadcrumbs->push($page_name, '/backoffice/lotterys');
		$this->content_view	= 'backoffice/lottery/index';
		
		
		$this->params['lotterys']	= Lotter::all([
			'conditions' => ['status = ?', 'open'],
			'order' => 'id desc'
		]);
		$this->params['lotterys2']	= Lotter::all([
			'conditions' => ['status != ?', 'open'],
			'order' => 'id desc'
		]);
		$this->params['wins']	= LottersWinner::all([
			'conditions' => ['winner_id = ?', $this->user->id],
			'order' => 'id desc'
		]);
				
	}
	public function view($id = FALSE)
	{
		if (!$id || !is_numeric($id) || !($lottery = Lotter::find(array('conditions' => array('id = ?', $id))))) redirect('backoffice/lotterys');

		$idioma = "pt-br";
		if(!empty($_COOKIE['idioma']))
		{
			$idioma = $_COOKIE['idioma'];
		}

		$file = substr(APPPATH, 0, strlen(APPPATH)-4);
		$path = $file."langs/backoffice/".$idioma.".php";
		include($path);

		$this->params['header_button']	= '<div class="btn-group heading-btn">
			<a href="' . site_url('backoffice/lotterys') . '" class="btn bg-teal btn-labeled">
				<b><i class="icon-circle-left2"></i></b>'.
				$lang['voltar']
			.'</a>
		</div>';
		
		if ($this->input->post())
		{
			$data = $this->input->post();

			$amount = $data['amount'];
		
			$contagemtickets = LottersTicket::count(array('conditions' => array('lottery_id = ? and user_id = ?', $id, $this->user->id)));
			$calculodetickets = $contagemtickets + $amount;
			$valornecessario = $contagemtickets * $lottery->ticket_price;
			$calc1 = $lottery->buyed_tickets + $amount;
			$calc2 = $contagemtickets + $amount;
			
			if ($lottery->status != 'open')
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['loteria_nao_aberta']));
			elseif (!is_numeric($amount) || $amount <= 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['digite_qtd']));
			elseif ($lottery->buyed_tickets >= $lottery->max_tickets AND $lottery->max_tickets != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['tickets_esgotados']));
			elseif ($calc1 > $lottery->max_tickets AND $lottery->max_tickets != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['ultrapassou_qtd']));
			elseif ($calc2 > $lottery->max_tickets_person AND $lottery->max_tickets_person != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['ultrapassou_qtd']));	
			elseif ($valornecessario > $this->user->balance)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => $lang['saldo_insuficiente']));
			else
			{

				/* Adicionar Tickets */
			for ($n = 1; $n <= $amount; $n++) {
				$insert = array();
				$insert['lottery_id']			= $id;
				$insert['user_id']				= $this->user->id;
				$insert['date']					= date('Y-m-d H:i:s');
				LottersTicket::create($insert);
			}

				/* Adicionar ao extrato */
				$insert = array();
				$insert['user_id']		= $this->user->id;
				$insert['date']			= date('Y-m-d H:i:s');
				$insert['value']		= $valornecessario;
				$insert['description']	= $lang['compra_de'].' '.$amount.' '.$lang['tickets_loteria'].' #'.$id.'.';
				$insert['type']			= 'debit';
				$insert['subtype']		= 'other';
				Extract::create($insert);

				/* Atualizar saldos */
				$update = User::find($this->user->id);
				$update->balance -= $valornecessario;
				$update->save();
				
				/* Atualizar Loteria */
				$lottery->buyed_tickets += $amount;
				$lottery->save();

				$this->session->set_flashdata('message', array('type' => 'success', 'text' => $lang['tickets_realizada']));
			}

			redirect('backoffice/lotterys/view/'.$id);
			exit;
		}


		$this->params['page_name'] = 'Loteria #'.$id;
		$page_name = $lang['loteria'].' #'.$id;
		$this->breadcrumbs->push($page_name, '/backoffice/lotterys/view/'.$id);

		$this->params['lottery'] = $lottery;
		$this->params['meustickets'] = LottersTicket::all(array('conditions' => array('lottery_id = ? and user_id = ?', $id, $this->user->id)));
		$this->params['contagemtickets'] = LottersTicket::count(array('conditions' => array('lottery_id = ? and user_id = ?', $id, $this->user->id)));
		$this->params['winners']	= LottersWinner::all([
			'conditions' => ['lottery_id = ?', $id],
			'order' => 'position asc'
		]);
		$this->content_view	= 'backoffice/lottery/view';
	}
}
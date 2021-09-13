<?php
use App\Libraries\Datatables;

class Lotterys extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->admin)
			redirect('admin/login');

		$this->params['module_name'] = 'Loterias';
		$this->breadcrumbs->push($this->params['module_name'], '/admin/lottery');
	}

	public function index()
	{
		$this->params['page_name'] = 'Lista';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/lottery/all');
		$this->content_view	= 'admin/lottery/all';

		$this->params['lotterys']	= Lotter::all([
			'order' => 'id desc'
		]);
	}
	public function create()
	{
		
			if ($this->input->post()){
			$data = $this->input->post();
			$data['value_initial'] = grava_money($data['value_initial']);
			$data['ticket_price'] = grava_money($data['ticket_price']);
			
			if (empty($data['name']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o nome!'));
			elseif (empty($data['description']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha a descrição!'));
			elseif (!in_array($data['type'], array('fix','acum')))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Escolha o tipo de loteria!'));	
			elseif (empty($data['percent_emp']) AND $data['percent_emp'] != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha a % da empresa!'));
			elseif (empty($data['value_initial']) AND $data['value_initial'] != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o valor inicial!'));	
			elseif (empty($data['ticket_price']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o valor do ticket!'));					
			elseif (empty($data['buyed_tickets']) AND $data['buyed_tickets'] != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha os tickets comprados!'));	
			elseif (empty($data['max_tickets']) AND $data['max_tickets'] != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o maximo de tickets vendidos!'));	
			elseif (empty($data['max_tickets_person']) AND $data['max_tickets_person'] != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o maximo de tickets por pessoa!'));					
			elseif (empty($data['ends']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha a data de fim do sorteio!'));		
			elseif (date('Y-m-d H:i:s') >= $data['ends'])
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'O fim do sorteio não pode ser inferior a data de hoje!'));		
			else {
			$data['status'] = 'open';
			$data['value_total'] = 0;
			$data['value_win'] = 0;
			$data['create_by'] = $this->admin->id;
			$data['starts'] = date('Y-m-d H:i:s');
			$data['winners'] = 1;
			$data['winner_id'] = 0;
			if (Lotter::create($data)) 
				$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Loteria adicionada!'));					
			else 
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Algum problema ocorreu!'));

			redirect('admin/lotterys');
			exit;
			}
		}
		
		$this->params['page_name'] = 'Nova Loteria';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/lotterys/create');
		$this->content_view	= 'admin/lottery/create';
	}
	public function edit($id = FALSE)
	{

			if (!$id || !is_numeric($id) || !($lottery = Lotter::find_by_id($id)))
			redirect('admin/announcements');

			if ($this->input->post()){
			$data = $this->input->post();
			$data['value_initial'] = grava_money($data['value_initial']);
			$data['ticket_price'] = grava_money($data['ticket_price']);
			
			if (empty($data['name']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o nome!'));
			elseif (empty($data['description']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha a descrição!'));
			elseif (!in_array($data['type'], array('fix','acum')))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Escolha o tipo de loteria!'));	
			elseif (empty($data['percent_emp']) AND $data['percent_emp'] != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha a % da empresa!'));
			elseif (empty($data['value_initial']) AND $data['value_initial'] != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o valor inicial!'));	
			elseif (empty($data['ticket_price']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o valor do ticket!'));					
			elseif (empty($data['buyed_tickets']) AND $data['buyed_tickets'] != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha os tickets comprados!'));	
			elseif (empty($data['max_tickets']) AND $data['max_tickets'] != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o maximo de tickets vendidos!'));	
			elseif (empty($data['max_tickets_person']) AND $data['max_tickets_person'] != 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o maximo de tickets por pessoa!'));					
			elseif (empty($data['ends']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha a data de fim do sorteio!'));		
			elseif (date('Y-m-d H:i:s') >= $data['ends'])
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'O fim do sorteio não pode ser inferior a data de hoje!'));		
			else {
			$lottery->name = $data['name'];
			$lottery->ends = $data['ends'];
			$lottery->max_tickets = $data['max_tickets'];
			$lottery->max_tickets_person = $data['max_tickets_person'];
			$lottery->buyed_tickets = $data['buyed_tickets'];
			//$lottery->ticket_price = $data['ticket_price'];
			$lottery->description = $data['description'];
			$lottery->value_initial = $data['value_initial'];
			$lottery->type = $data['type'];
			$lottery->percent_emp = $data['percent_emp'];
			//$lottery->winners = 1; 
			$lottery->last_edit = date('Y-m-d H:i:s');
			$lottery->last_editor = $this->admin->id;
			if ($lottery->save()) 
				$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Loteria alterada!'));
			else 
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Algum problema ocorreu!'));

			redirect('admin/lotterys/edit/' .$id);
			exit;
			}
		}

		$this->params['lottery']	= $lottery;
		$this->params['lasteditor']	= Admin::find_by_id($lottery->last_editor);
		$this->params['create_by']	= Admin::find_by_id($lottery->create_by);
		
		###MUDAR FUTURAMENTE PARA TER MAIS DE UM GANHADOR/PREMIO
		if($lottery->status == 'paid') $this->params['winner'] = User::find_by_id($lottery->winner_id);
		###MUDAR FUTURAMENTE PARA TER MAIS DE UM GANHADOR/PREMIO
		
		$this->params['page_name'] = 'Alterar Loteria';
		$this->breadcrumbs->push($this->params['page_name'] . ' - #' . $id, '/admin/lotterys/edit/' . $id);
		$this->content_view	= 'admin/lottery/edit';
	}
	public function cancel($id = FALSE)
	{
		if (!$id || !is_numeric($id) || !($lottery = Lotter::find_by_id($id)))
			redirect('admin/lotterys');
		
		if ($lottery->status != "open")
			redirect('admin/lotterys');
		
			#### CANCELA LOTTERY
			$lottery->status 		= 'cancel';
			$lottery->winner_id 	= 0;
			$lottery->value_win 	= 0;
			$lottery->value_total 	= 0;
			$lottery->last_edit 	= date("Y-m-d H:i:s");
			$lottery->last_editor 	= $this->admin->id;
			#### CANCELA LOTTERY
			
			
			if (LottersTicket::count(array('conditions' => array('lottery_id = ?', $lottery->id))) > 0){
			
			$tickets = LottersTicket::all(['conditions' => ['lottery_id = ?', $lottery->id]]);
			
			foreach ($tickets as $ticket)
			{
				
			#### INSERE EXTRATO ESTORNO
			$insertextract = array();
			$insertextract['user_id']		= $ticket->user_id;
			$insertextract['date']			= date('Y-m-d H:i:s');
			$insertextract['value']			= $lottery->ticket_price;
			$insertextract['description']	= 'Estorno Loteria. #'.$lottery->id.'';
			$insertextract['type']			= 'credit';
			$insertextract['bonus_cod']		= 2;
			$insertextract['subtype']		= 'bonus';
			$insertextract['lottery_id']	= $lottery->id;
			Extract::create($insertextract);
			#### INSERE EXTRATO ESTORNO
			
			#### INCLUI SALDO ESTORNO
			$user = User::find_by_id($ticket->user_id);
			$user->balance += $lottery->ticket_price; //CREDITA VALOR ESTORNO
			$user->save();
			#### INCLUI SALDO ESTORNO
		
				}
			}
			
		if ($lottery->save())
			$this->session->set_flashdata('message', ['text' => 'Loteria cancelada!', 'type' => 'success']);
		else
			$this->session->set_flashdata('message', ['text' => 'Houve algum problema!', 'type' => 'error']);

		redirect('admin/lotterys');
	}
}
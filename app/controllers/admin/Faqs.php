<?php
use App\Libraries\Datatables;

class Faqs extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->admin)
			redirect('admin/login');

		$this->params['module_name'] = 'F.A.Q';
		$this->breadcrumbs->push($this->params['module_name'], '/admin/faqs');
	}
	public function index() { redirect('admin/faqs/all'); }
	public function all()
	{
		$this->params['page_name'] = 'Lista';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/faqs/all');
		$this->content_view	= 'admin/faqs/all';

		$this->params['faqs']	= Faq::all();
	}
	public function create()
	{
			if ($this->input->post()){
			$data = $this->input->post();
			if (empty($data['title']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o titulo!'));
			elseif (empty($data['number']) OR $data['number'] < 1)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o numero!'));
			elseif (empty($data['text']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o texto!'));
			elseif (Faq::count(array('conditions' => array('number' => $data['number']))) > 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Numero já em uso! Tente outro.'));
			else {
			$data['date'] = date('Y-m-d');
			$data['last_editor'] = $this->admin->id;
			if (Faq::create($data)) 
				$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'F.A.Q adicionado!'));					
			else 
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Algum problema ocorreu!'));

			redirect('admin/faqs');
			exit;
			}
		}
		$this->params['ultimoid'] = Faq::last();
		$this->params['page_name'] = 'Novo F.A.Q';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/faqs/create');
		$this->content_view	= 'admin/faqs/create';
	}
	public function edit($id = FALSE)
	{

			if (!$id || !is_numeric($id) || !($faq = Faq::find_by_id($id)))
			redirect('admin/faqs');

			if ($this->input->post()){
			$data = $this->input->post();
			if (empty($data['title']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o titulo!'));
			elseif (empty($data['number']) OR $data['number'] < 1)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o numero!'));
			elseif (empty($data['text']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o texto!'));
			elseif (Faq::count(array('conditions' => array('number' => $data['number']))) > 0 AND $data['number'] != $faq->number)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Numero já em uso! Tente outro.'));
			else {
			$faq->title = $data['title'];
			$faq->number = $data['number'];
			$faq->text = $data['text'];
			$faq->last_edit = date('Y-m-d');
			$faq->last_editor = $this->admin->id;
			if ($faq->save()) 
				$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'F.A.Q alterado!'));
			else 
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Algum problema ocorreu!'));

			redirect('admin/faqs/edit/' .$id);
			exit;
			}
		}

		$this->params['faq']	= $faq;
		$this->params['lasteditor']	= Admin::find_by_id($faq->last_editor);

		$this->params['page_name'] = 'Alterar F.A.Q';
		$this->breadcrumbs->push($this->params['page_name'] . ' - #' . $number, '/admin/faqs/edit/' . $id);
		$this->content_view	= 'admin/faqs/edit';
	}
	public function delete($id = FALSE)
	{
		if (!$id || !is_numeric($id) || !($faq = Faq::find_by_id($id)))
			redirect('admin/faqs');

		if ($faq->delete())
			$this->session->set_flashdata('message', ['text' => 'F.A.Q excluido!', 'type' => 'success']);
		else
			$this->session->set_flashdata('message', ['text' => 'Houve algum problema!', 'type' => 'error']);

		redirect('admin/faqs/all');
	}
}
<?php
use App\Libraries\Datatables;

class Announcements extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->admin)
			redirect('admin/login');

		$this->params['module_name'] = 'Comunicados';
		$this->breadcrumbs->push($this->params['module_name'], '/admin/announcements');
	}
	public function index() { redirect('admin/announcements/all'); }
	public function all()
	{
		$this->params['page_name'] = 'Lista';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/announcements/all');
		$this->content_view	= 'admin/announcements/all';

		$this->params['announcements']	= Announcement::all();
	}
	public function view($slug = FALSE)
	{
		if (!$slug || !($announcement = Announcement::find(['conditions' => ['slug = ?', $slug]])))
		{
			$this->session->set_flashdata('message', ['text' => 'Comunicado inexistente!', 'type' => 'error']);
			redirect('admin/announcements/all');
		}

		$this->params['header_button']	= '<div class="btn-group heading-btn">
			<a href="' . site_url('admin/announcements/all') . '" class="btn bg-teal btn-labeled">
				<b><i class="icon-circle-left2"></i></b>
				Voltar
			</a>
		</div>';

		$this->params['page_name']		= $announcement->title;
		$this->breadcrumbs->push($this->params['page_name'], '/admin/announcements/view/' . $announcement->slug);
		$this->params['announcement']	= $announcement;
		$this->content_view				= 'admin/announcements/view';
	}
	public function create()
	{
			if ($this->input->post()){
			$data = $this->input->post();
			if (empty($data['title']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o titulo!'));
			elseif (empty($data['slug']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha a referencia URL!'));
			elseif (!in_array($data['priority'], array('1','2','3')))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha a prioridade!'));
			elseif (empty($data['body']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o texto!'));
			elseif (Announcement::count(array('conditions' => array('slug' => $data['slug']))) > 0)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Referencia URL já em uso! Tente outra.'));
			else {
			$data['date'] = date('Y-m-d H:i:s');
			$data['last_editor'] = $this->admin->id;
			if (Announcement::create($data)) 
				$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Comunicado adicionado!'));					
			else 
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Algum problema ocorreu!'));

			redirect('admin/announcements');
			exit;
			}
		}
		
		$this->params['page_name'] = 'Novo Comunicado';
		$this->breadcrumbs->push($this->params['page_name'], '/admin/announcements/create');
		$this->content_view	= 'admin/announcements/create';
	}
	public function edit($id = FALSE)
	{

			if (!$id || !is_numeric($id) || !($announcement = Announcement::find_by_id($id)))
			redirect('admin/announcements');

			if ($this->input->post()){
			$data = $this->input->post();
			if (empty($data['title']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o titulo!'));
			elseif (empty($data['slug']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha a referencia URL!'));
			elseif (!in_array($data['priority'], array('1','2','3')))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha a prioridade!'));
			elseif (empty($data['body']))
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha o texto!'));
			elseif (Announcement::count(array('conditions' => array('slug' => $data['slug']))) > 0 AND $data['slug'] != $announcement->slug)
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Referencia URL já em uso! Tente outra.'));
			else {
			$announcement->title = $data['title'];
			$announcement->slug = $data['slug'];
			$announcement->priority = $data['priority'];
			$announcement->body = $data['body'];
			$announcement->last_edit = date('Y-m-d H:i:s');
			$announcement->last_editor = $this->admin->id;
			if ($announcement->save()) 
				$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Comunicado alterado!'));
			else 
				$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Algum problema ocorreu!'));

			redirect('admin/announcements/edit/' .$id);
			exit;
			}
		}

		$this->params['announcement']	= $announcement;
		$this->params['lasteditor']	= Admin::find_by_id($announcement->last_editor);

		$this->params['page_name'] = 'Alterar Comunicado';
		$this->breadcrumbs->push($this->params['page_name'] . ' - #' . $id, '/admin/announcements/edit/' . $id);
		$this->content_view	= 'admin/announcements/edit';
	}
	public function delete($id = FALSE)
	{
		if (!$id || !is_numeric($id) || !($anuncio = Announcement::find_by_id($id)))
			redirect('admin/announcements');

		if ($anuncio->delete())
			$this->session->set_flashdata('message', ['text' => 'Comunicado excluido!', 'type' => 'success']);
		else
			$this->session->set_flashdata('message', ['text' => 'Houve algum problema!', 'type' => 'error']);

		redirect('admin/announcements/all');
	}
}
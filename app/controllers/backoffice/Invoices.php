<?php

/**
 * Project:    mmn.dev
 * File:       Invoices.php
 * Author:     Felipe Medeiros
 * Createt at: 27/05/2016 - 20:49
 */

class Invoices extends MY_Controller
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

		$this->params['module_name']	= 'Faturas';
		$module_name = $lang['faturas'];
		$this->breadcrumbs->push($module_name, '/backoffice/invoices');
	}	
	public function index() { redirect('backoffice/invoices/all'); }

	public function all($filter = FALSE)
	{
		$idioma = "pt-br";
		if(!empty($_COOKIE['idioma']))
		{
			$idioma = $_COOKIE['idioma'];
		}

		$file = substr(APPPATH, 0, strlen(APPPATH)-4);
		$path = $file."langs/backoffice/".$idioma.".php";
		include($path);

		$this->params['page_name']	= 'Lista';
		$page_name = $lang['lista'];
		$this->breadcrumbs->push($page_name, '/backoffice/invoices/all');

		$this->params['invoices'] = Invoice::all(array('conditions' => array('user_id = ?', $this->user->id)));
		$this->content_view = 'backoffice/invoices/all';
	}

	public function view($id = FALSE)
	{
		if (!is_numeric($id) || Invoice::count(array('conditions' => array('id = ? and user_id = ?', $id, $this->user->id))) != 1)
			redirect('backoffice/invoices');

		$idioma = "pt-br";
		if(!empty($_COOKIE['idioma']))
		{
			$idioma = $_COOKIE['idioma'];
		}

		$file = substr(APPPATH, 0, strlen(APPPATH)-4);
		$path = $file."langs/backoffice/".$idioma.".php";
		include($path);

		$invoice	 = Invoice::find(array('conditions' => array('id = ? and user_id = ?', $id, $this->user->id)));
		$this->params['invoice'] = $invoice;

		$user		 = User::find(array('conditions' => array('id = ?', $invoice->user_id)));
		$this->params['user'] = $user;
		
		$comprovant = Comprovant::all(array('conditions' => array('invoice_id = ?', $invoice->id)));
		$this->params['comprovants'] = $comprovant;

		$this->params['page_name']	= $lang['ver_fatura'];
		$this->breadcrumbs->push($lang['fatura_num'] . $invoice->id, '/backoffice/invoices/view/' . $invoice->id);

		$this->content_view = 'backoffice/invoices/view';
	}
    public function upload($id = NULL)
    {
		if (!is_numeric($id) || Invoice::count(array('conditions' => array('id = ? and user_id = ? and status = ?', $id, $this->user->id, 'open'))) != 1)
			redirect('backoffice/invoices');
		
			$idioma = "pt-br";
			if(!empty($_COOKIE['idioma']))
			{
				$idioma = $_COOKIE['idioma'];
			}

			$file = substr(APPPATH, 0, strlen(APPPATH)-4);
			$path = $file."langs/backoffice/".$idioma.".php";
			include($path);
		
            $config['upload_path']          = './assets/uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1000;
            $config['encrypt_name']			= true;

            $this->load->library('upload', $config);

	        if(Comprovant::count(array('conditions' => array('invoice_id = ?', $id))) >= 3) {
	        $this->session->set_flashdata('message', ['text' => $lang['max_3_anexos'], 'type' => 'error']);
	        redirect('backoffice/invoices/view/'.$id);
	        die;
	    	}


            if (!$this->upload->do_upload('comprovante')) {
            $error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('message', ['text' => $lang['erro1'], 'type' => 'error']);
			redirect('backoffice/invoices/view/'.$id);
            } else {
            //$data = array('upload_data' => $this->upload->data());
           	$data = $this->upload->data();

            $datainsert['invoice_id'] = $id;
			$datainsert['date'] = date('Y-m-d H:i:s');
			$datainsert['filename'] = $this->upload->data('file_name'); 
			$datainsert['filename_original'] = $this->upload->data('orig_name'); 

			if (Comprovant::create($datainsert)) $this->session->set_flashdata('message', ['text' => $lang['upload_com_ok'], 'type' => 'success']);
			else $this->session->set_flashdata('message', ['text' => $lang['erro1'], 'type' => 'error']);
			redirect('backoffice/invoices/view/'.$id);
            }
    }
}
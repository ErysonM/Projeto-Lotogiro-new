<?php
class Settings extends MY_Controller
{
public function __construct()
{
parent::__construct();
if (!$this->user)
redirect('backoffice/login');

$this->params['module_name']	= 'Configurações';
$this->breadcrumbs->push($this->params['module_name'], '/backoffice/settings');
}
public function index() { redirect('backoffice/settings/profile'); }
public function profile()
{
if ($this->input->post())
{
$data = $this->input->post();
if (!in_array($data['gender'], array('female', 'male')))
$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Informações invalidas!'));
elseif (empty($data['phone']) && empty($data['mobilephone']))
$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Você deve informar ao menos um telefone para contato!'));
else
{
$update = User::find($this->user->id);
$update->gender = $data['gender'];
$update->phone = $data['phone'];
$update->mobilephone = $data['mobilephone'];
$update->save();
$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Informações alteradas com sucesso!'));
}
redirect('backoffice/settings/profile');
exit;
}

$this->params['page_name']	= 'Perfil';
$this->breadcrumbs->push($this->params['page_name'], '/backoffice/settings/profile');
$this->content_view				= 'backoffice/settings/profile';

$this->params['sponsor']		= User::find_by_id($this->user->enroller);
}
public function address()
{
if ($this->input->post())
{
$data = $this->input->post();
if (empty($data['address_zip']) || empty($data['address_street']) || empty($data['address_number']) || empty($data['address_district']) || empty($data['address_city']) || empty($data['address_state'])  || empty($data['country']))
$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha todos os campos!'));		
elseif (Countrie::count(array('conditions' => array('code = ?', $data['country']))) != 1)
$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Pais inexistente!'));
else
{
$update = User::find($this->user->id);
foreach ($data as $key => $value)
$update->{$key} = $value;;
$update->save();
$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Informações alteradas com sucesso!'));
}
redirect('backoffice/settings/address');
exit;
}
$this->params['page_name']	= 'Endereço';
$this->breadcrumbs->push($this->params['page_name'], '/backoffice/settings/address');
$this->content_view				= 'backoffice/settings/address';

$query = Countrie::all(['order' => 'name asc']);
$loadinfo = array();
foreach ($query as $row) {
$code = $row->code;
$loadinfo[$code] = $row->name;
}

$this->params['options'] = $loadinfo;

}
public function bank()
{
if ($this->input->post())
{
$data = $this->input->post();
if (empty($data['bank_code']) || empty($data['bank_agency']) || !isset($data['bank_agency_digit']) || empty($data['bank_account']) || !isset($data['bank_account_digit']))
$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha todos os campos!'));
elseif (!in_array($data['bank_account_type'], array('corrente', 'poupanca')))
$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Tipo de conta invalido!'));
else
{
$update = User::find($this->user->id);
foreach ($data as $key => $value)
$update->{$key} = $value;
$update->save();
$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Informações alteradas com sucesso!'));
}
redirect('backoffice/settings/bank');
exit;
}

$this->params['page_name'] = 'Conta bancária';
$this->breadcrumbs->push($this->params['page_name'], '/backoffice/settings/bank');

$this->params['banks'] = Bank::all(array('order' => 'code asc'));
$this->content_view = 'backoffice/settings/bank';
}
public function password()
{
if ($this->input->post())
{
$data = $this->input->post();
if ($data['password'] != $this->encrypt->decode($this->user->password))
$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Senha atual invalida!'));
elseif ($data['password'] == $data['new_password'])
$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'A nova senha deve ser diferente da atual!'));
elseif ($data['new_password'] != $data['confirm_new_password'])
$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'As senhas não conferem!'));
elseif (strlen($data['new_password']) < 6)
$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'A nova senha deve ter no minimo 6 caracteres!'));
else
{
$update = User::find($this->user->id);
$update->password = $this->encrypt->encode($data['new_password']);
$update->save();
$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Sua senha foi alterada com sucesso!'));
}
redirect('backoffice/settings/password');
exit;
}

$this->params['page_name'] = 'Alterar senha';
$this->breadcrumbs->push($this->params['page_name'], '/backoffice/settings/password');
$this->content_view = 'backoffice/settings/password';
}
public function link()
{
if ($this->input->post())
{
$data = $this->input->post();
if (empty($data['link']))
$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Preencha todos os campos!'));
elseif (strlen($data['link']) < 3 || strlen($data['link']) > 15)
$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'O link deve ter entre 3 e 15 caracteres!'));
elseif (!preg_match("/^[a-z0-9-_]+$/", $data['link']))
$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Você não pode usar caracteres especiais!'));
elseif (User::count(array('conditions' => array('link = ?', $data['link']))) != 0)
$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Este link já esta em uso por outra pessoa!'));
elseif ($this->user->link != '')
$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Você ja definiu seu link!'));
else
{
$update = User::find($this->user->id);
$update->link = $data['link'];
$update->save();
$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Seu link de indicação foi atualizado!'));
}
redirect('backoffice/settings/link');
exit;
}
$this->params['page_name'] = 'Link de indicação';
$this->breadcrumbs->push($this->params['page_name'], '/backoffice/settings/link');
$this->content_view = 'backoffice/settings/link';
}
public function bitcoin()
{
if ($this->input->post())
{
$data = $this->input->post();

$update = User::find($this->user->id);
$update->bitcoin_address = $data['bitcoin_address'];
$update->save();
$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Informações alteradas com sucesso!'));

redirect('backoffice/settings/bitcoin');
exit;
}
$this->params['page_name'] = 'Carteira Bitcoin';
$this->breadcrumbs->push($this->params['page_name'], '/backoffice/settings/bitcoin');
$this->content_view = 'backoffice/settings/bitcoin';
}
public function avatar()
{
if ($this->input->post())
{
$data = $this->input->post();
if (empty($data['avatar']))
$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Escolha um avatar!'));
elseif (!($avatar = Avataravaible::find_by_id($data['avatar'])))
$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Este avatar não existe!'));
elseif (($avatar->geral == 'N') AND (Avatar::count(array('conditions' => array('avatar_id = ? and user_id = ?', $data['avatar'], $this->user->id))) != 1))
$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Você não possui este avatar!'));
else
{
$update = User::find($this->user->id);
$update->avatar = $data['avatar'];
$update->save();
$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Avatar alterado com sucesso!'));
}
redirect('backoffice/settings/avatar');
exit;
}

$this->params['avatarsavaible'] = Avataravaible::all(array('conditions' => array('geral = ?', 'Y')));
$this->params['avatars'] = Avatar::all(array('conditions' => array('user_id = ?', $this->user->id)));
$this->params['page_name'] = 'Avatar';
$this->breadcrumbs->push($this->params['page_name'], '/backoffice/settings/avatar');
$this->content_view = 'backoffice/settings/avatar';
}
}
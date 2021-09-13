<?php
/**
 * Author:      Felipe Medeiros
 * File:        Mail.php
 * Created in:  25/06/2016 - 00:59
 */
class Mail extends CI_Controller
{
	public function verify()
	{
	$setting = Setting::first();
	
		$users = User::all([
			'conditions' => [
				'status = ?',
				'inactive'
			]]);
		foreach ($users as $user)
		{
			//if($user->id == 11527){
			
					//$user->email = "admin@estarcash.tech";
					# Enviar email
					$this->load->library('parser');
					$this->email->from($setting->company_email, $setting->company_name);
					$this->email->reply_to($setting->company_email, $setting->company_name);
					$this->email->to($user->email);
					$this->email->subject('Global Marketing - Oportunidade');
					$name = "".$user->firstname." ".$user->lastname."";
					$msg = "Caro investidor, identificamos seu interesse em participar de nossa oportunidade e lhe parabenizamos por isto.<br>
Centenas de pessoas estão obtendo ganhos em dinheiro com nosso plano de investimentos e nossa recompensa em equipe.<br>
Pessoas comuns que nunca tiveram ganhos na internet estão conseguindo resultados que não acreditavam que seriam possíveis.<br>
Com a valorização da moedas virtuais em especial do Bitcoin nossas operações estão com resultados acima da média o que nos mostra que só estamos no inicio de um caminho de vitória e realização de sonhos.<br>
Você que ainda não fez sua ativação em nossa operação não fique de fora, a oportunidade não bate a sua porta duas vezes, esteja ciente que o seu futuro depende de suas ações e que as vezes temos que ter coragem e dar o primeiro passo.<br>
Lembrando que para ser um investidor e participar do plano de recompensas InvesteJovem você pode começar com o investimento mínimo de $10,00 o equivalente a +- R$34,00.<br>
<br>Duvidas estamos a disposição.
<br><br>06/06/2017, São Paulo - SP.<br>";
					
					
					$parse_data = array(
						'title'		=> 'ComunicadoGlobal Marketing',
						'msg'		=> $msg,
						'name'		=> $name,
						'link'		=> site_url(),
						'logo'		=> $setting->company_name,
						'logo_dark'	=> $setting->company_name,
						'company'	=> $setting->company_name
					);
					$email = read_file(APPPATH . 'views/templates/email_mailing.html');
					$message = $this->parser->parse_string($email, $parse_data);
					$this->email->message($message);
					$this->email->send();
				
			//}
		}	
				
 	}
}
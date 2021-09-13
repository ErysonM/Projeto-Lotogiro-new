<?php
/**
 * Author:      Felipe Medeiros
 * File:        Lottery.php
 * Created in:  25/06/2016 - 00:59
 */
class Lottery extends CI_Controller
{
	public function executelottery()
	{

	$this->verify();
	$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Loterias executas com sucesso!'));				
	redirect('admin/lotterys');
	
 	}
	
	public function verify()
	{
		$lotterys = Lotter::all([
			'conditions' => [
				'ends <= ? and status = ?',
				date('Y-m-d H:i:s'), 'open'
			]]);
		foreach ($lotterys as $lottery)
		{
		
		#### ATUALMENTE A LOTERIA SÓ TEM UM VENCEDOR, UPGRADE FUTURO MAIS DE UM VENCEDOR.

		if (LottersTicket::count(array('conditions' => array('lottery_id = ?', $lottery->id))) == 0){
			
		#CANCELA LOTTERY POR NÃO TER VENDIDO NENHUM TICKET.	
		$lottery->status 		= 'cancel';
		$lottery->winner_id 	= 0;
		$lottery->value_win 	= 0;
		$lottery->value_total 	= 0;
		$lottery->last_edit 	= date("Y-m-d H:i:s");
		$lottery->save();
		#CANCELA LOTTERY POR NÃO TER VENDIDO NENHUM TICKET.
		
		} else {
		
		#### PEGA O TICKET GANHADOR.
		$winner = LottersTicket::find_by_sql("SELECT * FROM `lotters_tickets` WHERE `lottery_id`='{$lottery->id}' order by rand() limit 1")[0];
		#### PEGA O TICKET GANHADOR.

		if($lottery->type == 'fix') $value_base = $lottery->value_initial;
		else $value_base = $lottery->value_initial+($lottery->buyed_tickets*$lottery->ticket_price);
	
		$value_total = $value_base;
		$percentcalc = (($value_base * $lottery->percent_emp) / 100);
		$value_win = $value_total - $percentcalc;

		#### INSERE NA TABELA DE  GANHADORES
		$insertwinner = array();
		$insertwinner['lottery_id']	= $lottery->id;
		$insertwinner['ticket_id']	= $winner->id;
		$insertwinner['winner_id']	= $winner->user_id;
		$insertwinner['position']	= 1;
		$insertwinner['value_win']	= $value_win;
		LottersWinner::create($insertwinner);
		#### INSERE NA TABELA DE  GANHADORES
		
		#### INSERE EXTRATO
		$insertextract = array();
		$insertextract['user_id']		= $winner->user_id;
		$insertextract['date']			= date('Y-m-d H:i:s');
		$insertextract['value']			= $value_win;
		$insertextract['description']	= 'Prêmio Loteria. #'.$lottery->id.'';
		$insertextract['type']			= 'credit';
		$insertextract['bonus_cod']		= 2;
		$insertextract['subtype']		= 'bonus';
		$insertextract['lottery_id']	= $lottery->id;
		Extract::create($insertextract);
		#### INSERE EXTRATO
		
		#### INCLUI SALDO AO WINNER
		$user = User::find_by_id($winner->user_id);
		$user->balance += $value_win; //CREDITA VALOR BONUS
		$user->save();
		#### INCLUI SALDO AO WINNER
	
		#### ATUALIZA LOTTERY
		$lottery->status 		= 'paid';
		$lottery->winner_id 	= $winner->user_id;
		$lottery->value_win 	= $value_win;
		$lottery->value_total 	= $value_total;
		$lottery->last_edit 	= date("Y-m-d H:i:s");
		$lottery->save();
		#### ATUALIZA LOTTERY
		
		}
		
		echo "Loteria #".$lottery->id." executada com sucesso.<br>";

		}
 	}
}
<?php
/**
 * Project:    mmn.dev
 * File:       invoice_paid_helper.php
 * Author:     Felipe Medeiros
 * Createt at: 27/05/2016 - 09:25
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @param bool $user_id
 * @param bool $data
 * @param int  $level
 */
function invoice_paid($id, $payment_method)
{
	//$instance &= get_instance();

	$invoice = Invoice::find_by_id($id);

	/* Atualizar Pedido */
	$invoice->status 		 = 'paid';
	$invoice->payment_date	 = date('Y-m-d H:i:s');
	$invoice->last_att		 = date('Y-m-d H:i:s');
	$invoice->payment_method = $payment_method;
	$invoice->save();

	/* Insere extrato */
	/*$insert = array();
	$insert['user_id']		= $invoice->user_id;
	$insert['date']			= date('Y-m-d H:i:s');
	$insert['value']		= $invoice->sum;
	$insert['description']	= 'Recarga de céditos.';
	$insert['type']			= 'credit';
	$insert['subtype']		= 'recharge';
	$insert['invoice_id']   = $invoice->id;
	Extract::create($insert);*/

	/* Atualizar usuário */
	$update = User::find($invoice->user_id);
	
	$calculo = (($invoice->sum / 100) * 200);
	$update->teto += $calculo;
	
	//if($update->first_recharge == 'N') $update->status = 'active'; //ATIVA USUARIO NA PRIMEIRA COMPRA.
	//if($update->first_recharge == 'N') $update->status = 'active'; // COMPROU SE ATIVOU
	 $update->status = 'active';
	//$update->balance += $invoice->sum; //CREDITA RECARGA NO USUARIO.
	//$update->pacpoints += $invoice->sum; //CREDITA RECARGA NO USUARIO.
	//if($update->first_recharge == 'N'){ //DA O BONUS DE PRIMEIRA RECARGA
	//$update->balance_special += $invoice->sum;
	//}
	if($update->first_recharge == 'N') $update->first_recharge = 'Y';

	$update->last_buy = date('Y-m-d H:i:s');
	$update->month_validate = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' +1 month'));
	$update->save();

	/* Insere avatar */
	/*$avatar = Avataravaible::find($invoice->avatar_id);
	$insert = array();
	$insert['user_id']		= $invoice->user_id;
	$insert['avatar_id']	= $invoice->avatar_id;
	$insert['starts']		= date('Y-m-d H:i:s');
	//$insert['ends']		= date('Y-m-d H:i:s');
	$insert['temporary']	= $avatar->temporary;
	Avatar::create($insert);*/

	bonus_indication($update->enroller, 1, $id);
	
	binary($invoice->user_id, $id);

	//MUDA STATUS DO PEDIDO
	//PAGA BONUS
}
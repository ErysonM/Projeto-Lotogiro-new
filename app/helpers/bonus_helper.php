<?php
/**
 * Project:    mmn.dev
 * File:       bonus_helper.php
 * Author:     Felipe Medeiros
 * Createt at: 27/05/2016 - 09:25
 */
defined('BASEPATH') OR exit('No direct script access allowed');


function bonus_indication($user_id = FALSE, $level = FALSE, $pedid = FALSE)
{

	if (!is_numeric($user_id) || !is_numeric($pedid) || User::count(array('conditions' => array('id = ?', $user_id))) != 1) return false;

	$user = User::find_by_id($user_id);

	if($level == 1) $percent = 25;
	elseif($level == 2) $percent = 5;
	elseif($level == 3) $percent = 5;
	elseif($level == 4) $percent = 5;
	elseif($level == 5) $percent = 5;
	elseif($level == 6) $percent = 5;
	
	$invoice = Invoice::find_by_id($pedid);

	$valorganho = (($invoice->sum * $percent) / 100);
	$valorganho = number_format($valorganho, 2, '.', '');

	/* Insere extrato */
	$insert = array();
	$insert['user_id']		= $user_id;
	$insert['date']			= date('Y-m-d H:i:s');
	$insert['value']		= $valorganho;
	if($level == 1) $insert['description'] = 'Bonus de indicação direta.';
	else $insert['description'] = 'Bonus de indicação indireta.';

	if($user->teto > $user->ganhos AND $user->status == 'active') 
		$insert['type']			= 'credit';
	else
		$insert['type']			= 'lost';
	
	if($level == 1) $insert['bonus_cod'] = 1;
	else $insert['bonus_cod'] = 2;
	$insert['subtype']		= 'bonus';
	$insert['invoice_id']   = $pedid;
	Extract::create($insert);

	if($user->teto > $user->ganhos AND $user->status == 'active'){
	/* Atualizar usuário */
	$user->balance += $valorganho; //CREDITA VALOR BONUS
	$user->ganhos += $valorganho;
	$user->save();
	}

	if (!$level)	$level = 1;
	else			++$level;

	if ($level <= 6 AND $user->enroller != 0) bonus_indication($user->enroller, $level, $pedid);

}
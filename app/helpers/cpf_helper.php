<?php
/**
 * Project:    mmn.dev
 * File:       cpf_helper.php
 * Author:     Felipe Medeiros
 * Createt at: 27/05/2016 - 09:25
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @param bool $cpf
 * @return bool
 */
function check_cpf($cpf = FALSE)
{
	if (empty($cpf))	return FALSE;

	$cpf = preg_replace('/[^0-9]/', '', $cpf);
	$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
	 
	if (strlen($cpf) != 11)	return FALSE;
	elseif (
		$cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444'
		|| $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999'
	)	return FALSE;
	else
	{
		for ($t = 9; $t < 11; $t++)
		{
			for ($d = 0, $c = 0; $c < $t; $c++)
				$d += $cpf{$c} * (($t + 1) - $c);

			$d = ((10 * $d) % 11) % 10;
			if ($cpf{$c} != $d)	return FALSE;
		}
		return TRUE;
	}
}

/**
 * @param bool $birthday
 * @return bool|float
 */
function calc_age($birthday = FALSE)
{
	if (!$birthday)	return FALSE;

	list($day, $month, $year) = explode('/', $birthday);
	$birthday	= mktime(0, 0, 0, $month, $day, $year);
	$today		= mktime(0, 0, 0, date('m'), date('d'), date('Y'));

	return floor((((($today - $birthday) / 60) / 60) / 24) / 365.25);
}
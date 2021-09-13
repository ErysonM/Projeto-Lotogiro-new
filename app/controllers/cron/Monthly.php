<?php
/**
 * Author:      Felipe Medeiros
 * File:        Monthly.php
 * Created in:  25/06/2016 - 00:59
 */
class Monthly extends CI_Controller
{
	public function extractmonth($month = FALSE)
	{
		$month = date("m", strtotime("-1 month"));
		$start_date	= date('Y') . '-' . $month . '-01 00:00:00';
		$end_date	= date('Y') . '-' . $month . '-' . days_in_month($month) . ' 23:59:59';
		$month2 = date("m", strtotime("+1 month"));

		$users = User::all();
		foreach ($users as $user)
		{
			$balance	= 0;
			$extracts	= Extract::find_by_sql("SELECT * FROM `extracts` WHERE `user_id` = '{$user->id}' AND (`type` = 'credit' OR `type` = 'debit') AND `date` BETWEEN '{$start_date}' AND '{$end_date}' ORDER BY `date` ASC");
			foreach ($extracts as $extract)
			{
				if ($extract->type == 'credit')		$balance += $extract->value;
				elseif ($extract->type == 'debit')	$balance -= $extract->value;	
			}

			if($balance != 0){
			# Debitar do mês anterior
			$insert					= [];
			$insert['date']			= $end_date;
			$insert['user_id']		= $user->id;
			$insert['description']	= 'Saldo transferido para próximo mês.';
			$insert['type']			= 'debit';
			$insert['subtype']		= 'other';
			$insert['value']		= $balance;
			Extract::create($insert);

			$insert					= [];
			$insert['date']			= date('Y') . '-' . ($month2) . '-01 00:00:00';
			$insert['user_id']		= $user->id;
			$insert['description']	= 'Saldo transferido do mês anterior.';
			$insert['type']			= 'credit';
			$insert['subtype']		= 'other';
			$insert['value']		= $balance;
			Extract::create($insert);
			}
		}
		
		echo 'Saldos transferidos para o proximo mês com sucesso.';
	}
}
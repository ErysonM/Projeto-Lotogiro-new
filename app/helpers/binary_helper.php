<?php
/**
 * Project:    mmn.dev
 * File:       binary_helper.php
 * Author:     Felipe Medeiros
 * Createt at: 27/05/2016 - 09:25
 */
defined('BASEPATH') OR exit('No direct script access allowed');

function get_user($owner_id, $direction)
{
    $direction = 'u'.$direction;
	$tree = Binarytree::find_by_sql("SELECT * FROM `binarytrees` WHERE `user_id` = '{$owner_id}' LIMIT 1")[0];
	if (($userId = $tree->{$direction}))
	{
		$user = User::find_by_id($userId);
		return $user;
	}

	return FALSE;
}

function create_tree($userId)
{
	Binarytree::create(['user_id' => $userId]);

	return Binarytree::find_by_user_id($userId);
}
function get_direction($user)
{
$user = User::find_by_id($user);

if($user->position == 'left') $ladoescolhido = 'left';
elseif($user->position == 'right') $ladoescolhido = 'right';
elseif($user->position == 'auto') {
if($user->pleft > $user->pright) $ladoescolhido = 'right';
elseif($user->pleft < $user->pright) $ladoescolhido = 'left';	
else $ladoescolhido = 'left';	
}
return $ladoescolhido;
}
function binary($user_id = FALSE, $pedid = FALSE)
{

	if (!is_numeric($user_id) || !is_numeric($pedid) || User::count(array('conditions' => array('id = ?', $user_id))) != 1) return false;

	$user = User::find_by_id($user_id);
	
	$posicionado = Binarytree::find_by_user_id($user_id);
	if(!$posicionado){
		
	$createtree = create_tree($user_id);
		
	$sponsor = User::find_by_id($user->enroller);

	$tree = Binarytree::find_by_user_id($sponsor->id);
	
	$directionx = get_direction($sponsor->id);
	$direction = "u".$directionx."";

	if ($tree->{$direction} == 0)
	{
		$tree->{$direction} = $user->id;
		$tree->save();

		//return $sponsor->id;
	} else
	{
		$search = array($tree->{$direction});
		$actual = reset($search);

		while ($actual)
		{
			$tree = Binarytree::find_by_user_id($actual);
			$directionx = get_direction($tree->user_id);
			$direction = "u".$directionx."";
			
			if ($tree->{$direction} == 0)
			{
				$tree->{$direction} = $user->id;
				$tree->save();
				break;
			} else
			{
				$search[] = $tree->{$direction};
				$actual = next($search);
			}
		}
	}
   }
   $ped = Invoice::find_by_id($pedid);
   $points = intval($ped->sum);
   $updatepoints = update_points($user_id, $points);
   
  }
function update_points($user = FALSE, $points = FALSE)
{
	$actual = $user;
	$continue = TRUE;
	while ($continue)
	{
		$tree = Binarytree::find_by_sql("SELECT * FROM `binarytrees` WHERE (`uleft` = '{$actual}' OR `uright` = '{$actual}') LIMIT 1")[0];
		if (!$tree)
		{
			$continue = FALSE;
			break;
		} else
		{
			$update = User::find_by_id($tree->user_id);
			
			if ($tree->uleft == $actual)
				$update->pleft += $points;
			elseif ($tree->uright == $actual)
				$update->pright += $points;
				
			$update->save();

			$actual = $tree->user_id;
			if (!$actual)
			{
				$continue = FALSE;
				break;
			}
		}
	}
  }
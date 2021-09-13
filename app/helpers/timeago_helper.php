<?php
/**
 * Project:    mmn.dev
 * File:       timeeago_helper.php
 * Author:     Felipe Medeiros
 * Createt at: 27/05/2016 - 09:25
 */
defined('BASEPATH') OR exit('No direct script access allowed');
    
function time_ago($timeago, $short = FALSE)
{
	$instance =& get_instance();

	$now = time();
	$timepices = array();
	if (!is_numeric($timeago))
		$timeago = human_to_unix($timeago);

	$timespan = timespan($timeago, $now); 
	$timespan = explode(',',  trim($timespan)); 
	foreach ($timespan as $key => $value)
	{
		$timespanvalue = explode(' ', trim($value)); 
		$arrayvalue = $timespanvalue[0] . ' ' . $instance->lang->line('application_' . $timespanvalue[1]); 
		$timepices[$key] = $arrayvalue;
	}
	$return = $timepices[0];
	if (isset($timepices[1]) && $short == FALSE)
		$return .= ' ' . $instance->lang->line('application_and') . ' ' . $timepices[1];

	$return .= ' ' . $instance->lang->line('application_ago');
	return $return;
}

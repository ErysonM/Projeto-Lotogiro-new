<?php
/**
 * Project:    mmn.dev
 * File:       Invoice.php
 * Author:     Felipe Medeiros
 * Createt at: 09/06/2016 - 02:41
 */
class Invoice extends ActiveRecord\Model
{
	static $belongs_to = array(
		array('user')
	);
	static $has_many = array(
		array("invoices_items")
	);
}
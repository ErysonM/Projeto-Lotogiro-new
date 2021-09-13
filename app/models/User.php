<?php
/**
 * Project:    mmn.dev
 * File:       User.php
 * Author:     Felipe Medeiros
 * Createt at: 09/06/2016 - 06:43
 */
class User extends ActiveRecord\Model
{
	static $belongs_to	= [
		['sponsor', 'foreign_key' => 'enroller', 'class_name' => 'User']
	];
}
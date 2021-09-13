<?php
/**
 * Project:    mmn.dev
 * File:       gravatar_helper.php
 * Author:     Felipe Medeiros
 * Createt at: 27/05/2016 - 09:25
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @param        $email
 * @param int    $s
 * @param string $d
 * @param string $r
 * @param bool   $img
 * @param array  $atts
 * @return string
 */
function get_gravatar($email, $s = 40, $d = 'mm', $r = 'g', $img = FALSE, $atts = array())
{
	$url = '//www.gravatar.com/avatar/';
	$url .= md5(strtolower(trim($email)));
	$url .= "?s={$s}&d={$d}&r={$r}";
	if (!$url)
		$url = base_url('upload/media/no-pic.png');
	return $url;
}

/**
 * @param bool $pic
 * @param bool $email
 * @return string
 */
function get_user_pic($pic = FALSE, $email = FALSE)
{
	if ($pic != 'no-pic.png')
		return base_url("upload/media/" . $pic);
	else
		return get_gravatar($email);
}
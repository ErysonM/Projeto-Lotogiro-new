<?php
/**
* Project:    MMN-VIP
* File:       tree_helper.php
* Author:     Felipe Sites
* Createt at: 27/05/2016 - 09:25
*/
defined('BASEPATH') OR exit('No direct script access allowed');

function make_linear($enroller, $level = FALSE) {
if (!$level)	$level = 1;
else			++$level;
$users = User::all(['conditions' => ['enroller = ?', $enroller], 'order' => 'id asc']);
if ($users) {

$idioma = "pt-br";
if(!empty($_COOKIE['idioma']))
{
	$idioma = $_COOKIE['idioma'];
}

$file = substr(APPPATH, 0, strlen(APPPATH)-4);
$path = $file."langs/backoffice/".$idioma.".php";
include($path);

$return = '';
foreach ($users as $user) {
$return	.= '<tr>
<td class="text-center"><span class="badge bg-teal">' . $level . '</span></td>
<td>' . $user->firstname . ' ' . $user->lastname . '</td>
<td>' . $user->email . '</td>
<td class="text-center">' . $user->mobilephone . '</td>
<td class="text-center"><span class="label label-'; 
if($user->banned == 'Y'): $return .= 'warning';
elseif($user->status != 'active'): $return .= 'default';
else: $return .= 'success';
endif; $return .= '">'; 
if ($user->banned == 'Y'): $return .= strtoupper($lang['bloqueado']);
elseif ($user->status != 'active'): $return .= strtoupper($lang['pendente']);
else: $return .= strtoupper($lang['ativo']);
endif; $return .= '</span></td>
</tr>';
if ($level < 6)
$return	.= make_linear($user->id, $level);
}
return $return;
}
return FALSE;
}

function count_linear($enroller, $level = FALSE) {
global $i;
if (!$level)	$level = 1;
else			++$level;
$users = User::all(['conditions' => ['enroller = ?', $enroller], 'order' => 'id asc']);
if ($users) {
foreach ($users as $user) {
++$i;
if ($level < 6) count_linear($user->id, $level);
}
return $i;
}
return FALSE;
}

function count_inlevels($enroller, $level = FALSE) {
$idioma = "pt-br";
if(!empty($_COOKIE['idioma']))
{
	$idioma = $_COOKIE['idioma'];
}

$file = substr(APPPATH, 0, strlen(APPPATH)-4);
$path = $file."langs/backoffice/".$idioma.".php";
include($path);

global $i;
global $nolevel1;
global $nolevel2;
global $nolevel3;
global $nolevel4;
global $nolevel5;
global $nolevel6;
if (!$level)	$level = 1;
else			++$level;
$users = User::all(['conditions' => ['enroller = ?', $enroller], 'order' => 'id asc']);
if ($users) {
foreach ($users as $user) {
++$i;
if($level == 1) ++$nolevel1;
if($level == 2) ++$nolevel2;
if($level == 3) ++$nolevel3;
if($level == 4) ++$nolevel4;
if($level == 5) ++$nolevel5;
if($level == 6) ++$nolevel6;
if ($level < 6) count_inlevels($user->id, $level);
}
}
if(empty($nolevel1)) $nolevel1 = 10;
if(empty($nolevel2)) $nolevel2 = 8;
if(empty($nolevel3)) $nolevel3 = 5;
if(empty($nolevel4)) $nolevel4 = 3;
if(empty($nolevel5)) $nolevel5 = 1;
if(empty($nolevel6)) $nolevel6 = 1;
$nivel = $lang['nivel'];
$return = "
<h1>&nbsp;&nbsp; $nivel 1: <b>".$nolevel1."</b> - $nivel 2: <b>".$nolevel2."</b> - $nivel 3: <b>".$nolevel3."</b> - $nivel 4: <b>".$nolevel4."</b> - $nivel 5: <b>".$nolevel5."</b> - $nivel 6: <b>".$nolevel6."</b> </h1>";
return $return;
}
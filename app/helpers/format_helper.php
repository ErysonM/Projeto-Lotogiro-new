<?php
/**
 * Project:    mmn.dev
 * File:       format_helper.php
 * Author:     Felipe Medeiros
 * Createt at: 26/05/2016 - 23:55
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @param      $value
 * @param bool $currency
 * @param int  $decimal
 * @return string
 */
function display_money($value, $currency = FALSE, $decimal = 2) // EXIBIR EM TEXTO. (CONTEM SIMBOLO MONETARIO)
{
    $settings = Setting::first();
    if ($currency === FALSE) $currency = $settings->currency;
    switch ($settings->money_format)
    {
        case 1:
            $value = number_format($value, $decimal, '.', ',');
            break;
        case 2:
            $value = number_format($value, $decimal, ',', '.');
            break;
        case 3:
            $value = number_format($value, $decimal, '.', '');
            break;
        case 4:
            $value = number_format($value, $decimal, ',', '');
            break;
        default:
            $value = number_format($value, $decimal, '.', ',');
            break;
    }
    switch ($settings->money_currency_position)
    {
        case 1:
            $return = $currency . ' ' . $value;
            break;
        case 2:
            $return = $value . ' ' . $currency;
            break; 
        case FALSE:
            $return = $value;
            break;          
        default:
            $return = $currency . ' ' . $value;
            break;
    }

    return $return;
}

function display_money2($value, $decimal = 2) //EXIBIR EM CAMPOS. (REMOVE SIMBOLO MONETARIO)
{
    $settings = Setting::first();
    switch ($settings->money_format)
    {
        case 1:
            $return = number_format($value, $decimal, '.', ',');
            break;
        case 2:
            $return = number_format($value, $decimal, ',', '.');
            break;
        case 3:
            $return = number_format($value, $decimal, '.', '');
            break;
        case 4:
            $return = number_format($value, $decimal, ',', '');
            break;
        default:
            $return = number_format($value, $decimal, '.', ',');
            break;
    }

    return $return;
}

function grava_money($value, $decimal = 2) //TRATA PARA GRAVAR NA DB.
{
    $settings = Setting::first();
    switch ($settings->money_format)
    {
        case 1:
            $value = str_replace("," , "" , $value); // tira virgula
            break;
        case 2:
            $value = str_replace("." , "" , $value); // tira ponto
            $value = str_replace("," , "." , $value); // virgula por ponto
            break;
        case 3:
            $value = $value;
            break;
        case 4:
            $value = str_replace("," , "." , $value); // virgula por ponto
            break;
        default:
            $value = str_replace("," , "" , $value); // tira virgula
            break;
    }

    $value = number_format($value, $decimal, '.', '');
    return $value;
}

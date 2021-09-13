<?php
if(isset($_GET['lang']) && $_GET['lang'] != null){
    $novoidioma = $_GET['lang'];
    $path = "langs/backoffice/".$novoidioma.".php";
    if(file_exists($path)){
        setcookie("idioma", $novoidioma, time()+(24*3600*30));
        $arq = $_SERVER['PHP_SELF'];
        $arq2 = explode("/", $arq);
        $arq3 = end($arq2);
        header("Location: $arq3");
    }else{
        echo "<script>alert('Este idioma não está disponível.');</script>"; 
    }
}

if(isset($_COOKIE['idioma'])){
    $idioma = $_COOKIE['idioma'];
    $caminho = "langs/backoffice/".$idioma.".php";
if(file_exists($caminho)){
    include($caminho);
}else{
    exit(); 
}
}else{
    $idioma = "pt-br";
    setcookie("idioma","pt-br", time()+(24*3600*30));
    include("langs/backoffice/pt-br.php");
}
?>
<div class="panel panel-<?php
                            if($withdrawal->status == 'open')       echo 'primary';
                        elseif($withdrawal->status == 'paid')       echo 'success';
                        elseif($withdrawal->status == 'chargeback') echo 'danger';
                        elseif($withdrawal->status == 'cancel')     echo 'danger';
                        ?> panel-bordered">
    <div class="panel-heading p-10">
        <h6 class="panel-title"><b><i class="icon-coins position-left"></i>  ID #<?php echo $withdrawal->id?> - <?php echo ucfirst($beneficiario->firstname)?> <?php echo ucfirst($beneficiario->lastname)?> - <?php echo ucfirst($withdrawal->gateway);?></b></h6>
    </div>
    <div class="panel-body p-10">
        <center>
            <h3><?=$lang['solicitacao_saque_id']?>#<?php echo $withdrawal->id;?> <br>
                <?=$lang['beneficiado']?>: <?php echo ucfirst($beneficiario->firstname)?> <?php echo ucfirst($beneficiario->lastname)?><br>
                Forma de recebimento: <?php echo ucfirst($withdrawal->gateway)?><br>
                <?=$lang['valor']?>: <?php echo display_money($withdrawal->value);?> </h3>
            <span class="label label-<?php
                            if($withdrawal->status == 'open')       echo 'primary';
                        elseif($withdrawal->status == 'paid')       echo 'success';
                        elseif($withdrawal->status == 'chargeback') echo 'danger';
                        elseif($withdrawal->status == 'cancel')     echo 'danger';
                        ?> col-md-6 col-md-offset-3" style="font-size: 20px; margin-bottom:20px;">
                        <?php
                            if($withdrawal->status == 'open')       echo strtoupper($lang['pendente']);
                        elseif($withdrawal->status == 'paid')       echo strtoupper($lang['pago']);
                        elseif($withdrawal->status == 'chargeback') echo strtoupper($lang['estornado']);
                        elseif($withdrawal->status == 'cancel')     echo strtoupper($lang['cancelado']);
                        ?>
            </span>
            <br/><br>
            <table class="table table-responsive text-left" style="width: 600px;">
                <tr>
                    <td class="field-title"><?=$lang['id_saque']?>:</td>
                    <td>#<?php echo $withdrawal->id;?></td>
                </tr>
                <tr>
                    <td class="field-title"><?=$lang['nome']?>:</td>
                    <td><?php echo ucfirst($beneficiario->firstname)?> <?php echo ucfirst($beneficiario->lastname)?></td>
                </tr>
                <tr>
                    <td class="field-title"><?=$lang['forma_de_recebimento']?>:</td>
                    <td><?php echo ucfirst($withdrawal->gateway)?></td>
                </tr>
                <tr>
                    <td class="field-title"><?=$lang['valor']?>:</td>
                    <td><?php echo display_money($withdrawal->value);?> (<?=$lang['taxa_descontada']?>)</td>
                </tr>
                <tr>
                    <td class="field-title"><?=$lang['taxa']?>:</td>
                    <td><?php echo display_money($withdrawal->tax);?></td>
                </tr>
                <tr>
                    <td class="field-title"><?=$lang['status']?>:</td>
                    <td>
                        <span class="label label-<?php
                            if($withdrawal->status == 'open')       echo 'primary';
                        elseif($withdrawal->status == 'paid')       echo 'success';
                        elseif($withdrawal->status == 'chargeback') echo 'danger';
                        elseif($withdrawal->status == 'cancel')     echo 'danger';
                        ?>"><?php
                            if($withdrawal->status == 'open')       echo strtoupper($lang['pendente']);
                        elseif($withdrawal->status == 'paid')       echo strtoupper($lang['pago']);
                        elseif($withdrawal->status == 'chargeback') echo strtoupper($lang['estornado']);
                        elseif($withdrawal->status == 'cancel')     echo strtoupper($lang['cancelado']);
                        ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="field-title"><?=$lang['data_saque']?>:</td>
                    <td><?php echo date($this->settings->date_format, strtotime($withdrawal->date));?> às <?php echo date($this->settings->date_time_format, strtotime($withdrawal->date));?></td>
                </tr>
                <tr>
                    <td class="field-title"><?=$lang['data_pagamento']?>:</td>
                    <td>
                        <?php if($withdrawal->status != 'open'): ?>
                        <?php echo date($this->settings->date_format, strtotime($withdrawal->payment_date));?> às <?php echo date($this->settings->date_time_format, strtotime($withdrawal->payment_date));?>
                        <?php else: ?>-<?php endif; ?>
                    </td>
                </tr>
                <?php if ($withdrawal->gateway == 'bitcoin') { ?>
                <tr>
                    <td class="field-title">Carteira bitcoin:</td>
                    <td><?php echo $withdrawal->bitcoin_address?></td>
                </tr>
                <?php } elseif($withdrawal->gateway == 'transferencia') { ?>
                <tr>
                    <td class="field-title"><?=$lang['banco']?>:</td>
                    <td>
                        <?php echo $withdrawal->bank_code?> - <?php echo $bank->name?>
                    </td>
                </tr>
                <tr>
                    <td class="field-title"><?=$lang['agencia']?>:</td>
                    <td>
                        <?php echo $withdrawal->bank_agency?>
                    </td>
                </tr>
                <tr>
                    <td class="field-title"><?=$lang['conta']?>:</td>
                    <td>
                        <?php echo $withdrawal->bank_account?>
                    </td>
                </tr>
                <tr>
                    <td class="field-title"><?=$lang['tipo_conta']?>:</td>
                    <td>
                        <?php echo ucfirst($withdrawal->bank_account_type)?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </center>
    </div>
</div>

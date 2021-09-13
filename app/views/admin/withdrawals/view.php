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
            <h3>Solicitação de Saque - ID #<?php echo $withdrawal->id;?> <br>
                Beneficiado: <?php echo ucfirst($beneficiario->firstname)?> <?php echo ucfirst($beneficiario->lastname)?><br>
                Forma de recebimento: <?php echo ucfirst($withdrawal->gateway)?><br>
                Valor: <?php echo display_money($withdrawal->value);?> </h3>
            <span class="label label-<?php
                            if($withdrawal->status == 'open')       echo 'primary';
                        elseif($withdrawal->status == 'paid')       echo 'success';
                        elseif($withdrawal->status == 'chargeback') echo 'danger';
                        elseif($withdrawal->status == 'cancel')     echo 'danger';
                        ?> col-md-6 col-md-offset-3" style="font-size: 20px; margin-bottom:20px;">
                        <?php
                            if($withdrawal->status == 'open')       echo 'PENDENTE';
                        elseif($withdrawal->status == 'paid')       echo 'PAGO';
                        elseif($withdrawal->status == 'chargeback') echo 'ESTORNADO';
                        elseif($withdrawal->status == 'cancel')     echo 'CANCELADO';
                        ?>
            </span>
            <br/><br>
            <table class="table table-responsive text-left" style="width: 600px;">
                <tr>
                    <td class="field-title">ID do Saque:</td>
                    <td>#<?php echo $withdrawal->id;?></td>
                </tr>
                <tr>
                    <td class="field-title">Nome:</td>
                    <td><?php echo ucfirst($beneficiario->firstname)?> <?php echo ucfirst($beneficiario->lastname)?></td>
                </tr>
                <tr>
                    <td class="field-title">Forma de recebimento:</td>
                    <td><?php echo ucfirst($withdrawal->gateway)?></td>
                </tr>
                <tr>
                    <td class="field-title">Valor:</td>
                    <td><?php echo display_money($withdrawal->value);?> (Valor já com a taxa descontada)</td>
                </tr>
                <tr>
                    <td class="field-title">Taxa:</td>
                    <td><?php echo display_money($withdrawal->tax);?></td>
                </tr>
                <tr>
                    <td class="field-title">Status:</td>
                    <td>
                        <span class="label label-<?php
                            if($withdrawal->status == 'open')       echo 'primary';
                        elseif($withdrawal->status == 'paid')       echo 'success';
                        elseif($withdrawal->status == 'chargeback') echo 'danger';
                        elseif($withdrawal->status == 'cancel')     echo 'danger';
                        ?>">
                        <?php
                            if($withdrawal->status == 'open')       echo 'PENDENTE';
                        elseif($withdrawal->status == 'paid')       echo 'PAGO';
                        elseif($withdrawal->status == 'chargeback') echo 'ESTORNADO';
                        elseif($withdrawal->status == 'cancel')     echo 'CANCELADO';
                        ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="field-title">Data Saque:</td>
                    <td><?php echo date($this->settings->date_format, strtotime($withdrawal->date));?> às <?php echo date($this->settings->date_time_format, strtotime($withdrawal->date));?></td>
                </tr>
                <tr>
                    <td class="field-title">Data Pagamento:</td>
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
                    <td class="field-title">Banco:</td>
                    <td>
                        <?php echo $withdrawal->bank_code?> - <?php echo $bank->name?>
                    </td>
                </tr>
                <tr>
                    <td class="field-title">Agência:</td>
                    <td>
                        <?php echo $withdrawal->bank_agency?>
                    </td>
                </tr>
                <tr>
                    <td class="field-title">Conta:</td>
                    <td>
                        <?php echo $withdrawal->bank_account?>
                    </td>
                </tr>
                <tr>
                    <td class="field-title">Tipo conta:</td>
                    <td>
                        <?php echo ucfirst($withdrawal->bank_account_type)?>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <td class="field-title">Ações:</td>
                    <td>
                    
                    <?php if($withdrawal->status != 'cancel'): ?>
                    <a href="<?=base_url('admin/withdrawals/cancel/' . $withdrawal->id);?>" class="btn btn-danger btn-icon mb-10" data-popup="tooltip" title="Cancelar saque">
                        <b><i class="icon-x"></i></b>
                    </a>
                    <?php else: ?> - <?php endif; ?>

                    <?php if($withdrawal->status == 'open' OR $withdrawal->status == 'chargeback'): ?>
                    <a href="<?=base_url('admin/withdrawals/paid/' . $withdrawal->id);?>" class="btn btn-success btn-icon mb-10" data-popup="tooltip" title="Marcar como pago">
                        <b><i class="icon-checkmark5"></i></b>
                    </a>
                    <?php endif; ?>

                    <?php if($withdrawal->status == 'paid'): ?>
                    <a href="<?=base_url('admin/withdrawals/chargeback/' . $withdrawal->id);?>" class="btn btn-warning btn-icon mb-10" data-popup="tooltip" title="Marcar como estornado">
                        <b><i class="icon-x"></i></b>
                    </a>
                    <?php endif; ?>

                    </td>
                </tr>
            </table>
        </center>
    </div>
</div>
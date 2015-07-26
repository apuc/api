<?php
?>
<p>Введите сумму на которую вы хотите пополнить счет</p>
<form id="payment" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">
    <input type="text" id="interkassa-money" class="form-control" name="interkassa-money">
    <input type="hidden" name="ik_co_id" value="55a65e6e3b1eafa94b8b456a"/>
    <input type="hidden" name="ik_pm_no" value="<?= $cash_id; ?>"/>
    <input id='ik_am' type="hidden" name="ik_am" value=""/>
    <input type="hidden" name="ik_cur" value="RUB"/>
    <input type="hidden" name="ik_desc" value="Пополнить счет"/>
    <input type="submit" class="btn btn-success btn-sm" value="Пополнить">
</form>
<?php
?>
    <form id="payment" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">
        <input type="hidden" name="ik_co_id" value="55a65e6e3b1eafa94b8b456a"/>
        <input type="hidden" name="ik_pm_no" value="<?= $cash_id; ?>"/>
        <input type="hidden" name="ik_am" value="1"/>
        <input type="hidden" name="ik_am_ed" value="1"/>
        <input type="hidden" name="ik_payment_amount" value=""/>
        <input type="hidden" name="ik_cur" value="RUB"/>
        <input type="hidden" name="ik_desc" value="Пополнить счет"/>
        <input type="submit" value="Пополнить">
    </form>
<?php
//    echo '<br />';
//
//    $desc = utf8_decode("\\u041f\\u043e\\u043f\\u043e\\u043b\\u043d\\u0438\\u0442\\u044c \\u0441\\u0447\\u0435\\u0442");
//    $params = ["ik_co_id"     => "55a65e6e3b1eafa94b8b456a",
//               "ik_co_prs_id" => "403681340919",
//               "ik_inv_id"    => "38538722",
//               "ik_inv_st"    => "success",
//               "ik_inv_crt"   => "2015-07-24 15:18:39",
//               "ik_inv_prc"   => "2015-07-24 15:18:39",
//               "ik_trn_id"    => "",
//               "ik_pm_no"     => "656",
//               "ik_pw_via"    => "test_interkassa_test_xts",
//               "ik_am"        => "1.00",
//               "ik_co_rfn"    => "0.9700",
//               "ik_ps_price"  => "1.00",
//               "ik_cur"       => "RUB",
//               "ik_desc"      => $desc];
//
//    $secret = 'IX2dqnWYhWmfec2C';
//
//    ksort($params, SORT_STRING); // сортируем по ключам в алфавитном порядке элементы массива
//    array_push($params, ['secret'=>$secret]); // добавляем в конец массива "секретный ключ"
//    $signString = implode(':', $params); // конкатенируем значения через символ ":"
//    $sign = base64_encode(md5($signString, true));
//
//    echo $sign;
?>
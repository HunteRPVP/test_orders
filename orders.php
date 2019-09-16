<?php

error_reporting(E_ERROR | E_PARSE);

require __DIR__ . '/vendor/autoload.php';
use ShopExpress\ApiClient\ApiClient;
use ShopExpress\ApiClient\Response\ApiResponse;

$i = 0;

$ApiClient = new ApiClient(
    'lNwzuV_Gb',
    'admin',
    'http://newshop.kupikupi.org/adm/api'
);

$orders = $ApiClient->get("orders",
    [
        limit => 10
    ]
);

$orders = $orders->orders;

?>

<!DOCTYPE html>
 
<html>
 
    <head>
        <title>Заказы</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="css/orders.css" type="text/css" />
        <script type="text/javascript" src="js/orders.js"></script>
    </head>
 
    <body>

        <table id = orders_table class = orders_table> 
            <thead> 
                <tr>
                    <th>Номер заказа</th>
                    <th>Дата создания заказа</th>
                    <th>Сумма заказа</th>
                </tr>
            </thead>
            <tbody id = orders_body>
                <?php $i = 0; foreach($orders as &$order):;?>
                <tr id='order_row<?php echo $i?>'>
                    <td id='id_row<?php echo $i?>'><?php echo $order["order_id"];?></td>
                    <td id='date_row<?php echo $i?>'><?php echo $order["created"];?></td>
                    <td id='sum_row<?php echo $i?>'><?php echo $order["summ"] . " руб.";?></td>
                </tr>
                <?php $i++; endforeach;?>
            </tbody>
        </table>
 
        <div class = "buttons">
            <a onclick="previous(<?php echo $i?>);" class="previous round" id="previous">&#8249;</a>
            <a onclick="next(<?php echo $i?>);" class="next round" id="next">&#8250;</a>
        </div>
    </body>
 
</html>
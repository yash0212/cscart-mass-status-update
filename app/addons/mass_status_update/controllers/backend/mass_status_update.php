<?php

if (!defined('BOOTSTRAP')) { die('Access denied'); }

$params = $_REQUEST;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($mode == 'update' && !empty($params['order_ids'])) {
        $search = "";
        foreach($params['order_ids'] as $order_id) {
            $search .= "&order_ids[]=".$order_id;
        }
        fn_redirect('mass_status_update.update?'.$search);
    }
    elseif ($mode == 'update_status' && !empty($params['order_ids'])) {
        //Create array of order_ids from request
        $order_ids = explode(",", $params['order_ids']);
        //Fetch status from request
        $status = $params['status'];
        //Send notification to admin/vendor/user
        $force_notification = array(
            'A' => 0,
            'V' => 0,
            'C' => 0
        );
        //Set mail recipients
        if(isset($params['mail_admin']) && ($params['mail_admin'] == "on")){
            $force_notification['A'] = 1;
        }
        if(isset($params['mail_vendor']) && ($params['mail_vendor'] == "on")){
            $force_notification['V'] = 1;
        }
        if(isset($params['mail_customer']) && ($params['mail_customer'] == "on")){
            $force_notification['C'] = 1;
        }
        //Change order status
        foreach ($order_ids as $order_id) {
            fn_change_order_status($order_id, $status, "", $force_notification);
        }
        fn_set_notification('N','Notice','Status of orders update successfully','I');
        fn_redirect("orders.manage");
    }
}

if ($mode == "update") {
    //Create array of order_ids from request
    $orders = array();
    foreach ($params['order_ids'] as $order_id) {
        $order = fn_get_order_info($order_id);
        array_push($orders, $order);
    }
    //Get all statuses
    $statuses = fn_get_statuses();
    $status_array = array();
    foreach ($statuses as $code => $status) {
        $status_array[$code] = $statuses[$code]['description'];
    }
    //Pass required data to view
    Tygh::$app['view']->assign('orders', $params['order_ids']);
    Tygh::$app['view']->assign('statuses', $statuses);
    Tygh::$app['view']->assign('statuses_array', $status_array);
}

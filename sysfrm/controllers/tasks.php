<?php
// *************************************************************************
// *                                                                       *
// * InTouch Software CRM                              *
// * Copyright (c) InTouch Software (Pty) Ltd. All Rights Reserved                      *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: info@intouchsoft.co.za                                                *
// * Website: https://www.intouchsoft.co.za                                  *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                       *
// *                                                                       *
// *************************************************************************
_auth();
$ui->assign('_sysfrm_menu', 'tasks');
$ui->assign('_st', 'Invoices');
$ui->assign('_title', 'Accounts- '. $config['CompanyName']);
$action = $routes['1'];
$user = User::_info();
$ui->assign('user', $user);
switch ($action) {
    case 'me':
//find all clients.
        $ui->assign('_st', 'Add Invoice');
        $c = ORM::for_table('sys_accounts')->select('id')->select('account')->select('company')->find_many();
        $ui->assign('c',$c);

        $t = ORM::for_table('sys_tax')->find_many();
        $ui->assign('t',$t);

//default idate ddate
        $ui->assign('idate',date('Y-m-d'));

        $ui->assign('xheader', '
<link rel="stylesheet" type="text/css" href="' . $_theme . '/lib/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="' . $_theme . '/lib/dp/dist/datepicker.min.css"/>

');
        $ui->assign('xfooter', '
<script type="text/javascript" src="' . $_theme . '/lib/select2/select2.min.js"></script>
<script type="text/javascript" src="' . $_theme . '/lib/dp/dist/datepicker.min.js"></script>
<script type="text/javascript" src="' . $_theme . '/lib/invoice.js"></script>

');
        $ui->assign('xjq', '



 ');

        $ui->display('tasks.tpl');



        break;


    default:
        echo 'action not defined';
}

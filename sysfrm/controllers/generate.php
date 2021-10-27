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
$ui->assign('_title', $_L['Transactions'].'- '. $config['CompanyName']);
$ui->assign('_st', 'Transactions');
$ui->assign('_sysfrm_menu', 'transactions');
$action = $routes['1'];
$user = User::_info();
$ui->assign('user', $user);
$mdate = date('Y-m-d');
switch ($action) {

    case 'balance-sheet':

      $d = ORM::for_table('sys_accounts')->where_not_equal('balance','0.00')->order_by_desc('balance')->find_many();
      $tbal = ORM::for_table('sys_accounts')->where_not_equal('balance','0.00')->sum('balance');
      $ui->assign('d',$d);
      $ui->assign('tbal',$tbal);
        $ui->display('balance-sheet.tpl');
        break;

    default:
        echo 'action not defined';
}

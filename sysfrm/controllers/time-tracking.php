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
$ui->assign('_sysfrm_menu', 'contacts');
$ui->assign('_title', 'Accounts- '. $config['CompanyName']);
$action = $routes['1'];
$user = User::_info();
$ui->assign('user', $user);
switch ($action) {

    case 'cal':
        $ui->assign('xheader', '
<link rel="stylesheet" type="text/css" href="' . $_theme . '/lib/cal/fullcalendar.min.css"/>
<link rel="stylesheet" type="text/css" href="' . $_theme . '/lib/cal/fullcalendar.print.css"/>

');
        $ui->assign('xfooter', '
<script type="text/javascript" src="' . $_theme . '/lib/cal/fullcalendar.min.js"></script>
<script type="text/javascript" src="' . $_theme . '/js/runner.js"></script>
<script type="text/javascript" src="' . $_theme . '/lib/cal.js"></script>

');
        $ui->display('cal.tpl');
        break;


    case 'source':


        $fdate = _get('from');
        $fdate = $fdate/1000;
        $fdate = date('Y-m-d',$fdate);
        $tdate = _get('to');
        $tdate = $tdate/1000;
        $tdate = date('Y-m-d',$tdate);
        $out = array();
//find current month
        $d = ORM::for_table('sys_tt');
//        $d->where_gte('date', $fdate);
//        $d->where_lte('date', $tdate);
//        $d->where('type','Expense');
//        $d->where('status','Uncleared');
        $x =  $d->find_many();
        foreach($x as $xs){

            $id = $xs['id'];
            $title = $xs['title'];
            $allday = $xs['allday'];
            $start = date('Y-m-d\TH:i:00',$xs['start']);

            $end = date('Y-m-d\TH:i:00',$xs['end']);

            $out[] = array(
                'id' => $id,
                'title' => $title,
                'start' => $start,
                'end' =>  $end,
                'allDay' => false,

            );

        }
        header('Content-Type: application/json');
        echo json_encode($out);
        exit;


        break;

    case 'render':


echo time();

        break;


    default:
        echo 'action not defined';
}

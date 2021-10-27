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
$action = $routes['1'];
$user = User::_info();
$ui->assign('user', $user);
switch ($action) {

    case 'tags':


        break;
    case 'contacts':
        header('Content-Type: application/json');
        $t = ORM::for_table('sys_tags')->where('type','Contacts')->find_many();
        $tags = '[';
        foreach ($t as $ts){


            $tags .= '{"id":"'.$ts['text'].'","text":"'.$ts['text'].'"},';
        }
        $tags = rtrim($tags,',');
        $tags .= ']';
        echo $tags;

        break;


    case 'income':
        header('Content-Type: application/json');
        $t = ORM::for_table('sys_tags')->where('type','Income')->find_many();
        $tags = '[';
        foreach ($t as $ts){


            $tags .= '{"id":"'.$ts['text'].'","text":"'.$ts['text'].'"},';
        }
        $tags = rtrim($tags,',');
        $tags .= ']';
        echo $tags;

        break;

    case 'expense':
        header('Content-Type: application/json');
        $t = ORM::for_table('sys_tags')->where('type','Expense')->find_many();
        $tags = '[';
        foreach ($t as $ts){


            $tags .= '{"id":"'.$ts['text'].'","text":"'.$ts['text'].'"},';
        }
        $tags = rtrim($tags,',');
        $tags .= ']';
        echo $tags;

        break;

    case 'transfer':
        header('Content-Type: application/json');
        $t = ORM::for_table('sys_tags')->where('type','Transfer')->find_many();
        $tags = '[';
        foreach ($t as $ts){


            $tags .= '{"id":"'.$ts['text'].'","text":"'.$ts['text'].'"},';
        }
        $tags = rtrim($tags,',');
        $tags .= ']';
        echo $tags;

        break;


    default:
        echo 'action not defined';
}

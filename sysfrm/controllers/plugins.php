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
$ui->assign('_sysfrm_menu', 'plugins');
$dir = $routes['1'];
$cont = $routes['2'];
$path = 'sysfrm/plugins/'.$dir.'/'.$cont.'.php';
$pl_path = 'sysfrm/plugins/'.$dir.'/';
if(file_exists($path)){
    $_pd = 'sysfrm/plugins/'.$dir.'/';
    $ui->assign('_pd','sysfrm/plugins/'.$dir.'/');
    require($path);

}
else{
//    echo $path;
    r2(U.'dashboard/','e',$_L['Plugin Not Found']);
}

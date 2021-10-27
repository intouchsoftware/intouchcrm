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
Class Auth{


    public static function _admin(){
       $user = User::_info();
        if($user['user_type'] == 'Admin'){
            return true;
        }
        r2(U.'dashboard','e','Invalid Access');

    }

    public static function _reseller4(){
        $user = User::_info();
        if($user['user_type'] == 'Admin' OR $user['user_type'] == 'Reseller 4'){
            return true;
        }
        r2(U.'dashboard','e','Invalid Access');

    }

    public static function _reseller3(){
        $user = User::_info();
        if($user['user_type'] == 'Admin' OR $user['user_type'] == 'Reseller 4' OR $user['user_type'] == 'Reseller 3'){
            return true;
        }
        r2(U.'dashboard','e','Invalid Access');

    }

    public static function _reseller2(){
        $user = User::_info();
        if($user['user_type'] == 'Admin' OR $user['user_type'] == 'Reseller 4' OR $user['user_type'] == 'Reseller 3' OR $user['user_type'] == 'Reseller 2'){
            return true;
        }
        r2(U.'dashboard','e','Invalid Access');

    }
}

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

Class Arr{

    public static function str_to_arr($str){
        $pieces = explode(',', $str);
        foreach ($pieces as $p){

        }
    }


    public static function arr_to_str($arr){
        $str = '';
        if(is_array($arr)){
            foreach($arr as $a){
                $str .= $a.',';
            }
            $str = rtrim($str,',');
        }
        return $str;
    }

}

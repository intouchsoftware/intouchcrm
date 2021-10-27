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

Class Asset{

    public static function css($path,$v=''){
        if($v == ''){
           $ver = '';
        }
        else{
            $ver = '?ver='.$v;
        }
        $gen = '';
        if(is_array($path)){

            foreach($path as $p){
                $gen .= '<link rel="stylesheet" type="text/css" href="ui/lib/'.$p.'.css'.$ver.'" />
        ';
            }


        }
        else{
            $gen = '<link rel="stylesheet" type="text/css" href="ui/lib/'.$path.'.css'.$ver.'" />
        ';
        }
        return $gen;
    }

    public static function js($path,$v=''){
        // <script type="text/javascript" src="ui/lib/s2/js/select2.min.js"></script>

        if($v == ''){
            $ver = '';
        }
        else{
            $ver = '?ver='.$v;
        }
        $gen = '';
        if(is_array($path)){
            foreach($path as $p){
                $gen .= '<script type="text/javascript" src="ui/lib/'.$p.'.js'.$ver.'"></script>
        ';
            }

        }
        else{
            $gen = '<script type="text/javascript" src="ui/lib/'.$path.'.js'.$ver.'"></script>
        ';
        }
        return $gen;
    }

}

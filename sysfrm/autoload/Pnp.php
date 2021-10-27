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
Class Pnp{

    public static function _js(){

    }

    public static function libjs($js){
        global $config;
return $config['theme'].'/lib/'.$js;
    }

}

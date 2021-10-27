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
class Ed {

    public static function encrypt($pure_string, $encryption_key='') {
//        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
//        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
//        $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
//        return $encrypted_string;
     return   base64_encode($pure_string);
    }

    public static function decrypt($encrypted_string, $encryption_key='') {
//        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
//        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
//        $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
//        return $decrypted_string;
        return   base64_decode($encrypted_string);
    }

}

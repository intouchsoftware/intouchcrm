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

Class Ib_I18n{

    public static function get_code($lan){

        if($lan == 'arabic'){
            return 'ar';
        }
        elseif($lan == 'azerbaijani'){
            return 'az';
        }

        elseif($lan == 'bengali'){
            return 'bn';
        }

        elseif($lan == 'catalan'){
            return 'ca';
        }
        elseif($lan == 'croatian'){
            return 'en';
        }

        elseif($lan == 'czech'){
            return 'cs';
        }
        elseif($lan == 'danish'){
            return 'da';
        }

        elseif($lan == 'dutch'){
            return 'da';
        }

        elseif($lan == 'en-us'){
            return 'en';
        }

        elseif($lan == 'farsi'){
            return 'fa';
        }

        elseif($lan == 'french'){
            return 'fr';
        }

        elseif($lan == 'german'){
            return 'de';
        }

        elseif($lan == 'hungarian'){
            return 'hu';
        }
        elseif($lan == 'italian'){
            return 'it';
        }

        elseif($lan == 'norwegian'){
            return 'no';
        }

        elseif($lan == 'portuguese-br'){
            return 'pt-br';
        }

        elseif($lan == 'portuguese-pt'){
            return 'pt';
        }

        elseif($lan == 'russian'){
            return 'ru';
        }

        elseif($lan == 'spanish'){
            return 'es';
        }

        elseif($lan == 'swedish'){
            return 'sw';
        }

        elseif($lan == 'turkish'){
            return 'tr';
        }

        elseif($lan == 'ukranian'){
            return 'ua';
        }

        else{
            return 'en';
        }

    }

}

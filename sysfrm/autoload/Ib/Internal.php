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

Class Ib_Internal{

    public static function get_moment_format($df){

        if($df == 'd/m/Y'){
            return 'DD/MM/YYYY';
        }

        elseif($df == 'd.m.Y'){
            return 'DD.MM.YYYY';
        }

        elseif($df == 'd-m-Y'){
            return 'DD-MM-YYYY';
        }

        elseif($df == 'm/d/Y'){
            return 'MM/DD/YYYY';
        }

        elseif($df == 'Y/m/d'){
            return 'YYYY/MM/DD';
        }

        elseif($df == 'Y-m-d'){
            return 'YYYY-MM-DD';
        }

        elseif($df == 'M d Y'){
            return 'MMM DD YYYY';
        }

        elseif($df == 'd M Y'){
            return 'DD MMM YYYY';
        }

        elseif($df == 'jS M y'){
            return 'Do MMM YY';
        }

        else{

            return 'dddd, MMMM Do YYYY';

        }

    }

}

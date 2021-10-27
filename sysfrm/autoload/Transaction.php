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
Class Transaction{
    public static function delete($id){

        //find the transaction
        $t = ORM::for_table('sys_transactions')->find_one($id);
        if($t){
            $a = ORM::for_table('sys_accounts')->where('account',$t['account'])->find_one();
            $cr = $t['cr'];
            $dr = $t['dr'];
            if($a){
                $cbal = $a['balance'];
                if($cr != '0.00'){
                    $nbal = $cbal-$cr;
                }
                else{
                    $nbal = $cbal+$dr;
                }
                $a->balance = $nbal;
                $a->save();

            }

            $t->delete();
            return true;
        }

        else{
            return false;
        }


//        if($t){
//            //find affected rows
//            $d = ORM::for_table('sys_transactions')->where_gt('id',$id)->where('account',$t['account'])->find_many();
//
//        }


    }

}

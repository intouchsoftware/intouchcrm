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

if(!isset($myCtrl)){
    $myCtrl = 'contacts';
}
_auth();
$ui->assign('_sysfrm_menu', 'contacts');
$ui->assign('_title', $_L['Contacts'].' - '. $config['CompanyName']);
$ui->assign('_st', $_L['Contacts']);
$action = $routes['1'];
$user = User::_info();
$ui->assign('user', $user);

$ui->assign('jsvar', '
_L[\'Working\'] = \''.$_L['Working'].'\';
_L[\'Submit\'] = \''.$_L['Submit'].'\';
 ');


switch ($action) {
    case 'add':

        $ui->assign('countries',Countries::all($config['country'])); // may add this $config['country_code']

        $fs = ORM::for_table('crm_customfields')->where('ctype','crm')->order_by_asc('id')->find_many();
        $ui->assign('fs',$fs);


//        $ui->assign('xheader', '
//<link rel="stylesheet" type="text/css" href="ui/lib/s2/css/select2.min.css"/>
//');
        $ui->assign('xheader', Asset::css('s2/css/select2.min'));
        $ui->assign('xfooter', Asset::js(array('s2/js/select2.min','s2/js/i18n/'.lan(),'add-contact')));
        $tags = Tags::get_all('Contacts');
        $ui->assign('tags',$tags);
        $ui->assign('xjq', '
 $("#country").select2({
 theme: "bootstrap"
 });
 ');

        $ui->assign('jsvar', '
_L[\'Working\'] = \''.$_L['Working'].'\';
 ');



        $ui->display('add-contact.tpl');






        break;

    case 'summary':

        $cid = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($cid);
        if($d){
            $ti = ORM::for_table('sys_transactions')
                ->where('payerid',$cid)
                ->sum('cr');
            if($ti == ''){
                $ti = '0';
            }
            $ui->assign('ti',$ti);
            $te = ORM::for_table('sys_transactions')
                ->where('payeeid',$cid)
                ->sum('dr');
            if($te == ''){
                $te = '0';
            }

            $ui->assign('te',$te);
            $ui->assign('d',$d);

            $cf = ORM::for_table('crm_customfields')->where('ctype','crm')->order_by_asc('id')->find_many();
            $ui->assign('cf',$cf);

            $ui->display('ajax.contact-summary.tpl');
        }
        else{

        }


        break;

    case 'activity':


        $cid = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($cid);
        if($d){
            $ac = ORM::for_table('sys_activity')->where('cid',$cid)->limit(20)->order_by_desc('id')->find_many();
            $ui->assign('ac',$ac);
            $ui->display('ajax.contact-activity.tpl');
        }
        else{

        }


        break;


    case 'invoices':


        $cid = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($cid);
        if($d){
$i = ORM::for_table('sys_invoices')->where('userid',$cid)->find_many();
            $ui->assign('i',$i);
            $ui->display('ajax.contact-invoices.tpl');
        }
        else{

        }


        break;


    case 'transactions':


        $cid = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($cid);
        if($d){
            $tr = ORM::for_table('sys_transactions')
                ->where_raw('(`payerid` = ? OR `payeeid` = ?)', array($cid, $cid))
                ->order_by_desc('id')->find_many();
            $ui->assign('tr',$tr);
            $ui->display('ajax.contact-transactions.tpl');
        }
        else{

        }


        break;

    case 'email':


        $cid = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($cid);
        if($d){
            $e = ORM::for_table('sys_email_logs')
                ->where('userid',$cid)
                ->order_by_desc('id')->find_many();
            $ui->assign('d',$d);
            $ui->assign('e',$e);
            $ui->display('ajax.contact-emails.tpl');
        }
        else{

        }


        break;


    case 'edit':


        $cid = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($cid);
        if($d){
            $fs = ORM::for_table('crm_customfields')->where('ctype','crm')->order_by_asc('id')->find_many();
            $ui->assign('fs',$fs);
            $ui->assign('countries',Countries::all($d['country']));
            $ui->assign('d',$d);
            $tags = Tags::get_all('Contacts');
            $ui->assign('tags',$tags);
            $dtags = explode(',',$d['tags']);
            $ui->assign('dtags',$dtags);
            $ui->display('ajax.contact-edit.tpl');
        }
        else{

        }


        break;



    case 'add-activity-post':

        $cid = _post('cid');
        $msg = $_POST['msg'];
        $icon = $_POST['icon'];
        $icon = trim($icon);
        //<a href="#"><i class="fa fa-camera"></i></a>

        $icon = str_replace('<a href="#"><i class="','',$icon);
        $icon = str_replace('"></i></a>','',$icon);
        if($icon == ''){
            $icon = 'fa fa-check';
        }

        if(Validator::Length($msg,1000,5) == false){
            echo $_L['Message Should be between 5 to 1000 characters'];
        }
        else{
            $d = ORM::for_table('sys_activity')->create();
            $d->cid = $cid;
            $d->msg = $msg;
            $d->icon = $icon;
            $d->stime = time();
            $d->sdate = date('Y-m-d');
            $d->o = $user['id'];
            $d->oname = $user['fullname'];
            $d->save();

            echo $cid;
        }

        break;


    case 'activity-delete':

        $id = $routes['3'];
        $d = ORM::for_table('sys_activity')->find_one($id);
        $d->delete();
        $cid = $routes['2'];
        r2(U.$myCtrl.'/view/'.$cid.'/','s',$_L['Deleted Successfully']);
        break;

    case 'view':
        $id  = $routes['2'];
        $d = ORM::for_table('crm_accounts')->find_one($id);
        if($d){

            //find all activity for this user
            $ac = ORM::for_table('sys_activity')->where('cid',$id)->limit(20)->order_by_desc('id')->find_many();
            $ui->assign('ac',$ac);


//            $ui->assign('xheader', '
//<link rel="stylesheet" type="text/css" href="' . $_theme . '/lib/select2/select2.css"/>
//<link rel="stylesheet" type="text/css" href="'.APP_URL.'/sysfrm/vendors/imgcrop/assets/css/croppic.css"/>
//<link rel="stylesheet" type="text/css" href="'.APP_URL.'/ui/lib/sn/summernote.css"/>
//<link rel="stylesheet" type="text/css" href="'.APP_URL.'/ui/lib/sn/summernote-bs3.css"/>
//<link rel="stylesheet" type="text/css" href="'.APP_URL.'/ui/lib/sn/summernote-sysfrm.css"/>
//
//');


            $ui->assign('xheader', Asset::css(array('s2/css/select2.min','sn/summernote','sn/summernote-bs3','sn/summernote-sysfrm','imgcrop/assets/css/croppic')));

//            $ui->assign('xfooter', '
//<script type="text/javascript" src="' . $_theme . '/lib/select2/select2.min.js"></script>
// <script type="text/javascript" src="'.APP_URL.'/ui/lib/sn/summernote.min.js"></script>
//<script type="text/javascript" src="'.APP_URL.'/sysfrm/vendors/imgcrop/croppic.js"></script>
//<script type="text/javascript" src="' . $_theme . '/lib/profile.js"></script>
//
//');


            $ui->assign('xfooter', Asset::js(array('s2/js/select2.min','s2/js/i18n/'.lan(),'sn/summernote.min','imgcrop/croppic','profile')));

            $ui->assign('xjq', '


 ');

            $ui->assign('d',$d);
            $ui->display('account-profile-alt.tpl');

        }
        else{
            r2(U . 'customers/list/', 'e', $_L['Account_Not_Found']);
        }

        break;

    case 'add-post':

        $account = _post('account');
        $company = _post('company');
        $email = _post('email');
        $phone = _post('phone');

        if(isset($_POST['tags']) AND ($_POST['tags']) != ''){
            $tags = $_POST['tags'];
        }
        else{
            $tags = '';
        }

        $address = _post('address');
        $city = _post('city');
        $state = _post('state');
        $zip = _post('zip');
        $country = _post('country');
        $msg = '';

//check if tag is already exisit



        if($account == ''){
            $msg .= $_L['Account Name is required'].' <br>';
        }

//check account is already exist
        $chk = ORM::for_table('crm_accounts')->where('account',$account)->find_one();
        if($chk){
            $msg .= 'Account already exist <br>';
        }

//        if($address == ''){
//            $msg .= 'Address is required <br>';
//        }
//        if($city == ''){
//            $msg .= 'City is required <br>';
//        }
//        if($state == ''){
//            $msg .= 'State is required <br>';
//        }
//        if($zip == ''){
//            $msg .= 'ZIP is required <br>';
//        }
//        if($country == ''){
//            $msg .= 'Country is required <br>';
//        }
        if($email != ''){
            if(Validator::Email($email) == false){
                $msg .= $_L['Invalid Email'].' <br>';
            }
            $f = ORM::for_table('crm_accounts')->where('email',$email)->find_one();

            if($f){
                $msg .= $_L['Email already exist'].' <br>';
            }
        }
//        if($phone != ''){
//            if(!is_numeric($phone)){
//                $msg .= $_L['Invalid Phone'].' <br>';
//            }
//        }

        if($msg == ''){

            Tags::save($tags,'Contacts');

            $d = ORM::for_table('crm_accounts')->create();

            $d->account = $account;
            $d->email = $email;
            $d->phone = $phone;
            $d->address = $address;
            $d->city = $city;
            $d->zip = $zip;
            $d->state = $state;
            $d->country = $country;
            $d->tags = Arr::arr_to_str($tags);

            //others
            $d->fname = '';
            $d->lname = '';
            $d->company = $company;
            $d->jobtitle = '';
            $d->cid = '0';
            $d->o = '0';
            $d->balance = '0.00';
            $d->status = 'Active';
            $d->notes = '';
            $d->password = '';
            $d->token = '';
            $d->ts = '';
            $d->img = '';
            $d->web = '';
            $d->facebook = '';
            $d->google = '';
            $d->linkedin = '';

            //
            $d->save();
            $cid = $d->id();
            _log($_L['New Contact Added'].' '.$account.' [CID: '.$cid.']','Admin',$user['id']);

            //now add custom fields
            $fs = ORM::for_table('crm_customfields')->where('ctype','crm')->order_by_asc('id')->find_many();
            foreach($fs as $f){
                $fvalue = _post('cf'.$f['id']);
                $fc = ORM::for_table('crm_customfieldsvalues')->create();
                $fc->fieldid = $f['id'];
                $fc->relid = $cid;
                $fc->fvalue = $fvalue;
                $fc->save();
            }
            //


            echo $cid;
        }
        else{
            echo $msg;
        }
        break;

    case 'list':
        $name = _post('name');
        //find all tags
        $t = ORM::for_table('sys_tags')->where('type','contacts')->find_many();
        $ui->assign('t',$t);
        if($name != ''){
            $paginator = Paginator::bootstrap('crm_accounts','account','%'.$name.'%');
            $d = ORM::for_table('crm_accounts')->where_like('account','%'.$name.'%')->offset($paginator['startpoint'])->limit($paginator['limit'])->order_by_desc('id')->find_many();
        }
        elseif(isset($routes[2]) AND ($routes[2]) != '' AND (!is_numeric($routes[2]))){
        $tags = $routes[2];
            $paginator['contents'] = '';
            $d = ORM::for_table('crm_accounts')->where_like('tags','%'.$tags.'%')->order_by_desc('id')->find_many();
        }
        else{
            $paginator = Paginator::bootstrap('crm_accounts');
            $d = ORM::for_table('crm_accounts')->offset($paginator['startpoint'])->limit($paginator['limit'])->order_by_desc('id')->find_many();
        }

        $ui->assign('d',$d);
        $ui->assign('paginator',$paginator);
        $ui->assign('xfooter', '
<script type="text/javascript" src="' . $_theme . '/lib/list-contacts.js"></script>

');
        $ui->assign('jsvar', '
_L[\'are_you_sure\'] = \''.$_L['are_you_sure'].'\';
 ');
        $ui->display('list-contacts.tpl');
        break;


    case 'edit-post':
        $id = _post('fcid');
        $d = ORM::for_table('crm_accounts')->find_one($id);
        if($d){

            $account = _post('account');
            $company = _post('company');

            $email = _post('edit_email');

            $tags = $_POST['tags'];
            $phone = _post('phone');
            $address = _post('address');
            $city = _post('city');
            $state = _post('state');
            $zip = _post('zip');
            $country = _post('country');
            $msg = '';

            if($account == ''){
                $msg .= $_L['Account Name is required']. ' <br>';
            }
//            if($tags != ''){
//                $pieces = explode(',', $tags);
//                foreach($pieces as $element)
//                {
//                    $tg = ORM::for_table('sys_tags')->where('text',$element)->where('type','Contacts')->find_one();
//                    if(!$tg){
//                        $tc = ORM::for_table('sys_tags')->create();
//                        $tc->text = $element;
//                        $tc->type = 'Contacts';
//                        $tc->save();
//                    }
//                }
//            }

            // Sadia ================= From V 2.4

            Tags::save($tags,'Contacts');


            //check email already exist




//            if($address == ''){
//                $msg .= 'Address is required <br>';
//            }
//            if($city == ''){
//                $msg .= 'City is required <br>';
//            }
//            if($state == ''){
//                $msg .= 'State is required <br>';
//            }
//            if($zip == ''){
//                $msg .= 'ZIP is required <br>';
//            }
//            if($country == ''){
//                $msg .= 'Country is required <br>';
//            }
                if($email != ''){

                if($email != ($d['email'])){
                    $f = ORM::for_table('crm_accounts')->where('email',$email)->find_one();

                    if($f){
                        $msg .= $_L['Email already exist'].' <br>';
                    }
                }
                if(Validator::Email($email) == false){
                    $msg .= $_L['Invalid Email'].' <br>';
                }
            }
//            if($phone != ''){
//                if(!is_numeric($phone)){
//                    $msg .= $_L['Invalid Phone'].' <br>';
//                }
//            }

            if($msg == ''){


                $d = ORM::for_table('crm_accounts')->find_one($id);
                $d->account = $account;
                $d->company = $company;


                $d->email = $email;
                $d->tags = Arr::arr_to_str($tags);
                $d->phone = $phone;
                $d->address = $address;
                $d->city = $city;
                $d->zip = $zip;
                $d->state = $state;
                $d->country = $country;
                $d->save();


                //delete existing records
                $exf = ORM::for_table('crm_customfieldsvalues')->where('relid',$id)->delete_many();
                $fs = ORM::for_table('crm_customfields')->order_by_asc('id')->find_many();
                foreach($fs as $f){
                    $fvalue = _post('cf'.$f['id']);
                    $fc = ORM::for_table('crm_customfieldsvalues')->create();
                    $fc->fieldid = $f['id'];
                    $fc->relid = $id;
                    $fc->fvalue = $fvalue;
                    $fc->save();
                }

                echo $id;
            }
            else{
                echo $msg;
            }

        }
        else{
            r2(U.$myCtrl.'/list', 'e', $_L['Account_Not_Found']);
        }

        break;
    case 'delete':
        $id = $routes['2'];
        if($_app_stage == 'Demo'){
            r2(U.$myCtrl.'/list/', 'e', 'Sorry! Deleting Account is disabled in the demo mode.');
        }
        $d = ORM::for_table('crm_accounts')->find_one($id);
        if($d){
            $d->delete();
            r2(U.$myCtrl.'/list/', 's', $_L['account_delete_successful']);
        }

        break;


    case 'more':
        $cid = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($cid);
        if($d){
            $ui->assign('countries',Countries::all($d['country']));
            $ui->assign('d',$d);
            $ui->display('ajax.contact-more.tpl');
        }
        else{

        }


        break;

    case 'edit-more':

        $id = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($id);
        if($d){
            $img = _post('picture');
            $facebook = _post('facebook');
            $google = _post('google');
            $linkedin = _post('linkedin');

            $msg = '';



            //check email already exist





            if($msg == ''){


                $d = ORM::for_table('crm_accounts')->find_one($id);

                $d->img = $img;
                $d->facebook = $facebook;
                $d->google = $google;
                $d->linkedin = $linkedin;
                $d->save();
                echo $d->id();
            }
            else{
                echo $msg;
            }

        }
        else{
            r2(U.$myCtrl.'/list/', 'e', $_L['Account_Not_Found']);
        }


        break;


    case 'edit-notes':

        $id = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($id);
        if($d){

            $notes = _post('notes');

            $msg = '';



            //check email already exist





            if($msg == ''){


                $d = ORM::for_table('crm_accounts')->find_one($id);


                $d->notes = $notes;
                $d->save();
                echo $d->id();
            }
            else{
                echo $msg;
            }

        }
        else{
            r2(U.$myCtrl.'/list/', 'e', $_L['Account_Not_Found']);
        }


        break;

    case 'render-address':
        $cid = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($cid);
        $address = $d['address'];
        $city = $d['city'];
        $state = $d['state'];
        $zip = $d['zip'];
        $country = $d['country'];
        echo "$address
$city
$state $zip
$country
";
        break;


    case 'send_email':
        $msg = '';
        $cid = _post('cid');
        $d = ORM::for_table('crm_accounts')->find_one($cid);
        $email = $d['email'];
        $toname = $d['account'];
$subject = _post('subject');
        if($subject == ''){
            $msg .= $_L['Subject is Empty'].' <br>';
        }
        $message = $_POST['message'];
if($message == ''){
    $msg .= $_L['Message is Empty'].' <br>';
}
        if($msg == ''){
            //send email
            Notify_Email::_send($toname,$email,$subject,$message,$cid);
            echo $cid;

        }
        else{
            echo $msg;
        }
        break;


    case 'modal_add':
        $ui->assign('countries',Countries::all($config['country'])); // may add this $config['country_code']
        $ui->display('modal_add_contact.tpl');


        break;



    default:
        echo 'action not defined';
}

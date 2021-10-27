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
$ui->assign('_sysfrm_menu', 'invoices');
$ui->assign('_st', 'Invoices');
$ui->assign('_title', $config['CompanyName']);
$action = $routes['1'];

switch ($action) {


    case 'iview':
        $id  = $routes['2'];
        $d = ORM::for_table('sys_invoices')->find_one($id);
        if($d){
            $token = $routes['3'];
            $token = str_replace('token_','',$token);
            $vtoken = $d['vtoken'];
            if($token != $vtoken){
                echo 'Sorry Token does not match!';
                exit;
            }


            $items = ORM::for_table('sys_invoiceitems')->where('invoiceid',$id)->order_by_asc('id')->find_many();
            $ui->assign('items',$items);
            //find related transactions
            $trs_c = ORM::for_table('sys_transactions')->where('iid', $id)->count();

            $trs = ORM::for_table('sys_transactions')->where('iid', $id)->order_by_desc('id')->find_many();
            $ui->assign('trs', $trs);
            $ui->assign('trs_c', $trs_c);
//find the user
            $a = ORM::for_table('crm_accounts')->find_one($d['userid']);
            $ui->assign('a',$a);
            $ui->assign('d',$d);

            $i_credit = $d['credit'];
            $i_due = '0.00';
            $i_total = $d['total'];
            if($d['credit'] != '0.00'){
                $i_due = $i_total - $i_credit;
            }
            else{
                $i_due =  $d['total'];
            }




            $ui->assign('i_due', $i_due);
            $pgs = ORM::for_table('sys_pg')->where('status','Active')->order_by_asc('sorder')->find_many();
            $ui->assign('pgs',$pgs);
            $cf = ORM::for_table('crm_customfields')->where('showinvoice','Yes')->order_by_asc('id')->find_many();
            $ui->assign('cf',$cf);

            $x_html = '';

            Event::trigger('view_invoice');


            $ui->assign('x_html',$x_html);

            $ui->display('client-iview.tpl');

        }
        else{
            r2(U . 'customers/list', 'e', $_L['Account_Not_Found']);
        }

        break;


    case 'q':
        $id  = $routes['2'];
        $d = ORM::for_table('sys_quotes')->find_one($id);
        if($d){
            $token = $routes['3'];
            $token = str_replace('token_','',$token);
            $vtoken = $d['vtoken'];
            if($token != $vtoken){
                echo 'Sorry Token does not match!';
                exit;
            }


            $items = ORM::for_table('sys_quoteitems')->where('qid',$id)->order_by_asc('id')->find_many();
            $ui->assign('items',$items);

            $a = ORM::for_table('crm_accounts')->find_one($d['userid']);
            $ui->assign('a',$a);
            $ui->assign('d',$d);

            $cf = ORM::for_table('crm_customfields')->where('showinvoice','Yes')->order_by_asc('id')->find_many();
            $ui->assign('cf',$cf);

            $x_html = '';




            $ui->assign('x_html',$x_html);

            $ui->display('client-quote.tpl');

        }
        else{
            r2(U . 'customers/list', 'e', $_L['Account_Not_Found']);
        }

        break;




    case 'iprint':
        $id  = $routes['2'];
        $d = ORM::for_table('sys_invoices')->find_one($id);
        if($d){

            $token = $routes['3'];
            $token = str_replace('token_','',$token);
            $vtoken = $d['vtoken'];
            if($token != $vtoken){
                echo 'Sorry Token does not match!';
                exit;
            }

            //find all activity for this user
            $items = ORM::for_table('sys_invoiceitems')->where('invoiceid',$id)->order_by_asc('id')->find_many();
            $trs_c = ORM::for_table('sys_transactions')->where('iid', $id)->count();

            $trs = ORM::for_table('sys_transactions')->where('iid', $id)->order_by_desc('id')->find_many();
//find the user
            $a = ORM::for_table('crm_accounts')->find_one($d['userid']);
            $i_credit = $d['credit'];
            $i_due = '0.00';
            $i_total = $d['total'];
            if($d['credit'] != '0.00'){
                $i_due = $i_total - $i_credit;
            }
            require 'sysfrm/vendors/invoices/render.php';

        }
        else{
            r2(U . 'customers/list', 'e', $_L['Account_Not_Found']);
        }

        break;

    case 'ipdf':
        $id  = $routes['2'];
        $d = ORM::for_table('sys_invoices')->find_one($id);
        if($d){
            $token = $routes['3'];
            $token = str_replace('token_','',$token);
            $vtoken = $d['vtoken'];
            if($token != $vtoken){
                echo 'Sorry Token does not match!';
                exit;
            }
            //find all activity for this user
            $items = ORM::for_table('sys_invoiceitems')->where('invoiceid',$id)->order_by_asc('id')->find_many();

            $trs_c = ORM::for_table('sys_transactions')->where('iid', $id)->count();

            $trs = ORM::for_table('sys_transactions')->where('iid', $id)->order_by_desc('id')->find_many();

//find the user
            $a = ORM::for_table('crm_accounts')->find_one($d['userid']);
            $i_credit = $d['credit'];
            $i_due = '0.00';
            $i_total = $d['total'];
            if($d['credit'] != '0.00'){
                $i_due = $i_total - $i_credit;
            }

            $i_due = number_format($i_due,2,$config['dec_point'],$config['thousands_sep']);
            $cf = ORM::for_table('crm_customfields')->where('showinvoice','Yes')->order_by_asc('id')->find_many();

            define('_MPDF_PATH','sysfrm/vendors/mpdf/');

            require('sysfrm/vendors/mpdf/mpdf.php');

            $pdf_c = '';
            $ib_w_font = 'dejavusanscondensed';
            if($config['pdf_font'] == 'default'){
                $pdf_c = 'c';
                $ib_w_font = 'Helvetica';
            }

            $mpdf=new mPDF($pdf_c,'A4','','',20,15,15,25,10,10);
            $mpdf->SetProtection(array('print'));
            $mpdf->SetTitle($config['CompanyName'].$_L['Invoice']);
            $mpdf->SetAuthor($config['CompanyName']);
            $mpdf->SetWatermarkText(ib_lan_get_line($d['status']));
            $mpdf->showWatermarkText = true;
            $mpdf->watermark_font = $ib_w_font;
            $mpdf->watermarkTextAlpha = 0.1;
            $mpdf->SetDisplayMode('fullpage');

            ob_start();

            require 'sysfrm/vendors/invoices/pdf-x2.php';

            $html = ob_get_contents();


            ob_end_clean();

            $mpdf->WriteHTML($html);

            if (isset($routes['4']) AND ($routes['4'] == 'dl')) {
                $mpdf->Output(date('Y-m-d') . _raid(4) . '.pdf', 'D'); # D
            } else {
                $mpdf->Output(date('Y-m-d') . _raid(4) . '.pdf', 'I'); # D
            }
        }
        else{
            r2(U . 'customers/list', 'e', $_L['Account_Not_Found']);
        }

        break;

    case 'qpdf':

        $id  = $routes['2'];

        $d = ORM::for_table('sys_quotes')->find_one($id);
        if ($d) {

            //find all activity for this user
            $items = ORM::for_table('sys_quoteitems')->where('qid', $id)->order_by_asc('id')->find_many();


            $a = ORM::for_table('crm_accounts')->find_one($d['userid']);



            $cf = ORM::for_table('crm_customfields')->where('showinvoice', 'Yes')->order_by_asc('id')->find_many();


            define('_MPDF_PATH','sysfrm/vendors/mpdf/');

            require('sysfrm/vendors/mpdf/mpdf.php');

            $pdf_c = '';
            $ib_w_font = 'dejavusanscondensed';
            if($config['pdf_font'] == 'default'){
                $pdf_c = 'c';
                $ib_w_font = 'Helvetica';
            }

            $mpdf=new mPDF($pdf_c,'A4','','',20,15,15,25,10,10);
            $mpdf->SetProtection(array('print'));
            $mpdf->SetTitle($config['CompanyName'].' Invoice');
            $mpdf->SetAuthor($config['CompanyName']);
            $mpdf->SetWatermarkText($d['status']);
            $mpdf->showWatermarkText = true;
            $mpdf->watermark_font = $ib_w_font;
            $mpdf->watermarkTextAlpha = 0.1;
            $mpdf->SetDisplayMode('fullpage');

            ob_start();

            require 'sysfrm/vendors/invoices/q-x2.php';

            $html = ob_get_contents();


            ob_end_clean();

            $mpdf->WriteHTML($html);

            if (isset($routes['3']) AND ($routes['3'] == 'dl')) {
                $mpdf->Output(date('Y-m-d') . _raid(4) . '.pdf', 'D'); # D
            } else {
                $mpdf->Output(date('Y-m-d') . _raid(4) . '.pdf', 'I'); # D
            }
            // $mpdf->Output();



        }
        break;


    case 'ipay':
        $id  = $routes['2'];
        $d = ORM::for_table('sys_invoices')->find_one($id);
        if($d){
            $token = $routes['3'];
            $token = str_replace('token_','',$token);
            $vtoken = $d['vtoken'];
            if($token != $vtoken){
                echo 'Sorry Token does not match!';
                exit;
            }

            //check pg
$ui->assign('d',$d);


            $i_credit = $d['credit'];
            $i_due = '0.00';
            $i_total = $d['total'];


            $amount = $i_total - $i_credit;
            $invoiceid = $d['id'];
            $vtoken = $d['vtoken'];
            $ptoken = $d['ptoken'];


            //get user details

            $u = ORM::for_table('crm_accounts')->find_one($d['userid']);


$pg = _post('pg');

          switch ($pg){

              case 'paypal':

                  $p = ORM::for_table('sys_pg')->where('processor', 'paypal')->find_one();

                  if($p){

                      $ppemail = $p['value'];
//
                      $currency_code = $p['c1'];
                      $c2 = $p['c2'];
                      if(($c2 != '') AND (is_numeric($c2)) AND($c2 != '1')){
                          $amount = $amount/$c2;
                      }

                      $url = 'https://www.paypal.com/cgi-bin/webscr';

                      $params = array(
                          array('name' => "business",
                              'value' => $ppemail
                          ),
                          array('name' => "return",
                              'value' => APP_URL . "/index.php?_route=client/ipay_submitted/$invoiceid/token_$vtoken/",
                          ),
                          array('name' => "cancel_return",
                              'value' => APP_URL . "/index.php?_route=client/ipay_cancel/$invoiceid/token_$vtoken/",
                          ),
                          array('name' => "notify_url",
                              'value' => APP_URL . "/index.php?_route=client/ipay_ipn/$invoiceid/token_$ptoken/",
                          ),
                          array('name' => "item_name_1",
                              'value' => "Payment For INV # $invoiceid"
                          ),
                          array('name' => "amount_1",
                              'value' => $amount
                          ),
                          array('name' => "item_number_1",
                              'value' => $invoiceid
                          ),
                          array('name' => "quantity_1",
                              'value' => '1'
                          ),
                          array('name' => "upload",
                              'value' => '1'
                          ),
                          array('name' => "cmd",
                              'value' => '_cart'
                          ),
                          array('name' => "txn_type",
                              'value' => 'cart'
                          ),
                          array('name' => "num_cart_items",
                              'value' => '1'
                          ),
                          array('name' => "rm",
                              'value' => '2'
                          ),
                          array('name' => "payment_gross",
                              'value' => $amount
                          ),
                          array('name' => "currency_code",
                              'value' => $currency_code
                          )
                      );


                      Fsubmit::form($url, $params);

                  }

                  else{
                      echo 'Paypal is Not Found!';
                  }


                  break;


              case 'manualpayment':
                  $p = ORM::for_table('sys_pg')->where('processor', 'manualpayment')->find_one();

                  if($p){
                      $ui->assign('ins',$p['value']);
                      $ui->display('client-ipay.tpl');
                  }


                  break;

              case 'stripe':
                  $p = ORM::for_table('sys_pg')->where('processor', 'stripe')->find_one();

                  if($p){
                      $a = ORM::for_table('crm_accounts')->find_one($d['userid']);
                      $it = $i_total - $i_credit;
                      $amount = $it*100;
                      $ins = ' <script
                                        src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
                                        data-key="'.$p['value'].'"
                                        data-amount="'.$amount.'"
                                        data-name="INV #'.$d['id'].'"
                                        data-email="'.$a['email'].'"
                                        data-currency="'.$p['c1'].'"
                                        data-description="Payment for Invoice # '.$d['id'].'">
                                </script>';
                      $ui->assign('ins',$ins);
                      $ui->display('client-ipay.tpl');
                  }


                  break;


              case 'authorize_net':

                  $p = ORM::for_table('sys_pg')->where('processor', 'authorize_net')->find_one();

                  if($p){
                      $invoiceid = $d['id'];
                      $amount = $i_total - $i_credit;
                      $url = 'https://secure.authorize.net/gateway/transact.dll';
                      $loginID = $p['value'];
                      $transactionKey = $p['c1'];

                      $description = "Invoice Payment - $invoiceid";

                      // an invoice is generated using the date and time
                      $invoice = $invoiceid;
// a sequence number is randomly generated
                      $sequence = rand(1, 1000);
// a timestamp is generated
                      $timeStamp = time();

                      $testMode = "false";
                      if (phpversion() >= '5.1.2') {
                          $fingerprint = hash_hmac("md5", $loginID . "^" . $sequence . "^" . $timeStamp . "^" . $amount . "^", $transactionKey);
                      } else {
                          $fingerprint = bin2hex(mhash(MHASH_MD5, $loginID . "^" . $sequence . "^" . $timeStamp . "^" . $amount . "^", $transactionKey));
                      }
                      $params = array(
                          array('name' => "x_login",
                              'value' => $loginID
                          ),
                          array('name' => "x_amount",
                              'value' => $amount
                          ),
                          array('name' => "x_description",
                              'value' => $description
                          ),
                          array('name' => "x_invoice_num",
                              'value' => $invoice
                          ),
                          array('name' => "x_fp_sequence",
                              'value' => $sequence
                          ),
                          array('name' => "x_fp_timestamp",
                              'value' => $timeStamp
                          ),
                          array('name' => "x_fp_hash",
                              'value' => $fingerprint
                          ),
                          array('name' => "x_test_request",
                              'value' => $testMode
                          ),
                          array('name' => "x_show_form",
                              'value' => "PAYMENT_FORM"
                          )
                      );

                      Fsubmit::form($url, $params);
                  }


                  break;


              case 'ccavenue':

                  $p = ORM::for_table('sys_pg')->where('processor', 'ccavenue')->find_one();

                  if($p){

                      require ('sysfrm/vendors/misc/ccavenue.php');

                      $currency_code = $p['c2'];
                      $c3 = $p['c3'];

                      if(($c3 != '') AND (is_numeric($c3)) AND($c3 != '1')){
                          $amount = $amount/$c3;
                      }

                      $Merchant_Id = $p['value']; //Given to merchant by ccavenue


                      $WorkingKey = $p['c1']; //Given to merchant by ccavenue

                      $redirect_url = APP_URL . "/index.php?_route=client/ipay_ipn/$invoiceid/token_$ptoken/";

                      $Checksum = getCheckSum($Merchant_Id,$amount,$invoiceid ,$redirect_url,$WorkingKey);

                      $url = 'https://www.ccavenue.com/shopzone/cc_details.jsp';




                      $params = array(

                          array('name' => "Merchant_Id",
                              'value' => $Merchant_Id
                          ),

                          array('name' => "Redirect_Url",
                              'value' => $redirect_url
                          ),

                          array('name' => "Amount",
                              'value' => $amount
                          ),
                          array('name' => "Order_Id",
                              'value' => $invoiceid
                          ),
                          array('name' => "Checksum",
                              'value' => $Checksum
                          ),
                          array('name' => "upload",
                              'value' => '1'
                          ),
                          array('name' => "ActionID",
                              'value' => 'TXN'
                          ),
                          array('name' => "TxnType",
                              'value' => 'A'
                          ),
                          array('name' => "num_cart_items",
                              'value' => '1'
                          ),
                          array('name' => "rm",
                              'value' => '2'
                          ),
                          array('name' => "payment_gross",
                              'value' => $amount
                          ),
                          array('name' => "TxnType",
                              'value' => 'A'
                          ),
                          array('name' => "payment_gross",
                              'value' => $amount
                          ),
                          array('name' => "Currency",
                              'value' => $currency_code
                          ),
                          array('name' => "billing_cust_name",
                              'value' =>$u['account']
                          ),
                          array('name' => "billing_cust_address",
                              'value' =>$u['address']
                          ),
                          array('name' => "billing_cust_country",
                              'value' =>$u['country']
                          ),
                          array('name' => "billing_cust_city",
                              'value' =>$u['city']
                          ),
                          array('name' => "billing_zip_code",
                              'value' =>$u['zip']
                          ),
                          array('name' => "billing_cust_tel",
                              'value' =>$u['phone']
                          ),
                          array('name' => "billing_cust_email",
                              'value' =>$u['email']
                          ),
                          array('name' => "billing_cust_notes",
                              'value' =>''
                          ),
                          array('name' => "delivery_cust_name",
                              'value' =>$u['account']
                          ),
                          array('name' => "delivery_cust_address",
                              'value' =>$u['address']
                          ),
                          array('name' => "delivery_cust_country",
                              'value' =>$u['country']
                          ),
                          array('name' => "delivery_cust_tel",
                              'value' =>$u['phone']
                          ),
                          array('name' => "Merchant_Param",
                              'value' =>''
                          ),
                          array('name' => "delivery_zip_code",
                              'value' =>$u['zip']
                          ),
                          array('name' => "delivery_cust_city",
                              'value' =>$u['city']
                          )

                      );


                      Fsubmit::form($url, $params);

                  }



                  break;


              case 'braintree':

                  $p = ORM::for_table('sys_pg')->where('processor', 'braintree')->find_one();
                  require_once 'sysfrm/vendors/braintree/Braintree.php';
                  Braintree_Configuration::environment($p['c4']);
                  Braintree_Configuration::merchantId($p['value']);
                  Braintree_Configuration::publicKey($p['c1']);
                  Braintree_Configuration::privateKey($p['c2']);

                  if($p){
                      $a = ORM::for_table('crm_accounts')->find_one($d['userid']);
                      $it = $i_total - $i_credit;
                      $amount = $it*100;
                      $clientToken = Braintree_ClientToken::generate(array());
                      $formurl = APP_URL . "/index.php?_route=client/btpay_submitted/$invoiceid/token_$vtoken/";
                      $vamount =  $config['currency_code']. number_format($d['total'],2,$config['dec_point'],$config['thousands_sep']);
                      $ins = '
                      <form id="checkout" method="post" action="'.$formurl.'">
  <div id="payment-form"></div>
  <input type="submit" value="Pay '.$config['currency_code'].' '.$vamount .'">
</form>
                      <script src="https://js.braintreegateway.com/v2/braintree.js"></script>
                      <script>
									var clientToken = "'.$clientToken.'";
									braintree.setup(clientToken, "dropin", {
  									container: "payment-form"
									});
								</script>';
                      $ui->assign('ins',$ins);
                      $ui->display('client-ipay.tpl');
                  }
                  break;




              default:
                  echo 'Payment Gateway Not Found!';

          }

        }
        else{
            echo 'Sorry Invoice Not Found!';
            exit;
        }

        break;

    /*
     * CCAvenue
     *
     *
     */


    case 'ipay_cancel':

        $id  = $routes['2'];
        $token = $routes['3'];
       r2(U."client/iview/$id/$token/",'e',$_L['Payment Cancelled']);

        break;


    case 'ipay_submitted':

        $id  = $routes['2'];
        $token = $routes['3'];
        r2(U."client/iview/$id/$token/",'s',$_L['Payment Successful']);


        break;

    case 'ipay_ipn':

        $id  = $routes['2'];
        $token = $routes['3'];
     //   r2(U."client/iview/$id/$token/",'s',$_L['Payment Successful']);

        $d = ORM::for_table('sys_invoices')->find_one($id);
        if($d) {
            $token = $routes['3'];
            $token = str_replace('token_', '', $token);
            $ptoken = $d['ptoken'];
            if ($token != $ptoken) {
                echo 'Sorry Token does not match!';
                exit;
            }

            $d->status = 'Paid';
            $d->save();

        }

        break;


    case 'btpay_submitted':
        $id  = $routes['2'];
        $token = $routes['3'];
        $p = ORM::for_table('sys_pg')->where('processor', 'braintree')->find_one();
        if($p){
            $merchantId	= $p["value"];
            $publicKey	= $p["c1"];
            $privateKey	= $p["c2"];
            $account 	= $p["c3"];
            $environment = $p["c4"];
            $accountname = $p["name"];
            require_once $_SERVER['DOCUMENT_ROOT'].'/braintree-php-3.0.1/lib/Braintree.php';
            Braintree_Configuration::environment($environment);
            Braintree_Configuration::merchantId($merchantId);
            Braintree_Configuration::publicKey($publicKey);
            Braintree_Configuration::privateKey($privateKey);
            $nonce = isset( $_POST["payment_method_nonce"] )?$_POST["payment_method_nonce"]:0;
            if ($nonce) {
                // get user
                $a = ORM::for_table('crm_accounts')->find_one($d['userid']);
                // get invoice
                $id  = $routes['2'];
                $d = ORM::for_table('sys_invoices')->find_one($id);
                if($d){
                    // we have an invoice, validate token...
                    $token = $routes['3'];
                    $token = str_replace('token_','',$token);
                    $vtoken = $d['vtoken'];
                    if($token != $vtoken){
                        echo 'Sorry Token does not match!';
                        exit;
                    } else {
                        // echo 'TOKEN MATCHES!!!!!!!!!!!!!!!!';
                        $i_credit = $d['credit'];
                        $i_due = '0.00';
                        $i_total = $d['total'];
                        $amount = $i_total - $i_credit;
                        $invoiceid = $d['id'];

                        $result = Braintree_Transaction::sale(array(
                            'amount' => $amount,
                            'orderId' => $id,
                            'paymentMethodNonce' => $nonce,
                            'options' => array(
                                'submitForSettlement' => True
                            )
                        ));

                        if ($result->success) {
                            $invoiceview = APP_URL . "/index.php?_route=invoices/pdf/$invoiceid/view/token_$vtoken";
                            $invoiceprint = APP_URL . "/index.php?_route=iview/print/$invoiceid/token_$vtoken";
                            $ins = "success!: Thank you for your payment";
                            $ins.= "<br />".'To PRINT your invoice click here <a href="'.$invoiceprint.'" target="_blank"><button>Print Invoice</button></a>';
                            $date = $result->transaction->createdAt->date; //"2015-06-15 18:52:57.000000"
                            $amount = $result->transaction->amount;
                            $amount = Finance::amount_fix($amount);
                            $payerid = $a["id"];
                            $pmethod = 'Braintree';
                            $amount = str_replace($config['currency_code'], '', $amount);
                            $amount = str_replace(',', '', $amount);
                            if (!is_numeric($amount)) {
                                $msg .= 'Invalid Amount' . '<br>';
                            }
                            $cat = 'Consulting'; //77; // Consulting income. This should already be defined on the invoice or line item.
                            $iid = $id;// invoice ID
                            $description = $p["name"]; //'Braintree Payment';
                            $a = ORM::for_table('sys_accounts')->where('id', $account)->find_one(); // get braintree balance
                            $cbal = $a['balance']; // customer balance
                            $nbal = $cbal + $amount;
                            $a->balance = $nbal;
                            $a->save(); // update customer balance
                            $d = ORM::for_table('sys_transactions')->create(); // BOF add a transaction
                            $d->account = $accountname;
                            $d->type = 'Income';
                            $d->payerid = $payerid;

                            $d->amount = $amount;
                            $d->category = $cat;
                            $d->method = $pmethod;
                            $d->description = 'Invoice '.$id .' Payment'; //$description;
                            $d->date = date('Y-m-d');//"2015-06-15 18:52:57.000000"
                            $d->dr = '0.00';
                            $d->cr = $amount;
                            $d->bal = $nbal;
                            $d->iid = $iid;
                            $d->save(); // BOF add a transaction
                            $tid = $d->id();
                            // log it...
                            _log('New Deposit: ' . $description . ' [TrID: ' . $tid . ' | Amount: ' . $amount . ']', 'Admin',$payerid);
                            _msglog('s', 'Transaction Added Successfully');
                            $i = ORM::for_table('sys_invoices')->find_one($iid);
                            if ($i) {
                                $pc = $i['credit'];
                                $it = $i['total'];
                                $dp = $it - $pc;
                                if (($dp == $amount) OR (($dp < $amount))) {
                                    $i->status = 'Paid';
                                    $i->datepaid = date('Y-m-d H:i:s');
                                } else {
                                    $i->status = 'Partially Paid';
                                }
                                $i->credit = $pc + $amount;
                                $i->paymentmethod = $accountname;
                                $i->save();

                            } //if ($i) {
                        } else if ($result->transaction) {
                            $ins = ("Error processing transaction:");
                            $ins .= ("\n  code: " . $result->transaction->processorResponseCode);
                            $ins .= ("\n  text: " . $result->transaction->processorResponseText);
                        } else {
                            $ins = ("Validation errors: \n");
                            $ins .= ($result->errors->deepAll());
                        }
                        $ui->assign('ins',$ins);
                        $ui->display('client-ipay.tpl');
                    }
                }
            }
            /* eof bernie changes */
        } else echo 'Payment Gateway Not Found!';


        break;

    default:
        echo 'action not defined';
}

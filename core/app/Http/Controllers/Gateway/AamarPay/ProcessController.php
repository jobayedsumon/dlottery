<?php

namespace App\Http\Controllers\Gateway\AamarPay;

use App\Constants\Status;
use App\Models\Deposit;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    /*
     * AamarPay Gateway
     */

    public static function process($deposit)
    {
        $basic = gs();
        $user = $deposit->user;
        $address = $user->address;
        $aamarpayAcc = json_decode($deposit->gatewayCurrency()->gateway_parameter);

        $val['store_id'] = trim($aamarpayAcc->store_id);
        $val['signature_key'] = trim($aamarpayAcc->signature_key);
        $val['currency'] = "$deposit->method_currency";
        $val['tran_id'] = "$deposit->trx";
        $val['amount'] = round($deposit->final_amo,2);
        $val['payment_type'] = 'VISA';
        $val['desc'] = "Payment To $basic->site_name Account";
        $val['cus_name'] = $user->username;
        $val['cus_email'] = $user->email;
        $val['cus_add1'] = $address->address ?? 'N/A';
        $val['cus_city'] = $address->city ?? 'N/A';
        $val['cus_state'] = $address->state ?? 'N/A';
        $val['cus_postcode'] = $address->zip ?? 'N/A';
        $val['cus_country'] = $address->country ?? 'N/A';
        $val['cus_phone'] = $user->mobile ?? 'N/A';
        $val['ship_name'] = $user->username ?? 'N/A';
        $val['ship_add1'] = $address->address ?? 'N/A';
        $val['ship_city'] = $address->city ?? 'N/A';
        $val['ship_state'] = $address->state ?? 'N/A';
        $val['ship_postcode'] = $address->zip ?? 'N/A';
        $val['ship_country'] = $address->country ?? 'N/A';
        $val['success_url'] = route('ipn.'.$deposit->gateway->alias);
        $val['fail_url'] = route('ipn.'.$deposit->gateway->alias);
        $val['cancel_url'] = route(gatewayRedirectUrl());

        $url = env('APP_ENV') == 'live' ? 'https://secure.aamarpay.com' : 'https://sandbox.aamarpay.com';

        $fields_string = http_build_query($val);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_URL, $url . '/request.php');

        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $redirect_url = str_replace('"', '', stripslashes(curl_exec($ch)));
        curl_close($ch);

        $send['val'] = $val;
        $send['view'] = 'user.payment.redirect';
        $send['method'] = 'post';
        $send['url'] = $url;
        $send['redirect'] = true;
        $send['redirect_url'] = $url . $redirect_url;

        return json_encode($send);
    }


    public function ipn(Request $request)
    {
        if (isset($request->status_code) && isset($request->pay_status)) {

            $deposit = Deposit::where('trx', $request->mer_txnid)->orderBy('id', 'DESC')->first();

            if ($request->amount == getAmount($deposit->final_amo)
                && $request->currency == $deposit->method_currency
                && $request->status_code == "2"
                && $request->pay_status == "Successful"
                && $deposit->status == Status::PAYMENT_INITIATE) {
                PaymentController::userDataUpdate($deposit);
                $notify[] = ['success', 'Transaction is successful'];
                return to_route(gatewayRedirectUrl(true))->withNotify($notify);
            } else {
                $notify[] = ['error', 'Payment failed'];
            }

        } else {
            $notify[] = ['error', 'Payment failed'];
        }
        return to_route(gatewayRedirectUrl())->withNotify($notify);
    }
}

<?php

namespace App\Http\Controllers\Gateway\Bkash;

use App\Constants\Status;
use App\Models\Deposit;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    /*
     * Bkash Gateway
     */

    public static function process($deposit)
    {
        $base_url = env('APP_ENV') == 'live' ? 'https://tokenized.pay.bka.sh/v1.2.0-beta' : 'https://tokenized.sandbox.bka.sh/v1.2.0-beta';
        $bkashAcc = json_decode($deposit->gatewayCurrency()->gateway_parameter);

        $user = $deposit->user;

        $response = self::getToken($base_url, $bkashAcc);
        $auth = $response['id_token'];
        session()->put('token', $auth);
        $callbackURL = route('ipn.'.$deposit->gateway->alias, ['deposit_id' => $deposit->id, 'token' => $auth]);

        $val = array(
            'mode' => '0011',
            'amount' => (string)round($deposit->final_amo,2),
            'currency' => "$deposit->method_currency",
            'intent' => 'sale',
            'payerReference' => $user->email,
            'merchantInvoiceNumber' => "$deposit->trx",
            'callbackURL' => $callbackURL
        );

        $url = curl_init($base_url . '/tokenized/checkout/create');
        $requestbodyJson = json_encode($val);

        $header = array(
            'Content-Type:application/json',
            'Authorization:' . $auth,
            'X-APP-Key:' . (env('APP_ENV') == 'live' ? $bkashAcc->app_key : '4f6o0cjiki2rfm34kfdadl1eqq')
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $requestbodyJson);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $resultdata = curl_exec($url);
        curl_close($url);

        $obj = json_decode($resultdata);

        $send['val'] = $val;
        $send['view'] = 'user.payment.redirect';
        $send['method'] = 'post';
        $send['url'] = $url;
        $send['redirect'] = true;
        $send['redirect_url'] = $obj->{'bkashURL'};

        return json_encode($send);
    }


    public function ipn(Request $request)
    {
        $paymentID = $request->paymentID;
        $auth = $request->token;
        $request_body = array(
            'paymentID' => $paymentID
        );

        $base_url = env('APP_ENV') == 'live' ? 'https://tokenized.pay.bka.sh/v1.2.0-beta' : 'https://tokenized.sandbox.bka.sh/v1.2.0-beta';

        $url = curl_init($base_url . '/tokenized/checkout/execute');

        $request_body_json = json_encode($request_body);

        $bkashAcc = json_decode(Deposit::find($request->deposit_id)->gatewayCurrency()->gateway_parameter);

        $header = array(
            'Content-Type:application/json',
            'Authorization:' . $auth,
            'X-APP-Key:' . (env('APP_ENV') == 'live' ? $bkashAcc->app_key : '4f6o0cjiki2rfm34kfdadl1eqq')
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $request_body_json);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $resultdata = curl_exec($url);
        curl_close($url);
        $obj = json_decode($resultdata);

        if (isset($obj) && $obj->statusCode == '0000' && $obj->statusMessage == "Successful" && $obj->transactionStatus == "Completed") {
            $deposit = Deposit::where('trx', $obj->merchantInvoiceNumber)->orderBy('id', 'DESC')->first();
            if ($deposit->status == Status::PAYMENT_INITIATE) {
                PaymentController::userDataUpdate($deposit);
                $notify[] = ['success', 'Transaction is successful'];
                return to_route(gatewayRedirectUrl(true))->withNotify($notify);
            } else {
                $notify[] = ['error', 'Payment failed'];
            }
        } else {
            $notify[] = ['error', 'Payment failed'];
            return to_route(gatewayRedirectUrl())->withNotify($notify);
        }
        return to_route(gatewayRedirectUrl())->withNotify($notify);
    }

    private static function getToken($base_url, $bkashAcc)
    {
        $post_token = array(
            'app_key' => env('APP_ENV') == 'live' ? $bkashAcc->app_key : '4f6o0cjiki2rfm34kfdadl1eqq',
            'app_secret' => env('APP_ENV') == 'live' ? $bkashAcc->app_secret : '2is7hdktrekvrbljjh44ll3d9l1dtjo4pasmjvs5vl5qr3fug4b'
        );

        $url = curl_init($base_url . '/tokenized/checkout/token/grant');
        $post_token_json = json_encode($post_token);
        $header = array(
            'Content-Type:application/json',
            'username:' . (env('APP_ENV') == 'live' ? $bkashAcc->username : 'sandboxTokenizedUser02'),
            'password:' . (env('APP_ENV') == 'live' ? $bkashAcc->password : 'sandboxTokenizedUser02@12345')
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $post_token_json);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

        $resultdata = curl_exec($url);
        curl_close($url);

        $response = json_decode($resultdata, true);

        if (array_key_exists('msg', $response)) {
            return $response;
        }

        return $response;
    }
}

<?php

use App\Constants\Status;
use App\Lib\GoogleAuthenticator;
use App\Models\AdminNotification;
use App\Models\Extension;
use App\Models\Frontend;
use App\Models\GeneralSetting;
use App\Models\UserLogin;
use Carbon\Carbon;
use App\Lib\Captcha;
use App\Lib\ClientInfo;
use App\Lib\CurlRequest;
use App\Lib\FileManager;
use App\Models\CommissionLog;
use App\Models\Referral;
use App\Models\Transaction;
use App\Models\User;
use App\Notify\Notify;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

function systemDetails()
{
    $system['name'] = 'LottoLab';
    $system['version'] = '2.0';
    $system['build_version'] = '4.3.6';
    return $system;
}

function slug($string)
{
    return Illuminate\Support\Str::slug($string);
}

function verificationCode($length)
{
    if ($length == 0) return 0;
    $min = pow(10, $length - 1);
    $max = (int) ($min - 1) . '9';
    return random_int($min, $max);
}

function getNumber($length = 8)
{
    $characters = '1234567890';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function activeTemplate($asset = false)
{
    $general = gs();
    $template = $general->active_template;
    if ($asset) return 'assets/templates/' . $template . '/';
    return 'templates.' . $template . '.';
}

function activeTemplateName()
{
    $general = gs();
    $template = $general->active_template;
    return $template;
}

function loadReCaptcha()
{
    return Captcha::reCaptcha();
}

function loadCustomCaptcha($width = '100%', $height = 58, $bgColor = '#003') //46 height
{
    return Captcha::customCaptcha($width, $height, $bgColor);
}

function verifyCaptcha()
{
    return Captcha::verify();
}

function loadExtension($key)
{
    $extension = Extension::where('act', $key)->where('status', Status::ENABLE)->first();
    return $extension ? $extension->generateScript() : '';
}

function getTrx($length = 12)
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getAmount($amount, $length = 2)
{
    $amount = round($amount, $length);
    return $amount + 0;
}

function showAmount($amount, $decimal = 2, $separate = true, $exceptZeros = false)
{
    $separator = '';
    if ($separate) {
        $separator = ',';
    }
    $printAmount = number_format($amount, $decimal, '.', $separator);
    if ($exceptZeros) {
        $exp = explode('.', $printAmount);
        if ($exp[1] * 1 == 0) {
            $printAmount = $exp[0];
        } else {
            $printAmount = rtrim($printAmount, '0');
        }
    }
    return $printAmount;
}


function removeElement($array, $value)
{
    return array_diff($array, (is_array($value) ? $value : array($value)));
}

function cryptoQR($wallet)
{
    return "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$wallet&choe=UTF-8";
}


function keyToTitle($text)
{
    return ucfirst(preg_replace("/[^A-Za-z0-9 ]/", ' ', $text));
}


function titleToKey($text)
{
    return strtolower(str_replace(' ', '_', $text));
}


function strLimit($title = null, $length = 10)
{
    return Str::limit($title, $length);
}


function getIpInfo()
{
    $ipInfo = ClientInfo::ipInfo();
    return $ipInfo;
}


function osBrowser()
{
    $osBrowser = ClientInfo::osBrowser();
    return $osBrowser;
}


function getTemplates()
{
    $param['purchasecode'] = env("PURCHASECODE");
    $param['website'] = @$_SERVER['HTTP_HOST'] . @$_SERVER['REQUEST_URI'] . ' - ' . env("APP_URL");
    $url = 'https://license.viserlab.com/updates/templates/' . systemDetails()['name'];
    $response = CurlRequest::curlPostContent($url, $param);
    if ($response) {
        return $response;
    } else {
        return null;
    }
}


function getPageSections($arr = false)
{
    $jsonUrl = resource_path('views/') . str_replace('.', '/', activeTemplate()) . 'sections.json';
    $sections = json_decode(file_get_contents($jsonUrl));
    if ($arr) {
        $sections = json_decode(file_get_contents($jsonUrl), true);
        ksort($sections);
    }
    return $sections;
}


function getImage($image, $size = null)
{
    $clean = '';
    if (file_exists($image) && is_file($image)) {
        return asset($image) . $clean;
    }
    if ($size) {
        return route('placeholder.image', $size);
    }
    return asset('assets/images/default.png');
}


function notify($user, $templateName, $shortCodes = null, $sendVia = null, $createLog = true)
{
    $general = gs();
    $globalShortCodes = [
        'site_name' => $general->site_name,
        'site_currency' => $general->cur_text,
        'currency_symbol' => $general->cur_sym,
    ];

    if (gettype($user) == 'array') {
        $user = (object) $user;
    }

    $shortCodes = array_merge($shortCodes ?? [], $globalShortCodes);

    $notify = new Notify($sendVia);
    $notify->templateName = $templateName;
    $notify->shortCodes = $shortCodes;
    $notify->user = $user;
    $notify->createLog = $createLog;
    $notify->userColumn = isset($user->id) ? $user->getForeignKey() : 'user_id';
    $notify->send();
}

function getPaginate($paginate = 20)
{
    return $paginate;
}

function paginateLinks($data)
{
    return $data->appends(request()->all())->links();
}


function menuActive($routeName, $type = null, $param = null)
{
    if ($type == 3) $class = 'side-menu--open';
    elseif ($type == 2) $class = 'sidebar-submenu__open';
    else $class = 'active';

    if (is_array($routeName)) {
        foreach ($routeName as $key => $value) {
            if (request()->routeIs($value)) return $class;
        }
    } elseif (request()->routeIs($routeName)) {
        if ($param) {
            $routeParam = array_values(@request()->route()->parameters ?? []);
            if (strtolower(@$routeParam[0]) == strtolower($param)) return $class;
            else return;
        }
        return $class;
    }
}


function fileUploader($file, $location, $size = null, $old = null, $thumb = null)
{
    $fileManager = new FileManager($file);
    $fileManager->path = $location;
    $fileManager->size = $size;
    $fileManager->old = $old;
    $fileManager->thumb = $thumb;
    $fileManager->upload();
    return $fileManager->filename;
}

function fileManager()
{
    return new FileManager();
}

function getFilePath($key)
{
    return fileManager()->$key()->path;
}

function getFileSize($key)
{
    return fileManager()->$key()->size;
}

function getFileExt($key)
{
    return fileManager()->$key()->extensions;
}

function diffForHumans($date)
{
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->diffForHumans();
}


function showDateTime($date, $format = 'Y-m-d h:i A')
{
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->translatedFormat($format);
}


function getContent($dataKeys, $singleQuery = false, $limit = null, $orderById = false)
{
    if ($singleQuery) {
        $content = Frontend::where('data_keys', $dataKeys)->orderBy('id', 'desc')->first();
    } else {
        $article = Frontend::query();
        $article->when($limit != null, function ($q) use ($limit) {
            return $q->limit($limit);
        });
        if ($orderById) {
            $content = $article->where('data_keys', $dataKeys)->orderBy('id')->get();
        } else {
            $content = $article->where('data_keys', $dataKeys)->orderBy('id', 'desc')->get();
        }
    }
    return $content;
}


function gatewayRedirectUrl($type = false)
{
    if ($type) {
        return 'user.deposit.history';
    } else {
        return 'user.deposit.index';
    }
}

function verifyG2fa($user, $code, $secret = null)
{
    $authenticator = new GoogleAuthenticator();
    if (!$secret) {
        $secret = $user->tsc;
    }
    $oneCode = $authenticator->getCode($secret);
    $userCode = $code;
    if ($oneCode == $userCode) {
        $user->tv = 1;
        $user->save();
        return true;
    } else {
        return false;
    }
}


function urlPath($routeName, $routeParam = null)
{
    if ($routeParam == null) {
        $url = route($routeName);
    } else {
        $url = route($routeName, $routeParam);
    }
    $basePath = route('home');
    $path = str_replace($basePath, '', $url);
    return $path;
}


function showMobileNumber($number)
{
    $length = strlen($number);
    return substr_replace($number, '***', 2, $length - 4);
}

function showEmailAddress($email)
{
    $endPosition = strpos($email, '@') - 1;
    return substr_replace($email, '***', 1, $endPosition);
}


function getRealIP()
{
    $ip = $_SERVER["REMOTE_ADDR"];
    //Deep detect ip
    if (filter_var(@$_SERVER['HTTP_FORWARDED'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_FORWARDED'];
    }
    if (filter_var(@$_SERVER['HTTP_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_FORWARDED_FOR'];
    }
    if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    if (filter_var(@$_SERVER['HTTP_X_REAL_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_X_REAL_IP'];
    }
    if (filter_var(@$_SERVER['HTTP_CF_CONNECTING_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    }
    if ($ip == '::1') {
        $ip = '127.0.0.1';
    }

    return $ip;
}


function appendQuery($key, $value)
{
    return request()->fullUrlWithQuery([$key => $value]);
}

function dateSort($a, $b)
{
    return strtotime($a) - strtotime($b);
}

function dateSorting($arr)
{
    usort($arr, "dateSort");
    return $arr;
}

function gs()
{
    $general = Cache::get('GeneralSetting');
    if (!$general) {
        $general = GeneralSetting::first();
        Cache::put('GeneralSetting', $general);
    }
    return $general;
}

function loadFbComment()
{
    $comment = Extension::where('act', 'fb-comment')->where('status', 1)->first();
    return  $comment ? $comment->generateScript() : '';
}

/*
     * Showing: Ordinal Numbers.
     */
function ordinal($number)
{
    $ends = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');
    if ((($number % 100) >= 11) && (($number % 100) <= 13))
        return $number . 'th';
    else
        return $number . $ends[$number % 10];
}

function levelCommission($id, $amount, $commissionType = '')
{
    $user = $id;
    $i    = 1;
    $general = gs();
    $level   = Referral::where('commission_type', $commissionType)->count();
    while ($user != "" || $user != "0" || $i < $level) {
        $bonusTaker   = User::find($user);
        $refer = User::find($bonusTaker->ref_by);
        if ($refer == "") {
            break;
        }
        $commission = Referral::where('commission_type', $commissionType)->where('level', $i)->first();
        if ($commission == null) {
            break;
        }
        $finalCommission = ($amount * $commission->percent) / 100;

        $referWallet = User::where('id', $refer->id)->first();
        $newBalance  = getAmount($referWallet->balance + $finalCommission);
        $referWallet->balance = $newBalance;
        $referWallet->save();
        $trx = getTrx();

        $transaction =  new Transaction();
        $transaction->user_id      = $refer->id;
        $transaction->amount       = getAmount($finalCommission);
        $transaction->charge       = $refer->id;
        $transaction->trx_type     = '+';
        $transaction->details      = 'Level ' . ordinal($i) . ' referral commission by ' . $refer->username;
        $transaction->trx          = $trx;
        $transaction->remark       = 'referral_bonus';
        $transaction->post_balance = $newBalance;
        $transaction->save();

        $commissionLog = new CommissionLog();
        $commissionLog->to_id           = $refer->id;
        $commissionLog->from_id         = $id;
        $commissionLog->level           = $i;
        $commissionLog->amount          = getAmount($finalCommission);
        $commissionLog->main_balance    = getAmount($newBalance);
        $commissionLog->percent         = $commission->percent;
        $commissionLog->commission_type = $commissionType;
        $commissionLog->trx             = $trx;
        $commissionLog->title           = 'Level ' . ordinal($i) . ' referral commission by ' . $bonusTaker->username;
        $commissionLog->save();

        notify($refer, 'REFERRAL_COMMISSION', [
            'amount'       => getAmount($finalCommission),
            'post_balance' => getAmount($newBalance),
            'trx'          => $trx,
            'level'        => 'level ' . ordinal($i) . ' Referral Commission',
            'currency'     => $general->cur_text
        ]);
        $user = $refer->id;
        $i++;
    }
    return 0;
}

/**
 * Create a new user instance after a valid registration.
 *
 * @param array $data
 *
 * @return User
 * @throws ContainerExceptionInterface
 * @throws NotFoundExceptionInterface
 */
function createUser(array $data)
{
    $general = gs();

    $referBy = session()->get('reference');
    if ($referBy) {
        $referUser = User::where('username', $referBy)->first();
    } else {
        $referUser = null;
    }
    //User Create
    $user = new User();
    $user->email = strtolower(trim($data['email']));
    $user->password = Hash::make($data['password']);
    $user->username = trim($data['username']);
    $user->ref_by = $referUser ? $referUser->id : 0;
    $user->country_code = $data['country_code'] ?? null;
    if (isset($data['mobile_code']) && isset($data['mobile'])) {
        $user->mobile = $data['mobile_code'] . $data['mobile'];
    }
    $user->address = [
        'address' => '',
        'state' => '',
        'zip' => '',
        'country' => isset($data['country']) ? $data['country'] : null,
        'city' => ''
    ];
    $user->kv = $general->kv ? Status::NO : Status::YES;
    $user->ev = $general->ev ? Status::NO : Status::YES;
    $user->sv = $general->sv ? Status::NO : Status::YES;
    $user->ts = 0;
    $user->tv = 1;
    $user->save();


    $adminNotification = new AdminNotification();
    $adminNotification->user_id = $user->id;
    $adminNotification->title = 'New member registered';
    $adminNotification->click_url = urlPath('admin.users.detail',$user->id);
    $adminNotification->save();


    //Login Log Create
    $ip = getRealIP();
    $exist = UserLogin::where('user_ip',$ip)->first();
    $userLogin = new UserLogin();

    //Check exist or not
    if ($exist) {
        $userLogin->longitude =  $exist->longitude;
        $userLogin->latitude =  $exist->latitude;
        $userLogin->city =  $exist->city;
        $userLogin->country_code = $exist->country_code;
        $userLogin->country =  $exist->country;
    }else{
        $info = json_decode(json_encode(getIpInfo()), true);
        $userLogin->longitude =  @implode(',',$info['long']);
        $userLogin->latitude =  @implode(',',$info['lat']);
        $userLogin->city =  @implode(',',$info['city']);
        $userLogin->country_code = @implode(',',$info['code']);
        $userLogin->country =  @implode(',', $info['country']);
    }

    $userAgent = osBrowser();
    $userLogin->user_id = $user->id;
    $userLogin->user_ip =  $ip;

    $userLogin->browser = @$userAgent['browser'];
    $userLogin->os = @$userAgent['os_platform'];
    $userLogin->save();

    return $user;
}

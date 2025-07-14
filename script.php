<?php

error_reporting(0);
$hitam="\033[0;30m"; $abu2="\033[1;30m";               $putih="\033[0;37m"; $putih2="\033[1;37m";$merah="\033[0;31m"; $merah2="\033[1;31m";             $hijau="\033[0;32m"; $hijau2="\033[1;32m";$kuning="\033[0;33m"; $kuning2="\033[1;33m";           $biru="\033[0;34m"; $biru2="\033[1;34m";$ungu="\033[0;35m"; $purple2="\033[1;35m";             $lblue="\033[0;36m"; $lblue2="\033[1;36m";                                                       $putih1="\033[7;37m";$merah1="\033[7;31m";                                  $hijau1="\033[7;32m";$kuning1="\033[7;33m";$biru1="\033[7;34m";                                   $ungu1="\033[7;35m";$lblue1="\033[7;36m";


date_default_timezone_set('UTC');




// Function generate random sentry-trace
function SentryTrace()
{
    $traceId = bin2hex(random_bytes(16)); // 32 karakter hex
    $spanId = bin2hex(random_bytes(8));   // 16 karakter hex
    return "{$traceId}-{$spanId}";
}

// Function kirim POST tanpa body
function post($url, $headers = [])
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);                                       curl_setopt($ch, CURLOPT_POSTFIELDS, ""); // Kosong
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);                             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {                                                          $error = curl_error($ch);
        curl_close($ch);
        return ['error' => $error];                                             }

    curl_close($ch);                                                            return $response;
}
                                                                            function get($url, $headers)
{
    $ch = curl_init($url);                                                      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);                                             
    if (curl_errno($ch)) {
        $error = curl_error($ch);                                                   curl_close($ch);
        return ['error' => $error];
    }                                                                       
    curl_close($ch);
    return $response;
}                                                                           



// ------------------ MAIN ------------------

// Header tetap, hanya sentry-trace yang random

// AUTH iamtubasya@gmail.com
$auth1="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJsb2dpbklkIjoiNTAxNTExMDAiLCJpYXQiOjE3NTE5MDMzOTksImV4cCI6MTc1NDQ5NTM5OSwiYXVkIjoiaW50ZXJsaW5rLXVzZXIiLCJpc3MiOiJpbnRlcmxpbmsifQ.T2B5uZAIdXVw-0l7x8g6aCg5tpFtpE9K6nXyIe2ToFw";
// AUTH mohtubagus321@gmail.com
$auth2="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJsb2dpbklkIjoiNjE4NTIxNTExMDAiLCJpYXQiOjE3NTE5MDA2NzQsImV4cCI6MTc1NDQ5MjY3NCwiYXVkIjoiaW50ZXJsaW5rLXVzZXIiLCJpc3MiOiJpbnRlcmxpbmsifQ.AY8jcg_QlvdT3nRq4mWNrGGhUtOGzQEJbCVpDxqZXP4";

function ua($auth){
$ua = [
    "Host: prod.interlinklabs.ai",
    "accept: */*",/**/
    "authorization: Bearer ".$auth,
    "sentry-trace: " .SentryTrace(),
    "baggage: sentry-environment=production,sentry-public_key=0b62d0d4eb3f9223954e188874dfea47,sentry-trace_id=5b4492dc572e453384e42c1663041005,sentry-sample_rate=1,sentry-transaction=index,sentry-sampled=true",
    "content-length: ",
    "accept-encoding: gzip",
    "user-agent: okhttp/4.12.0"
];
return $ua;
}


// USER INFO DATA //

function user($auth){

$utc = new DateTime("now", new DateTimeZone("UTC"));
$UTC=$utc->format("Y-m-d H:i:s");

$wib = new DateTime("now", new DateTimeZone("Asia/Jakarta"));
$WIB = $wib->format("Y-m-d H:i:s");




$hitam="\033[0;30m"; $abu2="\033[1;30m";               $putih="\033[0;37m"; $putih2="\033[1;37m";$merah="\033[0;31m"; $merah2="\033[1;31m";             $hijau="\033[0;32m"; $hijau2="\033[1;32m";$kuning="\033[0;33m"; $kuning2="\033[1;33m";           $biru="\033[0;34m"; $biru2="\033[1;34m";$ungu="\033[0;35m"; $purple2="\033[1;35m";             $lblue="\033[0;36m"; $lblue2="\033[1;36m";                                                       $putih1="\033[7;37m";$merah1="\033[7;31m";                                  $hijau1="\033[7;32m";$kuning1="\033[7;33m";$biru1="\033[7;34m";                                   $ungu1="\033[7;35m";$lblue1="\033[7;36m";
$ua=ua($auth);
$url="https://prod.interlinklabs.ai/api/v1/auth/current-user-full?include=userInfo%2Ctoken%2CisClaimable%2CadsMining";
 $get=json_decode(get($url,$ua));

$email=$get->data->userInfo->email;
$uid=$get->data->userInfo->loginId;
$silvertoken=$get->data->token->interlinkSilverTokenAmount;
$goldtoken=$get->data->token->interlinkGoldTokenAmount;
$diamontoken=$get->data->token->interlinkDiamondTokenAmount;

echo   "$putih2 ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ \n";
echo   "      $lblue2 • USER INFO • ";
echo "\n$putih2 ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
echo   "$putih2  • EMAIL   :$kuning2 $email\n";
echo   "$putih2  • USER_ID :$kuning2 @$uid\n";
echo   "$lblue2     • BALANCE TOKEN • \n";
echo   "$putih2  • Gold    :$hijau2 $goldtoken ".'$ITLG'."\n";
echo   "$putih2  • Silver  :$hijau2 $silvertoken ".'$ITLG'."\n";
echo   "$putih2  • Diamond :$hijau2 $diamontoken ".'$ITLG'."\n";
echo   "$putih2 ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
echo   "$lblue2  • Exp : $UTC UTC\n";
echo   "$lblue2  • Exp : $WIB WIB\n";
}


// CLAIM TOKEN //


function claim($auth){

global $hijau2,$merah2;
$ua=ua($auth);

$url="https://prod.interlinklabs.ai/api/v1/token/claim-airdrop";
 $post=json_decode(post($url,$ua));

$sts=$post->statusCode;

if ($sts=="200"){

echo "\n\n$hijau2 Successfully Mine!\n";

}else{

echo "\n\n$merah2 Failed Mine! | Sudah terclaim / Error!\n";

}


}


// GABUNG FUNCTION //

function gabung($auth){

claim($auth);
user($auth);

}

function start($auth){
gabung($auth);
}


start($auth2);
start($auth1);





?>

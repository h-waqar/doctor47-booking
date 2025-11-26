<?php
// FILE: lib/cybersource/class-sdv-cybersource-client.php
// FINAL, DOCUMENTATION-VERIFIED VERSION 2.0

if (!defined('ABSPATH')) exit;

class Sdv_CyberSource_Client_V2
{
    private $settings;

    public function __construct()
    {
        $opts = get_option('ww_cybs_settings', []);
        
        $this->settings = [
            'merchant_id' => isset($opts['merchant_id']) ? $opts['merchant_id'] : '',
            'api_key_id'  => isset($opts['api_key_id']) ? $opts['api_key_id'] : '',
            'secret_key'  => isset($opts['secret_key']) ? $opts['secret_key'] : '',
            'environment' => isset($opts['environment']) ? $opts['environment'] : 'test',
            'target_origin' => isset($opts['target_origin']) ? $opts['target_origin'] : home_url(),
        ];
    }

    private function host()
    {
        $env = isset($this->settings['environment']) ? $this->settings['environment'] : 'test';
        return $env === 'live' ? 'api.cybersource.com' : 'apitest.cybersource.com';
    }

    private function creds_ok()
    {
        return !empty($this->settings['merchant_id']) && !empty($this->settings['api_key_id']) && !empty($this->settings['secret_key']);
    }

    private function sign($method, $resourcePath, $payload)
    {
        $host       = $this->host();
        $date       = gmdate('D, d M Y H:i:s') . ' GMT';
        $mid        = trim($this->settings['merchant_id']);
        $keyid      = trim($this->settings['api_key_id']);
        $secret_b64 = trim($this->settings['secret_key']);
        $secret     = base64_decode($secret_b64);
        $digest           = 'SHA-256=' . base64_encode(hash('sha256', $payload, true));
        $request_target   = strtolower($method) . ' ' . $resourcePath;
        $signed_headers   = 'host date request-target digest v-c-merchant-id';
        $signature_string = "host: {$host}\n" . "date: {$date}\n" . "request-target: {$request_target}\n" . "digest: {$digest}\n" . "v-c-merchant-id: {$mid}";
        $signature = base64_encode(hash_hmac('sha256', $signature_string, $secret, true));
        $signature_header = sprintf('keyid="%s", algorithm="HmacSHA256", headers="%s", signature="%s"', $keyid, $signed_headers, $signature);
        return [
            'Host' => $host,
            'Date' => $date,
            'Digest' => $digest,
            'v-c-merchant-id' => $mid,
            'Signature' => $signature_header,
        ];
    }

    private function request($method, $resourcePath, $bodyArr)
    {
        if (!$this->creds_ok()) {
            return new WP_Error('cybs_missing_creds', 'CyberSource API credentials are not configured.');
        }
        $url     = 'https://' . $this->host() . $resourcePath;
        $payload = $bodyArr ? wp_json_encode($bodyArr) : '';
        $headers = $this->sign($method, $resourcePath, $payload);
        $headers['Content-Type'] = 'application/json;charset=utf-8';
        $res = wp_remote_request($url, ['method'  => $method, 'headers' => $headers, 'timeout' => 20, 'body' => $payload]);
        if (is_wp_error($res)) return $res;
        $code = wp_remote_retrieve_response_code($res);
        $body = wp_remote_retrieve_body($res);
        if ($code === 201 && $resourcePath === '/microform/v2/sessions') {
            return ['key' => $body];
        }
        $json = json_decode($body, true);
        if ($code >= 200 && $code < 300) {
            return ['code' => $code, 'json' => $json, 'raw' => $body];
        }
        return new WP_Error('cybs_http_error', 'CyberSource API Error: ' . $body, ['status' => $code, 'body' => $body]);
    }

    public function create_capture_context()
    {
        $target_origin = !empty($this->settings['target_origin']) ? $this->settings['target_origin'] : home_url();
        $body = [
            "targetOrigins" => [$target_origin],
            "clientVersion" => "v2.0",
            "allowedCardNetworks" => ["VISA", "MASTERCARD", "AMEX"],
            "paymentInformation" => ["card" => ["number" => ["selector" => "#cybs-card-number-container"], "securityCode" => ["selector" => "#cybs-security-code-container"]]]
        ];
        return $this->request('POST', '/microform/v2/sessions', $body);
    }

    /**
     * Creates a payment using a transient token.
     * THIS FUNCTION IS NOW CORRECTED BASED ON THE OFFICIAL DOCUMENTATION.
     */
    public function create_payment($amount, $currency, $transientTokenJwt, $billingDetails)
    {
        $order = [
            "clientReferenceInformation" => [
                "code" => "WW-BOOKING-" . time()
            ],
            "processingInformation" => [
                "capture" => true // Charge immediately
            ],
            "orderInformation" => [
                "amountDetails" => [
                    "totalAmount" => (string)$amount,
                    "currency"    => strtoupper($currency)
                ],
                "billTo" => $billingDetails
            ],
            // ✅ Correct placement of the transient token
            "tokenInformation" => [
                "transientTokenJwt" => $transientTokenJwt,
            ]
        ];

        return $this->request('POST', '/pts/v2/payments', $order);
    }
}

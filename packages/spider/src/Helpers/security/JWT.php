<?php

namespace Vector\Spider\Helpers\security;

class JWT
{
    const SECRET = "KUM@R 1S R0CK1NG";
    const TIMEOUT = 60 * 60;
    static function encode($data)
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
    }
    static function header()
    {
        return self::encode(json_encode(['type' => 'JWT', 'algo' => 'HS256']));
    }
    static function payload($payload, $expire)
    {
        return self::encode(json_encode($payload + ($expire ? [
            "Issue" => time(),
            "Expiry" => time() + self::TIMEOUT
        ] : [])));
    }
    static function generate($payload, $expire = true)
    {
        $header = self::header();
        $payload = self::payload($payload, $expire);
        $signature = self::encode(hash_hmac('sha256', $header . "." . $payload, self::SECRET, true));
        return  $header . "." . $payload . "." . $signature;
    }
    static function validate($token)
    {
        if (!$token) return ["success" => false, 'msg' => "Token is invalid"];
        list($header, $payload, $signature) = explode('.', $token);

        $expectedSignature = self::encode(hash_hmac('sha256', $header . "." . $payload, self::SECRET, true));
        if ($expectedSignature !== $signature) {
            return ["success" => false, 'msg' => "Token is invalid"];
        }

        $dec = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $payload)), true);

        if (isset($dec['Expiry']) && $dec['Expiry'] < time()) {
            return ["success" => false, 'msg' => "Token has expired"];
        }

        return ['success' => true, 'data' => $dec];
    }
}

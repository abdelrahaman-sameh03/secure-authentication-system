<?php
function base32_encode_custom(string $data): string {
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    $binary = '';
    foreach (str_split($data) as $char) {
        $binary .= str_pad(decbin(ord($char)), 8, '0', STR_PAD_LEFT);
    }
    $encoded = '';
    foreach (str_split($binary, 5) as $chunk) {
        if (strlen($chunk) < 5) {
            $chunk = str_pad($chunk, 5, '0', STR_PAD_RIGHT);
        }
        $encoded .= $alphabet[bindec($chunk)];
    }
    return $encoded;
}

function base32_decode_custom(string $secret): string {
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    $secret = strtoupper(preg_replace('/[^A-Z2-7]/', '', $secret));
    $binary = '';
    foreach (str_split($secret) as $char) {
        $pos = strpos($alphabet, $char);
        if ($pos !== false) {
            $binary .= str_pad(decbin($pos), 5, '0', STR_PAD_LEFT);
        }
    }
    $data = '';
    foreach (str_split($binary, 8) as $byte) {
        if (strlen($byte) === 8) {
            $data .= chr(bindec($byte));
        }
    }
    return $data;
}

function generate_2fa_secret(int $length = 20): string {
    return base32_encode_custom(random_bytes($length));
}

function hotp(string $secret, int $counter, int $digits = 6): string {
    $key = base32_decode_custom($secret);
    $counterBytes = pack('N*', 0) . pack('N*', $counter);
    $hash = hash_hmac('sha1', $counterBytes, $key, true);
    $offset = ord(substr($hash, -1)) & 0x0F;
    $binary = ((ord($hash[$offset]) & 0x7F) << 24) |
              ((ord($hash[$offset + 1]) & 0xFF) << 16) |
              ((ord($hash[$offset + 2]) & 0xFF) << 8) |
              (ord($hash[$offset + 3]) & 0xFF);
    $otp = $binary % (10 ** $digits);
    return str_pad((string)$otp, $digits, '0', STR_PAD_LEFT);
}

function totp_code(string $secret, ?int $time = null): string {
    $time = $time ?? time();
    return hotp($secret, floor($time / 30));
}

function verify_totp(string $secret, string $code, int $window = 1): bool {
    $code = preg_replace('/\D/', '', $code);
    if (strlen($code) !== 6) {
        return false;
    }
    $current = floor(time() / 30);
    for ($i = -$window; $i <= $window; $i++) {
        if (hash_equals(hotp($secret, $current + $i), $code)) {
            return true;
        }
    }
    return false;
}

function provisioning_uri(string $email, string $secret): string {
    $label = rawurlencode(ISSUER . ':' . $email);
    $issuer = rawurlencode(ISSUER);
    return "otpauth://totp/{$label}?secret={$secret}&issuer={$issuer}&algorithm=SHA1&digits=6&period=30";
}

function qr_url(string $uri): string {
    return 'https://api.qrserver.com/v1/create-qr-code/?size=240x240&data=' . rawurlencode($uri);
}

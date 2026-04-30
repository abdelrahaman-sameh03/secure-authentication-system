<?php
require_once __DIR__ . '/../config/app.php';

function b64url_encode(string $data): string {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function b64url_decode(string $data): string|false {
    $padding = 4 - (strlen($data) % 4);
    if ($padding < 4) {
        $data .= str_repeat('=', $padding);
    }
    return base64_decode(strtr($data, '-_', '+/'));
}

function generate_token(array $user): string {
    $header = ['alg' => 'HS256', 'typ' => 'JWT'];
    $payload = [
        'iss' => ISSUER,
        'iat' => time(),
        'exp' => time() + TOKEN_EXPIRY_SECONDS,
        'sub' => (int)$user['id'],
        'name' => $user['name'],
        'email' => $user['email'],
        'role' => $user['role'],
    ];
    $encodedHeader = b64url_encode(json_encode($header));
    $encodedPayload = b64url_encode(json_encode($payload));
    $signature = hash_hmac('sha256', "$encodedHeader.$encodedPayload", TOKEN_SECRET, true);
    return "$encodedHeader.$encodedPayload." . b64url_encode($signature);
}

function validate_token(?string $token): ?array {
    if (!$token) {
        return null;
    }
    $parts = explode('.', $token);
    if (count($parts) !== 3) {
        return null;
    }
    [$header, $payload, $signature] = $parts;
    $expected = b64url_encode(hash_hmac('sha256', "$header.$payload", TOKEN_SECRET, true));
    if (!hash_equals($expected, $signature)) {
        return null;
    }
    $decoded = b64url_decode($payload);
    if ($decoded === false) {
        return null;
    }
    $data = json_decode($decoded, true);
    if (!$data || !isset($data['exp']) || $data['exp'] < time()) {
        return null;
    }
    return $data;
}

function bearer_token(): ?string {
    $headers = function_exists('getallheaders') ? getallheaders() : [];
    $auth = $headers['Authorization'] ?? $headers['authorization'] ?? $_SERVER['HTTP_AUTHORIZATION'] ?? null;
    if ($auth && preg_match('/Bearer\s+(.*)$/i', $auth, $matches)) {
        return trim($matches[1]);
    }
    return $_SESSION['token'] ?? null;
}

<?php
use \Firebase\JWT\JWT;

class token
{
    private $key;

    public function __construct()
    {
        // Ganti dengan kunci rahasia Anda
        $this->key = 'secret_key';
    }

    public function generateToken($data)
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600; // Token kedaluwarsa dalam 1 jam
        
        $payload = array(
            'data' => $data,
            'iat' => $issuedAt,
            'exp' => $expirationTime
        );

        return JWT::encode($payload, $this->key);
    }

    public function decodeToken($token)
    {
        return JWT::decode($token, $this->key, array('HS256'));
    }
}

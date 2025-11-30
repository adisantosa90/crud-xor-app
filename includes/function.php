<?php
// Fungsi untuk mengenkripsi data menggunakan XOR
function xor_encrypt($data, $key) {
    $encrypted = '';
    $keyLength = strlen($key);
    
    for($i = 0; $i < strlen($data); $i++) {
        $encrypted .= $data[$i] ^ $key[$i % $keyLength];
    }
    
    return base64_encode($encrypted);
}

// Fungsi untuk mendekripsi data menggunakan XOR
function xor_decrypt($encrypted_data, $key) {
    $data = base64_decode($encrypted_data);
    $decrypted = '';
    $keyLength = strlen($key);
    
    for($i = 0; $i < strlen($data); $i++) {
        $decrypted .= $data[$i] ^ $key[$i % $keyLength];
    }
    
    return $decrypted;
}

// Kunci enkripsi (harus sama untuk enkripsi dan dekripsi)
define('ENCRYPTION_KEY', 'my_secret_key_123');
?>
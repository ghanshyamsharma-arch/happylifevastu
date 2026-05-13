<?php

namespace App\Services;
use GuzzleHttp\Client;

class FCMService
{
     public $serviceAccountKey = [
              "type": "service_account",
              "project_id": "happy-life-vastu",
              "private_key_id": "5777bef110ed013b5be989b2f4a9bc043cb04284",
              "private_key": "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDdaJu2uP2O7VXs\nOFen7yzAzMqQyocARCVXobGp6NM6mKPdvg9jIbiuyIeK+y2vazO1pw8ORBuXodA/\nE9TdKEuI1M/3bkNRejs+vTXEODd32cXdDvUazBlvWvgF1roBqCzjoRp5gfYjvAWQ\nGbEQ+VI6sFeIijvViQBD52VO+zJPctbKDheGPHvcoPZT1Jho0tJpgg3Stuq1K1no\nYIKi2+jsHmMdkkLInJyx7tc4JY82sSExWtNA61OrD3mG9+idBv5xhCiX/UsPk6Rp\nQD5fbQTObT7fJQ2ODJOb0LJiNilJihdeDrSI/c0yf0iWWIYyaExU7Tab6nzELB4u\nYiSxCc1XAgMBAAECggEARpkRdaz85LMWv7Cjep/P9FYYjRyW+WXBRnT/cn8Tw05i\nidUNkP1ypwC3/3/h7FpRba2sJk9fQPVOsp4/NJmhpCq/eVUGUBeahoHMgBmwzh15\ncuhPDVFhFtm51hrGyrp2Pcrj5zSiaHiOiYk3pYLqTl5mOtphA9CgbgZ9jjaYry4G\nALl1f1Z7XfHsXA0iEdETKW+1Ubxs54+HiJzqMzehy/ETHDPyQiNsvzuSZdR4LKcl\nrxKKWRUTH3oFpk+na6/iTmw2yckCdCTbYKDaXRgfCQVJfJUxE4eZgDMZRkWeg6GO\nR3QwEeMz2HqvQEFNxQgKnf/AchkF29OClzDjrm7PiQKBgQD5ubJ8u8mCgBBQgxit\njXdXKLvuuwZZRTM6ZegKV+n7rVOuIgEzJTlXaT5vHbcddiGVPHbhhDkvuImbB5mR\nhdMi4fxK/8DtqBjefDtjoIiDMvahYtSPzHFVRif+H75Hr0DcGc21LjmWV9OXaCo+\nUQSjcMtMDB9SOA+Xqq6Hfkx6FQKBgQDi+MUUS1yugWL8c5+tqnnQaaS0dUylCdfd\nvzQQpsC3T6/aZHrSFyKNZRtCtajw02Xta1zjkVxGEhdB25ZHkKN/Qtw+sVCvhJIk\nDaCMBjJ6wen103TkTyQhgvEl7ZXfjcPffDu2CLV3xhhxk4K5PjbQkfnHKM9FSslz\nA+Xa7MIguwKBgQC4rldMncgJ5dGq6TjP6OYQJETP6appTJ71GjY/qAKXqPhQuD8w\n5t+AQIn2vQAWHq35Ywz7/MAaBZxmdXlhwJmDm6LsiDXSzFUP/MojBK7QcFkqwx81\n9Vj/WnHrIuiitP3/iGm0Cyp1gCAwQc2z5lDK2njOlcx4DpOhc429EG9YfQKBgC3d\nLR3TuK++j30J9DtIloLpxhF9Hna/DXLOnzu6JnkkThmocjUf3aiKxL5vLOs1HISk\nTEnj5qx2HWL+d1iQvqkJnq3AcNh2xn0oj8ebvPmXU6qMBzPXViq7ZfVPFBjvcaQo\nW3yGN/0y91+D+kdqbfMpfDqlYXTUDu8B26Goc/XfAoGABjWfsr6GG09Z1lLRefNh\nRHZWjimthMX8sFO05iV4M9b6sItC4n5+u7pXyOCwsCNVMJlRTYlmGIsPXLhR+W6w\nwtixhIkJ9+nqTkelFP63pd7J8IHY6QfxkD7d0d6rl0Ey1FLdJ5Ci7bQSeQr9Fl25\nC05u9I5IOml3RBZm6g7lLLY=\n-----END PRIVATE KEY-----\n",
              "client_email": "firebase-adminsdk-fbsvc@happy-life-vastu.iam.gserviceaccount.com",
              "client_id": "108147079774044756518",
              "auth_uri": "https://accounts.google.com/o/oauth2/auth",
              "token_uri": "https://oauth2.googleapis.com/token",
              "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
              "client_x509_cert_url": "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-fbsvc%40happy-life-vastu.iam.gserviceaccount.com",
              "universe_domain": "googleapis.com"
    ];


public static function send($userDeviceDetail, $notification)
{
    $fcmService = new self();
    $projectId = 'happy-life-vastu';
    //$serverApiKey = env('FCM_SERVER_KEY');
    $accessToken = $fcmService->getAccessToken($serverApiKey);

    $endpoint = 'https://fcm.googleapis.com/v1/projects/' . $projectId . '/messages:send';

    $responses = []; // Array to store individual responses

    foreach ($userDeviceDetail->pluck('fcmToken')->all() as $token) {
        $notificationType = isset($notification['body']['notificationType']) ? (string) $notification['body']['notificationType'] : null;

        $payload = [
            'message' => [
                'token' => $token,
                'data' => [
                    'title' => $notification['title'],
                     'description' => $notification['body']['description'],
                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                    'body' => json_encode($notification['body']),

                ],
                'android' => [
                    'priority' => 'high',
                ],
            ],
        ];


        $headers = [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
        ];

        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $responses[] = json_decode($response, true);
    }

    return $responses;
}


    private function getAccessToken($serverApiKey)
    {
        $url = 'https://oauth2.googleapis.com/token';
        $data = [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $this->generateJwtAssertion($serverApiKey),
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $body = json_decode($response, true);

        return $body['access_token'];
    }


    private function generateJwtAssertion($serverApiKey)
{
    $now = time();
    $exp = $now + 3600; // Token expires in 1 hour

    $jwtClaims = [
        'iss' => $this->serviceAccountKey['client_email'],
        'sub' => $this->serviceAccountKey['client_email'],
        'aud' => 'https://oauth2.googleapis.com/token',
        'scope' => 'https://www.googleapis.com/auth/cloud-platform',
        'iat' => $now,
        'exp' => $exp,
    ];

    $jwtHeader = [
        'alg' => 'RS256',
        'typ' => 'JWT',
    ];

    $base64UrlEncodedHeader = $this->base64UrlEncode(json_encode($jwtHeader));
    $base64UrlEncodedClaims = $this->base64UrlEncode(json_encode($jwtClaims));

    $signatureInput = $base64UrlEncodedHeader.'.'.$base64UrlEncodedClaims;

    $privateKey = openssl_pkey_get_private($this->serviceAccountKey['private_key']);
    openssl_sign($signatureInput, $signature, $privateKey, OPENSSL_ALGO_SHA256);
    openssl_free_key($privateKey);

    $base64UrlEncodedSignature = $this->base64UrlEncode($signature);

    return $signatureInput.'.'.$base64UrlEncodedSignature;
}

    private function base64UrlEncode($input)
    {
        return rtrim(strtr(base64_encode($input), '+/', '-_'), '=');
    }

}


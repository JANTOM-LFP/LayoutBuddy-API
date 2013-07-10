<?php

class LayoutBuddy
{
    
    const VERSION = 0.2;

    const API_URL = 'http://layoutbuddy.com/api/';
    const STATIC_URL = 'http://static.layoutbuddy.com/';
    
    private $_publicKey;
    private $_privateKey;
    
    
    /**
     * class methods
     */
    
    protected static function getSubfolderPath($filename)
    {
        return $filename{0} . '/' . $filename{1} . '/' . $filename;
    }

    public static function getThumbnailImage($layoutId)
    {
        return self::STATIC_URL . '120/' . self::getSubfolderPath($layoutId) . '.jpg';
    }

    public static function getPreviewImage($layoutId)
    {
        return self::STATIC_URL . '600/' . self::getSubfolderPath($layoutId) . '.jpg';
    }
    
    
    
    /**
     * instance methods
     */
    
    public function __construct($publicKey, $privateKey)
    {
        if (!$publicKey || !$privateKey) {
            throw new Exception('Public and private keys must be set.');
        }
        
        $this->_publicKey = $publicKey;
        $this->_privateKey = $privateKey;
    }
    
    
    
    public function buildSignedRequestUrl($method, $params)
    {
        // Prepare parameters
        $params['public_key'] = $this->_publicKey;
        $params['timestamp'] = time();
        if (isset($params['signature'])) unset($params['signature']);
        
        // Generate signature
        ksort($params);
        $message = $method . '?' . http_build_query($params);
        $signature = hash_hmac('sha1', $message, $this->_privateKey, false);
        
        // Add signature
        $params['signature'] = $signature;
        
        $signedUrl = self::API_URL . $method . '?' . http_build_query($params);
        return $signedUrl;
    }
    
    
    
    public function request($method, $params = array(), $auth = false)
    {
        // If authentication required, prepare signed request
        if ($auth) {
            $url = $this->buildSignedRequestUrl($method, $params);
        } else {
            $params['public_key'] = $this->_publicKey;
            $url = self::API_URL . $method . '?' . http_build_query($params);
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($ch);
    }
    
    
    
    public function jsonRequest($method, $params = array(), $auth = false)
    {
        return json_decode($this->request($method, $params, $auth));
    }
    
    
    
}

<?php

class OAuth2Server {
    private $validToken = 'your-oauth2-token'; // Replace with your actual token

    public function isAuthorized() {
        $headers = apache_request_headers();
        if (!isset($headers['Authorization'])) {
            return false;
        }

        $token = str_replace('Bearer ', '', $headers['Authorization']);
        return $token === $this->validToken;
    }
}

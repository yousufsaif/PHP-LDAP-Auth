<?php

require_once 'LDAPConnection.php';
require_once 'config.php';

class UserController
{
    protected $ldapConnection;

    public function __construct(LDAPConnection $ldapConnection)
    {
        $this->ldapConnection = $ldapConnection;
    }

    public function login($username, $password)
    {
        try {
            $userData = $this->ldapConnection->authenticate($username, $password);
            $this->initializeSession($userData, $username);

            header('Location: ' . LOGIN_SUCCESS_URL);
            exit();
        } catch (Exception $e) {
            header('Location: ' . LOGIN_ERROR_URL . '?error=' . urlencode($e->getMessage()));
            exit();
        }
    }

    protected function initializeSession($userData, $username)
    {
        session_start();
        $_SESSION['ldap_user'] = $username;
        $_SESSION['ldap_fullname'] = ucwords($userData[0]["cn"][0]);
        // Add more session initializations if needed
    }
}

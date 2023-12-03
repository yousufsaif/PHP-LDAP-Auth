<?php

require_once 'UserController.php';
require_once 'config.php';

try {
    if (isset($_POST['keepMeIn']) && $_POST['keepMeIn'] == 'on') {
        session_start();
        $_SESSION['sar_rememberMe'] = 'on';
    }

    $ldapConfig = new LDAPConfig(LDAP_SERVER, LDAP_DOMAIN_CONTROLLER, LDAP_TREE);
    $ldapConnection = new LDAPConnection($ldapConfig);
    $controller = new UserController($ldapConnection);

    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    $controller->login($username, $password);
} catch (Exception $e) {
    header('Location: ' . LOGIN_ERROR_URL);
    exit();
}

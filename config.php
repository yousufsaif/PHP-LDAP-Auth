<?php

// LDAP Configuration
define("LDAP_SERVER", "192.168.100.xxx");
define("LDAP_DOMAIN_CONTROLLER", "companyxyz");
define("LDAP_TREE", "DC=companyxyz,DC=COM");

// URL Configuration
define("LOGIN_SUCCESS_URL", "http://yourdomain.com/home.php");
define("LOGIN_ERROR_URL", "http://yourdomain.com/login.php?error=true");

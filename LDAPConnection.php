<?php

require_once 'LDAPConfig.php';

class LDAPConnection
{
    protected $config;
    protected $connection;

    public function __construct(LDAPConfig $config)
    {
        $this->config = $config;
        $this->connect();
    }

    protected function connect()
    {
        $this->connection = ldap_connect($this->config->server);
        ldap_set_option($this->connection, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($this->connection, LDAP_OPT_REFERRALS, 0);

        if (!$this->connection) {
            throw new Exception("Unable to connect to LDAP server.");
        }
    }

    public function authenticate($username, $password)
    {
        $ldapUser = $username . "@" . $this->config->domainController;
        $bind = @ldap_bind($this->connection, $ldapUser, $password);

        if (!$bind) {
            throw new Exception("LDAP authentication failed.");
        }

        return $this->search($username);
    }

    protected function search($username)
    {
        $result = ldap_search($this->connection, $this->config->tree, "(sAMAccountName=$username)");
        $entries = ldap_get_entries($this->connection, $result);

        if (ldap_count_entries($this->connection, $result) < 1) {
            throw new Exception("User not found.");
        }

        return $entries;
    }
}

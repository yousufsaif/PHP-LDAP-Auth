<?php

class LDAPConfig
{
    public $server;
    public $domainController;
    public $tree;

    public function __construct($server, $domainController, $tree)
    {
        $this->server = $server;
        $this->domainController = $domainController;
        $this->tree = $tree;
    }
}

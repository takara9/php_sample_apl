<?php

Class Cfenv
{
    public $user;
    public $pass;
    public $host;
    public $port;
    public $ca;
    public $ca_pem_filename;
    public $label;
    public $dbname;

    // Constructor
    function __construct($inst_name) {
        
        if (isset($_ENV["VCAP_SERVICES"])) {
            $vcap_services = json_decode($_ENV["VCAP_SERVICES"]);
        } else {
            $vcap_services = json_decode(file_get_contents("vcap-local.json"))->{'VCAP_SERVICES'};
        }

        foreach($vcap_services as $key => $value) {
            $array = $vcap_services->{$key};
            foreach($array as $idx => $value) {
                if ($inst_name == $array[$idx]->name) {
                    $this->label = $array[$idx]->label;
                    switch ($this->label) {
                    case 'cleardb':
                        $this->parser_cleardb($array[$idx]->credentials);
                        break;
                    case 'compose-for-mysql':
                        $this->ca_pem_filename = $this->label."_".$idx.".pem";
                        $this->parser_compose_for_mysql($array[$idx]->credentials);
                        break;
                    case 'compose-for-postgresql':
                        $this->ca_pem_filename = $this->label."_".$idx.".pem";
                        $this->parser_compose_for_postgressql($array[$idx]->credentials);
                        break;
                    default:
                        echo "ERROR\n";
                    }
                }
            }
            echo "\n\n";
        }

        if ($svc == 'compose-for-mysql') {
        } else {
            return null;
        }
    }

    // ClearDB (MySQL)
    function parser_cleardb($vcap) {
        $this->host   = $vcap->hostname;
        $this->port   = $vcap->port;
        $this->ca     = null;
        $this->user   = $vcap->username;
        $this->pass   = $vcap->password;
        $this->dbname = $vcap->name;
    }


    // Compose for MySQL
    function parser_compose_for_mysql($vcap) {
        $uri = $vcap->uri; 
        $s1 = preg_replace('/mysql:\/\//',null,$uri);
        $sa = preg_split('/:/',$s1);
        $this->user = $sa[0];
        $this->pass = preg_split('/@/',$sa[1])[0];
        $this->host = preg_split('/@/',$sa[1])[1];
        $this->port = preg_split('/\//',$sa[2])[0];
        $this->ca = base64_decode($vcap->ca_certificate_base64);
        file_put_contents($this->ca_pem_filename,$this->ca);
    }


    // Compose for PostgreSQL
    function parser_compose_for_postgressql($vcap) {
        $uri = $vcap->uri;
        $s1 = preg_replace('/postgres:\/\//',null,$uri);
        $sa = preg_split('/:/',$s1);
        $this->user = $sa[0];
        $this->pass = preg_split('/@/',$sa[1])[0];
        $this->host = preg_split('/@/',$sa[1])[1];
        $this->port = preg_split('/\//',$sa[2])[0];
        $this->dbname = preg_split('/\//',$sa[2])[1];
        $this->ca = base64_decode($vcap->ca_certificate_base64);
        file_put_contents($this->ca_pem_filename,$this->ca);
    }
}                        
?>
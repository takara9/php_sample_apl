<?php

Class Vcap
{
    public $user;
    public $pass;
    public $host;
    public $port;
    public $ca;
    public $ca_pem_filename = '_compose.pem';

    function __construct($svc) {
        
        if (isset($_ENV["VCAP_SERVICES"])) {
            $vcap_services = json_decode($_ENV["VCAP_SERVICES"]);
        } else {
            $vcap_services = json_decode(file_get_contents("vcap-local.json"))->{'VCAP_SERVICES'};
        }
        
        $vcap = $vcap_services->{$svc}[0]->credentials;
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
}                        

?>
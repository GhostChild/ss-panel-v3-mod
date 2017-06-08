<?php

namespace App\Services\Mail;

use App\Services\Config;

class Sendcloud extends Base
{
    private $config, $API_USER, $API_KEY, $from, $fromName;

    /**
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        $this->config = $this->getConfig();
        $this->API_USER = ($this->config["API_USER"]);
        $this->API_KEY = ($this->config["API_KEY"]);
        $this->from = ($this->config["from"]);
        $this->fromName = ($this->config["fromName"]);

    }

    /**
     * @codeCoverageIgnore
     */
    public function getConfig()
    {
        return [
            "API_USER" => Config::get('sc_API_USER'),
            "API_KEY" => Config::get('sc_API_KEY'),
            "from" => Config::get('sc_from'),
            "fromName" => Config::get('sc_fromName')
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public function send($to, $subject, $text, $file)
    {
      $url = 'http://api.sendcloud.net/apiv2/mail/send';
      $param = array(
          'apiUser' => $this->API_USER,
          'apiKey' => $this->API_KEY,
          'from' => $this->from,
          'fromName' => $this->fromName,
          'to' => $to,
          'subject' => $subject,
          'html' => $text);
    
        $data = http_build_query($param);
    
        $options = array(
        'http' => array(
        'method'  => 'POST',
        'header'  => 'Content-Type: application/x-www-form-urlencoded',
        'content' => $data
        ));
    
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
    
        //return $result;
    



    }
}

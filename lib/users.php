<?php
namespace Unisender\Integration;

use Unisender\Integration\UnisenderApi;

class Users
{
    private $uni;
    private $list_ids;
    
    public function __construct($apikey = '', $list_ids = '')
    {
        $this->uni = new UnisenderApi($apikey);
        $this->list_ids = $list_ids;
    }
    
    public function checkSubscriptionByEmail($email)
    {
        $result = $this->uni->exportContacts(Array("list_ids" => $this->list_ids, "field_names" => array("email"),"email" => $email));
        $answer = json_decode($result, true);
        return $answer;
    }
    
    public function subscribe($fields)
    {
        $result = $this->uni->subscribe(Array("list_ids" => $this->list_ids, "fields" => $fields, "double_optin" => 3));
        $answer = json_decode($result, true);
        return $answer;
    }
}
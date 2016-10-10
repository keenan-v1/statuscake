<?php

namespace StatusCake;

class ContactGroup
{
    /**
     * [Required on update or delete]
     * Provide to Update a Contact Group Rather Than Insert New
     *
     * @var int|null
     */
    public $contactID = null;
    
    /**
     * [Required]
     * The internal Group Name.
     * @var string
     */
    public $groupName = 0;
    
    /**
     * @var int
     */
    public $desktopAlert = 0; // Set to 1 To Enable Desktop Alerts
    
    /**
     * Comma Seperated List of Emails To Alert. (no whitespace)
     *
     * @var array
     */
    public $email = [];
    
    /**
     * A Boxcar API Key
     *
     * @var string
     */
    public $boxCar = '';
    
    /**
     * A Pushover Account Key
     *
     * @var string
     */
    public $pushOver = '';
    
    /**
     * A URL To Send a POST alert.
     *
     * @var string
     */
    public $pingURL = '';
    
    /**
     * Will be converted to a Comma Seperated List of International Format Cell Numbers
     * @var array
     */
    public $mobile = [];
    
    public function isNew()
    {
        return $this->contactID === null;
    }
    
    /**
     * Adds an email.
     *
     * @param $email
     *
     * @return $this
     */
    public function addEmail($email)
    {
        if (!in_array($email, $this->email))
        {
            $this->email[] = $email;
        }
        
        return $this;
    }
    
    /**
     * Removes an email.
     *
     * @param $email
     *
     * @return $this
     */
    public function removeEmail($email)
    {
        $key = array_search($email, $this->email);
        
        if ($key === false)
        {
            return $this;
        }
        
        unset( $this->email[$key] );
        
        return $this;
    }
    
    /**
     * Parses the contact group for the API request.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'ContactId' => $this->contactID,
            'GroupName' => $this->groupName,
            'DesktopAlert' => $this->desktopAlert,
            'BoxCar' => $this->boxCar,
            'PushOver' => $this->pushOver,
            'PingURL' => $this->pingURL,
            'Email' => implode(',', $this->email),
            'Mobile' => implode(',', $this->mobile),
        ];
    }
}
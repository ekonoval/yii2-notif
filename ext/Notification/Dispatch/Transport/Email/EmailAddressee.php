<?php
namespace app\ext\Notification\Dispatch\Transport\Email;

use app\models\User;

class EmailAddressee
{
    public $email;
    public $name;

    public function __construct($email, $name)
    {
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * @param User $user
     * @return EmailAddressee
     */
    public static function getAddresseeByUser(User $user)
    {
        return new static($user->email, $user->username);
    }
}

<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Db\RawValue;

class User extends Model {
    public $uid;
    public $username;
    public $email;
    public $password;
    public $groupid;
    public $registertime;

    public $__title;
    public $__username;

    public function validation()
    {
        $this->validate(new EmailValidator(array(
            'field' => 'email'
        )));
        $this->validate(new UniquenessValidator(array(
            'field' => 'email',
            'message' => '<h5>Sorry, The email was registered by another user</h5>'
        )));
        $this->validate(new UniquenessValidator(array(
            'field' => 'username',
            'message' => '<h5>Sorry, That username is already taken</h5>'
        )));
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
    public function beforeValidationOnCreate() {
        $this->registertime = new RawValue('now()');
    }

    public static function getAvatar($email) {
        return "https://cdn.v2ex.com/gravatar/".md5(strtolower($email));
    }
}

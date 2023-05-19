<?php 

namespace App\Models;

use DateTime;

class User extends Model {
    protected $table = 'users';

    // get the fullname of a user
    public function getFullName(): string
    {
        return $this->firstname.' '.$this->lastname;
    }

    // get the firstname of a user
    public function getFirstname(): string
    {
        return $this->firstname;
    }
}
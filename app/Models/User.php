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

    // get a specific user by its email
    public function getByEmail(string $email): User
    {
        $user = $this->query("SELECT * FROM {$this->table} WHERE email = ?", [$email], true);
        if($user) {
            return $user;
        }else{
            $_SESSION['errors']['user'] = ['Email inconnu, veuillez créer un compte.'];
            header('Location: ' .URL.'auth/signup');
            exit;
        }
    }

    // create a user
    public function create(array $data, ?array $relations = null)
    {
        $data['isAdmin'] = 0;
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $user = $this->query("SELECT * FROM {$this->table} WHERE email = ?", [$data['email']], true);

        if($user) {
            $_SESSION['errors']['email'] = ['Un compte existe déjà avec cet email. Vous pouvez vous connecter avec cet email.'];
            header('Location: ' .URL.'auth/login');
            exit;
        }else{
            parent::create($data);

            return true;
        }
    }
}
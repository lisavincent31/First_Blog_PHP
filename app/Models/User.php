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

    // get the creation date for a post
    public function getCreatedAt(): string
    {
        return (new DateTime($this->created_at))->format('d/m/Y à H:i');
    }

    // get a specific user by its email
    public function getByEmail(string $email): User
    {
        $user = $this->query("SELECT * FROM {$this->table} WHERE email = ?", [$email], true);
        if($user) {
            return $user;
        }else{
            $_SESSION['errors']['user'] = ['Email inconnu, veuillez créer un compte.'];
            $url = URL.'auth/signup';
            $this->redirect($url);
            // header('Location: ' .URL.'auth/signup');
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
            $url = URL.'auth/login';
            $this->redirect($url);
            // header('Location: ' .URL.'auth/login');
        }else{
            parent::create($data);

            return true;
        }
    }
}
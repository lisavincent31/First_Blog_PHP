<?php

namespace App\Models;

use DateTime;

class User extends Model
{
    protected $table = 'users';

    /** 
     * Get the fullname of a user
     * 
     * @return string
     */
    public function getFullName(): string
    {
        return $this->firstname.' '.$this->lastname;
    }

    /** 
     * Get the firstname of a user
     * 
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /** 
     * Get the creation date for a post
     * 
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (new DateTime($this->created_at))->format('d/m/Y à H:i');
    }

    /** 
     * Get a specific user by his email
     * 
     * @return User
     */
    public function getByEmail(string $email): User
    {
        $user = $this->query("SELECT * FROM {$this->table} WHERE email = ?", [$email], true);
        if($user) {
            return $user;
        }else{
            $_SESSION['errors']['user'] = ['Email inconnu, veuillez créer un compte.'];
            header('Location: '.$this->url.'auth/signup');
        }
    }

    /** 
     * Create a user
     * 
     * @return void
     */
    public function create(array $data, ?array $relations = null)
    {
        $data['isAdmin'] = 0;
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $user = $this->query("SELECT * FROM {$this->table} WHERE email = ?", [$data['email']], true);

        if($user) {
            $_SESSION['errors']['email'] = ['Un compte existe déjà avec cet email. Vous pouvez vous connecter avec cet email.'];
            header('Location: '.$this->url.'auth/login');
        }else{
            parent::create($data);

            header('Location: '.$this->url);
        }
    }
}
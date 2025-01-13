<?php

namespace App\Auth;

use App\Models\User;

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function create($fullName, $email, $phoneNumber)
    {
        return $this->userModel->create($fullName, $email, $phoneNumber);
    }

    public function getAllUsers()
    {
        return $this->userModel->getAll();
    }

    public function getUserById($id)
    {
        return $this->userModel->getById($id);
    }
}

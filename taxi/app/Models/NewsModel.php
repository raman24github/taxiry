<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table = 'news';
    
     protected $allowedFields = ['email', 'user', 'password','cpassword'];

public function getNews($user = false)
    {
        if ($user === false) {
            return $this->findAll();
        }

        return $this->where(['user' => $user])->first();
    }}

<?php

namespace App\Controllers;

use App\Models\NewsModel;

class News extends BaseController
{
    public function index()
    {
        $model = model(NewsModel::class);

        $data = [
            'news'  => $model->getNews(),
            'title' => 'registered alredy',
        ];

        return view('templates/header', $data)
            . view('news/overview')
            . view('templates/footer');
    }
    
     public function view($user = null)
    {
        $model = model(NewsModel::class);

        $data['news'] = $model->getNews($user);

        if (empty($data['news'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $user);
        }

        $data['title'] = $data['news']['title'];

        return view('templates/header', $data)
            . view('news/view')
            . view('templates/footer');
    }
    public function create()
    {
        $model = model(NewsModel::class);

        if ($this->request->getMethod() === 'post' && $this->validate([
            'email' => 'required|min_length[3]|max_length[50]',
            'password'  => 'required',
            'cpassword'  => 'required',
        ])) {
            $model->save([
                'email' => $this->request->getPost('email'),
                'user'  => url_title($this->request->getPost('email'), '-', true),
                'password'  => $this->request->getPost('password'),
                'cpassword'  => $this->request->getPost('cpassword'),
            ]);

            return view('news/success');
        }

        return view('templates/header', ['title' => 'register yourself'])
            . view('news/create')
            . view('templates/footer');
    }
}


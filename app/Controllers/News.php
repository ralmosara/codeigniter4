<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\NewsModel;

class News extends BaseController
{
    public function index()
    {
        $model = new NewsModel();
        $data = [
            'news' => $model->getNews(),
            'title' => 'News Archive',
        ];

        echo view('templates/header', $data);
        echo view('news/overview', $data);
        echo view('templates/footer', $data);
    }

    public function view($slug = null)
    {
        $model = new NewsModel();
        $data['news'] = $model->getNews($slug);
        if (empty($data['news'])) {
            throw new
                \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
        }
        $data['title'] = $data['news']['title'];
        echo view('templates/header', $data);
        echo view('news/view', $data);
        echo view('templates/footer', $data);
    }

    public function create()
    {
        $model = new NewsModel();
        if (
            $this->request->getMethod() === "POST" && $this->validate([
                'title' => 'required|min_length[3]|max_length[255]',
                'body' => 'required',
            ])
        ) {
            $model->save([
                'title' => $this->request->getPost('title'),
                'slug' => url_title($this->request->getPost('title'), '-', true),
                'body' => $this->request->getPost('body'),
            ]);
            return redirect()->to('/news');
        } else {
            echo view('templates/header', ['title' => 'Create a news item']);
            echo view('news/create');
            echo view('templates/footer');
        }
 
    }

    public function edit($id)
    {   echo view('templates/header', ['title' => 'Update a news item']);
        $model = new NewsModel();
        $data['news'] = $model->getNewsbyId($id)->getRow();
        echo view('news/edit', $data);
    }

    public function update()
    {
        $model = new NewsModel();
        $id = $this->request->getPost('id');
        $data = array(
            'title' => $this->request->getPost('title'),
            'slug' => url_title($this->request->getPost('title'), '-', true),
        );
        $model->updateNews($data, $id);
        return redirect()->to('/news');
    }

    public function delete($id)
    {
        $model = new NewsModel();
        $model->deleteNews($id);
        return redirect()->to('/news');
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pages extends BaseController
{
    public function index()
    {
    return view('welcome_message');
    }
    public function view($page = 'home')
    {
        return $page;
    }
}

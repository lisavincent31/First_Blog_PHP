<?php 

namespace App\Controllers;

class HomeController extends Controller {

    // return the view of the homepage
    public function index()
    {
        return $this->view('homepage');
    }
}
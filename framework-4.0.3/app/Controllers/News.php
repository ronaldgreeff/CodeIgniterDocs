<?php namespace App\Controllers;

// import NewsModel
use App\Models\NewsModel;
use CodeIgniter\Controller;

class News extends Controller
{
    // view all news items
    public function index()
    {
        $model = new NewsModel();

        // $data['news'] = $model->getNews();

        $data = [
            'news' => $model->getNews(),
            'title' => 'News archive',
        ];

        // pass it to the views
        echo view('templates/header', $data);
        echo view('news/overview', $data); // app/Views/overview.php
        echo view('templates/footer', $data);
    }

    // view specific news item
    public function view($slug = null)
    {
        $model = new NewsModel();

        // Instead of calling the getNews() method without a parameter, the $slug
        // variable is passed, so it will return the specific news item.
        $data['news'] = $model->getNews($slug);

        if (empty($data['news']))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: '. $slug);
        }

        $data['title'] = $data['news']['title'];

        echo view('templates/header', $data);
        echo view('news/view', $data); // app/Views/view.php
        echo view('templates/footer', $data);
    }
}
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

    // create a news item
    public function create()
    {
        // load NewsModel
        $model = new NewsModel();

        // check if request is POST + validate $_POST fields
        // using Controller-provided helper function
        if ($this->request->getMethod() === 'post' && $this->validate([
                'title' => 'required|min_length[3]|max_length[255]',
                'body'  => 'required'
            ]))
        {
            // if form submitted (ie. POST) *and* passed validation, call the model
            $model->save([
                'title' => $this->request->getPost('title'),
                // url_title (provided by the URL Helper) sluggifies a string
                'slug'  => url_title($this->request->getPost('title'), '-', TRUE),
                'body'  => $this->request->getPost('body'),
            ]);

            // then load a view to display a success message
            echo view('news/success');

        }
        else
        // if validation unsuccesful (or not POST), display the form
        {
            echo view('templates/header', ['title' => 'Create a news item']);
            echo view('news/create');
            echo view('templates/footer');
        }
    }

}
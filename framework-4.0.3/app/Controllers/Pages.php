<?php namespace App\Controllers;

use CodeIgniter\Controller;

// Controllers map to URLs
// http://example.com/[controller-class]/[controller-method]/[arguments]
// http://example.com/news/latest/10

class Pages extends Controller
{
    public function index()
    {
        // localhost:8080/pages
        // the results from the index method inside our Pages
        // controller, which is to display the CodeIgniter “welcome” page,
        // because “index” is the default controller method

        // localhost:8080/pages/index 
        // the CodeIgniter “welcome” page, because we explicitly asked for
        // the “index” method

        return view('welcome_message');
    }


    public function view($page = 'home')
    {
        // check if page exists using PHPs native is_file()
        //    i.e.     APPATH.'Views/pages/home.php'
            // if not, show default error page using CodeIgniter's PageNotFoundException exception


        if ( ! is_file(APPPATH.'/Views/pages/'.$page.'.php') )
        // PHP native is_file() = APPATH.'Views/pages/home.php'
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
            // default error page using CodeIgniter's PageNotFoundException exception
        }

        // assign $page to the "title" element in the $data array
        $data['title'] = ucfirst($page); // Capitalize the first letter

        echo view('templates/header', $data);
        echo view('pages/'.$page, $data);
        echo view('templates/footer', $data);
    }
}
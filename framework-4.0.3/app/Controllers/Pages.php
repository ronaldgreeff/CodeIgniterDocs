<?php namespace App\Controllers;

use CodeIgniter\Controller;
// Controller provides a couple of helper methods,
// and makes sure you have access to Request and Response objects
// as well as the Logger class for saving info. to disk

// Controllers map to URLs
// http://example.com/news/latest/10
// http://example.com/[CONTROLLER CLASS]/[CONTROLLER METHOD]/[ARGUMENTS]

// CONTROLLER CLASS
class Pages extends Controller
{
    // CONTROLLER METHOD (+ARGUMENTS)
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

    // CONTROLLER METHOD + ARGUMENTS
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

        // load views in order to be displayed
        // view() - CodeIgniter built-in
        // $data - second parameter. Each value in $data array assigned to var with key's name
        // eg. $data['title'] in the controller is $title in the view
        echo view('templates/header', $data);
        echo view('pages/'.$page, $data);
        echo view('templates/footer', $data);

        // PHP echo
        // The echo statement can output one or more strings. In general terms, the echo statement can display anything that can be displayed to the browser, such as string, numbers, variables values, the results of expressions etc.
    }
}
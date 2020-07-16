<?php namespace App\Models;

// DB REFERENCE
// CREATE TABLE news (
//     id int(11) NOT NULL AUTO_INCREMENT,
//     title varchar(128) NOT NULL,
//     slug varchar(128) NOT NULL,
//     body text NOT NULL,
//     PRIMARY KEY (id),
//     KEY slug (slug)
// );

// SEED REFERENCE
// INSERT INTO news VALUES
// (1,'Elvis sighted','elvis-sighted','Elvis was sighted at the Podunk internet cafe. It looked like he was writing a CodeIgniter app.'),
// (2,'Say it isn\'t so!','say-it-isnt-so','Scientists conclude that some programmers have a sense of humor.'),
// (3,'Caffeination, Yes!','caffeination-yes','World\'s largest coffee shop open onsite nested coffee shop for staff only.');

// Create a new model by extending CodeIgniter\Model and
// load the database library. This will make the database
// class available through the $this->db object:

use CodeIgniter\Model;

// Create a new model by extending CodeIgniter\Model that loads the database library
// *** this makes the database class available through $this->db ***

class NewsModel extends Model
{
    protected $table = 'news';

    // Now need a method to get our posts from our database
    // using Query Builder (database abstraction layer)

    public function getNews($slug = false)
    // Query Builder also sanitizes input variables ($slug)
    {
        // getall() from news if no slug provided
        if ($slug === false)
        {
            return $this->findAll();
        }

        // get first() where $slug
        return $this->asArray()
                    ->where(['slug' => $slug])
                    ->first();
    }

    // findAll() and first() are provided by Model class
    // these helper classes use Query Builder to run
    // commands on the current table and returns array
    // of results in format of choice

}
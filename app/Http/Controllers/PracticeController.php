<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Debugbar;
use cebe\markdown\MarkdownExtra;
use App\Book;

class PracticeController extends Controller
{
    public function practice11() 
    {
        $book = Book::find(5);

        if(!$book) {
            dump("Did not delete book 5, did not find it.");
        } else {
            $book->delete();
            dump("Deleted book #5");
        }
    }

    public function practice9() 
    {
        $book = Book::where("author", "LIKE", "%Scott%")
                        ->first();
        if(!$book) {
            dump("Book not found, can't update.");
        } else {
            $book->title = "The Really Great Gatsby";
            $book->published = "2025";

            $book->save();
            dump("update complete");
        }

    }

    public function practice8()
    {
        $book = new Book();
        $books = $book->where("title", "LIKE", "%Harry Potter%")
                    ->orWhere("published", ">=", 1800)
                    ->orderBy("created_at")
                    ->get();
        dump($books->toArray());
    }

    public function practice7()
    {
        $book = new Book();
        $books = $book->all();
        dump($books->toArray());
    }

    public function practice6()
    {
        $newBook = new Book();
        $newBook->title = 'Harry Potter and the Sorcerer\'s Stone';
        $newBook->author = 'J.K. Rowling';
        $newBook->published = 1997;
        $newBook->cover = 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg';
        $newBook->purchase_link = 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427';
        $newBook->save();

        dump($newBook->toArray());
    }
    /**
    *
    */
    public function practice5()
    {
       // use markdown extra
		$parser = new MarkdownExtra();
		echo $parser->parse("# Hello World");

    }


    /**
    *
    */
    public function practice4()
    {
    	Debugbar::info($_GET);
        Debugbar::info("hello world");
        Debugbar::info(["a" => 1, "b" => 2, "c" => 3]);
		Debugbar::error('Error!');
		Debugbar::warning('Watch out…');
		Debugbar::addMessage('Another message', 'mylabel');

		return "Practice 4";
    }

    /**
    *
    */
    public function practice3()
    {
       return view("abc"); //purposely making error
    }


    /**
    *
    */
    public function practice2()
    {
    	$email = config("mail");
    	dump($email);
    }

    /**
    *
    */
    public function practice1()
    {
        dump('This is the first example.');
    }


    /**
    * ANY (GET/POST/PUT/DELETE)
    * /practice/{n?}
    *
    * This method accepts all requests to /practice/ and
    * invokes the appropriate method.
    *
    * http://foobooks.loc/practice/1 => Invokes practice1
    * http://foobooks.loc/practice/5 => Invokes practice5
    * http://foobooks.loc/practice/999 => Practice route [practice999] not defined
    */
    public function index($n = null)
    {
        # If no specific practice is specified, show index of all available methods
        if (is_null($n)) {
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    # Echo'ing display code from a controller is typically bad; making an
                    # exception here because:
                    # 1. This controller is for debugging/demonstration purposes only
                    # 2. This controller is introduced before we cover views
                    echo "<a href='".str_replace('practice', '/practice/', $method)."'>" . $method . "</a><br>";
                }
            }
        # Otherwise, load the requested method
        } else {
            $method = 'practice'.$n;

            if (method_exists($this, $method)) {
                return $this->$method();
            } else {
                dd("Practice route [{$n}] not defined");
            }
        }
    }
}
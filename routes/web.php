<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/debug', function () {

    $debug = [
        'Environment' => App::environment(),
        'Database defaultStringLength' => Illuminate\Database\Schema\Builder::$defaultStringLength,
    ];

    /*
    The following commented out line will print your MySQL credentials.
    Uncomment this line only if you're facing difficulties connecting to the
    database and you need to confirm your credentials. When you're done
    debugging, comment it back out so you don't accidentally leave it
    running on your production server, making your credentials public.
    */
    #$debug['MySQL connection config'] = config('database.connections.mysql');

    try {
        $databases = DB::select('SHOW DATABASES;');
        $debug['Database connection test'] = 'PASSED';
        $debug['Databases'] = array_column($databases, 'Database');
    } catch (Exception $e) {
        $debug['Database connection test'] = 'FAILED: '.$e->getMessage();
    }

    dump($debug);
});




/***
* 
***/
Route::get('/env', function () {
    dump(config('app.name'));
    dump(config('app.env'));
    dump(config('app.debug'));
    dump(config('app.url'));
});

/***
* Practice
***/
Route::any("/practice/{n?}", "PracticeController@index");

/*
Route::get('/', function () {
    return view('welcome'); //move to WelcomeController.php @index()
});*/
#Route::get("/", "WelcomeController@index"); __invoke()
Route::get("/", "WelcomeController");

/*
Route::get("/book/", function () {
	return "Show all the books"; //move to BookController.php @index()
});*/
Route::get("/book/", "BookController@index");



/*
Route::get("/book/{title}", function ($title) {
	return "You are viewing " .$title; //move to BookController.php @show()
});*/
Route::get("/book/{title}", "BookController@show");



Route::get("/example", function () {
	return Hash::make("topsecret");
});



/*
Route::get('/book/war-and-peace', function () {
	return "You want to view the book War and Peace.";
});
*/

/* added this code to purposefully create a bug to get error log 9/29/17 ykim*/
/*Route::get('/example', function () {
    return view('abc');
});*/

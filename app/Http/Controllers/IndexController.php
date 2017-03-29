<?php

class IndexController extends Controller {

        /*
        |--------------------------------------------------------------------------
        | Default Home Controller
        |--------------------------------------------------------------------------
        |
        | You may wish to use controllers instead of, or in addition to, Closure
        | based routes. That's great! Here is an example controller method to
        | get you started. To route to this controller, just add the route:
        |
        |       Route::get('/', 'HomeController@showWelcome');
        |
        */

        public function showIndex()
        {
                return View::make('home/construction-index');
        }

	public function showNews()
        {
                return View::make('home/noticias');
        }

	public function showPost()
        {
                return View::make('home/post');
        }

	public function showServices()
        {
                return View::make('home/servicios');
        }
	
	public function showWho()
        {
                return View::make('home/about');
        }

	public function showContact()
	{
		return View::make('home/contacto');
	}

}



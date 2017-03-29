
<?php

use Illuminate\Support\MessageBag;
use \App\Models\UserController;
class AuthController extends Controller {

	
    public function showLogin()
    {
        // Verificamos si hay sesión activa
        if (Auth::check())
        {
            // Si tenemos sesión activa mostrará la página de inicio
            return Redirect::to('home');
        }
        // Si no hay sesión activa mostramos el formulario
        return View::make('site/login');
	
    }
 
    public function postLogin()
    {

	$errors = new MessageBag;
        // Obtenemos los datos del formulario
        $data = [
            'email' => Input::get('email'),
            'password' => Input::get('password')
        ];
	
	//Log::info('email - '.Input::get('email'));
	//Log::info('password - '.Input::get('password'));
 
        // Verificamos los datos
        if (Auth::attempt($data, true)) // Como segundo parámetro pasámos el checkbox para sabes si queremos recordar la contraseña
        {
            // Si nuestros datos son correctos mostramos la página de inicio
	       return Redirect::intended('home');
	
        }
        // Si los datos no son los correctos volvemos al login y mostramos un error
	else{
	$errors = new MessageBag(['password' => ['Correo o contraseña inválidos.']]);
         // return Redirect::back()->with('error_message', 'Error al ingresar los datos')->withInput();
		return Redirect::back()->withErrors($errors)->withInput(Input::except('password'));
	}
		
    }
 
    public function logOut()
    {
        // Cerramos la sesión
        Auth::logout();
	Session::flush();
        // Volvemos al login y mostramos un mensaje indicando que se cerró la sesión
        return Redirect::to('login');

    }
 
}

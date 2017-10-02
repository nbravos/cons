<?php

use Illuminate\Support\Facades\Password;


class RemindersController extends Controller {

  /**
   * Display the password reminder view.
   *
   * @return Response
   */
  public function getRemind()
  {
    return View::make('password.remind');
  }

  /**
   * Handle a POST request to remind a user of their password.
   *
   * @return Response
   */
  public function postRemind()
  {
    switch ($response = Password::sendResetLink(Input::only('email')))
    {
      case Password::INVALID_USER:
        return Redirect::back()->with('error', Lang::get($response));

      case Password::RESET_LINK_SENT:

        return Redirect::back()->withSuccess('Hemos enviado un link a su cuenta de correo electrónico');
//        return redirect()->back()->with('status', 'Hemos enviando un link a tu cuenta de correo electrónico para que puedas resetear el password');

    }
  }

  /**
   * Display the password reset view for the given token.
   *
   * @param  string  $token
   * @return Response
   */
  public function getReset($token = null)
  {
    if (is_null($token)) App::abort(404);

    return View::make('password.reset')->with('token', $token);
  }

  /**
   * Handle a POST request to reset a user's password.
   *
   * @return Response
   */
  public function postReset()
  {
    $credentials = Input::only(
      'email', 'password', 'password_confirmation', 'token'
    );

    $response = Password::reset($credentials, function($user, $password)
    {
      $user->password = $password;
	
      $user->save();

      //Auth::login($user);
	
    });
	
    switch ($response)
    {
      case Password::INVALID_PASSWORD:
      case Password::INVALID_TOKEN:
      case Password::INVALID_USER:
        return Redirect::back()->with('error', Lang::get($response));

      case Password::PASSWORD_RESET:
        return Redirect::to('login');
    }
  }
}
?>

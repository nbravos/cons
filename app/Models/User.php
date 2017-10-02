<?php
namespace App\Models;

use  \Validator;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use App\Notifications\MyResetPassword;

class User extends Authenticatable {

	use  Notifiable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usuario';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function setPasswordAttribute($value)
    	{
        	if ( ! empty ($value))
        	{
            		$this->attributes['password'] = \Hash::make($value);
        	}
    	}	

	 public $errors;
    
	 public function isValid($data)
    	{
	$rules = array(
            'email'     => 'required|email|unique:usuario',
            'name' => 'required|min:4|max:40',
            'password'  => 'required|min:6|confirmed',
            'roles' => 'required|min:1'
        );

	$mensajes = array(
        'name.required' => 'El nombre de usuario es obligatorio',
        'email.required' => 'El correo electrónico del usuario es obligatorio',
	'password.required'=> 'La contraseña es obligatoria',
        'password.min' => 'La contraseña debe ser de al menos 6 caracteres',
	'password.confirmed' => 'Las contraseñas deben ser iguales',
	'roles.required' => '1: Usuario Administrador, 
				2: Usuario acceso medio,
				3: Acceso mínimo',

        );
        
        // Si el usuario existe:
        if ($this->exists)
        {
               //Evitamos que la regla “unique” tome en cuenta el email del usuario actual
		$rules['email'] .= ',email,' . $this->id;
        }
        else // Si no existe...
        {
            // La clave es obligatoria:
            $rules['password'] .= '|required';
        }
        
        $validator = Validator::make($data, $rules, $mensajes);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
	}
	protected $fillable = array('email', 'name', 'password', 'roles');

	 public function validAndSafe($data)
	{
        // Revisamos si la data es válida
        	if ($this->isValid($data))
        	{
            		// Si la data es valida se la asignamos al usuario
		        $this->fill($data);
            		// Guardamos el usuario
		        $this->save();
            
		        return true;
        	}
        
	        return false;
    	}

	
	public $timestamps = false;
}


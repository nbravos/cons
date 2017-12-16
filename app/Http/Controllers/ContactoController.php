<?php

use Illuminate\Http\Request;
use App\Mail\Contacto;

class ContactoController extends Controller
{
    public function email(Request $request)
	 {
	 	$data = Input::all();
		//dd($data);
	 	$title = $data['subject'];
	 	$content = $data['message'];
	 	$mail = $data['email'];
		$contact_name = $data['name'];

	 	/*this->validate($request, [
	 		'email'  => 'required|email',
            'nombre' => 'required|min:4|max:40',
            'mensaje'=> 'required|max:150'
            ]);*/

         Mail::send('emails.contacto', ['title' => $title, 'content' => $content], function ($message) use ($mail, $contact_name)
        {

            $message->from('noreplyconstructora@gmail.com', $contact_name);
            $message->to('contacto@aragonltda.cl');
            $message->subject("Ha recibido un correo de Contacto aragonltda.cl");
	    $message->replyTo($mail, $contact_name);
          $message->cc('secretaria@aragonltda.cl');
    //        $message->cc('aldo@aragonltda.cl');   
	
        });

        return redirect()->back()->with('message', 'Gracias por su mensaje!');    
	 }
}

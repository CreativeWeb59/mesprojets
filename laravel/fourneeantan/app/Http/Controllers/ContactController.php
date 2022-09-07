<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store()
    {
        $rules = array(
            'nom' => 'required|max:255',
            'telephone' => 'required|numeric|regex:/^[0-9]{10}$/', // accepte une série de 10 chiffres de 0 à 9
            'email'=>'required|max:255|email',
            'description'=>'required|between:5,255'
        );    
        $message = array(
                'nom.required' => 'Le nom est obligatoire',
                'telephone.required' => 'Le numéro de téléphone est obligatoire',
                'email.required' => 'L\'email est obligatoire',
                'description.required' => 'Le message est obligatoire',
            );

            $validator = Validator::make(request()->all(), $rules, $message );

        $errors = $validator->errors();
        
        if ( $validator->fails() ) 
        {
            return self::index(request()->all())->withErrors($validator->errors())->withInput(request()->all());

            //return back()->withErrors($validator)->withInput(request()->all());
            //return view('pages.contact')-> withErrors($validator);
        }


        Mail::to('admin@fourneeantan.fr')->send(new ContactMail(request()->all()));
        return view('pages.contactM');

    }
}

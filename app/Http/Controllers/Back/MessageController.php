<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
class MessageController extends Controller
{
    public function index(){
        $contacts=Contact::orderBy('created_at','DESC')->paginate(5);
        return view('back.messages.index',compact('contacts'));

    }

    public function delete(Request $request){
        $contact=Contact::findOrFail($request->id);
        $contact->delete();

        flash()->success('Başarıyla silindi');
        return redirect()->back();

    }
}


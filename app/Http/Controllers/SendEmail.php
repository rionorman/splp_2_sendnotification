<?php

namespace App\Http\Controllers;

use App\Mail\MailSender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class SendEmail extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function formEmail()
	{
		return view('email.formemail');
	}

	public function sendEmail(Request $request)
	{
		$response = Http::post(
			// 'http://localhost:8000/api/sendemail',
			'http://localhost:8290/broadcastemail/sendemail',
			[
				'email' => $request->email,
				'subject' => $request->subject,
				'content' => $request->content
			]
		);
		$data = json_decode($response->body(), true);
		// dd($data['message']);
		return redirect("/formemail")->with(['message' => $data['message']]);
	}
}

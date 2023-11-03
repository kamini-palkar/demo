<?php

namespace App\Http\Controllers;
use Mail;
use Illuminate\Mail\Mailable;
use App\Mail\MailableName;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MailController extends Controller
{
    //
    public function index()
    {
        // echo"hello";
        // $mailData = [
        //     'title' => 'Mail from Security Softwere  & Solutions LLP',
        //     'body' => 'This is Excel file of  student data  .'
        // ];
         
        // Mail::to('palkarkamini05@gmail.com')->send(new MailableName($mailData));
           
        // dd("Email is sent successfully.");




        $data["email"] = "palkarkamini05@gmail.com";
        $data["title"] = "Mail from Security Softwere  & Solutions LLP";
        $data["body"] = "This is email body .";
        $data["data"] = "SS&S LLP";
 
        $files = [
            public_path('excel\anu_645.xlsx'),
            public_path('excel\testseqr.xlsx'),
        ];
  
        Mail::send('demoMail', $data, function($message)use($data, $files) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"]);
 
            foreach ($files as $file){
                $message->attach($file);
            }
            
        });
 
        // dd('Mail sent successfully');
        // return view('email.mail');
        return redirect()->back()->with('success','Mail sent successfully');
        // return response()->json([
        //     'status'=>400,
        //     'message'=>'Mail send'

        // ],400);
    
    }

    public function UserMail(Request $request)
    {
        // echo"hello";
        $validator = Validator::make($request->all(), [
           
            'email' => 'required|email|',
            'user_file' => 'required|',

        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
    
            ],422);

        }
       else{
        $email = $request->input('email');
        $accessToken = $request->input('access_token');
        dd($accessToken);

        // $file = $request->file('user_file');
      
        // $fileName = $file->getClientOriginalName();
        // dd($fileName);
        // // dd(public_path());
        // $file->move(public_path('excel'), $fileName);
        // // dd($file);
        // $path = public_path('excel/').$fileName;

        $email=$request->input('email');

        $data["title"] = "Mail from Security Softwere  & Solutions LLP";
        $data["body"] = "This is email body .";
        $data["data"] = "SS&S LLP";
        $mail=Mail::send('demoMail', $data, function($message)use($data,$email) {
            $message->to($email, $email)
                    ->subject($data["title"]);
        //    $message->attach($path);
            
            
        });

  
            return response()->json([
                'status'=>400,
                'message'=>"Mail send"
    
            ],400);

        
        
       }
        // dd('Mail sent successfully');
        // return view('email.mail');
        // return redirect()->route('email.mail')
        //                 ->with('success','Mail sent successfully');
        // return redirect()->back()->with('success','Mail sent successfully');
    }
     


}

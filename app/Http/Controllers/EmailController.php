<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDO;

class EmailController extends Controller
{

    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'subject' => 'required',
            'reply' => 'required',
            'content' => 'required',
        ]);


        // return($request->content);
        if ($request->inputfile == 'confirm') {
            $file = fopen(public_path('./attachement/index.html'), 'w');

            $html = '<!DOCTYPE html>
                    <html lang="en">
                        <head>
                            <title></title>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1">
                            <link href="css/style.css" rel="stylesheet">
                        </head>
                        <body>' .
                $request->content
                . '</body>
                    </html>';
            fwrite($file, $html);

            fclose($file);
        }

        $str = $request->email;
        $emails = explode(',', trim($str));

        $str = $request->carboncopy;
        $carboncopy = explode(',', trim($str));

        $str = $request->blindcarboncopy;
        $blindcarboncopy = explode(',', trim($str));


        function replace_string_in_file($filename, $string_to_replace, $replace_with){
            $content=file_get_contents($filename);
            $content_chunks=explode($string_to_replace, $content);
            $content=implode($replace_with, $content_chunks);
            file_put_contents($filename, $content);
        }


        
        for ($i = 0; $i < count($emails); $i++ ) {
            # code...
       
            if(!empty($request->file('fileupload')))
            {

            
            $filename = $request->file('fileupload')->getRealPath();
            $string_to_replace="***";
            $replace_with= $emails[$i];
         

            if(!empty($filename))
            {
                replace_string_in_file($filename, $string_to_replace, $replace_with);
            }
            
        }

        if ($blindcarboncopy[0] != "" && $carboncopy[0] != "") {



            $data = [
                'subject' => $request->subject,
                'email' => $emails[$i],
                'reply' => $request->reply,
                'content' =>$request->content,
                'fileupload' => $request->file('fileupload'),
                'confirmed' => $request->inputfile,
                'carboncopy' => $carboncopy,
                'blindcarboncopy' =>  $blindcarboncopy
            ];



            Mail::send('info', $data, function ($message) use ($data) {
                if ($data['fileupload'] != "") {
                    $message->to($data['email'])
                        ->replyTo($data['reply'])
                        ->subject($data['subject'])
                        ->attach(
                            $data['fileupload']->getRealPath(),
                            [
                                'as' => $data['fileupload']->getClientOriginalName(),
                                'mime' => $data['fileupload']->getClientMimeType()
                            ]
                        )
                        ->cc($data['carboncopy'])
                        ->bcc($data['blindcarboncopy']);
                } else if ($data['confirmed'] == 'confirm') {
                    $message->to($data['email'])
                        ->replyTo($data['reply'])
                        ->subject($data['subject'])
                        ->attach(
                            public_path('./attachement/index.html'),
                            [
                                'as' => 'index.html',
                                'mime' => 'text/html'
                            ]
                        )
                        ->cc($data['carboncopy'])
                        ->bcc($data['blindcarboncopy']);
                } else {
                    $message->to($data['email'])
                        ->replyTo($data['reply'])
                        ->subject($data['subject'])
                        ->cc($data['carboncopy'])
                        ->bcc($data['blindcarboncopy']);
                }
            });
        } else if ($blindcarboncopy[0] != "") {


            $data = [
                'subject' => $request->subject,
                
                'email' => $emails[$i],
                'reply' => $request->reply,
                'content' =>$request->content,
                'fileupload' => $request->file('fileupload'),
                'confirmed' => $request->inputfile,
                'blindcarboncopy' =>  $blindcarboncopy
            ];
            Mail::send('info', $data, function ($message) use ($data) {
                if ($data['fileupload'] != "") {
                    $message->to($data['email'])
                        ->replyTo($data['reply'])
                        ->subject($data['subject'])
                        ->attach(
                            $data['fileupload']->getRealPath(),
                            [
                                'as' => $data['fileupload']->getClientOriginalName(),
                                'mime' => $data['fileupload']->getClientMimeType()
                            ]
                        )

                        ->bcc($data['blindcarboncopy']);
                } else if ($data['confirmed'] == 'confirm') {
                    $message->to($data['email'])
                        ->replyTo($data['reply'])
                        ->subject($data['subject'])
                        ->attach(
                            public_path('./attachement/index.html'),
                            [
                                'as' => 'index.html',
                                'mime' => 'text/html'
                            ]
                        )

                        ->bcc($data['blindcarboncopy']);
                } else {
                    $message->to($data['email'])
                        ->replyTo($data['reply'])
                        ->subject($data['subject'])

                        ->bcc($data['blindcarboncopy']);
                }
            });
        } else if ($carboncopy[0] != "") {


            $data = [
                'subject' => $request->subject,
                'email' => $emails[$i],
                'reply' => $request->reply,
                'content' =>$request->content,
                'fileupload' => $request->file('fileupload'),
                'confirmed' => $request->inputfile,
                'carboncopy' => $carboncopy,

            ];
            Mail::send('info', $data, function ($message) use ($data) {



                if ($data['fileupload'] != "") {
                    $message->to($data['email'])
                        ->replyTo($data['reply'])
                        ->subject($data['subject'])
                        ->attach(
                            $data['fileupload']->getRealPath(),
                            [
                                'as' => $data['fileupload']->getClientOriginalName(),
                                'mime' => $data['fileupload']->getClientMimeType()
                            ]
                        )
                        ->cc($data['carboncopy']);
                } else if ($data['confirmed'] == 'confirm') {
                    $message->to($data['email'])
                            ->replyTo($data['reply'])
                            ->subject($data['subject'])
                            ->attach(
                            public_path('./attachement/index.html'),
                            [
                                'as' => 'index.html',
                                'mime' => 'text/html'
                            ]
                        )
                        ->cc($data['carboncopy']);
                } else {
                    $message->to($data['email'])
                        ->replyTo($data['reply'])
                        ->subject($data['subject'])
                        ->cc($data['carboncopy']);
                }
            });
        } else {

            $data = [
                'subject' => $request->subject,
                
                'email' => $emails[$i],
                'reply' => $request->reply,
                'content' =>$request->content,
                'fileupload' => $request->file('fileupload'),
                'confirmed' => $request->inputfile,

            ];
            Mail::send('info', $data, function ($message) use ($data) {



                if ($data['fileupload'] != "") {
                    $message->to($data['email'])
                        ->replyTo($data['reply'])
                        ->subject($data['subject'])
                        ->attach(
                            $data['fileupload']->getRealPath(),
                            [
                                'as' => $data['fileupload']->getClientOriginalName(),
                                'mime' => $data['fileupload']->getClientMimeType()
                            ]
                        );
                } else if ($data['confirmed'] == 'confirm') {
                    $message->to($data['email'])
                        ->replyTo($data['reply'])
                        ->subject($data['subject'])
                        ->attach(
                            public_path('./attachement/index.html'),
                            [
                                'as' => 'index.html',
                                'mime' => 'text/html'
                            ]
                        );
                } else {
                    $message->to($data['email'])
                        ->replyTo($data['reply'])
                        ->subject($data['subject']);
                }
            });
        }




    }




 $counting = count($emails);
    if($i >= $counting ){
    $e  =  $counting - 1;
    $em = $emails[$e];

    if(!empty($request->file('fileupload')))
    {

        
        $filename = $request->file('fileupload')->getRealPath();
        if(!empty($filename))
        {
            $string_to_replace=$em;
            $replace_with= "***";
            replace_string_in_file($filename, $string_to_replace, $replace_with);
        }
        
    }

    }






        return back()->with(['message' => 'Email successfully sent!']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\smtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SmtpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = smtp::whereId(1)->first();
        return view('setting',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = 1;
        $data = array();
        $data['mailer'] = $request->mailer;
        $data['host'] = $request->host;
        $data['port'] = $request->port;
        $data['username'] = $request->username;
        $data['password'] = $request->password;
        $data['encryption'] = $request->encryption;
        $data['sender'] = $request->sender;
        $data['displayname'] = $request->displayname;
        DB::table('smtps')->where('id',$id)->update($data);
        return back();
    


}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\smtp  $smtp
     * @return \Illuminate\Http\Response
     */
    public function show(smtp $smtp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\smtp  $smtp
     * @return \Illuminate\Http\Response
     */
    public function edit(smtp $smtp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\smtp  $smtp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, smtp $smtp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\smtp  $smtp
     * @return \Illuminate\Http\Response
     */
    public function destroy(smtp $smtp)
    {
        //
    }
}

@extends('layout')

@section('content')
<a href="/"  class="btn btn-primary btn-sm mt-5 mx-5" ><b> < back </b> </a>
<h5 class="text-center mt-5 textcolor">SMTP SETTINGS</h5>
<div class="container">
    <div class="row">
      
            <div class="container offset-md-2">
                <form action="{{ route('store')}}" class="shadow col-12 col-md-8 p-4 rounded" method="post">
                    @csrf
                   

                    <label for="host">MAILER </label>
                    <input type="text" name="mailer" value="{{$data->mailer}}" placeholder="smtp"  class="form-control"/>
                    <br>

                    <label for="host">HOST </label>
                    <input type="text" name="host" value="{{$data->host}}" placeholder="smtp.expamle.host"  class="form-control"/>
                    <br>
                    <label for="port">PORT</label>
                    <input type="text" name="port" id="port" value="{{$data->port}}" class="form-control">
                    <br>
                    <label for="name">USER NAME</label>
                    <input type="text" name="username" placeholder="example" value="{{$data->username}}"  class="form-control"/>
                    <br>
                    <label for="pass">PASSWORD</label>
                    <input type="text" name="password" placeholder="**********" value="{{$data->password}}" class="form-control">
                    <br>
                    <label for="host">ENCRYPTION</label>
                    <input type="text" name="encryption"  value="{{$data->encryption}}" class="form-control"/>
                    <br>
                    <label for="host">SENDER</label>
                    <input type="text" name="sender" placeholder="" value="{{$data->sender}}" class="form-control"/>
                    <br>

                    <label for="host">DISPLAY NAME</label>
                    <input type="text" name="displayname" placeholder="" value="{{$data->displayname}}" class="form-control"/>
                    <br><br>
                    <button type="submit" name="submit" class="btn btn-info textcolor border shadow">UPDATE </button>
                        <br><br>
            </form>
        
            </div>
    </div>
</div>


    <br><br>
@endSection

@extends('layout')

@section('content')
    <div class="container shadow   ">
        <div class="col p-1 mt-5  offset-md-10 ">

            <button class="btn btn-secondary btn-sm" id="showCC"> CC</button>
            <button class="btn btn-secondary btn-sm" id="showBCC"> BCC</button>
            <button class="btn btn-success btn-sm" id="showBCC" onclick="window.location.href='./setting'"> SETTING</button>
        </div>
        <div class="offset-md-3">
            <form action="{{ route('sendmail') }}" id="contactForm" method="POST" class="col-12 col-md-9  "
                enctype="multipart/form-data">

                @csrf
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="inputBox">
                    <input type="text" class='form-control' name="reply" id="subject" placeholder="Reply To" />
                    </span>
                    @error('reply')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror

                    <input type="text" class='form-control' name="subject" id="subject" placeholder="Subject" />
                    @error('subject')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror


                </div>


                <div class="inputBox">
                    <!-- <input type="email"  placeholder="Receiver Email....." /> -->
                    <textarea class='form-control' id="emailid" name="email" cols="30" rows="1" placeholder="Email"></textarea>
                    @error('email')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                    <small>Use a comma to separate multiple email <br> <br></small>
                </div>


                <div class="showCCbox">
                    <!-- <input type="email"  placeholder="Receiver Email....." /> -->
                    <textarea id="carboncopy" class='form-control' name="carboncopy" cols="30" rows="1" placeholder="CC"></textarea>
                    <!-- <small>Use a comma to separate multiple email  <br> <br></small> -->

                </div>

                <div class="showBCCbox">
                    <!-- <input type="email"  placeholder="Receiver Email....." /> -->
                    <textarea id="blindcarboncopy" class='form-control' name="blindcarboncopy" cols="30" rows="1"
                        placeholder="BCC"></textarea>
                    <!-- <small>Use a comma to separate multiple email  <br> <br></small> -->

                </div>

                <div class="inputBox">
                    <textarea id="msgContent" name='content' class='form-control' cols="30" rows="10" placeholder="Message"></textarea>
                    @error('content')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="inputBox">
                    ADD Attachement
                    <br>
                    <label for="forhtml" class="btn btn-primary btn-sm my-2">SEND FILE AS HTML DOCUMENT </label>
                    <input type="checkbox" name="inputfile" id="forhtml" value="confirm">
                    <br>

                    <input type="file" name="fileupload" id="files" class="form-control">

                    <!-- <input type="text" name="path" id="path"  > -->


                </div>


                <div class="inputBox">
                    <button type="submit" class="btn btn-info mt-3">Submit</button>
                    <br> <br>
                </div>
            </form>



        </div>


    </div>
    <br><br>
@endSection

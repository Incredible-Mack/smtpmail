<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" >
    @yield('metaContent')
    <title>MAIL</title>
    <style>
        *{
            padding: 0px;
            margin: 0px;
        }
    </style>
</head>
<body>
    @yield('content')



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./format.js"></script>
    <script>
        $(function(){

            $('.showCCbox').hide();
                        $('.showBCCbox').hide();

                        $('#showCC').click(function(){
                            $('.showCCbox').toggle();
                        })

                        $('#showBCC').click(function(){
                            $('.showBCCbox').toggle();
                        })

                    $("#colorButton").click(function(){
                      
                        alert("HTML: " + $("#editor").html());
                    })
                    
                    $('.formsubmitted').submit(function(e){
                        e.preventDefault();
                        alert(3)
                        $.ajaxSetup({
                            headers:{
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        })
                           var url = $(this).attr('action');
                                $.ajax({
                                type:'post',
                                url : url,
                                data:{'content': $("#editor").html(),
                                     'email' : $('#email').val(),
                                     'reply' : $('#reply').val(),
                                    // 'fileupload' : $('#fileupload').val(),
                                    'confirmed' : $('#inputfile').val()
                                    'carboncopy' : $('#carboncopy').val()
                                    'blindcarboncopy' :  $('#blindcarboncopy').val()
                                    
                            
                            },
                                success:function(data)
                                {
                                    console.log(data)
                                    alert(1);
                                }
                            })
                    })
                   

                    // $.ajax({type:"POST",url:url,data:form.serialize(),success:function(data){$("#notification").hide()

               

        })
    </script>

</body>
</html>
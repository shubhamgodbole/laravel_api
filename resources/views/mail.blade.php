<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Email Verification</title>

        <!-- Fonts -->
        <!--link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"-->

    </head>
    <body>

       <div>
           {!! $header !!}
       </div>

       <div>
           {!! $html !!}
       </div>

       <div>
           {!! $footer !!}
       </div>


    </body>
</html>


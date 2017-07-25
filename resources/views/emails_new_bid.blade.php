<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="message">
            Добавлена новая заявка:
            name: <?=$_POST['name']?>
            email: <?=$_POST['email']?>
            question: <?=$_POST['question']?>
        </div>
    </body>
</html>
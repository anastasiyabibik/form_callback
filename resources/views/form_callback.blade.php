@extends('header')
@section('content')
<div class="over">
    <h1>Форма обратной связи</h1>

    {!! Form::open(['action'=>'IndexController@send', 'files'=>'true', 'class'=>'form_callback']) !!}
        <div class="form-group name">
            {{ Form::label('name','Имя:',['class'=>'label_name']) }}
            {{ Form::text('name', NULL,['class'=>'input_name', 'placeholder'=>'Введите Ваше имя']) }}
        </div>
        <div class="form-group email">
            {{ Form::label('email','E-mail:',['class'=>'label_email']) }}
            {{ Form::email('email', NULL,['class'=>'input_email', 'placeholder'=>'Адрес элетронной почты']) }}
        </div>
        <div class="form-group question">
            {{ Form::textarea('question', NULL,['class'=>'input_question', 'placeholder'=>'Введите Ваш вопрос']) }}
        </div>
        <div class="form-group files">
            {{ Form::label('files','Загрузить файлы:',['class'=>'label_files']) }}
            {{ Form::file('files',['class'=>'send_files', 'enctype'=>'multipart/form-data']) }}
        </div>
        <div class="email_admin">
            {{ Form::label('input_admin','Почта администратора:',['class'=>'label_admin']) }}
            {{ Form::text('input_admin', NULL,['class'=>'input_admin', 'placeholder'=>'Почта администратора']) }}
        </div>

        <div class="form-group btn">
            {{ Form::submit('Отправить' , ['class'=>'btn btn-primary']) }}
        </div>
    {!! Form::close() !!}

    <div class="message">
        <img class="close" src="{{asset('images/cancel.svg')}}">
    </div>
    <a class="preview btn btn-primary" href="bids_list">Просмотреть заявки</a>
</div>
@endsection
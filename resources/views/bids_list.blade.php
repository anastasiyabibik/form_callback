@extends('header')
@section('content')
<div class="over">
    {!! Form::open() !!}
        <div class="text_mail">
            {{ Form::textarea('answer', NULL,['class'=>'input_answer', 'placeholder'=>'Введите Ваш ответ']) }}
            <div class="group_botton">
                {{ Form::button('Ответить',['class'=>'button_send btn btn-primary']) }}
                {{ Form::button('Закрыть',['class'=>'button_cancel btn btn-primary']) }}
            </div>
        </div>
    {!! Form::close() !!}
    <h1>Список всех записей</h1>
    <div class="red">Выберите запись</div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Номер записи</th>
                <th>Имя</th>
                <th>Вопрос</th>
                <th>Email</th>
                <th>Файлы</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bids as $bid)
                <tr class="bid">
                    <td class="id">{!! $bid->id !!}</td>
                    <td class="name">{!! $bid->name !!}</td>
                    <td class="question">{!! $bid->question !!}</td>
                    <td class="email">{!! $bid->email !!}</td>
                    <td class="files">{!! $bid->files !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="admin_pannel">
        <img class="delete" src="{{asset('images/delete-button.svg')}}">
        <img class="send" src="{{asset('images/export.svg')}}">
    </div>
</div>
@endsection
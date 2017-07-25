$(function() {
    var files = [];
    // загружаем файлы
    $('.send_files').on('change', function() {
        files.push($(this).val());
        console.log(files);
    });

    //отправка post запроса формы
    $('.form_callback').on('submit', function (event) {
        event.preventDefault();
        var formData = {
            'name': $('.input_name').val(),
            'question': $('.input_question').val(),
            'email': $('.input_email').val(),
            'files': files,
            'admin_email': $('.input_admin').val()
        };
        $.ajax({
            url: $(this).prop('action'),
            data: formData,
            method : 'post',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function (data) {
                output = "<div class='alert alert-success'>"+data.responseJSON+"</div>";
                $('.alert').remove();
                $('.message').append(output);
                $('.message').css('display', 'block');
                $('.over').addClass('back');
                $('.form_callback').trigger('reset');
            },
            error: function (errors) {
                output = "<div class='alert alert-danger'><ul>";
                $.each(errors.responseJSON, function(index, error){
                    output += "<li>" + error + "</li>";
                });
                output += "</ul></div>";
                $('.alert').remove();
                $('.message').append(output);
                $('.message').css('display', 'block');
                $('.over').addClass('back');
            },
            dataType: 'json'
        });
        return false;
    });

    //устанавливаем или удаляем класс 'selected' для записи

    $('.bid').click(function () {
        if($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        }else {
            $(this).addClass('selected');
        }
        if($('.selected').length == 1){
            $('.admin_pannel').css('visibility', 'visible');
        } else {
            $('.admin_pannel').css('visibility', 'hidden');
        }
    });

    // удаление записи
    $('.delete').click(function () {
        var dataBid = {
            id: $('.selected').find('.id').html(),
            email: ''
        };
        $.post({
            url: 'bids_list',
            data: dataBid,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function (data) {
                $('.admin_pannel').css('visibility', 'hidden');
                $('.selected').remove();
            }
        });
        return false;
    });
    $('.send').click(function () {
       $('.text_mail').css('display', 'block');
       $('.over').addClass('back');
    });
    $('.close').click(function () {
        $('.over').removeClass('back');
        $('.message').css('display', 'none');
    });
    $('.button_cancel').click(function () {
        $('.text_mail').css('display', 'none');
        $('.over').removeClass('back');
    });
    $('.button_send').on('click', function() {
        var dataBid = {
            id: '',
            email: $('.selected').find('.email').html(),
            answer: $('.input_answer').val()
        };
        $.post({
            url: 'bids_list',
            data: dataBid,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function (data) {
                $('.text_mail').css('display', 'none');
                $('.over').removeClass('back');
            }
        });
    });
});
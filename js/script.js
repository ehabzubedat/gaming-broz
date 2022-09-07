// function that send an email using ajax
(function ($) {
    'use strict';

    var form = $('.contact-form'),
        message = $('#status'),
        form_data;

    // Success function
    function done_func(response) {
        message.fadeIn().removeClass('d-none alert alert-danger').addClass('alert alert-success');
        message.text(response);
        setTimeout(function () {
            message.fadeOut();
        }, 5000);
        form.find('input:not([type="submit"]), textarea').val('');
        $('#send-mail-btn').html("Send");
    }

    // fail function
    function fail_func(data) {
        message.fadeIn().removeClass('d-none alert alert-success').addClass('alert alert-danger');
        message.text(data.responseText);
        setTimeout(function () {
            message.fadeOut();
        }, 5000);
        $('#send-mail-btn').html("Send");
    }

    // if submit button is clicked
    form.submit(function (e) {
        e.preventDefault();
        $('#send-mail-btn').html("Sending ...");
        form_data = $(this).serialize();
        $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: form_data
            })
            .done(done_func)
            .fail(fail_func);
    });

})(jQuery);

// function to Show/Hide password field (sign in form)
(function ($) {
    $('#toggle-password').click(function () {

        if ($(this).hasClass('fa-eye')) {
            $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            $('#login-password').attr('type', 'text');
            $(this).tooltip('hide').attr('data-original-title', 'hide password').tooltip('show');
        } else {
            $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            $('#login-password').attr('type', 'password');
            $(this).tooltip('hide').attr('data-original-title', 'show password').tooltip('show');
        }
    });
})(jQuery);

// function to Show/Hide password field's (sign up form)
(function ($) {
    $('#toggle-password-both').click(function () {

        if ($(this).hasClass('fa-eye')) {
            $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            $('#password,#confirm-password').attr('type', 'text');
            $(this).tooltip('hide').attr('data-original-title', 'hide password').tooltip('show');
        } else {
            $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            $('#password,#confirm-password').attr('type', 'password');
            $(this).tooltip('hide').attr('data-original-title', 'show password').tooltip('show');
        }
    });
})(jQuery);

// function that enables enabling tooltips
(function ($) {
    $('[data-toggle="tooltip"]').tooltip();
})(jQuery);

// sign up functions
(function ($) {

    // Prevent submitting if enter is clicked in sign up form
    $('#signup-form').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });


    // hide all alert messages
    $('#first-name-error').hide();
    $('#last-name-error').hide();
    $('#birthday-error').hide();
    $('#gender-error').hide();
    $('#email-error').hide();
    $('#username-error').hide();
    $('#password-error').hide();
    $('#confirm-password-error').hide();
    $('#image-error').hide();

    // on click events for (next) button in sign up form
    // first page (next) button
    $('#next-1').click(function (e) {
        e.preventDefault();

        var re = /^[A-Za-z]+$/;

        // every time (next) button clicked hide these elements in step-1 of sign up 
        $('#login-link').hide();
        $('#first-name-error').hide().html('');
        $('#last-name-error').hide().html('');
        $('#birthday-error').hide().html('');
        $('#gender-error').hide().html('');

        // checking all fields in step-1 of sign up
        if ($('#first-name').val() == '') {
            $('#first-name-error').show().html('Please fill out this field!');
            return false;
        } else if ($('#first-name').val().length > 15) {
            $('#first-name-error').show().html('First name is too long!');
            return false;
        } else if (!re.test($('#first-name').val())) {
            $('#first-name-error').show().html('Invalid first name!');
            return false;
        } else if ($('#last-name').val() == '') {
            $('#last-name-error').show().html('Please fill out this field!');
            return false;
        } else if ($('#last-name').val().length > 15) {
            $('#last-name-error').show().html('First name is too long!');
            return false;
        } else if (!re.test($('#last-name').val())) {
            $('#last-name-error').show().html('Invalid last name!');
            return false;
        } else if ($('#birthday').val() == '') {
            $('#birthday-error').show().html('Please enter your birthday!');
            return false;
        } else if (ageCalculate($('#birthday').val()) < 16 || ageCalculate($('#birthday').val()) > 120) {
            $('#birthday-error').show().html('You must be at least 16 years old!');
            return false;
        } else if ($('#gender').val() == '') {
            $('#gender-error').show().html('Please choose an option!');
            return false;
        }

        $('#second').show();
        $('#first').hide();
        $('#progress-bar').css('width', ("50%"));
        $("#progress-text").html('step-2');
    });

    // seconds page (next) button
    $('#next-2').click(function (e) {
        e.preventDefault();

        // every time (next) button clicked hide these elements in step-2 of sign up 
        $('#email-error').hide().html('');
        $('#username-error').hide().html('');

        checkEmail($("#email").val()).done(function (data) {
            if (data == 'error') {
                $('#email-error').show().html('E-mail already exists!');
            }
        });

        checkUsername($("#username").val()).done(function (data) {
            if (data == 'error') {
                $('#username-error').show().html('Username already exists!');
            }
        });

        // checking all fields in step-2 of sign up
        if ($('#email-error').text() == 'E-mail already exists!') {
            return false;
        } else if ($('#email').val() == '') {
            $('#email-error').show().html('Please fill out this field!');
            return false;
        } else if (!validateEmail($('#email').val())) {
            $('#email-error').show().html('Invalid e-mail address!');
            return false;
        } else if ($('#username').val() == '') {
            $('#username-error').show().html('Please fill out this field!');
            return false;
        } else if ($('#username-error').text() == 'Username already exists!') {
            return false;
        } else if ($('#username').val().length > 20) {
            $('#username-error').show().html('Username too long!');
            return false;
        } else if (!validateUsername($('#username').val())) {
            $('#username-error').show().html('Invalid username!');
            return false;
        }

        $('#third').show();
        $('#second').hide();
        $('#progress-bar').css('width', ("75%"));
        $("#progress-text").html('step-3');
    });

    // third page (next) button
    $('#next-3').click(function (e) {
        e.preventDefault();

        // every time (next) button clicked hide these elements in step-2 of sign up 
        $('#password-error').hide().html('');
        $('#confirm-password-error').hide().html('');

        // checking all fields in step-3 of sign up
        if ($('#password').val() == '') {
            $('#password-error').show().html('Please fill out this field!');
            return false;
        } else if ($('#password').val().length < 8) {
            $('#password-error').show().html('The password is too short!');
            return false;
        } else if ($('#confirm-password').val() == '') {
            $('#confirm-password-error').show().html('Please fill out this field!');
            return false;
        } else if ($('#password').val() != $('#confirm-password').val()) {
            $('#confirm-password-error').show().html('Passwords does not match!');
            return false;
        }

        $('#fourth').show();
        $('#third').hide();
        $('#progress-bar').css('width', ("90%"));
        $("#progress-text").html('Almost Finished!');
    });

    // seconds page (previous) button
    $('#prev-2').click(function (e) {
        e.preventDefault();
        $('#second').hide();
        $('#first').show();
        $('#login-link').show();
        $('#progress-bar').css('width', ("25%"));
        $("#progress-text").html('step-1');
    });

    // third page (previous) button
    $('#prev-3').click(function (e) {
        e.preventDefault();
        $('#third').hide();
        $('#second').show();
        $('#progress-bar').css('width', ("50%"));
        $("#progress-text").html('step-2');
    });

    // third page (previous) button
    $('#prev-4').click(function (e) {
        e.preventDefault();
        $('#fourth').hide();
        $('#third').show();
        $('#progress-bar').css('width', ("75%"));
        $("#progress-text").html('step-3');
    });

    $('#sign-up-btn').click(function (e) {
        $('#image-error').hide().html('');

        if ($('#imageUpload')[0].files.length === 0) {
            $('#image-error').show().html('Please select a profile picture!');
            return false;
        }
    });

    // Sign up form submit
    $('#signup-form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    alert(response.message);
                    window.location.href = "login.php";
                } else if (response.status == 'error') {
                    alert(response.message);
                    window.location.href = "signup.php";
                }
            }
        });
    });


})(jQuery);

// Login functions
(function ($) {
    // Sign in form submit
    $('#sign-in-form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            beforeSend: function () {
                $('#login-btn').html("logging in ...");
            },
            success: function (response) {
                if (response.status == 'success') {
                    window.location.href = "index.php";
                } else if (response.status == 'error') {
                    $('#login-result').removeClass('d-none');
                    $('#login-result').show().html(response.message);
                    setTimeout(function () {
                        $('#login-result').fadeOut();
                    }, 2000);
                    $('#login-btn').html("login");
                }
            }
        });
    });
})(jQuery);

// function that calculates age 
function ageCalculate(date) {
    var birthDate = date;

    var d = new Date(birthDate);

    var mdate = birthDate.toString();
    var yearThen = parseInt(mdate.substring(0, 4), 10);
    var monthThen = parseInt(mdate.substring(5, 7), 10);
    var dayThen = parseInt(mdate.substring(8, 10), 10);

    var today = new Date();
    var birthday = new Date(yearThen, monthThen - 1, dayThen);

    var differenceInMillisecond = today.valueOf() - birthday.valueOf();

    var age = Math.floor(differenceInMillisecond / 31536000000);

    return age;
}

// Function that check if email already exists in database
function checkEmail(email) {

    return $.ajax({
        url: 'php/validations/checkEmail.php',
        type: 'POST',
        async: false,
        data: {
            email: email
        },
        success: function (response) {
            return response;
        }
    });
}

// Function that validates email 
function validateEmail(email) {
    var emailReg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

    return emailReg.test(email);
}


// Function that check if username already exists in database
function checkUsername(username) {

    return $.ajax({
        url: 'php/validations/checkUsername.php',
        type: 'POST',
        async: false,
        data: {
            username: username
        },
        success: function (response) {
            return response;
        }
    });
}

// Function that validates username
function validateUsername(username) {
    var usernameReg = /^[a-z0-9_-]{3,16}$/;

    return usernameReg.test(username);
}

// Function that preview the uploaded a image
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#imageUpload").change(function () {
    readURL(this);
});

function readImageURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imageView').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

$("#game-image").change(function () {
    readImageURL(this);
});

$("#article-image").change(function () {
    readImageURL(this);
});

// Profile picture the clear functionality
$("#reset-pic").on("click", function () {
    $("#imageUpload").replaceWith($("#imageUpload").val('').clone(true));
    $('#imagePreview').css('background-image', 'url(img/uploads/profile pictures/user.png)');
    $('#imagePreview').hide();
    $('#imagePreview').fadeIn(650);
});

// Account update info functions
(function ($) {

    // Prevent submitting if enter is clicked
    $('#account-form').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    $('#account-alert').hide();
    $('#account-fname-error').hide();
    $('#account-lname-error').hide();
    $('#account-email-error').hide();
    $('#account-username-error').hide();
    $('#account-birthday-error').hide();
    $('#account-gender-error').hide();

    // Validating form data when save changes is clicked
    $('#save-account').click(function (e) {
        var re = /^[A-Za-z]+$/;

        // every time (save changes) button clicked hide these elements
        $('#account-fname-error').hide().html('');
        $('#account-lname-error').hide().html('');
        $('#account-email-error').hide().html('');
        $('#account-username-error').hide().html('');
        $('#account-birthday-error').hide().html('');
        $('#account-gender-error').hide().html('');

        checkEmail($("#account-email").val()).done(function (data) {
            if (data == 'error') {
                $('#account-email-error').show().html('E-mail already exists!');
            }
        });

        checkUsername($("#account-username").val()).done(function (data) {
            if (data == 'error') {
                $('#account-username-error').show().html('Username already exists!');
            }
        });
        
        if ($('#account-first-name').val() == '') {
            $('#account-fname-error').show().html('Please fill this field!');
            return false;
        } else if ($('#account-first-name').val().length > 15) {
            $('#account-fname-error').show().html('First name is too long!');
            return false;
        } else if (!re.test($('#account-first-name').val())) {
            $('#account-fname-error').show().html('Invalid first name!');
            return false;
        } else if ($('#account-last-name').val() == '') {
            $('#account-lname-error').show().html('Please fill this field!');
            return false;
        } else if ($('#account-last-name').val().length > 15) {
            $('#account-lname-error').show().html('First name is too long!');
            return false;
        } else if (!re.test($('#account-last-name').val())) {
            $('#account-lname-error').show().html('Invalid last name!');
            return false;
        } else if (ageCalculate($('#account-birthday').val()) < 16 || ageCalculate($('#account-birthday').val()) > 120) {
            $('#account-birthday-error').show().html('You must be at least 16 years old!');
            return false;
        } else  if ($('#account-email-error').text() == 'E-mail already exists!') {
            return false;
        } else if ($('#account-email').val() == '') {
            $('#account-email-error').show().html('Please fill this field!');
            return false;
        } else if (!validateEmail($('#account-email').val())) {
            $('#account-email-error').show().html('Invalid e-mail address!');
            return false;
        } else  if ($('#account-username-error').text() == 'Username already exists!') {
            return false;
        } else if ($('#account-username').val() == '') {
            $('#account-username-error').show().html('Please fill this field!');
            return false;
        } else if ($('#account-username').val().length > 20) {
            $('#account-username-error').show().html('Username too long!');
            return false;
        } else if (!validateUsername($('#account-username').val())) {
            $('#account-username-error').show().html('Invalid username!');
            return false;
        } else if ($('#account-gender').val() == '') {
            $('#account-gender-error').show().html('Please select an option!');
            return false;
        }

    });


    // Account info form submit
    $('#account-form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (response) {
                if (response.status == 'success') {
                    $('#account-alert').removeClass('alert-danger').addClass('alert-success');
                    $('#account-alert').show().html(response.message);
                    setTimeout(function () {
                        $('#account-alert').fadeOut();
                    }, 3000);
                } else if (response.status == 'error') {
                    $('#account-alert').removeClass('alert-success').addClass('alert-danger');
                    $('#account-alert').show().html(response.message);
                    setTimeout(function () {
                        $('#account-alert').fadeOut();
                    }, 3000);
                }
            }
        });
    });
})(jQuery);

// Show selected file name
(function ($) {

    $(document).ready(function () {
        $('#game-image,#article-image').change(function (e) {
            var fileName = e.target.files[0].name;
            $('#game-image-label,#article-image-label').html(fileName);
        });
    });

})(jQuery);

// Function to add game to database
(function ($) {
    $('#game-form-alert').hide();

    // Add game form  submit
    $('#game-form').submit(function (e) {
        e.preventDefault();
        $('#add-game').html('Adding..');
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    $('#game-form-alert').removeClass('alert-danger').addClass('alert-success').show().html(response.message);
                    $('#game-form').find('input:not([type="submit"])').val('');
                    $('#game-image-label').html('Choose Game Image');
                } else if (response.status == 'error') {
                    $('#game-form-alert').removeClass('alert-success').addClass('alert-danger').show().html(response.message);
                } else {
                    $('#article-form-alert').removeClass('alert-success').addClass('alert-danger').show().html("Oh uh.. Something went wrong!")
                }
            }
        });
        $('#add-game').html('Add Game');
        setTimeout(function () {
            $('#game-form-alert').fadeOut();
        }, 3000);
    });
    

})(jQuery);

// Function to add article to database
(function ($) {
    $('#article-form-alert').hide();

    // Add game form  submit
    $('#article-form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    $('#article-form-alert').removeClass('alert-danger').addClass('alert-success').show().html(response.message);
                    $('#article-form').find('input:not([type="submit"]),textarea').val('');
                    $('#artcile-game').prop('selectedIndex', 0);
                    $('#article-image-label').html('Choose Image');
                } else if (response.status == 'error') {
                    $('#article-form-alert').removeClass('alert-success').addClass('alert-danger').show().html(response.message);
                } else {
                    $('#article-form-alert').removeClass('alert-success').addClass('alert-danger').show().html("Oh uh.. Something went wrong!");
                }
            }
        });
        setTimeout(function () {
            $('#article-form-alert').fadeOut();
        }, 3000);
    });

})(jQuery);

// Edit article form
(function ($) {
    $('#edit-article-form-alert').hide();

    $('#edit-article-form').on('submit', (function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    alert(response.message);
                    window.location.href = 'articles.php';
                } else if (response.status == 'error') {
                    $('#edit-article-form-alert').removeClass('alert-success').addClass('alert-danger').show().html(response.message);
                    $('html, body').animate({
                        scrollTop: 0
                    }, '300');
                }
            }
        });
        setTimeout(function () {
            $('#edit-article-form-alert').fadeOut();
        }, 3000);
    }));

})(jQuery);

// Edit game form
(function ($) {
    $('#edit-game-form-alert').hide();

    $('#edit-game-form').on('submit', (function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    alert(response.message);
                    window.location.href = 'games.php';
                } else if (response.status == 'error') {
                    $('#edit-game-form-alert').removeClass('alert-success').addClass('alert-danger').show().html(response.message);
                    $('html, body').animate({
                        scrollTop: 0
                    }, '300');
                }
            }
        });
        setTimeout(function () {
            $('#edit-game-form-alert').fadeOut();
        }, 3000);
    }));

})(jQuery);

// Display latest article
(function ($) {

    $('#latest-news-image').click(function (e) {
        var id = $('#latest-article-id').html();
        window.location.href = 'article.php?id=' + id;
    });

})(jQuery);

// Datatables
(function ($) {

    // Datatable (Games)
    $(document).ready(function () {
        $('#dtGames').DataTable({
            "paging": false,
            "autoWidth": false
        });
        $('.dataTables_length').addClass('bs-select');
    });
    
    // Datatable (Articles)
    $(document).ready(function () {
        $('#dtArticles').DataTable({
            "paging": false,
            "autoWidth": false,
            "order": [[2, "desc"]]
        });
        $('.dataTables_length').addClass('bs-select');
    });
    
    // Datatable (Topic Requests)
    $(document).ready(function () {
        $('#dtTopicRequests').DataTable({
            "paging": true,
            "autoWidth": true,
            "lengthMenu": [1, 2, 3, 4, 5]
        });
        $('.dataTables_length').addClass('bs-select');
    });

    // Datatable search
    $("#searchbox").keyup(function () {
    $('#dtGames,#dtArticles').DataTable().search($(this).val()).draw();
    });
    
})(jQuery);

// Add topic
(function ($) {
    $('#topic-alert').hide();
    
    // Add topic form submit
    $('#topic-form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (response) {
                if (response.status == 'success') {
                    $('#topic-alert').removeClass('alert-danger').addClass('alert-success').show().html(response.message);
                    $('#topic-form').find('input:not([type="submit"]),textarea').val('');
                }
                else if (response.status == 'error') {
                     $('#topic-alert').removeClass('alert-success').addClass('alert-danger').show().html(response.message); 
                }
            }
        });
        setTimeout(function () {
            $('#topic-alert').fadeOut();
        }, 4000);
    });
})(jQuery);

// Add comment
(function ($) {
    // Add comment form submit
    $('#comment-form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (response) {
                if (response.status == 'success') {
                    window.location.href = response.location;
                }
            }
        });
    });
})(jQuery);

// Search for a topic functions
function searchTopic(){
    var searchQuery =  $('#search-topic-input').val().replace(" ", "+");
    window.location.href = `topics.php?search=${searchQuery}`;
    $('#search-topic-input').val('');
}

$('#search-topic-form').submit(function (e) {
    e.preventDefault();
    searchTopic();
});

// Chat
(function ($) {
    // Function that send a messgae
    $('#send-message').click(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $('#chat-form').attr('action'),
            data: $('#chat-form').serialize(),
            success: function (response) {
                if (response.status == 'success') {
                    $("#chat-messages").load(location.href + " #chat-messages");
                    $("#scroll-messages").animate({scrollTop: $("#scroll-messages")[0].scrollHeight});
                    $('#message').val('');
                }
            }
        });
    });
})(jQuery);

/*$( document ).ready(function() {
    $("#scroll-messages").animate({scrollTop: $("#scroll-messages")[0].scrollHeight});
});*/

setInterval(function(){ 
    $("#chat-messages").load(location.href + " #chat-messages");
}, 1500);

// Add post
(function ($) {
    // Add post form submit
    $('#post-form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (response) {
                if (response.status == 'success') {
                    $('#post-form').find('input:not([type="submit"])').val('');
                    $('#create-post-btn').attr('disabled', 'disabled');
                    $("#myModal").modal('hide');
                }
            }
        });
    });
})(jQuery);

$(document).ready(function() {
  $('#post-description').on('keyup', function() {
    let empty = false;

    $('#post-description').each(function() {
      empty = $(this).val().length == 0;
    });

    if (empty)
      $('#create-post-btn').attr('disabled', 'disabled');
    else
      $('#create-post-btn').attr('disabled', false);
  });
});

if($('#search-friends') == ''){
    $('#friend-list').show();
}

$(document).ready(function() {
    $('#search-friends').keyup(function(){
        $.ajax({
            url: 'php/actions/search_friends.php',
            type: 'post',
            data: {search: $(this).val()},
            success: function(response){
                $('#friends-search-result').html(response);
                $('#friend-list').hide();  
            }
        });
    });
});

setTimeout(function () {
    $('#topic-request-alert,#game-alert').fadeOut();
}, 3500);

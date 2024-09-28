import $ from 'jquery';

$('#show_password').on('change', function(){
    const isChecked = $(this).is(':checked');
    $('#password').attr('type', isChecked ? 'text' : 'password');
});

$('#registerForm').on('submit', function(e) {
    e.preventDefault();

    const form = document.getElementById('registerForm') as HTMLFormElement;
    const formData = new FormData(form);

    console.log(formData);

    $.ajax({
        url: '/register',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: (response: { status: number; message: string }) => {
            if (response.status === 201) {
                alert(response.message);
                window.location.href = '/login';
            } else {
                alert(response.message);
            }
        },
        error: (jqXHR) => {
            try {
                const errorResponse = JSON.parse(jqXHR.responseText);
                alert(errorResponse.message || 'Registration failed. Please try again.');
            } catch (e) {
                alert('Registration failed. Please try again.');
            }
        }
    });
});

$('#loginForm').on('submit', function(e) {
    e.preventDefault();

    const form = document.getElementById('loginForm') as HTMLFormElement;
    const formData = new FormData(form);

    $.ajax({
        url: '/login',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: (response: { status: number; message: string }) => {
            if (response.status === 200) {
                alert(response.message);
                window.location.href = '/home';
            } else {
                alert(response.message);
            }
        },
        error: (jqXHR) => {
            try {
                const errorResponse = JSON.parse(jqXHR.responseText);
                alert(errorResponse.message || 'Login failed. Please try again.');
            } catch (e) {
                alert('Login failed. Please try again.');
            }
        }
    });
});
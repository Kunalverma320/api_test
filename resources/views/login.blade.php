<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <form method="post" id="loginform">
            <span class="login-message" id="login-message"></span>
            <br><br>
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <span class="login-email" id="login-email"></span>

            <br><br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <span class="login-password" id="login-password"></span>

            <br><br>
            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#loginform').on('submit', function(e) {
                e.preventDefault();
                var email = $('#email').val();
                var password = $('#password').val();

                $.ajax({
                    type: "POST",
                    url: "http://127.0.0.1:8000/api/user/login",
                    data: {
                        email: email,
                        password: password
                    },
                    success: function(response) {

                        $('.login-message').text('');
                        $('.login-email').text('');
                        $('.login-password').text('');

                        if (response.status === 422) {
                            if (response.error.email) {
                                $('#login-email').text(response.error.email[0]);
                            }
                            if (response.error.password) {
                                $('#login-password').text(response.error.password[0]);
                            }
                        } else if (response.status === 200) {
                            localStorage.setItem('accessToken', response.accessToken);
                            $('.login-message').text('Login successful! Redirecting...');
                            setTimeout(function() {
                                window.location.href = "/dashboard";
                            }, 2000);
                        }else if(response.status==401)
                        {
                            $('.login-message').text(response.message);
                        }
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            });

            function fetchUserData() {
                var token = localStorage.getItem('accessToken');

                if (token) {
                    $.ajax({
                        type: "GET",
                        url: "http://127.0.0.1:8000/api/user",
                        headers: {
                            'Authorization': 'Bearer ' + token
                        },
                        success: function(response) {
                            console.log('User Data:', response);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error fetching user data:", error);
                        }
                    });
                } else {
                    console.log("No token found");
                }
            }

            fetchUserData();
        });
    </script>
</body>
</html>

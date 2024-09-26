<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>


    <p class="responsedata"></p>

    <p class="ajaxdataget"></p>

    <script>
        $(document).ready(function() {
            var token = localStorage.getItem('accessToken');
            $.ajax({
                type: "get",
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                url: "http://127.0.0.1:8000/api/user",
                success: function(response) {
                    var TextShow = $('.responsedata');
                    TextShow.text('');

                    if (Array.isArray(response)) {
                        response.forEach(function(element) {
                            console.log(element);
                            TextShow.append('<p>' + JSON.stringify(element) + '</p>');
                        });
                    } else {
                        console.log(response);
                        TextShow.append('<p>' + JSON.stringify(response) + '</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        });
    </script>






</body>

</html>

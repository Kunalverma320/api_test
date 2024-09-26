<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Get Api</title>
</head>
<body>


    <script>
    $(document).ready(function () {
        $.ajax({
            type: "get",
            url: "https://jsonplaceholder.typicode.com/todos/",
            success: function (response) {
                response.forEach(function(element){
                console.log(element);
              });
            }
        });
    });
    </script>



</body>
</html>

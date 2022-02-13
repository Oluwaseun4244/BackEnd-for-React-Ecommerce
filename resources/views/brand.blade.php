<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category</title>
</head>

<body>
    <div class="faq-form">
        <form method="POST">
            @csrf
            <h5>Brand</h5>
            <label for="">Brand Name</label><br>
            <input type="text" placeholder="Brand" name="brand"><br>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>

</html>

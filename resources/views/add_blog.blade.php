<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="app.css">
    <title>Add Blog</title>
</head>
<body>
    <div class="product-form">
        <form action="" enctype="multipart/form-data" method="POST">
            @csrf
            <label for="">Author's Name</label><br>
            <input type="text" name="author_name" required><br>
            <label for="">Blog Title</label><br>
            <input type="text" name="title" required><br>
            <label for="">Blog Details</label><br>
            <textarea name="blog_details" required  cols="30" rows="10"></textarea><br>
            
            <label for="">Blog Image</label><br>
            <input type="file" name="blog_image" required><br><br>
            <button type="submit">Submit</button>
        </form>
    </div> 
</body>
</html>
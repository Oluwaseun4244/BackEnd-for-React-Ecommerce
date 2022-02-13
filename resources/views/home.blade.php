<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="app.css">
    <title>Document</title>
</head>

<body>
    <div class="product-form">
        <form action="" enctype="multipart/form-data" method="POST">
            @csrf
            <label for="">Product Name</label><br>
            <input type="text" name="product_name" required><br>
            <label for="">Product Price</label><br><br>
            <input type="number" name="price" required><br>
            <label for="">Product Old Price</label><br>
            <input type="number" name="product_old_price" required><br>
            <label for="">Product Description</label><br>
            <input type="text" name="product_description" required><br>
            <label for="">Product Category</label><br>
            <select name="category">
                <option selected disabled>Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{$category->category}}">{{$category->category}}</option>

                @endforeach
        
            </select><br>
            <label for="">Brand</label><br>
            <select name="brand">
                <option selected disabled>Select Brand</option>
                @foreach ($brands as $brand)
                <option value="{{$brand->brand}}">{{$brand->brand}}</option>

            @endforeach
            </select><br>
            <label for="">Featured?</label><br>
            <select name="featured">
                <option value="No">No</option>
                <option value="Yes">Yes</option>
            </select><br>
            <label for="">Trending?</label><br>
            <select name="trending">
                <option value="No">No</option>
                <option value="Yes">Yes</option>
            </select><br>
            <label for="">Product Image1</label><br>
            <input type="file" name="product_image1" required><br>
            <label for="">Product Image2</label><br>
            <input type="file" name="product_image2" required><br>
            <label for="">Product Image3</label><br>
            <input type="file" name="product_image3" required><br>
            <label for="">Product Image4</label><br>
            <input type="file" name="product_image4" required><br><br>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>

</html>

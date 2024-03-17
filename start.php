<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-image: url("media/angel.jpg");
            background-repeat: no-repeat;
            background-size: min(100%, 900px); /* Set the width to 100% or 900px, whichever is smaller */
            background-position: center top; /* Center the background image horizontally and align it to the top vertically */
            background-color: black; /* Set the page color to dark blue */
            margin: 0; /* Remove default margin */
            height: 100vh; /* Full viewport height */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top: 30px; /* Add this line */
        }

        /* Style the file input to look like a button */
        #fileToUpload {
            display: none;
        }

        /* Style the label to look like a button */
        label[for="fileToUpload"] {
            display: inline-block;
            width: 230px;
            height: 227px;
            background-image: url("media/button.png");
            background-color: transparent;
            background-repeat: no-repeat;
            background-size: contain;
            cursor: pointer; /* Change the cursor to a hand when hovering over the button */
            padding: 20px;
        }


        /* Style the submit input to look like a button */
        input[type="submit"] {
    background-color: transparent;       
    background-image: url("media/submit.jpg");
    background-repeat: no-repeat;
    background-size: contain;
    border: none;
    width: 410px;
    height: 111px;
    cursor: pointer;
    appearance: none;
    margin: 0;
    -webkit-appearance: none; /* For Safari and older Chrome browsers */
    
}

        
    </style>
</head>
<body>

    <div class="container">
        <form action="uploader.php" method="post" enctype="multipart/form-data">
        <label for="fileToUpload" class="custom-file-upload"></label>
        <input type="file" name="fileToUpload" id="fileToUpload" style="display: none;">
        <br><input type="submit" value="" name="submit">
        </form>
    </div>
</body>
</html>
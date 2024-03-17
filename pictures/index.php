
<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache"); // for compatibility with HTTP/1.0
header("Expires: Thu, 01 Jan 1970 00:00:00 GMT"); // Date in the past
?>
<!DOCTYPE html>
<html>
<head>
    <title>Directory Contents Sorted by Date</title>
    <style>
        @keyframes drift {
            0% {
                body {
                    background-position: 0 0;
                }
            }
            100% {
                background-position: 100% 0;
            }
        }
        button {
                background-color: #72f32b; 
                display: block;
                margin: 0 auto; /* Add this line to center the button */
                padding: 10px 20px;
                border-radius: 25px; 
                font-size: 20px;
            }


        
        body {
            background-image: url('bg/bg.png');
            background-repeat: repeat;
            animation: drift 80s linear infinite;
        }

        img {
            width: 250px; /* Thumbnail size */
            height: auto;
        }
        
        li {
            padding: 20px; /* Add padding between files */
        }

        .file-info {
            font-size: 24px; /* Increase font size here */
        }
        
        .header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: rgba(47, 47, 47, .7); /* Example color: light grey */
  padding: 5px 45px 10px 45px;
  border-radius: 10px;
}

.header h1 {
  margin: 0 auto;
  color: #e5e5e5
}



        
    </style>

<script>
    function openLightbox(imageUrl) {
        // Create a lightbox element
        var lightbox = document.createElement('div');
        lightbox.id = 'lightbox';
        lightbox.style.background = 'rgba(0, 0, 0, 0.7)';
        lightbox.style.position = 'fixed';
        lightbox.style.top = '0';
        lightbox.style.left = '0';
        lightbox.style.width = '100%';
        lightbox.style.height = '100%';
        lightbox.style.display = 'flex';
        lightbox.style.justifyContent = 'center';
        lightbox.style.alignItems = 'center';

        // Create an image element inside the lightbox
        var image = document.createElement('img');
        image.src = imageUrl;
        image.style.width = 'auto'; // Allow width to adjust to height maintaining aspect ratio
        image.style.height = '80%'; // Set height to fill 80% of viewport height


        // Append the image to the lightbox
        lightbox.appendChild(image);

        // Append the lightbox to the body
        document.body.appendChild(lightbox);

        // Close the lightbox when clicked outside the image
        lightbox.addEventListener('click', function() {
            document.body.removeChild(lightbox);
        });
    }
    </script>

</head>
<body>
<div class="header">
  <!-- Button with Image -->
  <button onclick="openLightbox('bg/01.png')">
    <img src="bg/qr.png" alt="QR Icon" style="height: 20px; width: 20px; "> QR Code
  </button>
  <h1>Photo Uploads</h1>
  <button onclick="location.reload()"><img src="bg/reload.png" style="height: 20px; width: 20px; "> Reload Page</button>
</div>
</body>




    


       <?php
            date_default_timezone_set('America/Houston');
            $dir = dirname(__FILE__);
            $files = scandir($dir, SCANDIR_SORT_NONE); // Get files without sorting
            $file_times = [];

            foreach ($files as $file) {
                if ($file != "." && $file != ".." && preg_match("/\.(png|jpg|pdf|psd|webp|avif)$/", $file)) {
                    $filePath = $dir . DIRECTORY_SEPARATOR . $file;
                    $file_times[$file] = filemtime($filePath); // Store file times
                }
            }

            arsort($file_times); // Sort files by time, newest first

            foreach ($file_times as $file => $time) {
                // Convert timestamp to human-readable format
                $modTime = date("F d Y H:i:s", $time);
                echo "<li><a href='$file'><img src='$file' alt='Thumbnail'></a> <span class='file-info'>$modTime</span></li>";
            }
        ?>
    </ul>
</body>
</html>
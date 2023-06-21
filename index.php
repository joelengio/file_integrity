<?php
?>
<!DOCTYPE html>
<html>
<head>
  <title>File Upload</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>        
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
 

  <style>
    body {
      background-image: url("bg.jpg");
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center center;
  font-family: Arial, sans-serif;
      
    }

    .container {
      
      margin-top: 50px;
      margin-bottom: 50px;
      padding: 40px;
      background-color: #e10403;
      background-image: linear-gradient(45deg, #ffeeee, #fff6ea, #f7e9d7 , #ebd8c3);
      background-size: 400% 400%;
      animation: gradientAnimation 15s ease infinite;

      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    @keyframes gradientAnimation {
      0% {
        background-position: 0% 50%;
      }
      50% {
        background-position: 100% 50%;
      }
      100% {
        background-position: 0% 50%;
      }
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .header img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
    }

    .header h1 {
      font-size: 24px;
      color: #333333;
      margin-top: 10px;
    }

    h2 {
      text-align: center;
      color: #333333;
      margin-bottom: 20px;
    }

    
    .hidden {
      display: none;
    }
    #preview .dz-preview .dz-image img {

    height: 150px;
    object-fit: cover;
  }
   
    .file-upload {
      margin-top: 20px;
    }

    .file-upload label {
      display: block;
      font-size: 16px;
      font-weight: bold;
      color: #555555;
      margin-bottom: 10px;
    }

    .file-upload input[type="file"] {
      width: 100%;
      padding: 10px;
    }

    .file-desc {
      font-size: 14px;
      color: #888888;
      margin-top: 5px;
    }
    .dropzone {
        border: 2px dashed #cccccc;
        border-radius: 4px;
        min-height: 200px;
        background-color: #f9f9f9;
        text-align: center;
        padding: 20px;
        cursor: pointer;
      }
      .dropzone:hover {
        border-color: #167EC2;
      }
      .dropzone .dz-message {
        font-size: 18px;
        color: #555555;
      }

      .dropzone .dz-preview {
        margin: 10px;
        display: inline-block;
        opacity: 0;
        animation: fade-in 0.3s ease-in-out forwards;
      }

      @keyframes fade-in {
        from {
          opacity: 0;
        }
        to {
          opacity: 1;
        }
      }

      .dropzone .dz-preview .dz-image {
        border-radius: 4px;
        overflow: hidden;
      }

      .dropzone .dz-preview .dz-image img {
        width: 100%;
        height: auto;
        object-fit: cover;
      }

      .dropzone .dz-preview .dz-details {
        padding: 10px;
        background-color: #ffffff;
        border: 1px solid #cccccc;
        border-radius: 4px;
      }

      .dropzone .dz-preview .dz-remove {
        color: #555555;
        font-size: 20px;
        text-decoration: none;
        position: absolute;
        top: 10px;
        right: 10px;
      }

      .upload-button {
        text-align: center;
        margin-top: 20px;
      }

      .upload-button button {
        font-size: 18px;
        background-color: #167EC2;
        color: #ffffff;
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
      }

      .upload-button button:hover {
        background-color: #45a049;
      }

      .upload-success {
        text-align: center;
        margin-top: 20px;
      
      }

      .upload-success p {
        font-size: 18px;
        color: #4caf50;
      }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
        <img src="logo.png" alt="Company Logo">
        <h1><span style ="color:#C2A416">JABC</span><span style = "color:#167EC2">rypt</span></h1>
    </div>
    <h2>Check Integrity</h2>
    <form action="upload.php" class="dropzone" id="dropzoneFrom"></form>
    
   
    <div class="upload-button">
        
      <button type="button" class="btn btn-info" id="submit-all">Upload</button>
    </div>
    <br><br>
    <div id="preview"></div>
    <div class="upload-button">
    <button type="button" class="btn btn-info" onclick="window.location.href='integrity.html'">Check Integrity</button>

    </div>

    <div id="upload-success" class="hidden">
      <p>Upload successful!</p>
    </div>
    
   </div>
 
    
  
  

  <script>
    $(document).ready(function(){
 
 Dropzone.options.dropzoneFrom = {
  autoProcessQueue: false,
  
  init: function(){
   var submitButton = document.querySelector('#submit-all');
   myDropzone = this;
   submitButton.addEventListener("click", function(){
    myDropzone.processQueue();
   });
   this.on("complete", function(){
    if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
    {
     var _this = this;
     _this.removeAllFiles();
    }
    list_image();
   });
  },
 };

 list_image();

 function list_image()
 {
  $.ajax({
   url:"upload.php",
   success:function(data){
    $('#preview').html(data);
   }
  });
 }

 $(document).on('click', '.remove_image', function(){
  var name = $(this).attr('id');
  $.ajax({
   url:"upload.php",
   method:"POST",
   data:{name:name},
   success:function(data)
   {
    list_image();
   }
  })
 });
 
});

function showUploadSuccess() {
      var successDiv = document.getElementById("upload-success");
      successDiv.style.display = "block";
      successDiv.querySelector("p").textContent = "Upload successful!";
    }
  </script>
</body>
</html>

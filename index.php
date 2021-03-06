<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Upload Files</title>
    <?php include 'css/css.html'; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <style>
        html {}
        
        body {
            font-family: Roboto, sans-serif;
            color: #0f3c4b;
            background-color: #e5edf1;
            padding: 5rem 1.25rem;
            /* 80 20 */
        }
        
        .container {
            width: 100%;
            max-width: 680px;
            /* 800 */
            text-align: center;
            margin: 0 auto;
        }
        
        .container h1 {
            font-size: 42px;
            font-weight: 300;
            color: #0f3c4b;
            margin-bottom: 40px;
        }
        
        .container h1 a:hover,
        .container h1 a:focus {
            color: #39bfd3;
        }
        
        .container nav {
            margin-bottom: 40px;
        }
        
        .container nav a {
            border-bottom: 2px solid #c8dadf;
            display: inline-block;
            padding: 4px 8px;
            margin: 0 5px;
        }
        
        .container nav a.is-selected {
            font-weight: 700;
            color: #39bfd3;
            border-bottom-color: currentColor;
        }
        
        .container nav a:not( .is-selected):hover,
        .container nav a:not( .is-selected):focus {
            border-bottom-color: #0f3c4b;
        }
        
        .container footer {
            color: #92b0b3;
            margin-top: 40px;
        }
        
        .container footer p+p {
            margin-top: 1em;
        }
        
        .container footer a:hover,
        .container footer a:focus {
            color: #39bfd3;
        }
        
        .box {
            font-size: 1.25rem;
            /* 20 */
            background-color: #c8dadf;
            position: relative;
            padding: 100px 20px;
        }
        
        .box.has-advanced-upload {
            outline: 2px dashed #92b0b3;
            outline-offset: -10px;
            -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
            transition: outline-offset .15s ease-in-out, background-color .15s linear;
        }
        
        .box.is-dragover {
            outline-offset: -20px;
            outline-color: #c8dadf;
            background-color: #fff;
        }
        
        .box__dragndrop,
        .box__icon {
            display: block;
        }
        
        .box.has-advanced-upload .box__dragndrop {
            display: inline;
        }
        
        .box.has-advanced-upload .box__icon {
            width: 100%;
            height: 80px;
            fill: #92b0b3;
            display: block;
            margin-bottom: 40px;
        }
        
        .box.is-uploading .box__input,
        .box.is-success .box__input,
        .box.is-error .box__input {
            visibility: hidden;
        }
        
        .box__uploading,
        .box__success,
        .box__error {
            display: none;
        }
        
        .box.is-uploading .box__uploading,
        .box.is-success .box__success,
        .box.is-error .box__error {
            display: block;
            position: absolute;
            top: 50%;
            right: 0;
            left: 0;
            -webkit-transform: translateY( -50%);
            transform: translateY( -50%);
        }
        
        .box__uploading {
            font-style: italic;
        }
        
        .box__success {
            -webkit-animation: appear-from-inside .25s ease-in-out;
            animation: appear-from-inside .25s ease-in-out;
        }
        
        @-webkit-keyframes appear-from-inside {
            from {
                -webkit-transform: translateY( -50%) scale( 0);
            }
            75% {
                -webkit-transform: translateY( -50%) scale( 1.1);
            }
            to {
                -webkit-transform: translateY( -50%) scale( 1);
            }
        }
        
        @keyframes appear-from-inside {
            from {
                transform: translateY( -50%) scale( 0);
            }
            75% {
                transform: translateY( -50%) scale( 1.1);
            }
            to {
                transform: translateY( -50%) scale( 1);
            }
        }
        
        .box__restart {
            font-weight: 700;
        }
        
        .box__restart:focus,
        .box__restart:hover {
            color: #39bfd3;
        }
        
        .js .box__file {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }
        
        .js .box__file+label {
            max-width: 80%;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
            display: inline-block;
            overflow: hidden;
        }
        
        .js .box__file+label:hover strong,
        .box__file:focus+label strong,
        .box__file.has-focus+label strong {
            color: #39bfd3;
        }
        
        .js .box__file:focus+label,
        .js .box__file.has-focus+label {
            outline: 1px dotted #000;
            outline: -webkit-focus-ring-color auto 5px;
        }
        
        .js .box__file+label * {
            /* pointer-events: none; */
            /* in case of FastClick lib use */
        }
        
        .no-js .box__file+label {
            display: none;
        }
        
        .no-js .box__button {
            display: block;
        }
        
        .box__button {
            font-weight: 700;
            color: #e5edf1;
            background-color: #39bfd3;
            display: block;
            padding: 8px 16px;
            margin: 40px auto 0;
        }
        
        .box__button:hover,
        .box__button:focus {
            background-color: #0f3c4b;
        }
    </style>
    <script>
        (function(e, t, n) {
            var r = e.querySelectorAll("html")[0];
            r.className = r.className.replace(/(^|\s)no-js(\s|$)/, "$1js$2")
        })(document, window, 0);
    </script>
</head>

<body>
<div class="container" role="main">
    <form action="upload.php" method="POST" enctype="multipart/form-data" class="box">
    <div class="box__input">
        <p>Naming a file will be best if you stick with an exact naming convention such as season-yearofStyle-styleType</p>
                <svg class="box__icon" xmlns="http://www.w3.org/2000/svg" width="50" height="43" viewBox="0 0 50 43">
                        <path d="M48.4 26.5c-.9 0-1.7.7-1.7 1.7v11.6h-43.3v-11.6c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v13.2c0 .9.7 1.7 1.7 1.7h46.7c.9 0 1.7-.7 1.7-1.7v-13.2c0-1-.7-1.7-1.7-1.7zm-24.5 6.1c.3.3.8.5 1.2.5.4 0 .9-.2 1.2-.5l10-11.6c.7-.7.7-1.7 0-2.4s-1.7-.7-2.4 0l-7.1 8.3v-25.3c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v25.3l-7.1-8.3c-.7-.7-1.7-.7-2.4 0s-.7 1.7 0 2.4l10 11.6z"/>
                    </svg>
                     
                    <lable>
                        Name the File Do not add file type in name
                    </lable>

                    <input type="text" name="img_name" placeholder="season-yearofStyle-styleType">
                    <lable>
                        Style Category
                    </lable>

                    <input type="text" name="style_category" placeholder="Retro, Indie, ect.">
 <lable>
                        Where Style Was Found
                    </lable>

                    <input type="text" name="style_found" placeholder="vogue, GQ, Elle">
<lable>
                        When Image Was Added
                    </lable>

                    <input type="text" name="img_added" placeholder="MM-DD-YYYY">

                    
        <input type="file" name="file" class="box__file">
        <label for="file">
                        <strong>Choose a file</strong>
                        <span class="box__dragndrop">or drag it here</span>
                        .
                    </label>
        <button type="submit" name="submit" class="box__button">
            UPLOAD
        </button>
        </div>
    </form>
    </div>
    
</body>

</html>
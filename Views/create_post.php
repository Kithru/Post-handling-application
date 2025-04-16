<?php
session_start();

require_once "../Classes/Classes.php";

$classManager = new classmanager();
$status = '';
$userid = '';
if (isset($_REQUEST['title'])) {
    $title = $_REQUEST['title'];
}
if (isset($_REQUEST['body'])) {
    $body = $_REQUEST['body'];
}

$userid = $_SESSION['userid'];

if (isset($_POST["submit"])) {
   
    $status = $classManager->createpost($title ,$body ,$userid);
}

?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Create Post</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script type="text/javascript">
                $(document).ready(function () {
                    var status = $('#status').val();
                    if (status === 'added') {
                        alert('Post created successfully.');
                         status = '';
//                        window.location.href = "project01.php";
                        return false;
                    } else if (status === 'duplicate') {
                        alert('Post already exist.');
//                        window.location.href = "index.php";
                        return false;
                    }else if (status === 'failed') {
                        alert('Error in the process.');
//                        window.location.href = "index.php";
                        return false;
                    }
                });
                $(() => {
                    $('.form-group').each((i, e) => {
                    $('.form-control', e).
                    focus(function () {
                        e.classList.add('not-empty');
                    }).
                    blur(function () {
                        this.value === '' ? e.classList.remove('not-empty') : null;
                    });

                    });

              });
        </script>
        <style>
            * {box-sizing: border-box}

            .container {
            padding: 16px;
            width: 80%;
            }

            input[type=text], input[type=password] {
            width: 50%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
            }

            input[type=text]:focus, input[type=password]:focus {
            background-color: #ddd;
            outline: none;
            }

            hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
            }

            .registerbtn {
            background-color: #0d48f1;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 50%;
            opacity: 0.9;
            }

            .registerbtn:hover {
            opacity:1;
            }

            a {
            color: dodgerblue;
            }

            .signin {
            background-color: #f1f1f1;
            text-align: center;
            width: 50%;
            }

            .form__group {
            position: relative;
            padding: 15px 0 0;
            margin-top: 10px;
            width: 50%;
            }

            .form__field {
            font-family: inherit; 
            width: 100%;
            border: 0;
            border-bottom: 2px solid #9b9b9b;
            outline: 0;
            font-size: 1.3rem;
            color: #333; /* Ensure text is visible */
            padding: 7px 0;
            background: transparent;
            transition: border-color 0.2s;
            }

            .form__field::placeholder {
            color: transparent;
            }

            .form__field:placeholder-shown ~ .form__label {
            font-size: 1.3rem;
            cursor: text;
            top: 20px;
            }

            .form__label {
            position: absolute;
            top: 0;
            display: block;
            transition: 0.2s;
            font-size: 1rem;
            color: #9b9b9b;
            }

            .form__field:focus {
            padding-bottom: 6px;
            border-width: 3px;
            border-image: linear-gradient(to right, #0d48f1, #90bcff);
            border-image-slice: 1;
            }

            .form__field:focus ~ .form__label {
            position: absolute;
            top: 0;
            display: block;
            transition: 0.2s;
            font-size: 1rem;
            /* color: #11998e;   */
            color: #0d48f1;
            /* Remove or adjust font-weight here */
            }

            /* reset input */
            .form__field:required, .form__field:invalid {
            box-shadow: none;
            }

        </style>
    </head>
    <body>
        <input type="hidden" name="status" id="status" value="<?php echo $status; ?>">
        <div id="div_content" align="center">
            <div id="div_header">
                <?php include('header.php') ?>
            </div>
            <div id="div_body">
                <div id="div_body_content" align="center" >
                    <div class="container">
                    <form method="post" action="create_post.php" >
                        
                        <h1>Create Post</h1>
                        <div class="form__group field">
                            <!-- <label for="email" align="left" style="margin-right: 620px;" ><b>Title</b></label><br> -->
                            <input type="input" class="form__field" placeholder="Enter Title" name="title" id="title" required>
                            <label for="title" class="form__label">Title</label>
                        </div>
                        <div class="form__group field">
                            <!-- <label for="message" align="left" style="margin-right: 830px;"><b>Message</b></label> <br> -->
                            <textarea class="form__field" placeholder="Enter your message here" name="body" maxlength="500" id="body" rows="4" cols="50" required></textarea>
                            <label for="body" class="form__label">Body</label>
                        </div>
                        <div>      
                            <button type="submit" name="submit" class="registerbtn">Create Post</button>
                        </div>

                    </form>
                    </div>
                </div>
            </div>
            
            <div id="div_footer" align="center">
                <?php include('footer.php') ?>
            </div>
        </div>
    </body>
</html>

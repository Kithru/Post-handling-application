
<?php
require_once "../Classes/Classes.php";

$classManager = new classmanager();
$email = '';
$password = '';
$status = '';
if (isset($_REQUEST['email'])) {
    $email = $_REQUEST['email'];
}
if (isset($_REQUEST['password'])) {
    $password = $_REQUEST['password'];
}

if (isset($_POST["submit"])) {
  
  $status = $classManager->register($email,$password);
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Project 01</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 
        <script type="text/javascript">
          
            $(document).ready(function () {
                  var status = $('#status').val();
                  if (status === 'added') {
                      alert('Registered successfully.');
                      status = '';
                      return false;
                  } else if (status == 'duplicate') {
                      alert('User already exists.');
                      status = '';
                  } else if (status == 'failed') {
                      alert('Error in the process.');
                      status = '';
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
              width: 70%;
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
                    <form method="post" style="margin-top: 100px;" action="project03.php" >
                    <input type="hidden" name="status" id="status" value="<?php echo $status; ?>">
                        <h1>Please Register</h1>
                        <div class="form__group field">
                            <!-- <label for="email" align="left" style="margin-right: 830px;" ><b>Email Address</b></label><br> -->
                            <input type="input" class="form__field" placeholder="Enter Email" name="email" id="email" required>
                            <label for="email" class="form__label">Email Address</label>
                        </div>
                        <div class="form__group field">
                            <!-- <label for="psw" style="margin-right: 870px;"><b>Password</b></label> <br> -->
                            <input type="input" class="form__field" placeholder="Enter Password" name="password" id="password" required>
                            <label for="email" class="form__label">Password</label>
                        </div>
                        <div>      
                            <button type="submit" style="margin-top: 20px;" name="submit" class="registerbtn">Sign up</button>
                        </div>

                        <div class="container signin">
                          <p>Already have an account? <a href="project03login.php">Sign in</a>.</p>
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

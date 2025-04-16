<?php
require_once "../Classes/email.php";

$Mailmanager = new Mailmanager();
$status = '';
if (isset($_REQUEST['name'])) {
    $name = $_REQUEST['name'];
}
if (isset($_REQUEST['email'])) {
    $email = $_REQUEST['email'];
}
if (isset($_REQUEST['message'])) {
    $message = $_REQUEST['message'];
}
if (isset($_REQUEST['subject'])) {
    $subject = $_REQUEST['subject'];
}

if (isset($_POST["submit"])) {
  
  $status = $Mailmanager->mailer($name,$email,$message,$subject);
  if ($status == 'sent') {
    $emaildata = $Mailmanager->saveemail($name,$email,$message,$subject);
  }
}



?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Project 02</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script type="text/javascript">
              $(document).ready(function () {
                  var status = $('#status').val();
                    if (status == 'sent') {
                        alert('Email has been sent.');
                        return false;
                    } else if (status !== 'sent' && status !== '') {
                        alert('Error in Process. Status: ' + status);
                        return false;
                    }
              });
                function validateEmail() {
                    var emailField = document.getElementById("email");
                    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

                    if (!emailPattern.test(emailField.value)) {
                        alert("Please enter a valid email address.");
                        return false;
                    } 
                }

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
              width: 60%;
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



/* demo */
/* body {
  font-family: "Poppins", sans-serif;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  font-size: 1.5rem;
  background-color: #222222;
}          */
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
                    <form method="post" style="margin-top: 100px;" action="send_email.php" >
                        
                        <h1>Contact Us</h1>
                        <div class="form__group field">
                            <!-- <label type="input" class="form__field" align="left" style=" margin-right: 830px;" ><b>Name</b></label><br> -->
                            <input type="input" class="form__field" placeholder="Enter Name" name="name" id="name" required>
                            <label for="name" class="form__label">Name</label>
                        </div>
                        <div class="form__group field">
                            <!-- <label for="email" align="left" style=" margin-right: 830px;" ><b>Email</b></label><br> -->
                            <input type="input" class="form__field" placeholder="Enter Email" name="email" id="email" onchange="validateEmail()" required>
                            <label for="email" class="form__label">Email</label>
                        </div>
                        <div class="form__group field">
                            <!-- <label for="subject" align="left" style=" margin-right: 830px;" ><b>Subject</b></label><br> -->
                            <input type="input" class="form__field" placeholder="Enter Subject" maxlength="100" name="subject" id="subject" required>
                            <label for="subject" class="form__label">Subject</label>
                        </div>
                        <div class="form__group field">
                            <!-- <label for="message" align="left" style="margin-right: 830px;"><b>Message</b></label> <br> -->
                            <textarea class="form__field" placeholder="Enter your message here" name="message" maxlength="500" id="message" rows="4" cols="50" required></textarea>
                            <label for="message" class="form__label">Message</label>
                        </div>
                        <div>      
                            <button type="submit" style="margin-top: 20px;" name="submit" class="registerbtn">Send</button>
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

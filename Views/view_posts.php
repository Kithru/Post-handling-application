<?php
session_start();

require_once "../Classes/Classes.php";
$postarray = array ();
$classManager = new classmanager();
$status = '';
$userid = '';
$userid = $_SESSION['userid'];
$searchValue = isset($_GET['search']) ? trim($_GET['search']) : '';

if (!empty($searchValue)) {
    $postarray = $classManager->getposts($searchValue);
} else {
    $postarray = $classManager->getposts(null);
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
              
            $(document).ready(function() {
                $('input[type="radio"]').change(function() {
                    const ratingValue = $(this).val();
                    const postId = $(this).closest('.rating-stars').find('input[type="hidden"]').val(); 
                    updaterate(postId, ratingValue);
                });
                
                function updaterate(Id, ratingValue) {
                    $.ajax({
                        url: 'update_rates_ajax.php',
                        method: 'POST',
                        data: { 
                            id: Id, 
                            rating: ratingValue  
                        },
                        success: function(response) {
                            response = response.trim(); 
                            if (response == 'rateadded') { 
                                alert('Rating updated successfully.');
                            } else {
                                alert('Failed to update rating.');
                            }
                        },
                        error: function() {
                            alert('Error updating rating.');
                        }
                    });
                }
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
                display: inline-block; /* Keeps button in line with text */
                margin: 10px 0; 
                padding: 10px;
                border: none;
                background-color: #007bff;
                color: white;
                border-radius: 5px;
                cursor: pointer;
                margin-right : 520px; 
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
            color: #333; 
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
            color: #0d48f1;
            }

            .form__field:required, .form__field:invalid {
            box-shadow: none;
            }
            .custom-div {
                width: 620px;
                height: auto;
                padding: 10px;
                border: 1px solid gray;
                margin: 0;
                border-radius: 10px; 
                margin-top: 20px; 
            }
            .rating-stars {
                direction: rtl; /* This makes stars align from right to left */
                display: inline-block;
            }

            .rating-stars input[type="radio"] {
                display: none; /* Hide the radio buttons */
            }

            .rating-stars label {
                font-size: 2rem;
                color: #ccc; /* Default star color */
                cursor: pointer;
            }

            .rating-stars input[type="radio"]:checked ~ label {
                color: gold; /* Color of the selected star and all previous stars */
            }

            .rating-stars label:hover,
            .rating-stars label:hover ~ label {
                color: gold; /* Color of stars on hover */
            }
           
        </style>
    </head>
    <body>
        <input type="hidden" name="status" id="status" value="<?php echo $status; ?>">
        <div id="div_content" align="center">
            <div id="div_header">
                <?php include('header2.php') ?>
            </div>
            <div id="div_body">
                <div id="div_body_content" align="center"  >
                    <div class="container">
                    <form method="post" action="view_posts.php" >
                    <?php
                    $listSize = sizeof($postarray);
                    if ($listSize > 0) {
                    for ($i = 0; $i < $listSize; $i++) {
                        $posts = $postarray[$i];
                                        ?>
                    <div class="custom-div">
                        <h2 class="post-title" align="left"><?php echo htmlspecialchars($posts["title"]); ?></h2>
                        <p class="post-body" align="left"><?php echo htmlspecialchars($posts["body"]); ?></p>
                        <div class="rating-stars">
                            <input type="radio" value="5" name="rating<?php echo urlencode($posts['id']); ?>" id="rs1_<?php echo urlencode($posts['id']); ?>" <?php echo urlencode($posts['rate']) == 5 ? 'checked' : ''; ?>>
                            <label for="rs1_<?php echo urlencode($posts['id']); ?>">&#9733;</label>

                            <input type="radio" value="4" name="rating<?php echo urlencode($posts['id']); ?>" id="rs2_<?php echo urlencode($posts['id']); ?>" <?php echo urlencode($posts['rate']) == 4 ? 'checked' : ''; ?>>
                            <label for="rs2_<?php echo urlencode($posts['id']); ?>">&#9733;</label>

                            <input type="radio" value="3" name="rating<?php echo urlencode($posts['id']); ?>" id="rs3_<?php echo urlencode($posts['id']); ?>" <?php echo urlencode($posts['rate']) == 3 ? 'checked' : ''; ?>>
                            <label for="rs3_<?php echo urlencode($posts['id']); ?>">&#9733;</label>

                            <input type="radio" value="2" name="rating<?php echo urlencode($posts['id']); ?>" id="rs4_<?php echo urlencode($posts['id']); ?>" <?php echo urlencode($posts['rate']) == 2 ? 'checked' : ''; ?>>
                            <label for="rs4_<?php echo urlencode($posts['id']); ?>">&#9733;</label>

                            <input type="radio" value="1" name="rating<?php echo urlencode($posts['id']); ?>" id="rs5_<?php echo urlencode($posts['id']); ?>" <?php echo urlencode($posts['rate']) == 1 ? 'checked' : ''; ?>>
                            <label for="rs5_<?php echo urlencode($posts['id']); ?>">&#9733;</label>

                            <input type="hidden" name="ratingvalue_<?php echo urlencode($posts['id']); ?>" id="ratingvalue_<?php echo urlencode($posts['id']); ?>" value="<?php echo urlencode($posts['id']); ?>">
                        </div>

                        <button type="submit" align="left" name="submit" class="registerbtn"><a href="post.php?id=<?php echo urlencode($posts['id']); ?>" style="color: white; text-decoration: none;">More</a></button>
                    </div>
                    <?php }
                    } else {?>
                        <div align="center" style="width:775px;margin-top:10px;" class="message_label">
                            No Posts found.<br>
                        </div>
                    <?php }?>
                    </form>
                    </div>

                    
                    </div>
                </div>
            </div>
            
            <div id="div_footer" style="margin-top: auto;" align="center">
                <?php include('footer.php') ?>
            </div>
        </div>	 
    </body>
</html>

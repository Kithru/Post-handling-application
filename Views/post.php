
<?php
session_start();
if (empty($_SESSION['userid'])) {
    header("Location: project03login.php");
     exit();
}

require_once "../Classes/Classes.php";
$postarray = array ();
$ratearray = array ();
$userid = '';
$userid = $_SESSION['userid'];
$status = '';
$id = '';
$title = '';
$body = '';
$rate1 = 0;
$rate2 = 0;
$rate3 = 0;
$rate4 = 0;
$rate5 = 0;
$count1 = 0;
$count2 = 0;
$count3 = 0;
$count4 = 0;
$count5 = 0;
$roundedRate= 0;  
$totalrate= 0;  
$totalcount= 0; 
$rate= 0;
$classManager = new classmanager();
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
}
$array = $classManager->getpostdata($id);
$postarray = $classManager->getcomments($id,$userid);
$ratearray = $classManager->getrate($id);
$id = $array['id'];      
$title = $array['title']; 
$body = $array['body']; 
//print_r ($ratearray);

foreach ($ratearray as $entry) {
    $rate = $entry['rate'];
    switch ($rate) {
        case 1:
            $rate1++;
            break;
        case 2:
            $rate2++;
            break;
        case 3:
            $rate3++;
            break;
        case 4:
            $rate4++;
            break;
        case 5:
            $rate5++;
            break;
    }
}

$count1 = $rate1 * 1; 
$count2 = $rate2 * 2; 
$count3 = $rate3 * 3; 
$count4 = $rate4 * 4; 
$count5 = $rate5 * 5; 
$totalcount = $count1 + $count2 + $count3 + $count4 + $count5;
$totalrate = $rate1 + $rate2 + $rate3 + $rate4 + $rate5;
$rate = $totalcount / $totalrate ;
$roundedRate = ceil($rate);
?> 
<!DOCTYPE HTML>
<html>
    <head>
        <title>Create Post</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/themes/fontawesome-stars.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/jquery.barrating.min.js"></script>
    
        
        <script type="text/javascript">
//                 $(document).ready(function () {
//                     var status = $('#status').val();
//                     if (status === 'added') {
//                         alert('Comment created successfully.');
//                          status = '';
// //                        window.location.href = "project01.php";
//                         return false;
//                     } else if (status === 'failed') {
//                         alert('Error in the process.');
// //                        window.location.href = "index.php";
//                         return false;
//                     }
//                 });
                    function addcomment(id) {
                        var comment = $('#comment').val();
                        if (comment != '') {
                            $.ajax({
                            url: 'add_comment_ajax.php',
                            method: 'POST',
                            data: { id: id, comment: comment },
                            success: function(response) {
                                response = response.trim(); 
                                var message = '';
                                var messageClass = ''; 
                                if (response == 'commentadded') {
                                    alert ('Comment added successfully.');
                                    // message = 'Comment added successfully.';
                                    // messageClass = 'alert-success';
                                    $('#comment').val('');
                                    // $('#msg').html(message).removeClass('alert-success alert-danger').addClass(messageClass).show();
                                    
                                    return false; 
                                } else {
                                    message = 'Failed to add comment.';
                                    messageClass = 'alert-danger'; 
                                }
                                
                            },
                            
                            
                        });
                        }
                    }

                    function addcomment(id) {
                        var comment = $('#comment').val();
                        if (comment != '') {
                            $.ajax({
                            url: 'add_comment_ajax.php',
                            method: 'POST',
                            data: { id: id, comment: comment },
                            success: function(response) {
                                response = response.trim(); 
                                var message = '';
                                var messageClass = ''; 
                                if (response == 'commentadded') {
                                    alert ('Comment added successfully.');
                                    // message = 'Comment added successfully.';
                                    // messageClass = 'alert-success';
                                    $('#comment').val('');
                                    // $('#msg').html(message).removeClass('alert-success alert-danger').addClass(messageClass).show();
                                    
                                    return false; 
                                } else {
                                    message = 'Failed to add comment.';
                                    messageClass = 'alert-danger'; 
                                }
                                
                            },
                            
                            
                        });
                        }
                    }
                    function deletecomment(Id) {
                        if (confirm('Are you sure you want to delete this comment?')) {
                            $.ajax({
                                url: 'delete_comment_ajax.php',
                                method: 'POST',
                                data: { id: Id },
                                success: function(response) {
                                    response = response.trim(); 
                                    if (response == 'deleted') {
                                        alert('Comment deleted successfully.');
                                        return false;
                                    } else {
                                        alert('Failed to delete comment.');
                                    }
                                },
                                error: function() {
                                    alert('Error deleting comment.');
                                }
                            });
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
* {
    box-sizing: border-box;
}

.container {
    padding: 16px;
    width: 80%;
    max-width: 70%;
}
.custom-div {
    width: 100%; 
    padding: 15px;
    margin: 10px 0;
    border: 1px solid #ccc; 
    border-radius: 5px; 
    background-color: #f9f9f9; 
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.form__group {
    position: relative;
    padding: 15px 0 0;
    margin-top: 10px;
    width: 100%; 
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

.form__label {
    position: absolute;
    top: 0;
    display: block;
    transition: 0.2s;
    font-size: 1rem;
    color: #9b9b9b;
}

textarea.form__field {
    resize: vertical; 
    min-height: 100px;
}
.deletebtn{
    display: block; 
    width: 20%; 
    margin-top: 20px;
    padding: 10px;
    border: none;
    background-color: #ff2e2e;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
}
.deletebtn:hover {
    opacity: 1;
}
.registerbtn {
    display: block; 
    width: 100%; 
    margin-top: 20px;
    padding: 10px;
    border: none;
    background-color: #007bff;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
}

.registerbtn:hover {
    opacity: 1;
}

@media (max-width: 600px) {
    .container {
        width: 100%; 
        padding: 10px;
    }

    .custom-div,
    .form__group,
    .registerbtn {
        width: 100%; 
    }
    .registerbtn {
        font-size: 1rem; 
    }
    .deletebtn{
        width: 100%; 
    }
    .deletebtn{
        font-size: 1rem; 
    }
}
    .form__group {
    position: relative;
    padding: 15px 0 0;
    margin-top: 10px;
    width: 100%;
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
    #msg {
        display: none; /* Initially hide the message */
        padding: 10px;
        border-radius: 5px;
        margin-top: 20px;
        font-size: 1rem;
        font-weight: bold;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    .custom-div2 {
    position: relative;
    width: 70%; 
    padding: 15px;
    margin: 10px 0;
    border: 1px solid #ccc; 
    border-radius: 5px; 
    background-color: #f9f9f9; 
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 150px; 
}

.deletebtn {
    position: absolute;
    bottom: 10px;
    left: 10px; 
    background-color: #dc3545;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px;
    cursor: pointer;
    width: 10%; 
}

.deletebtn:hover {
    background-color: #c82333;
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
                <?php include('header.php') ?>
            </div>
            <div id="div_body">
                <div id="div_body_content" align="center" >
                    <div class="container">
                        <form method="post" action="post.php" >
                        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                            <div class="custom-div">
                                <h2 class="post-title" align="left"><?php echo htmlspecialchars($title); ?></h2>
                                <p class="post-body" align="left"><?php echo htmlspecialchars($body); ?></p>  
                                
                                <div class="rating-stars">
                                    <input type="radio" value="5" name="rating<?php echo $id; ?>" id="rs1_<?php echo $id; ?>" <?php echo $roundedRate == 5 ? 'checked' : ''; ?>>
                                    <label for="rs1_<?php echo $id; ?>">&#9733;</label>

                                    <input type="radio" value="4" name="rating<?php echo $id; ?>" id="rs2_<?php echo $id; ?>" <?php echo $roundedRate == 4 ? 'checked' : ''; ?>>
                                    <label for="rs2_<?php echo $id; ?>">&#9733;</label>

                                    <input type="radio" value="3" name="rating<?php echo $id; ?>" id="rs3_<?php echo $id; ?>" <?php echo $roundedRate == 3 ? 'checked' : ''; ?>>
                                    <label for="rs3_<?php echo $id; ?>">&#9733;</label>

                                    <input type="radio" value="2" name="rating<?php echo $id; ?>" id="rs4_<?php echo $id; ?>" <?php echo $roundedRate == 2 ? 'checked' : ''; ?>>
                                    <label for="rs4_<?php echo $id; ?>">&#9733;</label>

                                    <input type="radio" value="1" name="rating<?php echo $id; ?>" id="rs5_<?php echo $id; ?>" <?php echo $roundedRate == 1 ? 'checked' : ''; ?>>
                                    <label for="rs5_<?php echo $id; ?>">&#9733;</label>

                                    <input type="hidden" name="ratingvalue_<?php echo $id; ?>" id="ratingvalue_<?php echo $id; ?>" value="<?php echo $id; ?>">
                                </div>
                                
                            </div>
                            <div class="form__group field">
                                <textarea class="form__field" placeholder="Enter your message here" name="comment" maxlength="500" id="comment" rows="4" cols="50" required></textarea>
                                <label for="comment" class="form__label">Comment</label>
                            </div>
                            <div>      
                                <button type="submit" style="margin-top: 20px;" name="submit" onclick="addcomment('<?php echo $id; ?>')" class="registerbtn">Create Comment</button>
                            </div>
                            
                        </form>
                    </div>

                   

                    <?php
                    $listSize = sizeof($postarray);
                    if ($listSize > 0) {
                    for ($i = 0; $i < $listSize; $i++) {
                        $posts = $postarray[$i];
                                        ?>
                    <div class="custom-div2">
                        <h2 class="post-title" align="left"><?php echo htmlspecialchars($posts["email"]); ?></h2>
                        <p class="post-body" align="left"><?php echo htmlspecialchars($posts["comment"]); ?></p>
                        
                        <button type="button" align="left" name="submit" class="deletebtn" onclick="deletecomment('<?php echo $posts['id']; ?>')">Delete</button>
                    </div>
                    <?php }
                    } else { ?>
                    <div class="custom-div2">
                        <h2 class="post-title" align="left"><?php echo "No Comments"; ?></h2>
                        <p class="post-body" align="left"><?php echo "Comment for the post"; ?></p>
                        
                    </div>
                    <?php } ?>




                    </div>
                </div>
            </div>
            
            <div id="div_footer" style="margin-top: auto;" align="center">
                <?php include('footer.php') ?>
            </div>
        </div>

	 

    </body>
</html>


<html lang="en">
<head>
    <title>header</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link href="../rating_plugin/src/css/star-rating-svg.css" rel="stylesheet" type="text/css" />
</head>
<style>
    .header {
        overflow: hidden;
        background-color: #f1f1f1;
        padding: 20px 10px;
    }
    .header a {
        float: left;
        color: black;
        text-align: center;
        padding: 12px;
        text-decoration: none;
        font-size: 16px;
        line-height: 15px;
        border-radius: 4px;
    }
    .header a.logo {
        font-size: 25px;
        font-weight: bold;
    }
    .header a:hover {
        background-color: #ddd;
        color: black;
    }
    .header a.active {
        background-color: dodgerblue;
        color: white;
    }
    .header-right {
        float: right;
    }
    @media screen and (max-width: 500px) {
        .header a {
            float: none;
            display: block;
            text-align: left;
        }
        .header-right {
            float: none;
        }
    }
</style>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <?php
        // Get the current page filename
        $currentPage = basename($_SERVER['PHP_SELF']);
    ?>
    <div class="header">
        <a class="logo">KV</a>
        <div class="header-right">
            <a href="project03.php" class="<?php echo $currentPage == 'project03.php' ? 'active' : ''; ?>">Home</a>
            <a href="project03login.php" class="<?php echo $currentPage == 'project03login.php' ? 'active' : ''; ?>">Login</a>
            <a href="send_email.php" class="<?php echo $currentPage == 'send_email.php' ? 'active' : ''; ?>">Contact us</a>
            <a href="view_posts.php" class="<?php echo $currentPage == 'view_posts.php' ? 'active' : ''; ?>">Posts</a>
        </div>
    </div>
</body>
</html>

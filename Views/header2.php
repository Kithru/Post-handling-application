<?php
$searchValue = isset($_GET['search']) ? trim($_GET['search']) : '';
?>
<html lang="en">
<head>
    <title>header</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

body {
  font-family: Arial;
}
input[type=text] {
  width: 130px;
  height: 40px;
  margin-top: 0px;
  margin-left: 620px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-color: white;
  background-image: url('searchicon.png');
  background-position: 10px 10px; 
  background-repeat: no-repeat;
  padding: 12px 20px 12px 40px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
  width: 20%;
}
</style>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <?php
        // Get the current page filename
        $currentPage = basename($_SERVER['PHP_SELF']);
    ?>
    <div class="header">
        <a class="logo">KV</a>
        <form id="searchForm" method="GET" action="view_posts.php">
            <input type="text"  name="search"  placeholder="Search..." value="<?php echo !empty($searchValue) ? htmlspecialchars($searchValue) : ''; ?>" oninput="handleSearchChange(this)">

        <div class="header-right">
            <a href="project03.php" class="<?php echo $currentPage == 'project03.php' ? 'active' : ''; ?>">Home</a>
            <a href="project03login.php" class="<?php echo $currentPage == 'project03login.php' ? 'active' : ''; ?>">Login</a>
            <a href="send_email.php" class="<?php echo $currentPage == 'send_email.php' ? 'active' : ''; ?>">Contact us</a>
        </div>
            </form>
    </div>
    
    <script>
        function handleSearchChange(input) {
            const searchValue = input.value.trim();
            if (searchValue == '') {
                window.location.href = window.location.pathname;
            } 
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<?php
$name = $_POST['HeroName'];
$race = $_POST['Race'];
$class = $_POST['Class'];
$age = $_POST['Age'];
$gender = $_POST['Gender'];
$kingdom = $_POST['KingdomName'];
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>A made Adventurer</title>
        <!-- Custom fonts for this theme -->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

        <!-- Theme CSS -->
        <link href="../../../css/freelancer.min.css" rel="stylesheet" type="text/css"/>
        <style>
            img {
                height: 250px;
                padding: 3pt;
            }
            p {
                margin-left: 8px;
            }
        </style>
    </head>

    <body>
        <div id="CharacterSheet" class="container">
            <div class="row">
                <h3 class="Content">The Brave Adventurer</h3>
            </div>
            <div class="row">
                 <div class="col-md-3">
                    <p>
                        <b>Race:  </b>
                        <?php
                        print($race);
                        ?>
                    </p>
                    <p>
                        <b>Class:  </b>
                        <?php
                        print($class);
                        ?>
                    </p>
                    <p>
                        <b>Age:  </b>
                        <?php
                        print($age);
                        ?>
                    </p>
                    <p>
                        <b>Gender:  </b>
                        <?php
                        print($gender);
                        ?>
                    </p>
                    <p>
                        <b>Kingdom:  </b>
                        <?php
                        print($kingdom);
                        ?>
                    </p>
                </div>
                <div class="col-md-5">
                    <h3>
                        <?php
                        print($name);
                        ?>
                    </h3>
                </div>
                <div class="col-md-4">
                    <?php
                    //print image here
                    ?>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript -->
        <script src="../../../vendor/jquery/jquery.min.js" type="text/javascript"></script>
        <script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>

        <!-- Plugin JavaScript -->
        <script src="../../../vendor/jquery-easing/jquery.easing.min.js" type="text/javascript"></script>

        <!-- Contact Form JavaScript -->
        <script src="../../../js/jqBootstrapValidation.min.js" type="text/javascript"></script>
        <script src="../../../js/contact_me.min.js" type="text/javascript"></script>

        <!-- Custom scripts for this template -->
        <script src="../../../js/freelancer.min.js" type="text/javascript"></script>
    </body>
</html>

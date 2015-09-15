<?php
include("logic.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Brian Kestenholz - CSCI E-15 - Project 2</title>
    <!-- Bootstrap -->
    <link href="css/tooltip-viewport.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container-fluid">
    <!-- Main component for a primary marketing message or call to action -->
        <div class="img-responsive col-sm-offset-4 col-sm-4">
            <img class="featurette-image img-responsive center-block" src="img/logo-vocabpass.png" alt="Password Generator">
        </div>
        <?php echo $warning; ?>
        <div class="panel col-sm-offset-4 col-sm-4">
            <div class="panel-body">
                <strong>Generate a new password while expanding your vocabulary with VOCABPASS. This tool is a modified version of the <a href="http://xkcd.com/936/">XKCD Password Generator</a>. The XKCD password generator combines common words into a hard to decipher password.  The VOCABPASS tool also uses this concept but instead pulls from a large dictionary and provides the definitions below of each word.</strong>
            </div>
        </div>
        <?php echo $finalpassword; ?>
        <div class="container col-sm-offset-4 col-sm-4">
        <form action="index.php" method="post">
            <table class="table">
                <tbody>
                <tr>
                    <td>Number of Words</td>
                    <td>
                        <select class="form-control" name="wordcount">
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary tooltip-bottom"
                                title="Select the number of words that you would like in your password">?
                        </button>
                        <!-- <button id="tooltip1" type="button" title="This should be shifted to the left" class="btn btn-info pull-right tooltip-bottom">?</button>-->
                    </td>

                </tr>
                <tr>
                    <td>Special Character</td>
                    <td>
                        <select class="form-control" name="specialcharacter">
                            <option value="1">None</option>
                            <option value="2">!</option>
                            <option value="3">#</option>
                            <option value="4">?</option>
                            <option value="5">-</option>
                            <option value="6">@</option>
                        </select>
                    </td>
                    <td>
                        <button id="tooltip2" type="button" class="btn btn-primary tooltip-bottom" title="If you would like each word seperated by a special character please choose one">?</button>
                    </td>
                </tr>
                <tr>
                    <td>Numeric Prefix</td>
                    <td>
                        <select class="form-control" name="addnumericprefix">
                            <option value="1">No</option>
                            <option value="2">Yes</option>
                        </select>
                    </td>
                    <td>
                        <button id="tooltip3" type="button" class="btn btn-primary tooltip-bottom" title="This option will add a number prefix to the beginning of the password">?</button>
                    </td>
                </tr>
                <tr>
                    <td>Numeric Suffix</td>
                    <td>
                        <select class="form-control" name="addnumericsuffix">
                            <option value="1">No</option>
                            <option value="2">Yes</option>
                        </select>
                    </td>
                    <td>
                        <button id="tooltip4" type="button" class="btn btn-primary tooltip-bottom" title="This option will add a number suffix to the end of the password">?</button>
                    </td>
                </tr>
                <tr>
                    <td>Capitize First Letter:</td>
                    <td>
                        <select class="form-control" name="capitlizefirstletter">
                            <option value="1">No</option>
                            <option value="2">Yes</option>
                        </select>
                    </td>
                    <td>
                        <button id="tooltip5" type="button" class="btn btn-primary tooltip-bottom" title="This option will capitilize the first letter of each word in the password">?</button>
                    </td>
                </tr>
                </tbody>
            </table>
            <p>
                <button type="submit" class="btn btn-lg btn-primary btn-block">Get Your Password</button>
            </p>
        </form>
            </div>
        <!-- Build Definition Table  -->
        <?php echo $definitiontable; ?>
    </div>
<!-- /container -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/tooltip-viewport.js"></script>
</body>
</html>
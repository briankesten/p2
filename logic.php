<?php

//*****Variables that might need to be changed********//

//MYSQL Login Credentials
$mysqlserver = "127.0.0.1";
$mysqluser = "root";
$mysqlpassword = "secret";
$mysqldatabase = "wn_pro_mysql";

//Set final password vaiable. We will be using throughout the script
$finalpassword = "";

//Declare Definition Table
$definitiontable = "";

//Generice warning message if input validation fails.
$warningmessage = "<div class=\"alert alert-danger col-sm-offset-4 col-sm-4\" role=\"alert\"><strong>Error:</strong>Input validation error occured. Please submit form again</div>";
$warning = "";

//Array for special characters which matches form.  Do not want to allow form to pass special characters
$characters = [
    "1" => "",
    "2" => "!",
    "3" => "#",
    "4" => "?",
    "5" => "-",
    "6" => "@"
];

//Check if form was submitted Get POST Variables. Code idea from PHP Manual
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //validate input to ensure no spoofing is occuring
    if (input_validate()) {
    //form input validated. continue.....
//********************************************************
//******************MYSQL Query***************************
//********************************************************

// MySQL Connection
        $mysqli = new mysqli($mysqlserver, $mysqluser, $mysqlpassword, $mysqldatabase);

// Check if connection was successful
        if ($mysqli->connect_errno) {
            // MySQL Connection Failed
            echo "MySQL Connection Failed" . " " . $mysqli->connect_errno . " " . $mysqli->connect_error;
            exit;
        }

        $sql = "SELECT wn_synset.synset_id, wn_synset.word, wn_synset.ss_type, wn_gloss.gloss FROM wn_synset, wn_gloss WHERE wn_synset.synset_id = wn_gloss.synset_id ORDER BY rand() LIMIT $wordcount; ";

        if ($result = $mysqli->query($sql)) {

            //Define HTML Table To Show Definitions. Only echo if input is valid
            $definitiontable = "
                   <div class=\"page-header  col-sm-offset-4 col-sm-4\">
                      <h2>Definitions</h2>
                   </div>
                   <div class=\"container col-sm-offset-4 col-sm-4\">
                   <table class=\"table\">
                   <thead>
                   <tr>
                     <th>Word</th>
                     <th>Type</th>
                     <th>Definition</th>
                   </tr>
                   </thead>
                   <tbody>";

            foreach ($result as $value) {
                //Build Rows of Definitions
                $definitiontable  .=
                    "<tr>
                           <td>" . $value["word"] . "</td>
                           <td>" . $value["ss_type"] . "</td>
                           <td>" . $value["gloss"] . "</td>
                         </tr>";
               $vocabpass[] = $value["word"];
            }
            $result->close();

        }

//Close Definition Table
$definitiontable .= "
    </tbody>
    </table>
    </div>
";

//Function to build final password
password_builder($vocabpass,$specialcharacter, $addnumericprefix,$addnumericsuffix,$capitlizefirstletter);

    }
}


//**********************************************************************
//..........................Functions***********************************
//**********************************************************************
//validate input values to make sure no spoofing is occuring with the application
function input_validate()
{
    global $warning;
    global $warningmessage;

    //will use for integer for SQL Query if validation passes later in script
    global $wordcount;
    global $specialcharacter;
    global $addnumericprefix;
    global $addnumericsuffix;
    global $capitlizefirstletter;

    //SET $_POST Variables
    $wordcount = $_POST["wordcount"];
    $specialcharacter = $_POST["specialcharacter"];
    $addnumericprefix = $_POST["addnumericprefix"];
    $addnumericsuffix = $_POST["addnumericsuffix"];
    $capitlizefirstletter = $_POST["capitlizefirstletter"];

    //Validate input to make sure no spoofing is occuring
    if ((!is_integer($wordcount)) && (!$wordcount >= 3) && (!$wordcount <= 6)) {
        $warning = $warningmessage;
        return 0;
    } else if ((!is_integer($specialcharacter)) && (!$specialcharacter >= 1) && (!$specialcharacter <= 6)) {
        $warning = $warningmessage;
        return 0;
    } else if ((!is_integer($addnumericprefix)) && (!$addnumericprefix >= 1) && (!$addnumericprefix <= 2)) {
        $warning = $warningmessage;
        return 0;
    } else if ((!is_integer($addnumericsuffix)) && (!$addnumericsuffix >= 1) && (!$addnumericsuffix <= 2)) {
        $warning = $warningmessage;
        return 0;
    } else if ((!is_integer($capitlizefirstletter)) && (!$capitlizefirstletter >= 1) && (!$capitlizefirstletter <= 2)) {
        $warning = $warningmessage;
        return 0;
    } else {
        return 1;
    }
}

function password_builder($vocabpass,$specialcharacter, $addnumericprefix,$addnumericsuffix,$capitlizefirstletter)
{
    global $characters;
    global $finalpassword;
    $finalpassword ="";
    $randomnumber = rand(0,9);

    //Check if password should be prefixed wtih a numbeer. If true add a rand number from 1-9
    if($addnumericprefix == 2){
        $finalpassword .= $randomnumber;
    }

    //count the words in the VocabPass array
    $numitems = count($vocabpass);

    //loop through array
    for($i = 0; $i < $numitems ; ++$i) {

        if ($capitlizefirstletter == 2)
        {
            $finalpassword .= ucfirst($vocabpass[$i]);
        }
        else
        {
            $finalpassword .= $vocabpass[$i];
        }
        if ($i < ($numitems - 1))
        {
            $finalpassword .= $characters[$specialcharacter];
        }
    }

    //add the number suffix to the password if true
    if($addnumericsuffix == 2)
    {
        $finalpassword .= $randomnumber;
    }
    $finalpassword = "
        <div class=\"alert alert-success col-sm-offset-4 col-sm-4\" role=\"alert\">
                    <h3 class=\"text-center\"><strong>$finalpassword</strong></h3>
        </div>";
}
?>
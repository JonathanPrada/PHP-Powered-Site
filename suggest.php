<?php

//$_SERVER is an array with multiple elements in it
//if a request method of post is found then execute code
if($_SERVER["REQUEST_METHOD"] == "POST") {
    //the string inside the square brackets
    //corresponds to the name attribute
    //For example inside the form field used to capture name it is name
    //Using trim and filter input we sanitize all text accordingly
    $name = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
    $details = trim(filter_input(INPUT_POST, "details", FILTER_SANITIZE_SPECIAL_CHARS));

    //check that our fields are not empty
    if ($name == "" || $email == "" || $details == "") {
        echo "Please fill in the required fields: Name, Email and Details";
        exit;
    }

    //if our address field is not empty
    //then we caught ourselves a spam robot
    if($_POST["address"] != ""){
        echo "Bad form input";
        exit;
    }

    //Include PHPMailer from github here
    require("inc/phpmailer/class.phpmailer.php");
    //import the mail object
    $mail = new PHPMailer;
    //utilize the mail object validating method
    //-> accesses a method. We use this to validate an address
    if (!$mail->ValidateAddress($email)) { //if not true not valid
        echo "Invalid email address";
        exit;
    }

    $email_body = "";
    //.= means keep everything in the variable now
    //and add the following info to end of that value
    $email_body .= "Name ". $name . "\n";
    $email_body .= "Email ". $email . "\n";
    $email_body .= "Details". $details . "\n";
    echo $email_body;

    //This fills in the email content
    $mail->setFrom($email, $name); //from person who sent
    $mail->addAddress('email@here.com', 'John'); // Add a recipient
    $mail->isHTML(false); // Set email format to HTML, if false text

    $mail->Subject = 'Personal Media Library Suggestion from' . $name;
    $mail->Body = $email_body;

    //This sends the email
    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        exit; //if error then code
    }

    //redirects after submitting form to this page
    //but with a url status set to thanks
    header("location:suggest.php?status=thanks");
}

//When this page is loaded
//This variable can get used in another file
//if referenced before the include statement!
//therefore it is used in header.php
$pageTitle = "Suggest a media item";
$section = "suggest";
include("inc/header.php");

?>

<div class="section page">
    <div class="wrapper">
        <h1>Suggest a media item</h1>
        <!-- check status is set and if it equals thanks
        then render the below, else render the form -->
        <?php if(isset($_GET["status"]) && $_GET["status"] == "thanks") {
                    echo "<p>Thanks for the email: I&rsquo;ll check out your suggestion shortly!</p>";
            } else { ?>
        <p>If you think there is something i&rsquo;m missing, let me know! Complete the form to send me an email.</p>
        <!-- We use post method as it is more secure than get -->
        <!-- When user posts our form gets send to the action -->
        <form method="post" action="suggest.php">
            <!-- Use table when multiple fields -->
            <table>
            <!-- Each row will have two columns, one for label one for field -->
            <tr>
                <!-- for the label -->
                <th>
                    <!-- For use to relate to input id -->
                    <label for="name">Name:</label>
                </th>
                <!-- for the field -->
                <td>
                    <input type="text" id="name" name="name" />
                </td>
            </tr>
            <tr>
                <!-- for the label -->
                <th>
                    <!-- For use to relate to input id -->
                    <label for="email">Email:</label>
                </th>
                <!-- for the field -->
                <td>
                    <input type="text" id="email" name="email" />
                </td>
            </tr>
            <tr>
                <!-- for the label -->
                <th>
                    <!-- DROP DOWN BOX-->
                    <label for="category">Category:</label>
                </th>
                <!-- for the field -->
                <td>
                    <!-- DROP DOWN BOX-->
                    <select name="category" id="category">
                        <!-- DROP DOWN BOX OPTIONS-->
                        <option value="">Select One</option>
                        <option value="Books">Book</option>
                        <option value="Movies">Movie</option>
                        <option value="Music">Music</option>
                    </select>
                </td>
            </tr>
            <tr>
                <!-- for the label -->
                <th>
                    <!-- For use to relate to input id -->
                    <label for="title">Title:</label>
                </th>
                <!-- for the field -->
                <td>
                    <input type="text" id="title" name="title" />
                </td>
            </tr>
            <tr>
                <!-- for the label -->
                <th>
                    <!-- DROP DOWN BOX-->
                    <label for="format">Format:</label>
                </th>
                <!-- for the field -->
                <td>
                    <!-- DROP DOWN BOX-->
                    <select type="format" id="format">
                        <!-- DROP DOWN BOX OPTIONS BASED ON FORMAT-->
                        <option value="">Select One</option>
                        <optgroup label="Books">
                            <option value="Audio">Audio</option>
                            <option value="Ebook">Ebook</option>
                            <option value="Hardback">Hardback</option>
                            <option value="Paperback">Paperback</option>
                        </optgroup>
                        <optgroup label="Movies">
                            <option value="Blue-ray">Blue-ray</option>
                            <option value="DVD">DVD</option>
                            <option value="Streaming">Streaming</option>
                            <option value="VHS">VHS</option>
                        </optgroup>
                        <optgroup label="Music">
                            <option value="Casette">Casette</option>
                            <option value="CD">CD</option>
                            <option value="MP3">MP3</option>
                            <option value="Vinyl">Vinyl</option>
                        </optgroup>
                    </select>
                </td>
                <tr>
                <th><label for="format">Format</label></th>
                <td><select id="format" name="format">
                    <option value="">Select One</option>
                    <optgroup label="Books">
                        <option value="Audio">Audio</option>
                        <option value="Ebook">Ebook</option>
                        <option value="Hardback">Hardback</option>
                        <option value="Paperback">Paperback</option>
                    </optgroup>
                    <optgroup label="Movies">
                        <option value="Blu-ray">Blu-ray</option>
                        <option value="DVD">DVD</option>
                        <option value="Streaming">Streaming</option>
                        <option value="VHS">VHS</option>
                    </optgroup>
                    <optgroup label="Music">
                        <option value="Cassette">Cassette</option>
                        <option value="CD">CD</option>
                        <option value="MP3">MP3</option>
                        <option value="Vinyl">Vinyl</option>
                    </optgroup>
                </select></td>
            </tr>
            <tr>
                <th>
                    <label for="genre">Genre</label>
                </th>
                <td>
                    <select name="genre" id="genre">
                        <option value="">Select One</option>
                        <optgroup label="Books">
                            <option value="Action">Action</option>
                            <option value="Adventure">Adventure</option>
                            <option value="Comedy">Comedy</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="Historical">Historical</option>
                            <option value="Historical Fiction">Historical Fiction</option>
                            <option value="Horror">Horror</option>
                            <option value="Magical Realism">Magical Realism</option>
                            <option value="Mystery">Mystery</option>
                            <option value="Paranoid">Paranoid</option>
                            <option value="Philosophical">Philosophical</option>
                            <option value="Political">Political</option>
                            <option value="Romance">Romance</option>
                            <option value="Saga">Saga</option>
                            <option value="Satire">Satire</option>
                            <option value="Sci-Fi">Sci-Fi</option>
                            <option value="Tech">Tech</option>
                            <option value="Thriller">Thriller</option>
                            <option value="Urban">Urban</option>
                        </optgroup>
                        <optgroup label="Movies">
                            <option value="Action">Action</option>
                            <option value="Adventure">Adventure</option>
                            <option value="Animation">Animation</option>
                            <option value="Biography">Biography</option>
                            <option value="Comedy">Comedy</option>
                            <option value="Crime">Crime</option>
                            <option value="Documentary">Documentary</option>
                            <option value="Drama">Drama</option>
                            <option value="Family">Family</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="Film-Noir">Film-Noir</option>
                            <option value="History">History</option>
                            <option value="Horror">Horror</option>
                            <option value="Musical">Musical</option>
                            <option value="Mystery">Mystery</option>
                            <option value="Romance">Romance</option>
                            <option value="Sci-Fi">Sci-Fi</option>
                            <option value="Sport">Sport</option>
                            <option value="Thriller">Thriller</option>
                            <option value="War">War</option>
                            <option value="Western">Western</option>
                        </optgroup>
                        <optgroup label="Music">
                            <option value="Alternative">Alternative</option>
                            <option value="Blues">Blues</option>
                            <option value="Classical">Classical</option>
                            <option value="Country">Country</option>
                            <option value="Dance">Dance</option>
                            <option value="Easy Listening">Easy Listening</option>
                            <option value="Electronic">Electronic</option>
                            <option value="Folk">Folk</option>
                            <option value="Hip Hop/Rap">Hip Hop/Rap</option>
                            <option value="Inspirational/Gospel">Insirational/Gospel</option>
                            <option value="Jazz">Jazz</option>
                            <option value="Latin">Latin</option>
                            <option value="New Age">New Age</option>
                            <option value="Opera">Opera</option>
                            <option value="Pop">Pop</option>
                            <option value="R&B/Soul">R&amp;B/Soul</option>
                            <option value="Reggae">Reggae</option>
                            <option value="Rock">Rock</option>
                        </optgroup>
                    </select>
                </td>
            </tr>
            </tr>
            <tr>
                <!-- for the label -->
                <th>
                    <!-- For use to relate to input id -->
                    <label for="year">Year:</label>
                </th>
                <!-- for the field -->
                <td>
                    <input type="text" id="year" name="year" />
                </td>
            </tr>
            <tr>
                <!-- for the label -->
                <th>
                    <!-- For use to relate to input id -->
                    <label for="details">Suggest Item Details:</label>
                </th>
                <!-- for the field -->
                <td>
                    <textarea name="details" id="details"></textarea>
                </td>
            </tr>
            <!-- HONEYPOT TECHNIQUE AGAINST SPAM ATTACKS
            IT LOOKS REAL BUT ITS A TRAP, ITS HIDDEN BUT
            IF A ROBOT SPAMMER FILLS IN ITS TRAPPED-->
            <tr style="display:none">
                <!-- for the label -->
                <th>
                    <!-- For use to relate to input id -->
                    <label for="details">Address:</label>
                </th>
                <!-- for the field -->
                <td>
                    <textarea name="address" id="address"></textarea>
                </td>
                <p>Please leave this field blank</p>
            </tr>
            </table>
            <!-- include our button -->
            <input type="submit" value="Send" />
        </form>
        <?php } ?>
    </div>
    <h1><?php $pageTitle; ?></h1>
</div>

<?php include("inc/footer.php"); ?>

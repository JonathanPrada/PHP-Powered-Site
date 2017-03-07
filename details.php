<?php
/*We are going to add one more page to display the details for each item. We will grab the details of the specific item we choose. If we can't find the item specified, we redirect to the Catalog page.*/

include("inc/data.php");
include("inc/functions.php");

//If there is a value in the url /details.php?id=101
if (isset($_GET["id"])) {
    //assign that id to a variable
    $id = $_GET["id"];
    //if that id exists inside our catalog
    if(isset($catalog["id"])) {
        //then assign that item to a variable
        $item = $catalog[$id];
    }
}

//if item is not set
if(!isset($item)){
    //we redirect using header function
    //tell the browser to look for a different page
    header("location:catalog.php");
    //make sure nothing else is processed when redirecting
    exit;
}

//use the item title
$pageTitle = $item["title"];
$section = null;

include("inc/header.php");

?>

<div class="section page">

    <div class="wrapper">

        <div class="media-picture">

        <span>
        <img src="<?php echo $item["img"]; ?>" alt="<?php echo $item["title"]; ?>" />
        </span>

        </div>
    </div>
</div>

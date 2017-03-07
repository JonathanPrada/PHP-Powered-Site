<?php
//When this page is loaded
//This variable can get used in another file
//if referenced before the include statement!
//therefore it is used in header.php

include("inc/data.php");
include("inc/functions.php");

$pageTitle = "Full Catalog";
$section = null;


//If there is a value in cat assign pagetitle
if (isset($_GET["cat"])) {
    //set the correct page titles
    if ($_GET["cat"] == "books") {
        $pageTitle = "Books";
        $section = "books";
    } else if ($_GET["cat"] == "movies") {
        $pageTitle = "Movies";
        $section = "movies";
    } else if ($_GET["cat"] == "music") {
        $pageTitle = "Music";
        $section = "music";
    }
}

include("inc/header.php"); ?>

<div class="section catalog page">
    <div class="wrapper">
        <h1><?php
        //if our section is not null i.e. on books
        //add this next to our page title inside the h1 tag
        if ($section != null) {
            echo "<a href='catalog.php'>Full Catalog</a> &gt; ";
        }
        echo $pageTitle; ?></h1>

        <ul class="items">
            <?php
              //Select four items from catalog
              //Random becomes an array with items
              $categories = array_category($catalog, $section);

              //send each of the picked random items
              //to the get_item_html function
              //which builds the html and gets echo'd here
              foreach ($categories as $id) {
                echo get_item_html($id,$catalog[$id]);
            }
            ?>
        </ul>
    </div>
</div>

<?php include("inc/footer.php"); ?>
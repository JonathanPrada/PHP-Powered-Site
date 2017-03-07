<?php
/*We are going to add one more page to display the details for each item. We will grab the details of the specific item we choose. If we can't find the item specified, we redirect to the Catalog page.*/

include("inc/data.php");
include("inc/functions.php");

/*//If there is a value in the url /details.php?id=101
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
*/

//If there is a value in the url /details.php?id=101
if (isset($_GET["id"])) {
    //assign that id to a variable
    $id = $_GET["id"];
    //if that id exists inside our catalog
    if (isset($catalog[$id])) {
      //then assign that item to a variable
      $item = $catalog[$id];
    }
}

//if item is not set
if (!isset($item)) {
  //we redirect using header function
  //tell the browser to look for a different page
  header("location:catalog.php");
  exit;
}


//use the item title
$pageTitle = $item["title"];
$section = null;

include("inc/header.php");

?>

<div class="section page">

    <div class="wrapper">

        <div class="breadcrumbs">
            <a href="catalog.php">Full Catalog</a> &gt;
            <a href="catalog.php?cat=<?php echo strtolower($item["category"]); ?>"
            ><?php echo $item["category"]; ?> </a> &gt;
            <?php echo $item["title"]; ?>
        </div>

        <div class="media-picture">

        <span>
        <img src="<?php echo $item["img"]; ?>" alt="<?php echo $item["title"]; ?>" />
        </span>

        </div>

<div class ="media-details">
    <H1><?php echo $item['title']; ?></H1>

   <table>
    <tr>
      <th>Category</th>
      <td><?php echo $item["category"]; ?></td>
    </tr>
    <tr>
      <th>Genre</th>
      <td><?php echo $item["genre"]; ?></td>
    </tr>
    <tr>
      <th>Format</th>
      <td><?php echo $item["format"]; ?></td>
    </tr>
    <tr>
      <th>Year</th>
      <td><?php echo $item["year"]; ?></td>
    </tr>
    <?php
    //display base on category
    if (strtolower($item["category"]) == "books"){

    ?>
    <tr>
      <th>Authors</th>
      <!--Use implode to join multiple authors by comma -->
      <td><?php echo implode(" ,",$item["authors"]); ?></td>
    </tr>
    <tr>
      <th>Publisher</th>
      <td><?php echo $item["publisher"]; ?></td>
    </tr>
    <tr>
      <th>ISBN</th>
      <td><?php echo $item["isbn"]; ?></td>
    </tr>
      <?php } else if (strtolower($item["category"]) == "movies"){?>


    <tr>
      <th>Director</th>
      <td><?php echo $item["director"]; ?></td>
    </tr>
    <tr>
      <th>Writers</th>
      <td><?php echo implode(" ,",$item["writers"]); ?></td>
    </tr>
    <tr>
      <th>Stars</th>
      <td><?php echo implode(" ,",$item["stars"]); ?></td>
    </tr>
      <?php }

     else if (strtolower($item["category"]) == "music"){

    ?>
    <tr>
      <th>Artist</th>
      <td><?php echo $item["artist"]; ?></td>
    </tr>
    <?php } ?>
  </table>

  </div>
  </div>
</div>

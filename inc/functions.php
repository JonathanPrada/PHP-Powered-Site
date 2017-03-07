<?php

//gets passed parameters are iterated in a for loop at index.php
function get_item_html($id, $item) {
  $output = "<li><a href='#'><img src='"
          . $item["img"] ."' alt='"
          . $item["title"] ."'>"
          . "<p>View Details</p>"
          ."</a></li>";
  return $output;
}

//defines the array and category from array
//we want to return
function array_category($catalog, $category){
    //create empty array
    $output = array();

    //loop through array
    foreach ($catalog as $id => $item){
        //Make category and item["category"] both lower case
        //then do the comparison after they are lower case
        //if the condition is true and both match then do code
        //if category is passed as section = null
        if($category == null OR strtolower($category) == strtolower($item["category"])) {
            //get the item title
            $sort = $item["title"];
            //remove or trim any "the", "a" or "and"
            //from the beginning of sort
            //ltrim removes these starting from left
            $sort = ltrim($sort, "The ");
            $sort = ltrim($sort, "A ");
            $sort = ltrim($sort, "And ");

            //create array with the id ready
            //for that id add the item title
            $output[$id] = $sort;
        }
    }
    //sort alphabetically
    asort($output);
    //make sure to return only the keys
    return array_keys($output);
}

?>
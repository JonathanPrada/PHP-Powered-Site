	<?php
	$pageTitle = "Personal Media Library";
	$section = null;
	include("inc/header.php");
	include("inc/data.php");
	include("inc/functions.php");
	?>
		<div class="section catalog random">

			<div class="wrapper">

				<h2>May we suggest something?</h2>

				<ul class="items">
			        <?php
			          //Select four items from catalog
			          //Random becomes an array with items
			          $random = array_rand($catalog, 4);

			          //send each of the picked random items
			          //to the get_item_html function
			          //which builds the html and gets echo'd here
					  foreach ($random as $id) {
					    echo get_item_html($id,$catalog[$id]);
					}
			        ?>
				</ul>

			</div>

		</div>
	<?php include("inc/footer.php"); ?>

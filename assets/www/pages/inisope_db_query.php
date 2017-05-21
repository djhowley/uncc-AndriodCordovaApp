<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.css" rel="stylesheet" type="text/css" />
    <script src="http://ququplay.github.io/jquery-mobile-square-ui-theme/js/jquery.min.js"></script>
    <script src="http://ququplay.github.io/jquery-mobile-square-ui-theme/js/jqm.min.js"></script>
	
	<script src="http://localhost:8080/target/target-script-min.js#anonymous"></script>
	
	<!-- This menu button was taken from http://www.internetkultur.at/simple-hamburger-drop-down-menu-with-css-and-jquery/ Date Retrieved 1/11/2017-->
    <style>
        .menu-btn div {
            position: absolute;
            left: 100%;
            top: 64%;
            padding-right: 8px;
            margin-top: -0.50em;
            line-height: 1.2;
            font-size: 18px;
            font-weight: 200;
            vertical-align: middle;
            z-index: 99;
        }

        .menu-btn span {
            display: block;
            width: 19px;
            height: 3px;
            margin: 7px 0;
            background: rgb(0,0,0);
            z-index: 99;
        }

        .responsive-menu {
            display: none;
        }

        .expand {
            display: block;
        }
    </style>

</head>
<body>
	
	
<!--This code was derived from the PHP website here http://php.net/manual/en/function.str-getcsv.php. The author is unknown and all credit goes to php site-->
<?php
echo "<div id='page' data-role='page' data-theme='c'>
<div data-role='header' class='ui-content'>
		<a href='#myPanel' class='ui-btn ui-btn-inline ui-corner-all' style='text-decoration:none; font-size:18px; color:white'>&#9776;</a>
</div>
<div data-role='panel' id='myPanel'>
		<h2>Main Menu</h2>
		<ul>
				<li style='list-style:none; padding:5px'><a href='../index.html' rel='external'  data-transition='pop'>Home</a></li>
				<li style='list-style:none; padding:5px'><a href='../index.html#frm_datacollection' rel='external' data-transition='pop'>Update Directory</a></li>
				<li style='list-style:none; padding:5px'><a href='../pages/inisope_db_query.php?username=' rel='external' data-transition='pop'>Directory Listing</a></li>
		</ul>
</div>
	<div data-role='content'>
<form action='inisope_db_query.php'>
	<input type='text' id='myInput' onkeyup='myFunction()' placeholder='Search for names..' title='Type in a name'>
</form>
		<br />";

function csv2array( $filename, $delimiter )
{
    // read the CSV lines into a numerically indexed array
    $all_lines = @file( $filename );
    if( !$all_lines ) {
        return FALSE;
    }
    $csv = array_map( function( &$line ) use ( $delimiter ) {
        return str_getcsv( $line, $delimiter );
    }, $all_lines );

    // use the first row's values as keys for all other rows
    array_walk( $csv, function( &$a ) use ( $csv ) {
        $a = array_combine( $csv[0], $a );
    });
    array_shift( $csv ); // remove column header row

    return $csv;
}

$items = csv2array( 'cities.csv', ',' );
$i = 1;
		 echo "<br /><center><table id='myTable' style='postition:fixed; width:100%'>";
		 // output data of each row
       while($i < 99){
            echo "<div><tr><td><ul data-role='listview' style='display:inline-block; margin-left:0; height:70px; width:100%'>
						<li><a href='#Item_$i' data-transition='pop'>" . ( $items[$i]['FNAME'] ) . " " . ( $items[$i]['LNAME'] ) . "</a></li>
						</ul></td></tr></div>";
						$i++;
             }
             echo "</table></center></div>
			  <div data-role='footer' data-theme='a'>
            <h4>Daniel Howley &copy; 2017</h4>
        </div>
    		</div>
						 ";

?>
	
    <!--This script code is derived from w3schools and has been repurposed as a serach punction for the div pages in the directory list. http://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_filter_list
	All credit goes to w3 schools.-->

<script>
    function myFunction() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
            } else {
            tr[i].style.display = "none";
            }
        }
        }
    }
</script>
	
	<!--This code was derived from the PHP website here http://php.net/manual/en/function.str-getcsv.php. The author is unknown and all credit goes to php site-->
	<?php

function csvarray( $filename, $delimiter )
{
    // read the CSV lines into a numerically indexed array
    $all_lines = @file( $filename );
    if( !$all_lines ) {
        return FALSE;
    }
    $csv = array_map( function( &$line ) use ( $delimiter ) {
        return str_getcsv( $line, $delimiter );
    }, $all_lines );

    // use the first row's values as keys for all other rows
    array_walk( $csv, function( &$a ) use ( $csv ) {
        $a = array_combine( $csv[0], $a );
    });
    array_shift( $csv ); // remove column header row

    return $csv;
}

$list = csvarray( 'cities.csv', ',' );
	
$x = 0;
while($x < 99){
	$x++;
	echo "<div id='Item_$x' data-role='page' data-theme='b' data-add-back-btn='true'>
		<div data-role='header' data-theme='a'>
				<h1>Directory App</h1>
		</div>
		<div data-role='content'>
			  <h3>" . ( $list[$x]['FNAME'] ) . " " . ( $list[$x]['LNAME'] ) . "</h3>
				<center>
				<h5>" . ( $list[$x]['ADDRESS'] ) . "</h5>
				<iframe  style='width:50%; height:50%; border:0'
								frameborder='0'
								src='https://www.google.com/maps/embed/v1/place?key=AIzaSyBbCJu_psK9dAU6-grIqD8fF2vo0vcugto
								&q=".($list[$x]['ADDRESS'])."' allowfullscreen></iframe>
				</center>
		</div>
		<div data-role='footer' data-theme='a'>
				<h4>Daniel Howley &copy; 2017</h4>
		</div>
</div>";
	}
?>

	
	
	
	<!-- This function was taken from http://www.internetkultur.at/simple-hamburger-drop-down-menu-with-css-and-jquery/ Date Retrieved 1/11/2017-->
    <script type="text/javascript">
        jQuery(function ($) {
            $('.menu-btn').click(function () {
                $('.responsive-menu').toggleClass('expand')
            })
        })
    </script>
</body>
</html>
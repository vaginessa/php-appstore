<?php
/*

Copyright (c) 2013 Alan Beebe

Permission is hereby granted, free of charge, to any person obtaining a copy of this
software and associated documentation files (the "Software"), to deal in the Software
without restriction, including without limitation the rights to use, copy, modify, merge,
publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons
to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or
substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR
PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE
FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
DEALINGS IN THE SOFTWARE.

*/

	header('Content-Type: text/html; charset=UTF-8');

	// Set the timezone to Apples servers so the dates are correct
	date_default_timezone_set("America/Los_Angeles"); 

	// Includes
	include ("appstore.inc.php");
	
	// Set the APP ID we want to get reviews for
	$appID = $_GET["id"];
	if (strlen($appID) == 0) $appID = "577499909";
	
	// Set the country we want to get details for
	$country = $_GET["country"];
	if (strlen($country) == 0) $country = "US";
	
	// Download the most recent reviews
	$_APPSTORE = new APPSTORE($appID, $country);
	$arrReviews = $_APPSTORE->reviewsForPage(0);
	$appName = $_APPSTORE->appName();
	$appIcon = $_APPSTORE->appIcon();
	$appDeveloper = $_APPSTORE->appDeveloper();
	$appTotalStars = $_APPSTORE->appTotalStars();
	$appTotalRatings = $_APPSTORE->appTotalRatings();
	$appCurrentStars = $_APPSTORE->appCurrentStars();
	$appCurrentRatings = $_APPSTORE->appCurrentRatings();
	$appCategoryName = $_APPSTORE->appCategoryName();
	$appCategoryID = $_APPSTORE->appCategoryID();
	$appRankCategory = $_APPSTORE->appRankCategory();
	$appRankCategoryGrossing = $_APPSTORE->appRankCategoryGrossing();
	 
	$appName = htmlentities($appName);
	$appDeveloper = htmlentities($appDeveloper);
?>
<HTML>
	<HEAD>
		<TITLE><?= $appName; ?></TITLE>
		<meta name="viewport" content="user-scalable=0, initial-scale=1.0" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="apple-mobile-web-app-capable" content="yes">
		<STYLE media="screen" type="text/css">

			body {
				margin: 0px;
				font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
			}
			
			div.app-header {
				padding: 15px; 
				background-color: #f5f5f5;
			}
			
			div.app-header-shadow {
				height: 4px;
				background: -moz-linear-gradient(top,  rgba(0,0,0,0.65) 0%, rgba(0,0,0,0) 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0.65)), color-stop(100%,rgba(0,0,0,0))); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(top,  rgba(0,0,0,0.65) 0%,rgba(0,0,0,0) 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(top,  rgba(0,0,0,0.65) 0%,rgba(0,0,0,0) 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(top,  rgba(0,0,0,0.65) 0%,rgba(0,0,0,0) 100%); /* IE10+ */
				background: linear-gradient(to bottom,  rgba(0,0,0,0.65) 0%,rgba(0,0,0,0) 100%); /* W3C */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6000000', endColorstr='#00000000',GradientType=0 ); /* IE6-9 */
			}
			
			img.app-icon {
				width: 77px;
				height: 77px;
				border-radius: 15px;
				-webkit-border-radius: 15px;
				-moz-border-radius: 15px;
			}
			
			div.app-title {
				color: #3d3d3d;
				font-size: 13px;
				font-weight: bold;
				text-shadow: 0px 1px #ffffff;
			}
			
			div.app-developer {
				color: #646464;
				font-size: 13px;
				text-shadow: 0px 1px #ffffff;
			}
			
			div.app-rating {
				margin-top: 10px;
				color: #6a6a6a;
				font-weight: bold;
				font-size: 11px;
			}
			
			div.app-rankings {
				margin-top: 10px;
				color: #646464;
				font-size: 11px;
				text-shadow: 0px 1px #ffffff;
			}
			
			span.app-ranking-value {
				color: #6a6a6a;
				font-weight: bold;
				font-size: 11px;
			}
			
			div.comment-box {	
				position: relative;
			}
			
			div.comment-box-odd {
				padding: 15px;
				background-color: #ebebeb;
			}
			
			div.comment-box-even {
				padding: 15px;
				background-color: #f5f5f5;
			}
			
			div.comment-box-title {
				color: #4c4c4c;
				font-size: 13;
				font-weight: bold;
				margin-bottom: 10px;
				text-shadow: 0px 1px #ffffff;
			}
			
			div.comment-box-details {
				color: #4c4c4c;
				font-size: 12;
				text-shadow: 0px 1px #ffffff;
			}
			
			div.comment-box-review {
				color: #4c4c4c;
				font-size: 13;
				margin-top: 10px;
				text-shadow: 0px 1px #ffffff;
			}
			
			img.star-full {
				width: 12px;
				height: 13px;
				vertical-align:text-bottom;
				margin-right: 1px;
			}
			
			img.star-empty {
				width: 12px;
				height: 13px;
				vertical-align: text-bottom;
				margin-right: 1px;
			}
			
			img.star-full-small {
				width: 12px;
				height: 13px;
				vertical-align:text-bottom;
				margin-right: 1px;
			}
			
			img.star-half-small {
				width: 12px;
				height: 13px;
				vertical-align: text-bottom;
				margin-right: 1px;
			}
			
			img.star-empty-small {
				width: 12px;
				height: 13px;
				vertical-align: text-bottom;
				margin-right: 1px;
			}
			
			div.version {
				color: #b0b0b0;
				font-size: 13;
				font-weight: 700;
				position: absolute;
				top: 5px;
				right: 5px;
				text-shadow: 0px 1px #ffffff;
			}
			
			a.comment-box-author {
				text-decoration: none;
				color: #4c4c4c;
			}
			
		</STYLE>
	</HEAD>
	<BODY>
		<DIV class="app-header">
			<TABLE WIDTH="100%" cellpadding="0" cellspacing="0">
				<TR>
					<TD VALIGN="top" ALIGN="center" WIDTH="77">
						<IMG class="app-icon" src="<?= $appIcon; ?>">
					</TD>
					<TD WIDTH="10"></TD>
					<TD VALIGN="top">
						<DIV class="app-title"><?= $appName; ?></DIV>
						<DIV class="app-developer"><?= $appDeveloper; ?></DIV>
						<DIV class="app-rating"><?= htmlForStars($appCurrentStars, true); ?> (<?= number_format($appCurrentRatings); ?>)</DIV>
						<DIV class="app-rankings"><?= $appCategoryName; ?> <SPAN class="app-ranking-value">#<?= $appRankCategory; ?></SPAN>,  Grossing <SPAN class="app-ranking-value">#<?= $appRankCategoryGrossing; ?></SPAN></DIV>
					</TD>
				</TR>
			</TABLE>
		</DIV>
		<DIV class="app-header-shadow"></DIV>
	
<?php
for ($x = 0; $x < sizeof($arrReviews); $x++) {
	$review = $arrReviews[$x];
	if ($x % 2 == 0) {
		$boxType = "comment-box-even";
	} else {
		$boxType = "comment-box-odd";
	}
	$commentNumber = $x + 1;
	$reviewComment = str_replace("\n", "<BR>", htmlentities($review["review"]));
	$reviewUserName = htmlentities($review["user_name"]);
	$reviewUserNameEncoded = urlencode($review["user_name"]);
	$htmlStars = htmlForStars($review["stars"]);
	
$HTML = <<<HTML
	<DIV CLASS="comment-box">
		<DIV CLASS="version">
			v{$review["version"]}
		</DIV>
		<DIV CLASS="{$boxType}">
			<DIV CLASS="comment-box-title">
				{$commentNumber}. {$review["title"]}
			</DIV>
			<DIV CLASS="comment-box-details">
				{$htmlStars} by <a class="comment-box-author" href="example_user.php?id={$review["user_id"]}&username={$reviewUserNameEncoded}">{$reviewUserName}</a> - {$review["date_string"]}
			</DIV>
			<DIV CLASS="comment-box-review">
				{$reviewComment}
			</DIV>		
		</DIV>
	</DIV>
	<DIV STYLE="height: 1px; background-color: #d2d2d2"></DIV>
	<DIV STYLE="height: 1px; background-color: #ffffff"></DIV>
HTML;

print $HTML;

}


function htmlForStars($stars, $isSmall = false) {
	$html = "";
	$hasHalfStar = (floor($stars) == $stars) ? false : true;
	$stars = floor($stars);
	if ($isSmall) $small = "-small";
	for ($x = 0; $x < 5; $x++) {
		if ($x < $stars) {
			$html .= '<IMG class="star-full'.$small.'" SRC="star_full.png">';
		} else {
			if ($hasHalfStar) {
				$hasHalfStar = false;
				$html .= '<IMG class="star-half'.$small.'" SRC="star_half.png">';
			} else {
				$html .= '<IMG class="star-empty'.$small.'" SRC="star_empty.png">';
			}
		}
	}
	return $html;
}

	
?>
	</BODY>
</HTML>

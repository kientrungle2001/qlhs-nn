<?php
/*******************************************************************************
*  Title: PHP click counter (CCount)
*  Version: 2.0.1 from 4th August 2014
*  Author: Klemen Stirn
*  Website: http://www.phpjunkyard.com
********************************************************************************
*  COPYRIGHT NOTICE
*  Copyright 2004-2014 Klemen Stirn. All Rights Reserved.

*  This script may be used and modified free of charge by anyone
*  AS LONG AS COPYRIGHT NOTICES AND ALL THE COMMENTS REMAIN INTACT.
*  By using this code you agree to indemnify Klemen Stirn from any
*  liability that might arise from it's use.

*  Selling the code for this program, in part or full, without prior
*  written consent is expressly forbidden.

*  Using this code, in part or full, to create derivate work,
*  new scripts or products is expressly forbidden. Obtain permission
*  before redistributing this software over the Internet or in
*  any other medium. In all cases copyright and header must remain intact.
*  This Copyright is in full effect in any country that has International
*  Trade Agreements with the United States of America or
*  with the European Union.

*  Removing any of the copyright notices without purchasing a license
*  is expressly forbidden. To remove copyright notice you must purchase
*  a license for this script. For more information on how to obtain
*  a license please visit the page below:
*  http://www.phpjunkyard.com/buy.php
*******************************************************************************/

define('IN_SCRIPT',1);
define('THIS_PAGE', 'INSTRUCTIONS');

// Require the settings file
require '../ccount_settings.php';

// Load functions
require '../inc/common.inc.php';

// Start session
pj_session_start();

// Are we logged in?
pj_isLoggedIn(true);

// Require admin header
require 'admin_header.inc.php';
?>

<?php pj_processMessages(); ?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Counting clicks on links</h3>
			</div>
			<div class="panel-body">
				<p>To count clicks on a link (for example to fin out how many times a file has been downloaded), follow these steps:</p>

<ol>
<li>Determine which link you wish to count clicks on, for example:<br />
<code>http://example.com/myFile.zip</code><br />&nbsp;</li>
<li>Open the <a href="new_link.php" class="text-center"><i class="glyphicon glyphicon-plus"></i>&nbsp;New link</a> page and submit your chosen link as a new link.<br />&nbsp;<br />
In our example, you would enter <code>http://example.com/myFile.zip</code> as the <b>Link URL</b>.<br />&nbsp;</li>
<li>When a link is submitted, a special <i>tracking URL</i> is generated by CCount. For example:<br />
<code>http://example.com/ccount/click.php?id=<b>123</b></code><br />&nbsp;</li>
<li>To count clicks, use the generated tracking URL in your website instead of the original link.<br />&nbsp;</li>
<li>Then, when a visitor clicks<br />
<code>http://example.com/ccount/click.php?id=<b>123</b></code><br />
CCount will count the click and redirect the visitor to the destination page:<br />
<code>http://example.com/myFile.zip</code><br />&nbsp;<br />&nbsp;Simple, but effective!</li>
</ol>

			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Displaying click count on your website</h3>
			</div>
			<div class="panel-body">
				<p>You can always view click statistics in CCount admin pages. However, you can also display link count publicly:</p>

<ol>
<li>Place the following code in the head of the web page (between <code>&lt;head&gt;</code> and <code>&lt;/head&gt;</code> tags), where you wish to display count statistics:<br />&nbsp;<br />
<?php
if ( isset($_SERVER['HTTP_HOST']) && isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/admin/instructions.php') !== false )
{
	$url = 'http://' . $_SERVER['HTTP_HOST'] . str_replace('/admin/instructions.php', '/display.php', $_SERVER['REQUEST_URI']);
}
else
{
	$url = 'http://example.com/ccount/display.php';
}
?>
<code>&lt;script src=&quot;<?php echo $url; ?>&quot;&gt;&lt;/script&gt;</code>
<?php
if ($url == 'http://example.com/ccount/display.php')
{
	echo "<br />&nbsp;<br />(change <code>http://example.com/ccount/display.php</code> to the URL of <code>display.php</code> on your server)";
}
?><br />&nbsp;</li>
<li>Place the following code in your web page exactly where you want the count to appear:<br />&nbsp;<br />
<code>&lt;script&gt;ccount_display('<b>LINK_ID</b>')&lt;/script&gt;</code>
<br />&nbsp;<br />Replace <code>LINK_ID</code> with the actual link ID. In the first example generated ID was <b>123</b>, so the actual code to display count would be:<br />&nbsp;<br />
<code>&lt;script&gt;ccount_display('<b>123</b>')&lt;/script&gt;</code><br />&nbsp;<br />
To show <i>unique</i> clicks, use this code this code instead:<br />&nbsp;<br />
<code>&lt;script&gt;ccount_<b>unique</b>('LINK_ID')&lt;/script&gt;</code></li>
</ol>

			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-md-6 col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Enjoy using CCount?</h3>
			</div>
			<div class="panel-body">
				<p>You are invited to rate CCount or even write a short review here:</p>
				<p><a href="http://www.hotscripts.com/listing/php-click-counter/" target="_blank"><i class="glyphicon glyphicon-globe"></i>&nbsp;Rate this Script @ Hot Scripts</a></p>
				<p><a href="http://php.resourceindex.com/rate?05375" target="_blank"><i class="glyphicon glyphicon-globe"></i>&nbsp;Rate this Script @ PHP Resource index</a></p>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-lg-6">
		 <div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Stay updated</h3>
			</div>
			<div class="panel-body">
				<p>Want to stay up-to-date with news from PHP Junkyard?</p>
				<p>Join my free newsletter. Low volume. No SPAM.</p>
				<p><a href="http://www.phpjunkyard.com/support/newsletter.php" target="_blank"><i class="glyphicon glyphicon-globe"></i>&nbsp;Join Newsletter</a></p>
			</div>
		</div>
	</div>
</div>

<?php

// Get footer
include('admin_footer.inc.php');

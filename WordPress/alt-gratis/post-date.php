<?php
/*
* post date used in content.php, content-archives.php, content-search.php and content-home.php
*/
?>
<div class="post-date" itemprop="datePublished" content="<?php echo get_the_date('c'); ?>">
	
	<div class="date-mnth"><?php echo get_the_date('M'); ?></div>
	<div class="date-day"><?php echo get_the_date('d'); ?></div>
	<div class="date-yr"><?php echo get_the_date('Y'); ?></div>
	
</div><!-- /alignright post-date -->
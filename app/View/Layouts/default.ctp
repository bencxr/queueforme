<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'Queue for me: Instant Queue Management at the Point-of-Entry');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($cakeDescription, '/'); ?></h1>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
        <div id="footer">
            <?php  if(isset($user['fullname'])) { ?>
                    Logged in as <?php echo $user['username']; ?>.  
                <div style="float:right; background:white">
                    <?php if (($GLOBALS["SiteMode"]=="Merchant") && (isset($user["merchant_id"]))) { ?>
                        <?php echo $this->Html->link("merchant settings", array("controller" => "merchants", "action" => "edit", $user["merchant_id"])); ?>
                    <?php } ?>
                    <?php echo $this->Html->link("logout", array("controller" => "users", "action" => "logout")); ?> 
                </div>
            <?php } ?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>

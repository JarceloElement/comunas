<!-- <div class="card-header" data-background-color="gray">
	<h4 class="title">Datos necesarios para el registro de indicadores</h4>
</div> -->




<?php if ($_GET["type"] == 1){?>
	<?php include "core/app/view/internet_type.php"; ?>
<?php } ?>


<?php if ($_GET["type"] == 2){?>
	<?php include "core/app/view/operative_type.php"; ?>
<?php } ?>

<?php if ($_GET["type"] == 3){?>
	<?php include "core/app/view/status_type.php"; ?>
<?php } ?>


<?php if ($_GET["type"] == 4){?>
	<?php include "core/app/view/action_line.php"; ?>
<?php } ?>

<?php if ($_GET["type"] == 5){?>
	<?php include "core/app/view/coord_type.php"; ?>
<?php } ?>

<?php if ($_GET["type"] == 6){?>
	<?php include "core/app/view/responsible_type.php"; ?>
<?php } ?>

<?php if ($_GET["type"] == 7){?>
	<?php include "core/app/view/user_type.php"; ?>
<?php } ?>

<?php if ($_GET["type"] == 8){?>
	<?php include "core/app/view/report_date_limit.php"; ?>
<?php } ?>

<?php if ($_GET["type"] == 9){?>
	<?php include "core/app/view/products_category.php"; ?>
<?php } ?>

<?php if ($_GET["type"] == 10){?>
	<?php include "core/app/view/strategic_action.php"; ?>
<?php } ?>

<?php if ($_GET["type"] == 11){?>
	<?php include "core/app/view/products_type.php"; ?>
<?php } ?>
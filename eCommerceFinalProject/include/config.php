<?php
declare(strict_types=1);

/*
 * eCommerceFinalProject config.php
 * 
 * @author Ying-Shan Liang (Celine Liang)
 * @since 2023-04-29
 * (c) Copyright 2023 Ying-Shan Liang 
 */

$conn = mysqli_connect('localhost', 'root', '', 'commerce_final_project') or die('connection failed');
$conn->query("SET @@auto_increment_increment=1");
?>
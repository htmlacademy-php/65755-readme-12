<?php
require_once 'config/db.php';

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
mysqli_set_charset($link, "utf8");

$content_types = [];

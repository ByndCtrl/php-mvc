<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= URL_ROOT; ?>/css/style.css">
    <title><?= (isset($title)) ? SITE_NAME . ' | ' . $title : SITE_NAME . ' | ' . ucwords($_GET['url']); ?></title>
</head>
<body>


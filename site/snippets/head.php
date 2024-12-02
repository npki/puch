<!doctype html>
<html lang="de">
  <head>
    <title><?= $site->title() ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php snippet('meta_information'); ?>
    <?php snippet('robots'); ?>

    <meta name="msapplication-TileColor" content="#000000">
    <meta name="theme-color" content="#000000">

    <link rel="icon" type="image/png" sizes="32x32" href="<?= $site->url('') ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $site->url('') ?>/favicon.png">
    
    <?= css(['assets/css/base.css', '@auto']) ?>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>      
      :root {
        --poster-color: <?= $site->postercolor() ?>;        
      }
    </style>

</head>
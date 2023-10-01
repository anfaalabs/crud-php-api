<?php

require __DIR__ . "/../apps/index.php";

$metatag = (object) [
  /**
   * Title/judul dari setiap halaman web nya
   * 
   * @example
   * ``
   * $title = "Hello World!"; // title dari halaman tsb: "Hello World"
   * ``
   */
  "title" => isset($meta->title) ? $meta->title : "Kampusku Apps",

  /**
   * deskripsi dari setiap halaman, ini bisa dibuat berbeda dengan membuat 
   * variabel $description disetiap halaman yang mau dibedakan deskripsinya
   */
  "description" => isset($meta->description) ? $meta->description : "Kampusku Apps adalah aplikasi website untuk manajemen data mahasiswa pada suatu kampus",

  /**
   * URL dari halamannya
   */
  "url" => isset($meta->url) ? $meta->url : "https://github.com/anfaalabs/crud-php-api",


  /**
   * Opengraph Image untuk setiap halaman
   */
  "image" => isset($meta->image) ? $meta->image : "https://opengraph.githubassets.com/d4bf315c357a40f96879143f91b4264669746d61026e0f122ed3c4ce45c6eb50/anfaalabs/crud-php-api",
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Meta Tags Generated with https://metatags.io -->

  <!-- Primary Meta Tags -->
  <title><?= $metatag->title; ?></title>
  <meta name="title" content="<?= $metatag->title; ?>" />
  <meta name="description" content="<?= $metatag->description; ?>" />

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website" />
  <meta property="og:url" content="<?= $metatag->url; ?>" />
  <meta property="og:title" content="<?= $metatag->title; ?>" />
  <meta property="og:description" content="<?= $metatag->description; ?>" />
  <meta property="og:image" content="<?= $metatag->image; ?>" />

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image" />
  <meta property="twitter:url" content="<?= $metatag->url; ?>" />
  <meta property="twitter:title" content="<?= $metatag->title; ?>" />
  <meta property="twitter:description" content="<?= $metatag->description; ?>" />
  <meta property="twitter:image" content="<?= $metatag->image; ?>" />


  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary mb-4">
    <div class="container-fluid py-2 px-4">
      <a class="navbar-brand" href="<?= base_url(); ?>">
        <img src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
        B-Kampus
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url(); ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">GitHub</a>
          </li>
        </ul>
      </div>

    </div>
  </nav>
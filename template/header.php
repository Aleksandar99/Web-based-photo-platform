<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Галерия</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0 shadow-sm">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 bg-light" href="<?= url() ?>">
    <img src="<?= url('img/logo.jpg') ?>" alt="logo">
  </a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
          aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</header>
<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-5">
        <ul class="nav flex-column">
          <li class="nav-item m-auto">
            <a class="btn btn-outline-primary" aria-current="page" href="<?= url() ?>">
              <span data-feather="plus"></span>
              Нова галерия
            </a>
          </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span><span data-feather="camera" class="me-2"></span>Галерии</span>
        </h6>
        <ul class="nav flex-column">
			<?php if ($gallery): ?>
				<?php
				$galleries = $gallery->getGalleries();
				sort($galleries); ?>
				<?php foreach ($galleries as $gallery_name): ?>
          <li class="nav-item ms-3">
            <a class="nav-link" href="<?= url('preview.php?gallery=' . $gallery_name) ?>">
              <span data-feather="image"></span>
            <?= $gallery_name . ' (' . $gallery->countImages($gallery_name) . ')' ?>
            </a>
          </li>
				<?php endforeach ?>
			<?php endif ?>
        </ul>
      </div>
    </nav>

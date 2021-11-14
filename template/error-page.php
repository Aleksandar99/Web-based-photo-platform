<?php session_start() ?>
<main class="col-md-9 ms-sm-auto col-lg-9 px-md-4 py-md-3">
	<?php $flash = flash('error'); ?>
	<?php if (!empty($flash)): ?>
    <div class="alert alert-danger my-5">
      <h4>Грешка:</h4>
    <?php foreach ($flash as $error): ?>
      <ul>
        <li><?= $error ?></li>
      </ul>
    <?php endforeach ?>
    </div>
	<?php endif ?>
</main>

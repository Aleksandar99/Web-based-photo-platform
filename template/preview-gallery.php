<main class="col-md-9 ms-sm-auto col-lg-9 px-md-4">
	<div class="d-flex justify-content-between align-items-center">
		<h4 class="mb-3 my-3"><span class="text-secondary">Галерия </span> <?= $galleryName ?></h4>
		<button id="rmgallery" class="btn btn-sm btn-danger" data-gallery="<?= $galleryName ?>">
			<span data-feather="trash"></span>
		</button>
	</div>
	<hr>
	<div class="row my-3">
		<div class="col-12">
			<?php if($galleryName !=='' && $gallery->galleryExist($galleryName)): ?>
				<form id="galleryForm" class="needs-validation" novalidate action="new-gallery.php" method="post"
					  enctype="multipart/form-data">
					<input type="hidden" name="add-gallery" value="<?= $galleryName ?>">
					<div class="mb-3">
						<label for="exampleFormControlTextarea1" class="form-label">
							Добавете снимки към галерията
						</label>
						<input type="file" name="files[]" class="form-control" id="files" multiple required>
						<div class="invalid-feedback" id="errorMsg">
							няма избрани снимки
						</div>
					</div>
					<div>
						<button type="submit" class="btn btn-primary">
							<span data-feather="plus"></span>добави</button>
					</div>
				</form>
				<hr>
			<?php endif ?>
		</div>
	</div>
	<div class="row">
		<?php if ($galleryName !=='' && $gallery->galleryExist($galleryName)): ?>
			<?php foreach ($gallery->getImages() as $file): ?>
				<div class="col-12 col-sm-6 col-md-3">
					<div class="card my-4 equalize shadow" style="min-height: 360px">
						<a href="<?= url($file['img_path']) ?>" target="_blank">
							<img src="<?= $file['thumbs'] ?>" class="card-img-top" alt="thumb"
								 data-bs-toggle="tooltip" data-bs-placement="top"
								 title="<?= $file['img_name'] . ' (' . $file['info'][0] . 'x' . $file['info'][1] . ')' ?>"
							>
						</a>
						<div class="card-body position-relative">
              <p class="card-text">
				        <?= $file['img_name'] . ' (' . $file['info'][0] . 'x' . $file['info'][1] . ')' ?>
              </p>
              <div class="text-end position-absolute" style="bottom:10px; right:20px">
                <button class="del-btn ms-3 btn btn-danger btn-sm"
                        data-gallery="<?= $galleryName ?>" data-image="<?= $file['img_name'] ?>">
                  <span data-feather="trash-2"></span>
                </button>
              </div>
            </div>
					</div>
				</div>
			<?php endforeach ?>
		<?php else: ?>
			<div class="alert alert-danger my-5">
				<h5 class="mb-3">
					Не съществува галерия с име <?= $galleryName ?>
				</h5>
				<div>
					<a href="<?= url() ?>" class="btn btn-outline-primary btn-sm">нова галерия</a>
				</div>
			</div>
		<?php endif ?>
	</div>
</main>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
		integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE"
		crossorigin="anonymous"></script>
<script src="assets/js/app.js"></script>

<script>
    $( document ).ready(function() {
        var maxHeight = 0;
        $(".equalize").each(function () {
            if ($(this).height() > maxHeight) {
                maxHeight = $(this).height();
            }
        });

        $(".equalize").each(function () {
            $(".equalize").height(maxHeight);
        });
    });

    (function () {
        'use strict'
        feather.replace({'aria-hidden': 'true'});

        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })

    })()

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    $('.del-btn').on('click', function(e){

        let filename = $(this).data('image');
        let gallery = $(this).data('gallery');
        const button = $(this);

        if(confirm("Тази снимка ще бъде изтрита!")){
            $.ajax({
                method: 'post',
                url:'delete-image.php',
                data:{file:filename, gallery:gallery}
            }).done(function(result){
                let res = JSON.parse(result);
                if(res.s === 'success'){
                    button.closest('.card').hide();
                }
            })
        }

    });

    $("#rmgallery").on('click', function(){
        const gallery = $(this).data('gallery');
        if(confirm('Галерията ще бъде изрита!')){
            $.ajax({
                method: 'post',
                url: 'delete-gallery.php',
                data: {gallery: gallery}
            }).done(function(result){
                window.location.href = "<?= url() ?>";
            })
        }
    })

</script>

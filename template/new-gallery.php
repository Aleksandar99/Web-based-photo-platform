<main class="col-md-9 ms-sm-auto col-lg-9 px-md-4">
	<h3 class="mb-3 mt-3">Нова галерия</h3>
	<hr>
	<form id="galleryForm" class="needs-validation" novalidate action="new-gallery.php" method="post"
		  enctype="multipart/form-data">
		<div class="mb-3">
			<label for="gallery" class="form-label">Име на галерията</label>
			<input type="text" name="gallery" class="form-control" id="gallery"
				   placeholder="Въведете име на новата галерия" required>
			<div class="invalid-feedback">
				Въведете име на новата галерия
			</div>
		</div>
		<div class="mb-3">
			<label for="files" class="form-label">Изберете файлове от компютъра</label>
			<input type="file" name="files[]" class="form-control" id="files" multiple required>
			<div class="invalid-feedback" id="errorMsg"></div>
		</div>
		<div>
			<button type="submit" class="btn btn-primary">създай</button>
		</div>
	</form>
</main>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE"
        crossorigin="anonymous"></script>
<script src="assets/js/app.js"></script>
<script>

    (function () {
        'use strict'
        feather.replace({'aria-hidden': 'true'})

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

</script>

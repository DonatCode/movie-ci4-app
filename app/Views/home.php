<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<h2 class="mb-4 fw-bold">
    🔥 Popular Movies
</h2>

<div class="row" id="movie-container">

<?php foreach($movies as $movie): ?>

<div class="col-md-3 mb-4">

    <div class="card movie-card h-100">

        <img src="https://image.tmdb.org/t/p/w500<?= $movie['poster_path']; ?>"
             class="card-img-top">

        <div class="card-body">

            <h5 class="movie-title">
                <?= $movie['title']; ?>
            </h5>

            <p class="rating">
                ⭐ <?= $movie['vote_average']; ?>
            </p>

            <a href="/detail/<?= $movie['id']; ?>"
               class="btn btn-netflix w-100">

               View Detail

            </a>

            <a href="/favorite/<?= $movie['id']; ?>"
   class="btn btn-warning w-100 mt-2">

   ❤ Favorite

</a>

        </div>

    </div>

</div>

<?php endforeach; ?>

</div>

<div class="d-flex justify-content-center mt-4 mb-5">

    <?php if($currentPage > 1): ?>

    <a href="/page/<?= $currentPage - 1; ?>"
       class="btn btn-secondary me-2">

       Previous

    </a>

    <?php endif; ?>

    <a href="/page/<?= $currentPage + 1; ?>"
       class="btn btn-netflix">

       Next

    </a>

</div>

<?= $this->endSection(); ?>
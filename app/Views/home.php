<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<h2 class="section-title">
    Popular Movies
</h2>

<div class="row" id="movie-container">

<?php foreach($movies as $movie): ?>

<div class="col-6 col-md-4 col-lg-3 mb-4">

    <div class="card movie-card h-100">

        <img src="https://image.tmdb.org/t/p/w500<?= $movie['poster_path']; ?>"
             class="card-img-top">

        <div class="card-body">

            <h5 class="movie-title">
                <?= $movie['title']; ?>
            </h5>

            <p class="rating">
                Rating: <?= $movie['vote_average']; ?>/10
            </p>

            <a href="/detail/<?= $movie['id']; ?>"
               class="btn btn-netflix w-100 mb-2">

               View Details

            </a>

            <a href="/favorite/<?= $movie['id']; ?>"
               class="btn btn-dark w-100 border border-secondary">

               + My List

            </a>

        </div>

    </div>

</div>

<?php endforeach; ?>

</div>

<div class="d-flex justify-content-center mt-4 mb-5">

    <?php if($currentPage > 1): ?>

    <a href="/page/<?= $currentPage - 1; ?>"
       class="btn btn-dark border border-secondary me-2">

       Previous

    </a>

    <?php endif; ?>

    <a href="/page/<?= $currentPage + 1; ?>"
       class="btn btn-netflix">

       Next

    </a>

</div>

<?= $this->endSection(); ?>
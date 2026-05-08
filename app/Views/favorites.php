<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<h2 class="mb-4 fw-bold">
    ❤ Favorite Movies
</h2>

<div class="row">

<?php foreach($movies as $movie): ?>

<div class="col-md-3 mb-4">

    <div class="card movie-card h-100">

        <img src="https://image.tmdb.org/t/p/w500<?= $movie['poster']; ?>"
             class="card-img-top">

        <div class="card-body">

            <h5 class="movie-title">
                <?= $movie['title']; ?>
            </h5>

            <p class="rating">
                ⭐ <?= $movie['rating']; ?>
            </p>

            <a href="/detail/<?= $movie['movie_id']; ?>"
            class="btn btn-netflix w-100 mb-2">

            🎬 Detail

            </a>

            <a href="/deleteFavorite/<?= $movie['id']; ?>"
            class="btn btn-danger w-100">

            🗑 Delete

            </a>

        </div>

    </div>

</div>

<?php endforeach; ?>

</div>

<?= $this->endSection(); ?>
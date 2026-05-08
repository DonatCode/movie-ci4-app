<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="row align-items-center">

    <div class="col-md-4 mb-4">

        <img src="https://image.tmdb.org/t/p/w500<?= $movie['poster_path']; ?>"
             class="img-fluid rounded shadow">

    </div>

    <div class="col-md-8">

        <h1 class="fw-bold mb-3">
            <?= $movie['title']; ?>
        </h1>

        <p class="rating">
            ⭐ <?= $movie['vote_average']; ?>
        </p>

        <p>
            <strong>Release Date:</strong>
            <?= $movie['release_date']; ?>
        </p>

        <p>
            <?= $movie['overview']; ?>
        </p>

        <?php if(isset($movie['videos']['results'][0])): ?>

<div class="ratio ratio-16x9 mt-4 mb-4">

    <iframe
        src="https://www.youtube.com/embed/<?= $movie['videos']['results'][0]['key']; ?>"
        allowfullscreen>
    </iframe>

</div>

<?php endif; ?>

        <a href="/" class="btn btn-netflix">
            ⬅ Back
        </a>

    </div>

</div>

<?= $this->endSection(); ?>
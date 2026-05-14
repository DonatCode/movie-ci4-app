<!DOCTYPE html>
<html>
<head>

    <title>BARUDARK STUDIO</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{

            background-image:
            linear-gradient(
                rgba(0,0,0,0.55),
                rgba(0,0,0,0.75)
            ),
            url('/background/movie-bg.png');

            background-size: cover;
            background-position: center;
            background-attachment: fixed;

            color:white;
            font-family: Arial, Helvetica, sans-serif;

        }

        .navbar{

            background: rgba(0,0,0,0.85);

            backdrop-filter: blur(8px);

            padding-top:15px;
            padding-bottom:15px;

            border-bottom:1px solid rgba(255,255,255,0.08);

        }

        .navbar-brand img{

            height:55px;
            transition:0.3s;

        }

        .navbar-brand img:hover{

            transform:scale(1.05);

        }

        .nav-link{

            color:#d6d6d6 !important;
            margin-left:15px;
            font-size:15px;
            transition:0.3s;

        }

        .nav-link:hover{

            color:white !important;

        }

        .nav-link.active{

    color:white !important;

    font-weight:bold;

    position:relative;

}

.nav-link.active::after{

    content:'';

    position:absolute;

    left:0;

    bottom:-5px;

    width:100%;

    height:2px;

    background:#e50914;

    border-radius:10px;

}

        .search-box{

            background:#141414;
            border:1px solid #333;
            color:white;

        }

        .search-box:focus{

            background:#141414;
            color:white;
            border:1px solid #e50914;
            box-shadow:none;

        }

        .movie-card{

            background:#181818;
            border:none;
            overflow:hidden;
            transition:0.35s;
            border-radius:10px;

        }

        .movie-card:hover{

            transform:scale(1.05);
            z-index:10;

            box-shadow:
            0 10px 25px rgba(0,0,0,0.7);

        }

        .movie-card img{

            height:400px;
            object-fit:cover;

        }

        .movie-title{

            font-size:16px;
            font-weight:bold;
            color:white;

        }

        .rating{

            color:#b3b3b3;
            font-size:14px;

        }

        .btn-netflix{

            background:#e50914;
            color:white;
            border:none;
            border-radius:5px;

        }

        .btn-netflix:hover{

            background:#b20710;
            color:white;

        }

        .section-title{

            font-size:32px;
            font-weight:bold;
            margin-bottom:25px;

        }

        .tmdb-logo{

            position:fixed;
            bottom:15px;
            right:15px;
            opacity:0.75;
            z-index:999;

        }

        .tmdb-logo img{

            width:110px;

        }

        .skeleton{

            animation:skeleton-loading 1s linear infinite alternate;

        }

        @keyframes skeleton-loading{

            0%{
                background-color:hsl(200,20%,20%);
            }

            100%{
                background-color:hsl(200,20%,35%);
            }

        }

        .skeleton-card{

            height:400px;
            border-radius:10px;
            margin-bottom:20px;

        }

        .loading-text{

            height:20px;
            width:100%;
            border-radius:5px;
            margin-top:10px;

        }

    </style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">

    <div class="container-fluid px-4">

        <a class="navbar-brand" href="/">

            <img src="/assets/img/logo.png"
                 alt="BARUDARK STUDIO">

        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-4">

    <li class="nav-item">
        <a class="nav-link <?= current_url() == base_url('/') ? 'active' : ''; ?>"
           href="/">

           Home

        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link <?= strpos(current_url(), '/genre/28') ? 'active' : ''; ?>"
           href="/genre/28">

           Action

        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link <?= strpos(current_url(), '/genre/35') ? 'active' : ''; ?>"
           href="/genre/35">

           Comedy

        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link <?= strpos(current_url(), '/genre/27') ? 'active' : ''; ?>"
           href="/genre/27">

           Horror

        </a>
    </li>

</ul>

            <div class="ms-auto d-flex align-items-center">

                <input type="text"
                       id="search"
                       class="form-control search-box"
                       placeholder="Search movies...">

            </div>

        </div>

    </div>

</nav>

<div class="container-fluid px-4 mt-4">

    <?= $this->renderSection('content'); ?>

</div>

<div class="tmdb-logo">

    <img src="/assets/img/tmdb.png"
         alt="TMDB Logo">

</div>

<script>

function showSkeleton()
{
    let container = document.getElementById('movie-container');

    let skeleton = '';

    for(let i = 0; i < 8; i++)
    {
        skeleton += `

        <div class="col-md-3">

            <div class="card movie-card">

                <div class="skeleton skeleton-card"></div>

                <div class="card-body">

                    <div class="skeleton loading-text"></div>

                    <div class="skeleton loading-text"></div>

                </div>

            </div>

        </div>

        `;
    }

    container.innerHTML = skeleton;
}


document.getElementById('search').addEventListener('keyup', function(){

    let keyword = this.value;

    showSkeleton();

    fetch('/search?keyword=' + keyword)

    .then(response => response.text())

    .then(data => {

        let parser = new DOMParser();

        let html = parser.parseFromString(data, 'text/html');

        let movies = html.getElementById('movie-container');

        document.getElementById('movie-container').innerHTML = movies.innerHTML;

    });

});

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


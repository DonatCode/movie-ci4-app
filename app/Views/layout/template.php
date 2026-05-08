<!DOCTYPE html>
<html>
<head>
    <title>Movie App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{

    background-image:
    linear-gradient(
        rgba(0,0,0,0.45),
        rgba(0,0,0,0.55)
    ),
    url('/background/movie-bg.png');

    backdrop-filter: blur(1px);

    background-size: cover;
    background-position: center;
    background-attachment: fixed;

    color:white;
}

        .navbar{
            background-color:#000 !important;
        }

        .navbar-brand img{

    transition:0.3s;

}

.navbar-brand img:hover{

    transform:scale(1.08);

    filter:drop-shadow(0 0 10px red);

}

        .movie-card{
            transition:0.3s;
            border:none;
            background:#1c1c1c;
            overflow:hidden;
        }

        .movie-card:hover{
            transform:scale(1.05);
            box-shadow:0 0 20px rgba(255,255,255,0.2);
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
            color:#ffd700;
            font-weight:bold;
        }

        .btn-netflix{
            background:#e50914;
            color:white;
            border:none;
        }

        .btn-netflix:hover{
            background:#b20710;
            color:white;
        }

        .search-box{
            width:250px;
        }

        .skeleton{
    animation: skeleton-loading 1s linear infinite alternate;
}

@keyframes skeleton-loading{

    0%{
        background-color: hsl(200, 20%, 20%);
    }

    100%{
        background-color: hsl(200, 20%, 35%);
    }

}

.skeleton-card{
    height: 400px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.loading-text{
    height: 20px;
    width: 100%;
    border-radius: 5px;
    margin-top: 10px;
}

    </style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow">

    <div class="container">

        <a class="navbar-brand" href="/">

    <img src="/assets/img/logo.png"
         alt="BARUDARK STUDIO"
         height="55">

</a>

        <div>

    <a href="/genre/28"
       class="btn btn-sm btn-danger">
       Action
    </a>

    <a href="/genre/35"
       class="btn btn-sm btn-warning">
       Comedy
    </a>

    <a href="/genre/27"
       class="btn btn-sm btn-light">
       Horror
    </a>

    <a href="/favorites"
   class="btn btn-warning ms-2">

   ❤ Favorites

</a>

</div>

        <form action="/search" method="get" class="d-flex">

            <input type="text"
       id="search"
       class="form-control me-2 search-box"
       placeholder="Search movie...">

            <button class="btn btn-netflix">
                Search
            </button>

        </form>

    </div>

</nav>

<div class="container mt-4">

    <?= $this->renderSection('content'); ?>

</div>

<script>

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
</script>

</body>
</html>
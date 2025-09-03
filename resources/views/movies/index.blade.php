<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineVerse | Discover Movies</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            color: #fff;
            min-height: 100vh;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="100" height="100" opacity="0.05"><circle cx="50" cy="50" r="40" fill="none" stroke="white" stroke-width="2"/></svg>');
            z-index: -1;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
            padding-top: 20px;
        }

        .header h1 {
            font-size: 3.5rem;
            font-weight: 700;
            background: linear-gradient(to right, #ff8a00, #da1b60);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: inline-block;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .header p {
            color: #a0a0d0;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .search-container {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .search-form {
            display: flex;
            max-width: 600px;
            margin: 0 auto;
            position: relative;
        }

        .search-input {
            flex: 1;
            padding: 18px 60px 18px 24px;
            border: none;
            border-radius: 50px;
            background: rgba(0, 0, 0, 0.4);
            color: white;
            font-size: 1.1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            background: rgba(0, 0, 0, 0.6);
            box-shadow: 0 5px 20px rgba(218, 27, 96, 0.3);
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .search-btn {
            position: absolute;
            right: 6px;
            top: 6px;
            background: linear-gradient(to right, #ff8a00, #da1b60);
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(218, 27, 96, 0.4);
        }

        .search-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 7px 20px rgba(218, 27, 96, 0.6);
        }

        .movies-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 30px;
        }

        .movie-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .movie-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
            background: rgba(255, 255, 255, 0.08);
        }

        .movie-poster {
            width: 100%;
            height: 330px;
            object-fit: cover;
            transition: all 0.5s ease;
        }

        .movie-card:hover .movie-poster {
            transform: scale(1.08);
        }

        .movie-info {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .movie-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 10px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .movie-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-top: 15px;
        }

        .movie-rating {
            display: flex;
            align-items: center;
            background: rgba(0, 0, 0, 0.4);
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 500;
        }

        .movie-rating i {
            color: #ffc107;
            margin-right: 5px;
        }

        .movie-year {
            color: #a0a0d0;
            font-size: 0.9rem;
        }

        .no-movies {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
        }

        .no-movies i {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #da1b60;
            opacity: 0.7;
        }

        .no-movies p {
            font-size: 1.2rem;
            color: #a0a0d0;
        }

        .movie-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 40%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            z-index: 0;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .movie-card:hover::after {
            opacity: 1;
        }

        .movie-info {
            position: relative;
            z-index: 1;
        }

        .loader {
            display: none;
            text-align: center;
            padding: 30px;
            grid-column: 1 / -1;
        }

        .loader i {
            font-size: 2rem;
            color: #ff8a00;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2.5rem;
            }

            .movies-grid {
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                gap: 20px;
            }

            .movie-poster {
                height: 240px;
            }

            .search-input {
                padding: 14px 50px 14px 20px;
                font-size: 1rem;
            }

            .search-btn {
                width: 44px;
                height: 44px;
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 2rem;
            }

            .movies-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .movie-poster {
                height: 200px;
            }

            .search-container {
                padding: 20px;
            }
        }

        /* Animation for cards */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .movie-card {
            animation: fadeIn 0.5s ease forwards;
        }

        /* Stagger animations */
        .movie-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .movie-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .movie-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .movie-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .movie-card:nth-child(5) {
            animation-delay: 0.5s;
        }

        .movie-card:nth-child(6) {
            animation-delay: 0.6s;
        }

        .movie-card:nth-child(7) {
            animation-delay: 0.7s;
        }

        .movie-card:nth-child(8) {
            animation-delay: 0.8s;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>CineVerse by Allen</h1>
            <p>Discover the world of cinema with our curated collection of popular movies</p>
        </div>

        <div class="search-container">
            <form method="GET" action="{{ route('movies.search') }}" class="search-form" id="searchForm">
                <input type="text" name="query" placeholder="Search for movies..." class="search-input"
                    value="{{ request('query') }}">
                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <div class="movies-grid">
            @forelse($movies as $movie)
                <div class="movie-card">
                    <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}"
                        class="movie-poster">
                    <div class="movie-info">
                        <h2 class="movie-title">{{ $movie['title'] }}</h2>
                        <div class="movie-meta">
                            <div class="movie-rating">
                                <i class="fas fa-star"></i>
                                <span>{{ $movie['vote_average'] }}</span>
                            </div>
                            <div class="movie-year">{{ date('Y', strtotime($movie['release_date'])) }}</div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="no-movies">
                    <i class="fas fa-film"></i>
                    <p>No movies found. Try a different search.</p>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchForm = document.getElementById('searchForm');
            const moviesGrid = document.querySelector('.movies-grid');

            searchForm.addEventListener('submit', function (e) {
                // Show loading indicator
                moviesGrid.innerHTML = `
                    <div class="loader">
                        <i class="fas fa-spinner"></i>
                        <p>Searching movies...</p>
                    </div>
                `;
            });

            // Add hover effect to movie cards
            const movieCards = document.querySelectorAll('.movie-card');
            movieCards.forEach(card => {
                card.addEventListener('mouseenter', function () {
                    this.style.zIndex = '10';
                });

                card.addEventListener('mouseleave', function () {
                    this.style.zIndex = '1';
                });
            });
        });
    </script>
</body>

</html>
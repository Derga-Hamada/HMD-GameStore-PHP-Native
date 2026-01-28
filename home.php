<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$games = [
    [
        "title" => "Resident Evil 7", 
        "img" => "Resident Evil 7.jpg", 
        "price" => "Free",
        "category" => "horror",
        "desc" => "Ethan Winters searches for his long-missing wife in a derelict plantation occupied by an infected family."
    ],
    [
        "title" => "Until Dawn", 
        "img" => "Until Dawn.jpg", 
        "price" => "$4.99",
        "category" => "horror",
        "desc" => "Eight young adults have to survive on Blackwood Mountain until they are rescued at dawn."
    ],
    [
        "title" => "Outlast 2", 
        "img" => "Out last.jpg", 
        "price" => "$19.99",
        "category" => "horror",
        "desc" => "Journalists Blake and Lynn crash in the Arizona Desert, inhabited by a murderous cult driven mad by hallucinations."
    ],
    [
        "title" => "Halo Infinite", 
        "img" => "Holo Infinite.jpg", 
        "price" => "$29.99",
        "category" => "sci-fi",
        "desc" => "Master Chief wages a war against the Banished on the open world Zeta Halo, using a mixture of vehicles and weapons."
    ],
    [
        "title" => "Fallout 76", 
        "img" => "Fallout.jpg", 
        "price" => "$39.99",
        "category" => "sci-fi",
        "desc" => "Set in 2102, twenty-five years after a nuclear war. You are a resident of Vault 76, housing America's best minds."
    ],
    [
        "title" => "Titanfall 2", 
        "img" => "TitanFall.jpg", 
        "price" => "$49.99",
        "category" => "sci-fi",
        "desc" => "Experience the bond between a Pilot and a Titan in this action-packed first-person shooter set in a sci-fi universe."
    ],
    [
        "title" => "Grand Theft Auto V", 
        "img" => "GTA 5.jpg", 
        "price" => "$34.99",
        "category" => "open-world",
        "desc" => "Three criminals commit heists while under pressure from a corrupt government agency in the open world of Los Santos."
    ],
    [
        "title" => "Red Dead Redemption 2", 
        "img" => "Red Dead Redemption 2.jpg", 
        "price" => "$44.99",
        "category" => "open-world",
        "desc" => "Arthur Morgan and the Van der Linde gang must rob, steal and fight their way across the rugged heartland of America."
    ],
    [
        "title" => "Elden Ring", 
        "img" => "Elden Ring.jpg", 
        "price" => "$59.99",
        "category" => "open-world",
        "desc" => "A fantasy action-RPG adventure set within a world created by Hidetaka Miyazaki and George R. R. Martin."
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMD Games</title>
    <style>
        body {
            margin: 0;
            padding-bottom: 50px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('img1.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .top-bar {
            background-color: rgba(20, 139, 236, 0.95);
            color: #fff;
            padding: 10px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .left-section {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .brand-section {
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
        }

        .site-logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
        }

        .site-name {
            font-size: 1.8rem;
            font-weight: bold;
            color: white;
            letter-spacing: 1px;
        }

        .search-container {
            position: relative;
        }

        .search-input {
            padding: 8px 15px;
            border-radius: 20px;
            border: none;
            outline: none;
            width: 250px;
            font-size: 1rem;
            transition: width 0.3s;
        }

        .search-input:focus {
            width: 300px;
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
        }

        .category-filter {
            background-color: transparent;
            color: white;
            border: 1px solid white;
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 1rem;
            outline: none;
        }

        .category-filter:hover {
            background-color: white;
            color: #148bec;
        }

        .category-filter option {
            background-color: #148bec;
            color: white;
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-name {
            font-weight: bold;
            font-size: 1.1rem;
        }
        
        .logout-btn {
            background-color: #dc3545;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
            border: 1px solid white;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background-color: white;
            color: #dc3545;
        }

        .hero-section {
            text-align: center;
            margin: 30px auto;
            max-width: 800px;
        }
        
        .hero-img {
            width: 100%;
            max-width: 300px;
            filter: drop-shadow(0 0 15px rgba(255, 255, 255, 0.6));
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        .hero-title {
            color: white;
            text-shadow: 2px 2px 4px #000;
            font-size: 2rem;
            margin-top: 10px;
        }

        .games-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .game-card {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            overflow: hidden;
            width: 300px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            transition: transform 0.3s;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .game-card:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 25px rgba(0,0,0,0.4);
        }

        .game-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-bottom: 3px solid #148bec;
        }

        .game-info {
            padding: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
        }

        .game-title {
            margin: 5px 0 10px 0;
            color: #333;
            font-size: 1.3rem;
            font-weight: 800;
        }

        .game-desc {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.4;
            margin-bottom: 15px;
            height: 60px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .game-price {
            color: #28a745;
            font-weight: bold;
            font-size: 1.4rem;
            margin-bottom: 10px;
        }

        .btn-buy {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
            font-weight: bold;
            transition: background 0.3s;
            box-shadow: 0 3px 10px rgba(0, 123, 255, 0.3);
        }

        .btn-buy:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .more-games-container {
            text-align: center;
            margin: 50px 0;
        }

        .btn-more {
            background-color: #ffc107;
            color: #333;
            padding: 15px 50px;
            border: none;
            border-radius: 50px;
            font-size: 1.3rem;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4);
            transition: 0.3s;
        }

        .btn-more:hover {
            transform: scale(1.1);
            background-color: #e0a800;
        }
    </style>
</head>
<body>

    <div class="top-bar">
        <div class="left-section">
            <a href="#" class="brand-section">
                <img src="logo.png" alt="Logo" class="site-logo">
                <span class="site-name">HMD Games</span>
            </a>
            
            <div class="search-container">
                <input type="text" id="searchInput" class="search-input" placeholder="Search games..." onkeyup="filterGames()">
            </div>

            <select id="categoryFilter" class="category-filter" onchange="filterGames()">
                <option value="all">All Categories</option>
                <option value="horror">Horror</option>
                <option value="open-world">Open World</option>
                <option value="sci-fi">Sci-Fi</option>
            </select>
        </div>
        
        <div class="user-section">
            <span class="user-name">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <div class="hero-section">
        <img src="logo.png" alt="HMD Games Logo" class="hero-img">
        <h2 class="hero-title">Choose Your Next Adventure</h2>
    </div>

    <div class="games-grid" id="gamesGrid">
        <?php foreach ($games as $game): ?>
            <div class="game-card" data-category="<?= $game['category'] ?>">
                <img src="<?= $game['img'] ?>" alt="<?= $game['title'] ?>" class="game-image">
                <div class="game-info">
                    <div>
                        <h3 class="game-title"><?= $game['title'] ?></h3>
                        <p class="game-desc"><?= $game['desc'] ?></p>
                    </div>
                    <div>
                        <p class="game-price"><?= $game['price'] ?></p>
                        <button class="btn-buy" onclick="alert('Starting <?= $game['title'] ?>...')">Play Now</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="more-games-container">
        <button class="btn-more" onclick="alert('Enjoy these, soon we will add new games')">More Games +</button>
    </div>

    <script>
        function filterGames() {
            var input = document.getElementById('searchInput');
            var filterText = input.value.toLowerCase();
            var categorySelect = document.getElementById('categoryFilter');
            var selectedCategory = categorySelect.value;
            var grid = document.getElementById('gamesGrid');
            var cards = grid.getElementsByClassName('game-card');

            for (var i = 0; i < cards.length; i++) {
                var card = cards[i];
                var title = card.getElementsByClassName('game-title')[0].innerText.toLowerCase();
                var category = card.getAttribute('data-category');
                
                var matchesSearch = title.includes(filterText);
                var matchesCategory = (selectedCategory === 'all') || (category === selectedCategory);

                if (matchesSearch && matchesCategory) {
                    card.style.display = "";
                } else {
                    card.style.display = "none";
                }
            }
        }
    </script>

</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="header-container">
            <input type="text" placeholder="Search Profiles" class="search-input">
            <a href="profile.php" class="profile-link">
                <img src="profile-icon.png" alt="Profile">
            </a>
        </div>
    </header>
    <main>
        <div class="tweets-container">
            <?php foreach ($tweets as $tweet): ?>
                <div class="tweet">
                    <h3><?php echo htmlspecialchars($tweet['username']); ?></h3>
                    <p><?php echo htmlspecialchars($tweet['content']); ?></p>
                    <small>Posté le <?php echo $tweet['created_at']; ?></small>
                    <div class="like-button">❤️</div>
                </div>
            <?php endforeach; ?>
        </div>

        <form action="acceuille_proccess.php" method="post" class="tweet-form">
            <textarea name="content" rows="4" cols="50" placeholder="Quoi de neuf ?" required></textarea>
            <button type="submit">Post</button>
        </form>
    </main>
</body>
</html>

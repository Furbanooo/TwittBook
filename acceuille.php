<?php require 'config.php';

// Préparer et exécuter la requête pour récupérer tous les tweets et likes avec les informations des utilisateurs
$statement = $connexion->prepare("SELECT tweets.*, users.username,
(SELECT COUNT(*) FROM likes_dislikes WHERE tweet_id = tweets.id AND type = 'like') AS likes,
(SELECT COUNT(*) FROM likes_dislikes WHERE tweet_id = tweets.id AND type = 'dislike') AS dislikes
FROM tweets
JOIN users ON tweets.user_id = users.id
ORDER BY tweets.created_at DESC");
$statement->execute();

// array des tweets
$tweets = $statement->fetchAll();
?>

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
            <?php if (empty($tweets)): ?>
                <p>Aucun tweet n'a encore été publié.</p>
            <?php else: ?>
                <?php foreach ($tweets as $tweet): ?>
                    <div class="tweet">
                        <h3><?php echo htmlspecialchars($tweet['username']); ?></h3>
                        <p><?php echo htmlspecialchars($tweet['content']); ?></p>
                        <small>Posté le <?php echo $tweet['created_at']; ?></small>
                        <div class="like-dislike-container">
                            <form action="home.php" method="post" style="display: inline;">
                                <input type="hidden" name="tweet_id" value="<?php echo $tweet['id']; ?>">
                                <input type="hidden" name="action" value="like">
                                <button type="submit" class="like-button">❤️ <?php echo $tweet['likes']; ?></button>
                            </form>
                            <form action="home.php" method="post" style="display: inline;">
                                <input type="hidden" name="tweet_id" value="<?php echo $tweet['id']; ?>">
                                <input type="hidden" name="action" value="dislike">
                                <button type="submit" class="dislike-button">💔 <?php echo $tweet['dislikes']; ?></button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <form action="acceuille_proccess.php" method="post" class="tweet-form">
            <textarea name="content" rows="4" cols="50" placeholder="Quoi de neuf ?" required></textarea>
            <button type="submit">Post</button>
        </form>  
    </main>

</body>
</html>

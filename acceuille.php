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
    <link rel="stylesheet" href="style/variables.css">
    <link rel="stylesheet" href="style/layout.css">
    <link rel="stylesheet" href="style/acceuille.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Traiter les "likes" et "dislikes" avec AJAX
        $('.like-button, .dislike-button').click(function(e) {
            e.preventDefault(); // Empêcher le formulaire de se soumettre

            // Récupérer les données du formulaire
            var form = $(this).closest('form');
            var tweet_id = form.find('input[name="tweet_id"]').val();
            var action = form.find('input[name="action"]').val();

            // Envoyer la requête AJAX au serveur
            $.ajax({
                url: 'acceuille_proccess.php',
                method: 'POST',
                data: { tweet_id: tweet_id, action: action },
                success: function(response) {
                    // Mettre à jour le nombre de "likes" ou "dislikes" affiché
                    var count = parseInt($(this).parent().find('.count').text()) || 0;
                    if (action === 'like') {
                        count += 1;
                    } else if (action === 'dislike') {
                        count -= 1;
                    }
                    $(this).parent().find('.count').text(count);

                    // Charger le nouveau nombre de likes depuis le serveur et mettre à jour le contenu HTML de la page
                    $('.like-count-' + tweet_id).load('acceuille.php .like-count-' + tweet_id);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
    </script>
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
                            <form action="acceuille_proccess.php" method="post" style="display: inline;">
                                <input type="hidden" name="tweet_id" value="<?php echo $tweet['id']; ?>">
                                <input type="hidden" name="action" value="like">
                                <button type="submit" class="like-button">❤️ <span class="count"><?php echo $tweet['likes']; ?></span></button>
                            </form>
                            <span class="like-count-<?php echo $tweet['id']; ?>"> <?php echo $tweet['likes']; ?> likes</span>
                            <form action="acceuille_proccess.php" method="post" style="display: inline;">
                                <input type="hidden" name="tweet_id" value="<?php echo $tweet['id']; ?>">
                                <input type="hidden" name="action" value="dislike">
                                <button type="submit" class="dislike-button">💔 <span class="count"><?php echo $tweet['dislikes']; ?></span></button>
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

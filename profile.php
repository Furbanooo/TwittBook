<?php 
 include 'profile_proccess.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="style/profile.css">
</head>
<body>
    <header>
        <h1>Profile Page</h1>
        <nav>
            <a href="acceuille.php">Home</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <section class="profile-info">
            <img src="profile-picture.png" alt="Profile Picture" class="profile-picture">
            <h2><?php echo htmlspecialchars($user['username']); ?></h2>
        </section>
        <section class="user-tweets">
            <h3>Your Tweets</h3>
            <div class="tweets-container">
                <?php if (empty($tweets)): ?>
                    <p>You haven't posted any tweets yet.</p>
                <?php else: ?>
                    <?php foreach ($tweets as $tweet): ?>
                        <div class="tweet">
                            <p><?php echo htmlspecialchars($tweet['content']); ?></p>
                            <small>Posted on <?php echo $tweet['created_at']; ?></small>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
        <section class="logout">
            <a href="logout.php" class="logout-button">Logout</a>
        </section>
    </main>
</body>
</html>

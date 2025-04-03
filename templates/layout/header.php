<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'Real vs AI'; ?></title>
    
    <!-- Favicon -->
    <link rel="icon" href="static/images/mascot/pix1.png" type="image/png">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="static/css/custom.css" rel="stylesheet">
    
    <!-- Optional additional CSS based on page -->
    <?php if (isset($additional_css)): ?>
        <?php foreach ($additional_css as $css): ?>
            <link href="<?php echo $css; ?>" rel="stylesheet">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Real vs AI</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo is_current_url('/') || is_current_url('/index.php') ? 'active' : ''; ?>" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo is_current_url('/game.php') ? 'active' : ''; ?>" href="game.php">Play</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo is_current_url('/multiplayer.php') ? 'active' : ''; ?>" href="multiplayer.php">Multiplayer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo is_current_url('/leaderboard.php') ? 'active' : ''; ?>" href="leaderboard.php">Leaderboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo is_current_url('/instructions.php') ? 'active' : ''; ?>" href="instructions.php">How to Play</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo is_current_url('/tutorial.php') ? 'active' : ''; ?>" href="tutorial.php">Tutorial</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo htmlspecialchars($_SESSION['username']); ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                                    <li><a class="dropdown-item" href="admin.php">Admin Panel</a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo is_current_url('/login.php') ? 'active' : ''; ?>" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo is_current_url('/register.php') ? 'active' : ''; ?>" href="register.php">Register</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo is_current_url('/contribute.php') ? 'active' : ''; ?>" href="contribute.php">Contribute</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
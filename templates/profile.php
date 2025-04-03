<div class="container">
    <div class="profile-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-5">
                    <?php if (!empty($user['avatar'])): ?>
                        <span class="me-2" id="currentAvatar"><?= htmlspecialchars($user['avatar']) ?></span>
                    <?php else: ?>
                        <i class="fas fa-user-circle me-2" id="defaultAvatar"></i>
                    <?php endif; ?>
                    <?= htmlspecialchars($user['username']) ?>
                </h1>
                <p class="text-muted">Member since <?= format_datetime($user_stats['joined'], 'F j, Y') ?></p>
            </div>
            <div class="col-md-4 text-md-end">
                <?php if (is_current_user_admin()): ?>
                    <a href="/admin/dashboard.php" class="btn btn-outline-primary">
                        <i class="fas fa-cog me-1"></i> Admin Dashboard
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="profile-stats">
            <div class="profile-stat-item">
                <div class="profile-stat-label">Games Played</div>
                <div class="profile-stat-value"><?= $user_stats['total_games'] ?></div>

            </div>
            <div class="profile-stat-item">
                <div class="profile-stat-label">Highest Score</div>
                <div class="profile-stat-value"><?= $user_stats['highest_score'] ?></div>
            </div>
            <div class="profile-stat-item">
                <div class="profile-stat-label">Achievements</div>
                <div class="profile-stat-value"><?= count($user_achievements) ?></div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Top Scores</h4>
                </div>
                <div class="card-body">
                    <?php if (empty($best_scores)): ?>
                        <p class="text-center">No scores yet. Start playing to see your best performances!</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Score</th>
                                        <th>Game Mode</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($best_scores as $score): ?>
                                        <tr>
                                            <td><strong><?= htmlspecialchars($score['score']) ?></strong></td>
                                            <td>
                                                <?= htmlspecialchars(ucfirst($score['game_mode'])) ?>
                                                <?php if (!empty($score['difficulty'])): ?>
                                                    <span class="badge bg-secondary"><?= htmlspecialchars(ucfirst($score['difficulty'])) ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= format_datetime($score['created_at']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Recent Games</h4>
                </div>
                <div class="card-body">
                    <?php if (empty($recent_games)): ?>
                        <p class="text-center">No games played yet. Start playing to see your game history!</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Mode</th>
                                        <th>Score</th>
                                        <th>Result</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recent_games as $game): ?>
                                        <tr>
                                            <td>
                                                <?= htmlspecialchars(ucfirst($game['game_mode'])) ?>
                                                <?php if (!empty($game['difficulty'])): ?>
                                                    <span class="badge bg-secondary"><?= htmlspecialchars(ucfirst($game['difficulty'])) ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= htmlspecialchars($game['score']) ?></td>
                                            <td>
                                                <?php if ($game['completed']): ?>
                                                    <span class="badge bg-success">Completed</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">Game Over</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= format_datetime($game['created_at']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Achievements</h4>
                </div>
                <div class="card-body">
                    <?php if (empty($achievements)): ?>
                        <p class="text-center">No achievements available.</p>
                    <?php else: ?>
                        <div class="row">
                            <?php foreach ($achievements as $achievement): ?>
                                <div class="col-md-4 col-6 mb-4 text-center">
                                    <div class="achievement-badge <?= $achievement['earned'] ? 'earned' : 'not-earned' ?>">
                                        <i class="fas <?= htmlspecialchars($achievement['icon']) ?> achievement-icon"></i>
                                        <div class="achievement-title"><strong><?= htmlspecialchars($achievement['title']) ?></strong></div>
                                        <div class="achievement-tooltip">
                                            <p class="small mb-0"><?= htmlspecialchars($achievement['description']) ?></p>
                                            <?php if ($achievement['earned']): ?>
                                                <p class="small mt-1 mb-0 text-warning">Earned on: <?= format_datetime($achievement['date'], 'M j, Y') ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Account Settings</h4>
                </div>
                <div class="card-body">
                    <!-- Avatar Selection -->
                    <div class="mb-4">
                        <h5>Avatar for Multiplayer</h5>
                        <p class="text-muted small mb-3">Choose an avatar that will appear next to your name in multiplayer games</p>

                        <form action="/profile.php" method="post" id="avatarForm">
                            <input type="hidden" name="action" value="update_avatar">
                            <input type="hidden" name="avatar" id="selectedAvatar" value="<?= htmlspecialchars($user['avatar'] ?? '') ?>">

                            <div class="avatar-selection mb-3">
                                <div class="row g-2">
                                    <!-- Humans -->
                                    <div class="col-12 mb-2">
                                        <div class="avatar-category">Humans</div>
                                    </div>
                                    <?php foreach (['👨', '👩', '👴', '👵', '👲', '👳‍♂️', '👳‍♀️', '👮‍♂️', '👮‍♀️', '👷‍♂️', '👷‍♀️', '💂‍♂️', '👨‍⚕️', '👩‍⚕️'] as $avatar): ?>
                                        <div class="col-2 col-md-1">
                                            <div class="avatar-option <?= ($user['avatar'] === $avatar) ? 'selected' : '' ?>" data-avatar="<?= $avatar ?>">
                                                <?= $avatar ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                    <!-- Robots -->
                                    <div class="col-12 mb-2 mt-3">
                                        <div class="avatar-category">Robots & Technology</div>
                                    </div>
                                    <?php foreach (['🤖', '👾', '💻', '🖥️', '🤖', '📱', '📟', '🎮', '🕹️', '🔌', '💡', '🔋', '🔍', '📡'] as $avatar): ?>
                                        <div class="col-2 col-md-1">
                                            <div class="avatar-option <?= ($user['avatar'] === $avatar) ? 'selected' : '' ?>" data-avatar="<?= $avatar ?>">
                                                <?= $avatar ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                    <!-- Other Emojis -->
                                    <div class="col-12 mb-2 mt-3">
                                        <div class="avatar-category">Animals & Nature</div>
                                    </div>
                                    <?php foreach (['🐱', '🐶', '🦊', '🐼', '🐨', '🦁', '🐯', '🐮', '🐷', '🐸', '🐙', '🦄', '🦉', '🦋'] as $avatar): ?>
                                        <div class="col-2 col-md-1">
                                            <div class="avatar-option <?= ($user['avatar'] === $avatar) ? 'selected' : '' ?>" data-avatar="<?= $avatar ?>">
                                                <?= $avatar ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <?php if (!empty($user['avatar'])): ?>
                                        <p class="mb-0">Current Avatar: <span class="selected-avatar-display"><?= htmlspecialchars($user['avatar']) ?></span></p>
                                    <?php else: ?>
                                        <p class="mb-0 text-muted">No avatar selected</p>
                                    <?php endif; ?>
                                </div>
                                <button type="submit" class="btn btn-primary" id="saveAvatarBtn">Save Avatar</button>
                            </div>
                        </form>
                    </div>

                    <hr class="my-4">

                    <!-- Email Update -->
                    <div class="mb-4">
                        <h5>Update Email</h5>
                        <form action="/profile.php" method="post" id="emailForm">
                            <input type="hidden" name="action" value="update_email">

                            <div class="mb-3">
                                <label for="current_email" class="form-label">Current Email</label>
                                <input type="email" class="form-control bg-dark text-light" id="current_email" value="<?= htmlspecialchars($user['email']) ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="new_email" class="form-label">New Email</label>
                                <input type="email" class="form-control bg-dark text-light" id="new_email" name="new_email" required>
                            </div>

                            <div class="mb-3">
                                <label for="password_for_email" class="form-label">Current Password</label>
                                <input type="password" class="form-control bg-dark text-light" id="password_for_email" name="password" required>
                                <div class="form-text">Enter your current password to confirm this change</div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Email</button>
                        </form>
                    </div>

                    <hr class="my-4">

                    <!-- Country Selection -->
                    <div class="mb-4">
                        <h5>Your Country</h5>
                        <p class="text-muted small mb-3">Select your country to display a flag next to your name on the leaderboard</p>

                        <?php
                        // Include countries helper functions
                        require_once __DIR__ . '/../includes/countries.php';

                        // Get user's country or default to US
                        $user_country = $user['country'] ?? 'US';
                        $country_name = get_country_name($user_country);
                        ?>

                        <div class="mb-3">
                            <div class="country-display mb-3">
                                <div class="country-flag"><?= get_country_flag_html($user_country, 'md') ?></div>
                                <div><?= htmlspecialchars($country_name) ?></div>
                            </div>
                            <a href="/update_user_country.php" class="btn btn-outline-primary">
                                <i class="fas fa-globe me-1"></i> Change Country
                            </a>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Game Preferences -->
                    <div class="mb-4">
                        <h5>Game Preferences</h5>
                        <p class="text-muted small mb-3">Customize your gameplay experience with these settings</p>

                        <form action="/profile.php" method="post" id="timerPreferencesForm">
                            <input type="hidden" name="action" value="update_timer_preference">

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="hideTimer" name="hide_timer" value="1" <?= ($user['hide_timer'] ?? 0) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="hideTimer">Hide Timer</label>
                                <div class="form-text">The timer will still work in the background, but won't be visible during gameplay.</div>
                                <div class="form-text text-warning mt-1">Note: This only affects Single Player (Hard), Multiplayer, and Endless modes.</div>
                            </div>

                            <button type="submit" class="btn btn-primary">Save Preferences</button>
                        </form>
                    </div>

                    <hr class="my-4">

                    <!-- Password Update -->
                    <div>
                        <h5>Change Password</h5>
                        <form action="/profile.php" method="post" id="passwordForm">
                            <input type="hidden" name="action" value="update_password">

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" class="form-control bg-dark text-light" id="current_password" name="current_password" required>
                            </div>

                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control bg-dark text-light" id="new_password" name="new_password" required>
                            </div>

                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control bg-dark text-light" id="confirm_password" name="confirm_password" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Avatar selection
                    const avatarOptions = document.querySelectorAll('.avatar-option');
                    const selectedAvatarInput = document.getElementById('selectedAvatar');
                    const selectedAvatarDisplay = document.querySelector('.selected-avatar-display');

                    avatarOptions.forEach(option => {
                        option.addEventListener('click', function() {
                            // Remove selected class from all options
                            avatarOptions.forEach(opt => opt.classList.remove('selected'));

                            // Add selected class to clicked option
                            this.classList.add('selected');

                            // Update hidden input value
                            const avatarValue = this.getAttribute('data-avatar');
                            selectedAvatarInput.value = avatarValue;

                            // Update display if it exists
                            if (selectedAvatarDisplay) {
                                selectedAvatarDisplay.textContent = avatarValue;
                            }
                        });
                    });

                    // Password confirmation validation
                    const passwordForm = document.getElementById('passwordForm');
                    const newPasswordInput = document.getElementById('new_password');
                    const confirmPasswordInput = document.getElementById('confirm_password');

                    if (passwordForm) {
                        passwordForm.addEventListener('submit', function(event) {
                            if (newPasswordInput.value !== confirmPasswordInput.value) {
                                event.preventDefault();
                                alert('New passwords do not match. Please try again.');
                            }
                        });
                    }
                });
            </script>
        </div>
    </div>
</div>
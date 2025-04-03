    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Real vs AI</h5>
                    <p>Test your ability to distinguish between real photos and AI-generated images.</p>
                </div>
                <div class="col-md-3">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-white">Home</a></li>
                        <li><a href="/game.php" class="text-white">Play Game</a></li>
                        <li><a href="/leaderboard.php" class="text-white">Leaderboard</a></li>
                        <li><a href="/instructions.php" class="text-white">How to Play</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Support</h5>
                    <ul class="list-unstyled">
                        <li><a href="/contribute.php" class="text-white">Contribute</a></li>
                        <li><a href="/terms.php" class="text-white">Terms of Use</a></li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; <?php echo date('Y'); ?> Real vs AI. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Validation JS -->
    <script src="/static/js/validation.js"></script>
    
    <!-- Optional additional JavaScript based on page -->
    <?php if (isset($additional_js)): ?>
        <?php foreach ($additional_js as $js): ?>
            <script src="<?php echo $js; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <!-- Optional custom JavaScript based on page -->
    <?php if (isset($custom_js)): ?>
        <script>
            <?php echo $custom_js; ?>
        </script>
    <?php endif; ?>
</body>
</html>
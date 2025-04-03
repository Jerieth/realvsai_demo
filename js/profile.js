/**
 * Profile page JavaScript
 * Handles achievement celebrations and UI interactions
 */

document.addEventListener('DOMContentLoaded', function() {
    // Check if there are any newly earned achievements
    const flashMessages = document.querySelectorAll('.alert-success');
    let hasNewAchievement = false;
    
    flashMessages.forEach(message => {
        if (message.textContent.includes('new achievements')) {
            hasNewAchievement = true;
            // Add special styling to the notification
            message.classList.add('achievement-notification');
            
            // Trigger confetti celebration
            if (typeof JSConfetti !== 'undefined') {
                const jsConfetti = new JSConfetti();
                
                // Launch confetti with the game's color theme
                jsConfetti.addConfetti({
                    confettiColors: [
                        '#7467fd', // Primary color (Cornflower Blue)
                        '#2d315a', // Secondary color (Rhino)
                        '#00c09d', // Success color
                        '#ffc107', // Warning color
                        '#ffffff'  // White
                    ],
                    confettiNumber: 200
                });
                
                // Add emojis for extra flair
                setTimeout(() => {
                    jsConfetti.addConfetti({
                        emojis: ['🏆', '🎮', '🎯', '⭐', '🔥'],
                        emojiSize: 1.5,
                        confettiNumber: 30
                    });
                }, 800);
            }
        }
    });
    
    // If there are newly earned achievements, highlight them with a glow effect
    if (hasNewAchievement) {
        // Get all cards that are marked as earned
        const earnedAchievements = document.querySelectorAll('.achievement-badge .card.earned');
        
        // Add special highlighting to newly earned achievements
        earnedAchievements.forEach(card => {
            // Check if this is a recently earned achievement
            const dateElement = card.querySelector('.achievement-earned-date .badge');
            if (dateElement) {
                const earnedDate = new Date(dateElement.textContent.replace('Earned on ', ''));
                const now = new Date();
                
                // If achievement was earned in the last day, highlight it
                if ((now - earnedDate) < (24 * 60 * 60 * 1000)) {
                    card.classList.add('newly-earned');
                    
                    // Add pulsing effect to the icon
                    const icon = card.querySelector('i');
                    if (icon) {
                        icon.classList.add('pulse-animation');
                    }
                }
            }
        });
    }
    
    // Add tooltips to achievement badges for additional info
    const achievementBadges = document.querySelectorAll('.achievement-badge');
    achievementBadges.forEach(badge => {
        badge.addEventListener('mouseenter', function() {
            this.querySelector('.card').classList.add('hover-effect');
        });
        
        badge.addEventListener('mouseleave', function() {
            this.querySelector('.card').classList.remove('hover-effect');
        });
    });
});
<?php

$quickLinks = [
    'How it works'           => 'how-it-works.php',
    'FAQ'                    => 'faq.php',
    'Terms & Conditions'     => 'terms.php',
    'Privacy Policy'         => 'privacy.php',
];

// Define Location Links
$locationLinks = [
    'Riyadh' => 'riyadh.php',
    'Jeddah' => 'jeddah.php',
    'Dammam' => 'dammam.php',
];

// Define Social Icons
$socialIcons = [
    'Facebook'  => ['url' => '#', 'img' => 'img/Facebook.jpg'],
    'Instagram' => ['url' => '#', 'img' => 'img/Instagram.jpg'],
    'X'         => ['url' => '#', 'img' => 'img/x.jpg'],
    'YouTube'   => ['url' => '#', 'img' => 'img/Youtube.jpg'],
    'Snapchat'  => ['url' => '#', 'img' => 'img/Snapchat.jpg'],
    'LinkedIn'  => ['url' => '#', 'img' => 'img/LinkedIn.jpg'],
    'WhatsApp'  => ['url' => '#', 'img' => 'img/whatsapp.jpg'],
    'TikTok'    => ['url' => '#', 'img' => 'img/tiktok.jpg'],
];
?>

<footer class="footer">
    <div class="footer-grid">
        <!-- Quick Links -->
        <div class="footer-links">
            <?php foreach ($quickLinks as $text => $link): ?>
                <a href="<?= htmlspecialchars($link) ?>"><?= htmlspecialchars($text) ?></a>
            <?php endforeach; ?>
        </div>

       
        <div class="footer-links">
            <?php foreach ($locationLinks as $city => $link): ?>
                <a href="<?= htmlspecialchars($link) ?>"><?= htmlspecialchars($city) ?></a>
            <?php endforeach; ?>
        </div>

        
        <div class="social-icons">
            <?php foreach ($socialIcons as $title => $data): ?>
                <a href="<?= htmlspecialchars($data['url']) ?>" title="<?= htmlspecialchars($title) ?>">
                    <img src="<?= htmlspecialchars($data['img']) ?>" alt="<?= htmlspecialchars($title) ?>">
                </a>
            <?php endforeach; ?>
        </div>
    </div>


    <div class="footer-bottom">
        &copy; <?= date('Y') ?> MyOffers - All Rights Reserved.
    </div>
</footer>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo esc_html(get_option('modern_mm_title', 'Under Construction')); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: url('<?php echo esc_url(get_option('modern_mm_background_image', '')); ?>') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            text-align: center;
            padding: 10% 0;
        }
        .container { max-width: 700px; margin: auto; }
        .social-icons a { margin: 0 10px; color: #fff; font-size: 1.5rem; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo esc_html(get_option('modern_mm_title', 'Under Construction')); ?></h1>
        <p><?php echo esc_html(get_option('modern_mm_lead', 'We’re making improvements and will be back shortly.')); ?></p>
        <div class="social-icons">
            <?php
            $icons = json_decode(get_option('modern_mm_social_icons', '[]'), true);
            foreach ($icons as $icon => $url) {
                echo '<a href="' . esc_url($url) . '" target="_blank"><i class="fab fa-' . esc_attr($icon) . '"></i></a>';
            }
            ?>
        </div>
    </div>
</body>
</html>

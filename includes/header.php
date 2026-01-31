<?php
require_once __DIR__ . '/../config/config.php';

// Output buffering and compression for performance
ob_start('ob_gzhandler');

// Set caching headers for static content
header('Cache-Control: public, max-age=86400'); // Cache for 1 day
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT');

// Determine the current page to fetch the correct metadata
$current_page_key = get_current_page();
$page_meta = $page_config[$current_page_key] ?? $page_config['index'];

// Special handling for individual blog posts
if ($current_page_key === 'blogs' && isset($_GET['id'])) {
    $post_id = htmlspecialchars($_GET['id']);
    $found_post = null;
    foreach ($blog_data as $post) {
        if ($post['id'] == $post_id) {
            $found_post = $post;
            break;
        }
    }
    if ($found_post) {
        $page_meta['title'] = $found_post['title'] . ' | Sunsari-2 Blog';
        $page_meta['meta_description'] = $found_post['summary'];
        $page_meta['canonical'] = 'https://sunsari2.com/blogs?id=' . $post_id;
        $page_meta['og_type'] = 'article';
    }
}

// Handle multilingual content
$lang = isset($_GET['lang']) && isset($translations[$_GET['lang']]) ? $_GET['lang'] : 'en';
$t = $translations[$lang];

?>
<!DOCTYPE html>
<html class="light" lang="<?php echo $lang; ?>">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- SEO Meta Tags -->
    <title><?php echo htmlspecialchars($page_meta['title']); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($page_meta['meta_description']); ?>" />
    <meta name="keywords" content="<?php echo htmlspecialchars($page_meta['meta_keywords']); ?>" />
    <link rel="canonical" href="<?php echo htmlspecialchars($page_meta['canonical']); ?>" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="<?php echo htmlspecialchars($page_meta['og_type']); ?>" />
    <meta property="og:title" content="<?php echo htmlspecialchars($page_meta['title']); ?>" />
    <meta property="og:description" content="<?php echo htmlspecialchars($page_meta['meta_description']); ?>" />
    <meta property="og:url" content="<?php echo htmlspecialchars($page_meta['canonical']); ?>" />
    <meta property="og:image" content="https://sunsari2.com/assets/images/og-image.jpg" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo htmlspecialchars($page_meta['title']); ?>" />
    <meta name="twitter:description" content="<?php echo htmlspecialchars($page_meta['meta_description']); ?>" />
    <meta name="twitter:image" content="https://sunsari2.com/assets/images/twitter-image.jpg" />

    <!-- Geographic Meta Tags -->
    <meta name="geo.region" content="<?php echo $geo_tags['geo.region']; ?>" />
    <meta name="geo.placename" content="<?php echo $geo_tags['geo.placename']; ?>" />
    <meta name="geo.position" content="<?php echo $geo_tags['geo.position']; ?>" />
    <meta name="ICBM" content="<?php echo $geo_tags['ICBM']; ?>" />

    <!-- Hreflang tags for multilingual SEO -->
    <link rel="alternate" hreflang="en" href="https://sunsari2.com/<?php echo $current_page_key; ?>?lang=en" />
    <link rel="alternate" hreflang="ne" href="https://sunsari2.com/<?php echo $current_page_key; ?>?lang=ne" />
    <link rel="alternate" hreflang="x-default" href="https://sunsari2.com/<?php echo $current_page_key; ?>" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/favicon/favicon.ico" />
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png" />
    <link rel="manifest" href="/assets/favicon/site.webmanifest" />

    <!-- Styles and Fonts -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#DC143C",
                        "secondary": "#1E40AF",
                        "background-light": "#f8f6f6",
                        "background-dark": "#211114",
                    },
                    fontFamily: {
                        "display": ["Public Sans", "sans-serif"],
                        "news": ["Newsreader", "serif"],
                    },
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Public Sans', sans-serif; }
        .font-news { font-family: 'Newsreader', serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>

    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    <?php
        $breadcrumb_schema = generate_breadcrumbs($page_meta['title']);
        echo $breadcrumb_schema;
    ?>
    </script>
    <?php if ($current_page_key === 'index' && isset($schema_place)): ?>
    <script type="application/ld+json">
        <?php echo json_encode($schema_place, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
    </script>
    <?php elseif ($current_page_key === 'candidate' && isset($schema_person)): ?>
    <script type="application/ld+json">
        <?php echo json_encode($schema_person, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
    </script>
    <script type="application/ld+json">
        <?php echo json_encode($campaign_office_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
    </script>
    <?php endif; ?>

    <!-- Google Analytics 4 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-XXXXXXXXXX');
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen">

    <!-- Universal Header Section -->
    <header class="bg-primary text-white py-6 px-4 md:px-12 shadow-lg">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
            <a href="/" class="flex items-center gap-4 group">
                <div class=" p-2 rounded-lg shadow-sm">
                    <img src="/assets/images/logo.png" alt="Sunsari-2 Logo" class="h-14 w-auto object-contain">
                </div>
                <div>
                    <h1 class="text-2xl font-bold leading-tight">Sunsari-2 Constituency</h1>
                    <p class="text-white/80 text-sm">Koshi Province, Nepal • Data Management System</p>
                </div>
            </a>
            <nav class="flex gap-4">
                <a href="/" class="text-white/80 hover:text-white font-bold">Home</a>
                <a href="/candidate" class="text-white/80 hover:text-white font-bold">Candidate</a>
                <a href="/blog.php" class="text-white/80 hover:text-white font-bold">Blog</a>
            </nav>
        </div>
    </header>

<?php
/**
 * Blog Meta Component - SEO, Schema Markup, and Social Media Optimization
 * This file generates all necessary meta tags, JSON-LD schema, and SEO elements
 * for individual blog posts in Sunsari-2 constituency website.
 */

// Load blog data
$blog_data_file = __DIR__ . '/../data/blog_data.json';
$all_blog_posts = [];

if (file_exists($blog_data_file)) {
    $json_content = file_get_contents($blog_data_file);
    $all_blog_posts = json_decode($json_content, true);
}

// Find current post by ID
$current_post = null;
if (isset($blogId)) {
    foreach ($all_blog_posts as $post) {
        if ($post['id'] == $blogId) {
            $current_post = $post;
            break;
        }
    }
}

// Default values if post not found
if (!$current_post) {
    $current_post = [
        'title' => $pageTitle ?? 'Blog Post',
        'author' => 'Admin',
        'date' => date('Y-m-d'),
        'category' => 'General',
        'image_url' => 'assets/images/news/sujan-lama.jpg',
        'alt_text' => 'Sunsari-2 News',
        'summary' => 'Latest news and updates from Sunsari-2 constituency.',
        'content' => ''
    ];
}

// Generate clean URL-friendly slug
function generateSlug($title) {
    $slug = strtolower(trim($title));
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    $slug = trim($slug, '-');
    return substr($slug, 0, 50);
}

// SEO Variables
$post_title = htmlspecialchars($current_post['title']);
$post_author = htmlspecialchars($current_post['author']);
$post_date = $current_post['date'];
$post_category = htmlspecialchars($current_post['category']);
$post_image = $current_post['image_url'];
$post_summary = htmlspecialchars($current_post['summary']);
$post_url = 'https://sunsari2.com/blogs/sunsari/' . generateSlug($current_post['title']) . '.php';
$site_name = 'Sunsari-2 Constituency - Koshi Province Nepal';
$post_keywords = 'Sujan Lama, Sunsari-2, ' . $post_category . ', Koshi Province, Nepal, ' . $post_title;

// Get related posts (same category)
$related_posts = [];
$related_count = 0;
foreach ($all_blog_posts as $post) {
    if ($post['id'] != $current_post['id'] && $post['category'] == $current_post['category'] && $related_count < 3) {
        $related_posts[] = $post;
        $related_count++;
    }
}

// If not enough related posts, add recent posts
if (count($related_posts) < 3) {
    foreach ($all_blog_posts as $post) {
        if ($post['id'] != $current_post['id'] && !in_array($post, $related_posts) && $related_count < 3) {
            $related_posts[] = $post;
            $related_count++;
        }
    }
}

// JSON-LD Schema Markup
$schema_article = [
    "@context" => "https://schema.org",
    "@type" => "NewsArticle",
    "headline" => $post_title,
    "description" => $post_summary,
    "image" => [
        "@type" => "ImageObject",
        "url" => "https://sunsari2.com/" . $post_image,
        "width" => 1200,
        "height" => 630
    ],
    "datePublished" => date('c', strtotime($post_date)),
    "dateModified" => date('c', strtotime($post_date)),
    "author" => [
        "@type" => "Person",
        "name" => $post_author,
        "url" => "https://sujanlama.com"
    ],
    "publisher" => [
        "@type" => "Organization",
        "name" => $site_name,
        "logo" => [
            "@type" => "ImageObject",
            "url" => "https://sunsari2.com/assets/images/logo.png"
        ]
    ],
    "mainEntityOfPage" => [
        "@type" => "WebPage",
        "@id" => $post_url
    ],
    "articleSection" => $post_category,
    "keywords" => $post_keywords,
    "about" => [
        "@type" => "Place",
        "name" => "Sunsari-2 Constituency",
        "address" => [
            "@type" => "PostalAddress",
            "addressLocality" => "Itahari",
            "addressRegion" => "Koshi Province",
            "addressCountry" => "NP"
        ]
    ]
];

// BreadcrumbList Schema
$breadcrumb_schema = [
    "@context" => "https://schema.org",
    "@type" => "BreadcrumbList",
    "itemListElement" => [
        [
            "@type" => "ListItem",
            "position" => 1,
            "name" => "Home",
            "item" => "https://sunsari2.com/"
        ],
        [
            "@type" => "ListItem",
            "position" => 2,
            "name" => "Blog",
            "item" => "https://sunsari2.com/blogs.php"
        ],
        [
            "@type" => "ListItem",
            "position" => 3,
            "name" => $post_title,
            "item" => $post_url
        ]
    ]
];

// Person Schema for Sujan Lama
$person_schema = [
    "@context" => "https://schema.org",
    "@type" => "Person",
    "name" => "Sujan Lama",
    "jobTitle" => "Political Leader",
    "affiliation" => [
        "@type" => "Organization",
        "name" => "Sunsari-2 Constituency"
    ],
    "address" => [
        "@type" => "PostalAddress",
        "addressLocality" => "Itahari",
        "addressRegion" => "Koshi Province",
        "addressCountry" => "NP"
    ],
    "url" => "https://sujanlama.com",
    "knowsAbout" => ["Politics", "Governance", "Community Development", "Agriculture", "Education", "Healthcare"]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Primary Meta Tags -->
    <title><?php echo $post_title; ?> | Sunsari-2 Constituency - Sujan Lama</title>
    <meta name="title" content="<?php echo $post_title; ?> | Sunsari-2 Constituency">
    <meta name="description" content="<?php echo $post_summary; ?>">
    <meta name="keywords" content="<?php echo $post_keywords; ?>">
    <meta name="author" content="<?php echo $post_author; ?>">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="revisit-after" content="7 days">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo $post_url; ?>">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?php echo $post_url; ?>">
    <meta property="og:title" content="<?php echo $post_title; ?>">
    <meta property="og:description" content="<?php echo $post_summary; ?>">
    <meta property="og:image" content="https://sunsari2.com/<?php echo $post_image; ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="<?php echo $site_name; ?>">
    <meta property="og:locale" content="en_US">
    <meta property="article:published_time" content="<?php echo date('c', strtotime($post_date)); ?>">
    <meta property="article:author" content="<?php echo $post_author; ?>">
    <meta property="article:section" content="<?php echo $post_category; ?>">
    <meta property="article:tag" content="Sujan Lama, Sunsari-2, <?php echo $post_category; ?>">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo $post_url; ?>">
    <meta name="twitter:title" content="<?php echo $post_title; ?>">
    <meta name="twitter:description" content="<?php echo $post_summary; ?>">
    <meta name="twitter:image" content="https://sunsari2.com/<?php echo $post_image; ?>">
    <meta name="twitter:creator" content="@SujanLama">
    <meta name="twitter:site" content="@Sunsari2">
    
    <!-- Geographic Meta Tags -->
    <meta name="geo.region" content="NP-P1">
    <meta name="geo.placename" content="Sunsari District">
    <meta name="geo.position" content="26.6544;87.2718">
    <meta name="ICBM" content="26.6544, 87.2718">
    
    <!-- Additional SEO Meta Tags -->
    <meta name="category" content="<?php echo $post_category; ?>">
    <meta name="coverage" content="Worldwide">
    <meta name="distribution" content="Global">
    <meta name="rating" content="General">
    <meta name="copyright" content="Sunsari-2 Constituency">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/images/favicon.ico">
    <link rel="apple-touch-icon" href="../../assets/images/apple-touch-icon.png">
    
    <!-- Fonts and Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#DC143C",
                        "secondary": "#1E40AF",
                    },
                    fontFamily: {
                        "display": ["Public Sans", "sans-serif"],
                    },
                },
            },
        }
    </script>
    
    <style>
        body { font-family: "Public Sans", sans-serif; }
        .material-symbols-outlined { font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24; }
        .prose { max-width: 100%; }
        .prose p { margin-bottom: 1.5rem; line-height: 1.8; color: #374151; }
        .prose h3 { margin-top: 2rem; margin-bottom: 1rem; }
        .prose ul { margin-bottom: 1.5rem; }
        .prose ul li { margin-bottom: 0.5rem; }
    </style>
    
    <!-- JSON-LD Schema Markup -->
    <script type="application/ld+json">
    <?php echo json_encode($schema_article, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
    </script>
    
    <script type="application/ld+json">
    <?php echo json_encode($breadcrumb_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
    </script>
    
    <script type="application/ld+json">
    <?php echo json_encode($person_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
    </script>
    
    <!-- Preconnect for Performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.tailwindcss.com">
</head>
<body class="bg-gray-50">
    
    </header>
    
    <!-- Breadcrumbs -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <nav class="flex items-center gap-2 text-sm">
                <a href="../../index.php" class="text-primary hover:underline">Home</a>
                <span class="material-symbols-outlined text-xs text-gray-400">chevron_right</span>
                <a href="../../blogs.php" class="text-primary hover:underline">Blog</a>
                <span class="material-symbols-outlined text-xs text-gray-400">chevron_right</span>
                <span class="text-gray-600 truncate max-w-md"><?php echo $post_title; ?></span>
            </nav>
        </div>
    </div>
<?php
// Make related posts available globally
$GLOBALS['related_posts'] = $related_posts;
$GLOBALS['current_post'] = $current_post;
?>

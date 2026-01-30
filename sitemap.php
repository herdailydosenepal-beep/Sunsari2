<?php
// Set the header to output XML
header('Content-Type: application/xml; charset=utf-8');

// Base URL of the website
$baseUrl = 'https://yourdomain.com';

// Array of pages to include in the sitemap
// In a more advanced setup, this could be generated from a database
$pages = [
    [
        'loc' => '/',
        'lastmod' => date('Y-m-d'),
        'changefreq' => 'weekly',
        'priority' => '1.0'
    ],
    [
        'loc' => '/candidate.php',
        'lastmod' => date('Y-m-d'),
        'changefreq' => 'monthly',
        'priority' => '0.9'
    ],
    [
        'loc' => '/blogs.php',
        'lastmod' => date('Y-m-d'),
        'changefreq' => 'daily',
        'priority' => '0.8'
    ]
];

// Start the XML output
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

// Loop through the pages and generate the XML for each
foreach ($pages as $page) {
    echo '<url>';
    echo '<loc>' . $baseUrl . htmlspecialchars($page['loc']) . '</loc>';
    echo '<lastmod>' . htmlspecialchars($page['lastmod']) . '</lastmod>';
    echo '<changefreq>' . htmlspecialchars($page['changefreq']) . '</changefreq>';
    echo '<priority>' . htmlspecialchars($page['priority']) . '</priority>';
    echo '</url>';
}

// End the XML output
echo '</urlset>';
?>

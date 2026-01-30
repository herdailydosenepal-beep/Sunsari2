<?php
require_once '../includes/header.php';

$post_id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : null;

// Ensure blog_data is loaded and is an array
if (!isset($blog_data) || !is_array($blog_data)) {
    $blog_data = [];
}

// If no ID specified, show the blog listing page with blog_section
if (!$post_id) {
    ?>
    <main class="max-w-7xl mx-auto p-4 md:p-8 space-y-12">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-sm font-medium">
            <a class="text-primary hover:underline" href="index.php">Home</a>
            <span class="material-symbols-outlined text-xs text-slate-400">chevron_right</span>
            <span class="text-slate-500">All Articles</span>
        </nav>
        
        <?php require_once '../includes/blog_section.php'; ?>
    </main>
    <?php
    require_once '../includes/footer.php';
    exit;
}

// Otherwise, show single post view
$found_post = null;
foreach ($blog_data as $post) {
    if ($post['id'] == $post_id) {
        $found_post = $post;
        break;
    }
}

if (!$found_post) {
    ?>
    <main class="max-w-7xl mx-auto px-6 py-8">
        <p class="text-center text-red-500">Blog post not found.</p>
        <p class="text-center mt-4">
            <a href="blogs.php" class="text-primary hover:underline font-bold">← Back to all articles</a>
        </p>
    </main>
    <?php
    require_once 'includes/footer.php';
    exit;
}

$display_posts = [$found_post];
?>

<!-- Single Post View -->
<main class="max-w-[1200px] mx-auto px-6 py-8">
    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-2 mb-6 text-sm font-medium">
        <a class="text-primary hover:underline" href="index.php">Home</a>
        <span class="material-symbols-outlined text-xs text-slate-400">chevron_right</span>
        <a class="text-primary hover:underline" href="blogs.php">News</a>
        <span class="material-symbols-outlined text-xs text-slate-400">chevron_right</span>
        <span class="text-slate-500 truncate max-w-xs"><?php echo htmlspecialchars($found_post['title']); ?></span>
    </nav>
    
    <div class="flex flex-col lg:flex-row gap-12">
        <!-- Main Blog Post Section -->
        <div class="flex-1">
            <article class="bg-white dark:bg-zinc-900/50 p-0 md:p-8 rounded-xl border border-slate-100 dark:border-zinc-800">
                <!-- Article Header -->
                <header class="mb-8">
                    <h1 class="text-secondary text-4xl md:text-5xl font-extrabold tracking-tight leading-tight mb-4">
                        <?php echo htmlspecialchars($found_post['title']); ?>
                    </h1>
                    <div class="flex flex-wrap items-center gap-4 text-slate-500 text-sm mb-8 font-sans">
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-primary text-lg">person</span>
                            <span class="font-bold text-slate-700"><?php echo htmlspecialchars($found_post['author']); ?></span>
                        </div>
                        <span class="hidden sm:inline">•</span>
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-primary text-lg">calendar_today</span>
                            <span><?php echo date('F d, Y', strtotime($found_post['date'])); ?></span>
                        </div>
                        <span class="hidden sm:inline">•</span>
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-primary text-lg">schedule</span>
                            <span><?php echo calculate_reading_time($found_post['content'] ?? ''); ?> min read</span>
                        </div>
                        <span class="hidden sm:inline">•</span>
                        <div class="bg-secondary/10 text-secondary px-2.5 py-0.5 rounded text-xs font-bold uppercase tracking-wider">
                            <?php echo htmlspecialchars($found_post['category']); ?>
                        </div>
                    </div>
                    <!-- Featured Image -->
                    <div class="w-full h-[400px] bg-center bg-no-repeat bg-cover rounded-xl overflow-hidden border border-slate-200"
                        data-alt="<?php echo htmlspecialchars($found_post['alt_text']); ?>"
                        style='background-image: url("<?php echo htmlspecialchars($found_post['image_url']); ?>");'>
                    </div>
                </header>
                <!-- Article Content -->
                <div class="prose prose-lg max-w-none text-slate-800 leading-relaxed space-y-6">
                    <p class="text-xl leading-relaxed text-slate-600 italic">
                        <?php echo htmlspecialchars($found_post['summary']); ?>
                    </p>
                    <?php echo $found_post['content']; ?>
                </div>
                
                <!-- Back to Blog Link -->
                <div class="mt-12 pt-6 border-t border-slate-200">
                    <a href="blogs.php" class="inline-flex items-center gap-2 text-primary hover:text-primary/80 font-bold transition">
                        <span class="material-symbols-outlined">arrow_back</span>
                        Back to all articles
                    </a>
                </div>
            </article>
        </div>

        <!-- Right Sidebar -->
        <aside class="w-full lg:w-[320px] shrink-0">
            <div class="sticky top-24 space-y-8">
                <!-- Recent Posts Widget -->
                <div class="bg-white dark:bg-zinc-900 border border-slate-100 dark:border-zinc-800 rounded-xl overflow-hidden">
                    <div class="bg-secondary text-white px-5 py-3 font-bold text-sm tracking-wide uppercase">
                        Recent Posts
                    </div>
                    <div class="p-5 space-y-6">
                        <?php
                        // Sort blog data by date for recent posts
                        if (!empty($blog_data) && is_array($blog_data)):
                            $sorted_blog_data = $blog_data;
                            usort($sorted_blog_data, function($a, $b) {
                                return strtotime($b['date']) - strtotime($a['date']);
                            });
                            $recent_posts = array_slice($sorted_blog_data, 0, 5); // Get top 5 recent posts
                        ?>
                            <?php foreach ($recent_posts as $recent_post): 
                                if ($recent_post['id'] == $found_post['id']) continue; // Skip current post
                            ?>
                                <a class="group block" href="blogs.php?id=<?php echo htmlspecialchars($recent_post['id']); ?>">
                                    <h4 class="text-secondary font-bold text-sm leading-snug group-hover:underline"><?php echo htmlspecialchars($recent_post['title']); ?></h4>
                                    <span class="text-slate-400 text-[11px] uppercase tracking-tighter"><?php echo date('M d, Y', strtotime($recent_post['date'])); ?></span>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-slate-500 text-sm">No recent posts available.</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- About Section -->
                <div class="bg-white dark:bg-zinc-900 border border-slate-100 dark:border-zinc-800 rounded-xl overflow-hidden p-5">
                    <h3 class="font-bold text-lg mb-3">About Sujan Lama</h3>
                    <img src="assets/images/news/sujan-lama.jpg" alt="Sujan Lama" class="w-full h-48 object-cover rounded-lg mb-3">
                    <p class="text-sm text-slate-600 mb-4">Visionary leader committed to the development of Sunsari-2 constituency.</p>
                    <a href="https://sujanlama.com" target="_blank" class="block bg-primary text-white text-center py-2 rounded-lg font-bold hover:bg-primary/90 transition">
                        Learn More
                    </a>
                </div>
            </div>
        </aside>
    </div>
</main>

<?php require_once '../includes/footer.php'; ?>

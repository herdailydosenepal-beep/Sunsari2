<?php
require_once 'includes/header.php';

$post_id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : null;
$display_posts = [];
$current_post_title = "News & Political Updates"; // Default for listing page

if ($post_id) {
    $found_post = null;
    foreach ($blog_data as $post) {
        if ($post['id'] == $post_id) {
            $found_post = $post;
            break;
        }
    }

    if ($found_post) {
        $display_posts[] = $found_post;
        $current_post_title = $found_post['title']; // Update for single post view
    } else {
        // Post not found
        echo '<main class="max-w-[1200px] mx-auto px-6 py-8"><p class="text-center text-red-500">Blog post not found.</p></main>';
        require_once 'includes/footer.php';
        exit;
    }
} else {
    // No ID specified, display all blog posts (listing page behavior)
    $display_posts = $blog_data;
}

?>

<!-- Main Content Container -->
<main class="max-w-[1200px] mx-auto px-6 py-8">
    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-2 mb-6 text-sm font-medium">
        <a class="text-primary hover:underline" href="index.php">Home</a>
        <span class="material-symbols-outlined text-xs text-slate-400">chevron_right</span>
        <a class="text-primary hover:underline" href="blogs.php">News</a>
        <?php if ($post_id && $found_post): // Only show specific title if a post was successfully found and displayed ?>
            <span class="material-symbols-outlined text-xs text-slate-400">chevron_right</span>
            <span class="text-slate-500 truncate max-w-xs"><?php echo htmlspecialchars($found_post['title']); ?></span>
        <?php endif; ?>
    </nav>
    <div class="flex flex-col lg:flex-row gap-12">
        <!-- Main Blog Posts Section -->
        <div class="flex-1 space-y-8">
            <?php if (!empty($display_posts)): ?>
                <?php foreach ($display_posts as $post): ?>
                    <article class="bg-white dark:bg-zinc-900/50 p-0 md:p-8 rounded-xl border border-slate-100 dark:border-zinc-800 mb-8">
                        <!-- Article Header -->
                        <header class="mb-8">
                            <h1 class="text-secondary text-4xl md:text-5xl font-extrabold tracking-tight leading-tight mb-4">
                                <?php echo htmlspecialchars($post['title']); ?>
                            </h1>
                            <div class="flex flex-wrap items-center gap-4 text-slate-500 text-sm mb-8 font-sans">
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-primary text-lg">person</span>
                                    <span class="font-bold text-slate-700"><?php echo htmlspecialchars($post['author']); ?></span>
                                </div>
                                <span class="hidden sm:inline">•</span>
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-primary text-lg">calendar_today</span>
                                    <span><?php echo date('F d, Y', strtotime($post['date'])); ?></span>
                                </div>
                                <span class="hidden sm:inline">•</span>
                                <div class="bg-secondary/10 text-secondary px-2.5 py-0.5 rounded text-xs font-bold uppercase tracking-wider">
                                    <?php echo htmlspecialchars($post['category']); ?>
                                </div>
                            </div>
                            <!-- Featured Image -->
                            <div class="w-full h-[400px] bg-center bg-no-repeat bg-cover rounded-xl overflow-hidden border border-slate-200"
                                data-alt="<?php echo htmlspecialchars($post['alt_text']); ?>"
                                style='background-image: url("<?php echo htmlspecialchars($post['image_url']); ?>");'>
                            </div>
                        </header>
                        <!-- Article Content -->
                        <div class="prose prose-lg max-w-none text-slate-800 leading-relaxed space-y-6">
                            <p class="text-xl leading-relaxed text-slate-600 italic">
                                <?php echo htmlspecialchars($post['summary']); ?>
                            </p>
                            <?php echo $post['content']; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No blog posts found.</p>
            <?php endif; ?>
        </div>

        <!-- Right Sidebar -->
        <aside class="w-full lg:w-[320px] shrink-0">
            <div class="sticky top-24 space-y-8">
                <!-- Related Articles Widget -->
                <div class="bg-white dark:bg-zinc-900 border border-slate-100 dark:border-zinc-800 rounded-xl overflow-hidden">
                    <div class="bg-secondary text-white px-5 py-3 font-bold text-sm tracking-wide uppercase">
                        Recent Posts
                    </div>
                    <div class="p-5 space-y-6">
                        <?php
                        // Sort blog data by date for recent posts
                        usort($blog_data, function($a, $b) {
                            return strtotime($b['date']) - strtotime($a['date']);
                        });
                        $recent_posts = array_slice($blog_data, 0, 2); // Get top 2 recent posts
                        ?>
                        <?php foreach ($recent_posts as $recent_post): ?>
                            <a class="group block" href="blogs.php?id=<?php echo htmlspecialchars($recent_post['id']); ?>">
                                <h4 class="text-secondary font-bold text-sm leading-snug group-hover:underline"><?php echo htmlspecialchars($recent_post['title']); ?></h4>
                                <span class="text-slate-400 text-[11px] uppercase tracking-tighter"><?php echo date('M d, Y', strtotime($recent_post['date'])); ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>
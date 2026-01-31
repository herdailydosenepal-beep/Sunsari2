<?php
require_once 'includes/header.php';
?>

<main class="min-h-[70vh] flex items-center justify-center bg-gradient-to-br from-slate-50 to-slate-100 dark:from-zinc-900 dark:to-zinc-800">
    <div class="max-w-2xl mx-auto px-6 py-16 text-center">
        <!-- 404 Icon -->
        <div class="mb-8">
            <span class="material-symbols-outlined text-primary" style="font-size: 120px;">
                error_outline
            </span>
        </div>
        
        <!-- Error Message -->
        <h1 class="text-secondary text-6xl md:text-7xl font-black tracking-tight mb-4">
            404
        </h1>
        <h2 class="text-slate-700 dark:text-slate-300 text-2xl md:text-3xl font-bold mb-6">
            Page Not Found
        </h2>
        <p class="text-slate-600 dark:text-slate-400 text-lg mb-8 leading-relaxed">
            The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
        </p>
        
        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="/index.php" class="inline-flex items-center gap-2 bg-primary text-white px-8 py-3 rounded-lg font-bold hover:bg-primary/90 transition-colors">
                <span class="material-symbols-outlined">home</span>
                Go to Homepage
            </a>
            <a href="/blogs" class="inline-flex items-center gap-2 bg-secondary text-white px-8 py-3 rounded-lg font-bold hover:bg-secondary/90 transition-colors">
                <span class="material-symbols-outlined">article</span>
                Read Latest News
            </a>
        </div>
        
        <!-- Quick Links -->
        <div class="mt-12 pt-8 border-t border-slate-200 dark:border-zinc-700">
            <p class="text-slate-500 text-sm mb-4">Quick Links:</p>
            <div class="flex flex-wrap justify-center gap-6 text-sm">
                <a href="/" class="text-primary hover:underline font-medium">Home</a>
                <a href="/candidate" class="text-primary hover:underline font-medium">Candidates</a>
                <a href="/blogs" class="text-primary hover:underline font-medium">Blog</a>
            </div>
        </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>

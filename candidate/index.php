<?php require_once '../includes/header.php'; ?>

<?php
// Get candidate ID from URL
$candidate_id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : null;

// Find the candidate
$selected_candidate = null;
if ($candidate_id && !empty($candidates_data['candidates'])) {
    foreach ($candidates_data['candidates'] as $cand) {
        if ($cand['id'] == $candidate_id) {
            $selected_candidate = $cand;
            break;
        }
    }
}

// If no ID or candidate not found, show all candidates with Sujan Lama featured
if (!$selected_candidate) {
    ?>
    <main class="max-w-7xl mx-auto p-4 md:p-8">
        <!-- Page Header -->
        <div class="mb-10">
            <nav class="flex items-center gap-2 text-sm font-medium mb-4">
                <a class="text-primary hover:underline" href="../index.php">Home</a>
                <span class="material-symbols-outlined text-xs text-slate-400">chevron_right</span>
                <span class="text-slate-500">Candidates</span>
            </nav>
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white mb-3 tracking-tight">
                Election Candidates <span class="text-primary">2026</span>
            </h1>
            <p class="text-lg text-slate-600 dark:text-slate-400 font-medium">
                House of Representatives • Sunsari-2 Constituency • Koshi Province, Nepal
            </p>
        </div>

        <?php if (!empty($candidates_data['candidates'])): ?>
            <?php
            // Separate featured and other candidates
            $featured_candidate = null;
            $other_candidates = [];
            
            foreach ($candidates_data['candidates'] as $candidate) {
                if ($candidate['featured'] ?? false) {
                    $featured_candidate = $candidate;
                } else {
                    $other_candidates[] = $candidate;
                }
            }
            ?>

            <!-- Featured Candidate - Sujan Lama -->
            <?php if ($featured_candidate): ?>
                <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl p-6 md:p-10 mb-12">
                    <div class="flex flex-col lg:flex-row gap-10 items-start">
                        <!-- Candidate Photo -->
                        <div class="w-full lg:w-[400px] flex-shrink-0">
                            <div class="relative">
                                <div class="aspect-[4/5] rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-700 border border-slate-200 dark:border-slate-600">
                                    <img src="../<?php echo htmlspecialchars($featured_candidate['image']); ?>" 
                                         alt="<?php echo htmlspecialchars($featured_candidate['name']); ?>"
                                         class="w-full h-full object-cover"
                                         onerror="this.src='../assets/images/news/sujan-lama.jpg'">
                                </div>
                                <div class="absolute top-4 left-4 bg-primary text-white px-4 py-2 rounded-lg font-bold text-xs uppercase tracking-widest flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm">star</span>
                                    Featured Candidate
                                </div>
                            </div>
                        </div>
                        
                        <!-- Candidate Info -->
                        <div class="flex-1 space-y-6">
                            <div>
                                <h2 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white mb-4 leading-tight">
                                    <?php echo htmlspecialchars($featured_candidate['name']); ?>
                                </h2>
                                <div class="flex flex-wrap items-center gap-3">
                                    <span class="bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 px-4 py-1.5 rounded-full text-sm font-bold border border-red-100 dark:border-red-900/30">
                                        <?php echo htmlspecialchars($featured_candidate['party']); ?>
                                    </span>
                                    <span class="bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 px-4 py-1.5 rounded-full text-sm font-bold border border-blue-100 dark:border-blue-900/30">
                                        <?php echo htmlspecialchars($featured_candidate['position']); ?>
                                    </span>
                                </div>
                            </div>

                            <p class="text-xl italic text-slate-500 font-medium leading-relaxed border-l-4 border-primary pl-6 py-2">
                                "<?php echo htmlspecialchars($featured_candidate['slogan']); ?>"
                            </p>
                            
                            <p class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
                                <?php echo htmlspecialchars($featured_candidate['description']); ?>
                            </p>
                            
                            <!-- Stats Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 py-4 border-y border-slate-100 dark:border-slate-700">
                                <div>
                                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 flex items-center gap-2">
                                        <span class="material-symbols-outlined text-sm text-primary">school</span>
                                        Education
                                    </h4>
                                    <p class="font-bold text-slate-800 dark:text-white">
                                        <?php echo htmlspecialchars($featured_candidate['education']); ?>
                                    </p>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 flex items-center gap-2">
                                        <span class="material-symbols-outlined text-sm text-primary">work</span>
                                        Experience
                                    </h4>
                                    <p class="font-bold text-slate-800 dark:text-white">
                                        <?php echo htmlspecialchars($featured_candidate['experience']); ?>
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Focus Areas -->
                            <div>
                                <h3 class="font-bold text-slate-800 dark:text-white mb-4 text-sm uppercase tracking-widest flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">ads_click</span>
                                    Key Focus Areas
                                </h3>
                                <div class="flex flex-wrap gap-2">
                                    <?php foreach ($featured_candidate['focus_areas'] as $area): ?>
                                        <span class="bg-slate-50 dark:bg-slate-900 text-slate-700 dark:text-slate-300 px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 text-sm font-bold">
                                            <?php echo htmlspecialchars($area); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex flex-wrap gap-4 pt-4">
                                <?php if (!empty($featured_candidate['contact']['website'])): ?>
                                    <a href="<?php echo htmlspecialchars($featured_candidate['contact']['website']); ?>" 
                                       target="_blank"
                                       class="bg-red-600 hover:bg-red-700 text-white px-8 py-4 rounded-xl font-bold flex items-center gap-2">
                                        <span class="material-symbols-outlined">language</span>
                                        Visit Website
                                    </a>
                                <?php endif; ?>
                                <a href="../blogs/index.php?search=<?php echo urlencode($featured_candidate['name']); ?>" 
                                   class="bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-800 dark:text-white border border-slate-200 dark:border-slate-700 px-8 py-4 rounded-xl font-bold flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">article</span>
                                    Read Updates
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Other Candidates -->
            <?php if (!empty($other_candidates)): ?>
                <div class="space-y-6">
                    <h2 class="text-2xl font-black text-slate-800 dark:text-white uppercase tracking-widest flex items-center gap-3">
                        <span class="h-1 w-12 bg-primary"></span>
                        Other Candidates
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php foreach ($other_candidates as $candidate): ?>
                            <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-100 dark:border-slate-700 p-5">
                                <div class="flex gap-6 items-center">
                                    <div class="w-32 h-32 rounded-lg overflow-hidden bg-slate-100 dark:bg-slate-700 flex-shrink-0 border border-slate-200 dark:border-slate-600">
                                        <img src="../<?php echo htmlspecialchars($candidate['image']); ?>" 
                                             alt="<?php echo htmlspecialchars($candidate['name']); ?>"
                                             class="w-full h-full object-cover"
                                             onerror="this.src='../assets/images/news/sujan-lama.jpg'">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-xl font-black text-slate-900 dark:text-white mb-1 truncate">
                                            <?php echo htmlspecialchars($candidate['name']); ?>
                                        </h3>
                                        <p class="text-primary font-bold text-sm mb-3">
                                            <?php echo htmlspecialchars($candidate['party']); ?>
                                        </p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium line-clamp-2 mb-4">
                                            <?php echo htmlspecialchars($candidate['description']); ?>
                                        </p>
                                        <div class="flex flex-wrap gap-2">
                                            <?php foreach (array_slice($candidate['focus_areas'], 0, 2) as $area): ?>
                                                <span class="text-[10px] uppercase tracking-wider bg-slate-50 dark:bg-slate-900 px-2 py-1 rounded border border-slate-200 dark:border-slate-700 text-slate-500 font-bold">
                                                    <?php echo htmlspecialchars($area); ?>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

        <?php else: ?>
            <div class="text-center py-20 bg-white dark:bg-slate-800 rounded-2xl border border-slate-100">
                <span class="material-symbols-outlined text-slate-200 text-8xl mb-4 block">person_off</span>
                <p class="text-slate-400 text-lg font-bold">No candidate profiles currently available.</p>
            </div>
        <?php endif; ?>
    </main>
    <?php
} else {
    // Show individual candidate detail (can be implemented if needed)
    header("Location: index.php");
    exit();
}
?>

<?php require_once '../includes/footer.php'; ?>

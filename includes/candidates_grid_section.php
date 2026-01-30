<!-- Candidates Section -->
<section>
    <div class="flex items-center gap-3 mb-6">
        <span class="material-symbols-outlined text-primary text-3xl">how_to_vote</span>
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Candidates for Sunsari-2</h2>
    </div>
    
    <?php if (!empty($candidates_data['candidates']) && is_array($candidates_data['candidates'])): ?>
        <?php
        // Separate featured (Sujan Lama) and other candidates
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
            <div class="bg-gradient-to-br from-primary/5 to-secondary/5 border-2 border-primary/20 rounded-2xl p-8 mb-8 shadow-lg">
                <div class="flex flex-col md:flex-row gap-8 items-start">
                    <!-- Candidate Photo -->
                    <div class="w-full md:w-64 flex-shrink-0">
                        <div class="relative">
                            <div class="aspect-square rounded-2xl overflow-hidden bg-slate-200 dark:bg-slate-700 border-4 border-white dark:border-slate-600 shadow-xl">
                                <img src="<?php echo htmlspecialchars($featured_candidate['image']); ?>" 
                                     alt="<?php echo htmlspecialchars($featured_candidate['name']); ?>"
                                     class="w-full h-full object-cover"
                                     onerror="this.src='assets/images/news/sujan-lama.jpg'">
                            </div>
                            <div class="absolute -top-4 -right-4 bg-primary text-white px-4 py-2 rounded-full font-bold text-sm shadow-lg">
                                <span class="material-symbols-outlined text-sm">star</span>
                                Featured
                            </div>
                        </div>
                    </div>
                    
                    <!-- Candidate Info -->
                    <div class="flex-1">
                        <div class="mb-4">
                            <h3 class="text-3xl font-bold text-slate-900 dark:text-white mb-2">
                                <?php echo htmlspecialchars($featured_candidate['name']); ?>
                            </h3>
                            <div class="flex flex-wrap items-center gap-3 mb-3">
                                <span class="bg-primary text-white px-4 py-1.5 rounded-full text-sm font-bold">
                                    <?php echo htmlspecialchars($featured_candidate['party']); ?>
                                </span>
                                <span class="text-slate-600 dark:text-slate-400 text-sm flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">person</span>
                                    <?php echo htmlspecialchars($featured_candidate['position']); ?>
                                </span>
                            </div>
                            <p class="text-lg italic text-secondary font-semibold mb-4">
                                "<?php echo htmlspecialchars($featured_candidate['slogan']); ?>"
                            </p>
                        </div>
                        
                        <p class="text-slate-700 dark:text-slate-300 mb-6 leading-relaxed">
                            <?php echo htmlspecialchars($featured_candidate['description']); ?>
                        </p>
                        
                        <!-- Education & Experience -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div class="bg-white dark:bg-slate-800 p-4 rounded-lg border border-slate-200 dark:border-slate-700">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="material-symbols-outlined text-secondary">school</span>
                                    <h4 class="font-bold text-slate-800 dark:text-white">Education</h4>
                                </div>
                                <p class="text-sm text-slate-600 dark:text-slate-400">
                                    <?php echo htmlspecialchars($featured_candidate['education']); ?>
                                </p>
                            </div>
                            <div class="bg-white dark:bg-slate-800 p-4 rounded-lg border border-slate-200 dark:border-slate-700">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="material-symbols-outlined text-secondary">work</span>
                                    <h4 class="font-bold text-slate-800 dark:text-white">Experience</h4>
                                </div>
                                <p class="text-sm text-slate-600 dark:text-slate-400">
                                    <?php echo htmlspecialchars($featured_candidate['experience']); ?>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Focus Areas -->
                        <div class="mb-6">
                            <h4 class="font-bold text-slate-800 dark:text-white mb-3 flex items-center gap-2">
                                <span class="material-symbols-outlined text-secondary">target</span>
                                Key Focus Areas
                            </h4>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach ($featured_candidate['focus_areas'] as $area): ?>
                                    <span class="bg-secondary/10 text-secondary px-3 py-1.5 rounded-lg text-sm font-medium border border-secondary/20">
                                        <?php echo htmlspecialchars($area); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <!-- Contact & Action Buttons -->
                        <div class="flex flex-wrap gap-3">
                            <a href="candidate.php" class="bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-lg font-bold transition-all flex items-center gap-2 shadow-md hover:shadow-lg">
                                <span class="material-symbols-outlined">person</span>
                                View Full Profile
                            </a>
                            <?php if (!empty($featured_candidate['contact']['website'])): ?>
                                <a href="<?php echo htmlspecialchars($featured_candidate['contact']['website']); ?>" 
                                   target="_blank"
                                   class="bg-secondary hover:bg-secondary/90 text-white px-6 py-3 rounded-lg font-bold transition-all flex items-center gap-2 shadow-md hover:shadow-lg">
                                    <span class="material-symbols-outlined">language</span>
                                    Visit Website
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- Other Candidates -->
        <?php if (!empty($other_candidates)): ?>
            <div>
                <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-4">Other Candidates</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php foreach ($other_candidates as $candidate): ?>
                        <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6 hover:shadow-lg transition-shadow">
                            <div class="flex gap-4">
                                <div class="w-24 h-24 rounded-lg overflow-hidden bg-slate-200 dark:bg-slate-700 flex-shrink-0">
                                    <img src="<?php echo htmlspecialchars($candidate['image']); ?>" 
                                         alt="<?php echo htmlspecialchars($candidate['name']); ?>"
                                         class="w-full h-full object-cover"
                                         onerror="this.src='assets/images/news/sujan-lama.jpg'">
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-1">
                                        <?php echo htmlspecialchars($candidate['name']); ?>
                                    </h4>
                                    <p class="text-sm text-primary font-semibold mb-2">
                                        <?php echo htmlspecialchars($candidate['party']); ?>
                                    </p>
                                    <p class="text-xs text-slate-600 dark:text-slate-400 mb-3">
                                        <?php echo htmlspecialchars($candidate['description']); ?>
                                    </p>
                                    <a href="candidate.php?id=<?php echo $candidate['id']; ?>" 
                                       class="text-secondary hover:text-secondary/80 font-bold text-sm flex items-center gap-1">
                                        View Profile
                                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
        
    <?php else: ?>
        <div class="text-center py-12 text-slate-500">
            <p>No candidates data available.</p>
        </div>
    <?php endif; ?>
</section>

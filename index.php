<?php require_once 'includes/header.php'; ?>

<main class="max-w-7xl mx-auto p-4 md:p-8 space-y-12">
    <section class="mt-8">
        <div class="flex items-center gap-3 mb-6">
            <span class="material-symbols-outlined text-primary text-3xl">badge</span>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Candidate Details</h2>
        </div>

        <div
            class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="h-1.5 bg-primary w-full"></div>

            <div class="p-0">
                <div class="flex flex-col md:flex-row items-stretch">

                    <div
                        class="md:w-1/3 lg:w-1/4 bg-slate-50 dark:bg-slate-900/30 border-b md:border-b-0 md:border-r border-slate-200 dark:border-slate-700">
                        <div class="p-6 flex flex-col items-center justify-center h-full">
                            <div
                                class="w-32 h-32 lg:w-40 lg:h-40 rounded-full overflow-hidden border-4 border-white dark:border-slate-700 shadow-md">
                                <img class="w-full h-full object-cover"
                                    alt="<?php echo htmlspecialchars($candidate_info['candidate']['name']); ?>"
                                    src="<?php echo htmlspecialchars($candidate_info['candidate']['image']); ?>" />
                            </div>
                            <span
                                class="mt-4 px-3 py-1 bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-widest rounded-full">
                                Official Candidate
                            </span>
                        </div>
                    </div>

                    <div class="p-6 md:p-8 flex-1 flex flex-col justify-center">
                        <div class="mb-4 text-center md:text-left">
                            <h3 class="text-3xl font-black text-slate-800 dark:text-white mb-1">
                                <?php echo htmlspecialchars($candidate_info['candidate']['name']); ?>
                            </h3>
                            <p
                                class="text-primary font-bold text-sm flex items-center justify-center md:justify-start gap-2">
                                <span><?php echo htmlspecialchars($candidate_info['candidate']['constituency']); ?></span>
                                <span class="text-slate-300">•</span>
                                <span
                                    class="text-slate-500 dark:text-slate-400 font-medium"><?php echo htmlspecialchars($candidate_info['candidate']['affiliation']); ?></span>
                            </p>
                        </div>

                        <div
                            class="bg-slate-50 dark:bg-slate-900/50 p-4 rounded-lg border border-slate-100 dark:border-slate-700 mb-6">
                            <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed italic">
                                "<?php echo htmlspecialchars($candidate_info['candidate']['key_message']); ?>"
                            </p>
                        </div>

                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 gap-0 border border-primary rounded-lg overflow-hidden">
                            <a href="https://sujanlama.com" target="_blank"
                                class="bg-primary text-white text-center py-3 font-bold hover:bg-opacity-90 transition-all text-sm">
                                Full Profile & Bio
                            </a>
                            <a href="https://forms.gle/cUi2Wy9VAPjMtcKH8" target="_blank"
                                class="bg-white dark:bg-transparent text-primary text-center py-3 font-bold hover:bg-primary/5 transition-all text-sm border-t sm:border-t-0 sm:border-l border-primary">
                                Contact Now
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- Section 2: Demographics -->
    <section>
        <div class="flex items-center gap-3 mb-6">
            <span class="material-symbols-outlined text-primary text-3xl">groups</span>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Demographics by Municipality</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <?php foreach ($index_data['demographics'] as $demo): ?>
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-sm overflow-hidden border border-slate-200 dark:border-slate-700">
                    <div class="bg-secondary text-white px-4 py-3 font-bold">
                        <?php echo htmlspecialchars($demo['name']); ?>
                        <?php echo isset($demo['wards']) ? '(' . htmlspecialchars($demo['wards']) . ')' : ''; ?>
                    </div>
                    <div class="p-5 space-y-4">
                        <div>
                            <p class="text-xs text-slate-500 uppercase font-bold tracking-tighter mb-1">Population
                                Breakdown
                            </p>
                            <div class="flex justify-between text-sm">
                                <span>Male: <?php echo htmlspecialchars($demo['male_population']); ?></span>
                                <span>Female: <?php echo htmlspecialchars($demo['female_population']); ?></span>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs mb-1 font-bold">
                                <span>Literacy Rate</span>
                                <span class="text-secondary"><?php echo htmlspecialchars($demo['literacy_rate']); ?></span>
                            </div>
                            <div class="w-full bg-slate-100 dark:bg-slate-700 h-2 rounded-full overflow-hidden">
                                <div class="bg-secondary h-full"
                                    style="width: <?php echo htmlspecialchars($demo['literacy_rate']); ?>;"></div>
                            </div>
                        </div>
                        <div class="pt-2 border-t border-slate-100 dark:border-slate-700 text-xs space-y-2">
                            <p><strong class="text-slate-800 dark:text-slate-200">Area:</strong>
                                <?php echo htmlspecialchars($demo['area']); ?>
                                <?php echo htmlspecialchars($demo['area_unit']); ?>
                            </p>
                            <p><strong class="text-slate-800 dark:text-slate-200">Main Groups:</strong>
                                <?php echo htmlspecialchars($demo['main_groups']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Section 3: Religious Places (Inaruwa Focus) -->
        <section>
            <div class="flex items-center gap-3 mb-6">
                <span class="material-symbols-outlined text-primary text-3xl">synagogue</span>
                <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Landmarks in Inaruwa</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <?php foreach ($index_data['landmarks'] as $landmark): ?>
                    <div
                        class="bg-white dark:bg-slate-800 p-4 rounded-xl border border-slate-200 dark:border-slate-700 flex gap-4">
                        <div
                            class="w-20 h-20 rounded-lg bg-slate-100 dark:bg-slate-700 flex-shrink-0 flex items-center justify-center">
                            <span
                                class="material-symbols-outlined text-secondary text-3xl"><?php echo htmlspecialchars($landmark['icon']); ?></span>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-800 dark:text-white">
                                <?php echo htmlspecialchars($landmark['name']); ?>
                            </h3>
                            <p class="text-sm text-slate-500 mb-2">
                                <?php echo htmlspecialchars($landmark['location']); ?>
                            </p>
                            <span
                                class="text-xs bg-slate-100 dark:bg-slate-700 px-2 py-1 rounded"><?php echo htmlspecialchars($landmark['type']); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <!-- Section 4: Key Issues -->
        <section>
            <div class="flex items-center gap-3 mb-6">
                <span class="material-symbols-outlined text-primary text-3xl">error</span>
                <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Key Constituency Issues</h2>
            </div>
            <div
                class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden h-[312px]">
                <div class="flex border-b border-slate-200 dark:border-slate-700">
                    <button
                        class="flex-1 py-4 text-sm font-bold border-b-2 border-secondary text-secondary bg-blue-50/50 dark:bg-blue-900/10">Rural</button>
                    <button
                        class="flex-1 py-4 text-sm font-bold border-b-2 border-transparent text-slate-400 hover:text-slate-600">Urban</button>
                    <button
                        class="flex-1 py-4 text-sm font-bold border-b-2 border-transparent text-slate-400 hover:text-slate-600">Youth</button>
                    <button
                        class="flex-1 py-4 text-sm font-bold border-b-2 border-transparent text-slate-400 hover:text-slate-600">Women</button>
                </div>
                <div class="p-6">
                    <ul class="space-y-4">
                        <?php foreach ($index_data['key_issues'] as $issue): ?>
                            <li class="flex items-start gap-4">
                                <div
                                    class="<?php echo htmlspecialchars($issue['icon_bg_color']); ?> <?php echo htmlspecialchars($issue['icon_text_color']); ?> p-1 rounded-full">
                                    <span
                                        class="material-symbols-outlined text-lg"><?php echo htmlspecialchars($issue['icon']); ?></span>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800 dark:text-white">
                                        <?php echo htmlspecialchars($issue['title']); ?>
                                    </p>
                                    <p class="text-sm text-slate-500">
                                        <?php echo htmlspecialchars($issue['description']); ?>
                                    </p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>
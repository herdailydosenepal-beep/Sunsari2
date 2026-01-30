<?php require_once 'includes/header.php'; ?>

<main class="max-w-[1200px] mx-auto px-4 md:px-10 py-6">
    <!-- Breadcrumbs -->
    <div class="flex flex-wrap gap-2 py-2">
        <a class="text-[#4e5e97] dark:text-gray-400 text-sm font-medium hover:underline" href="index.php">Home</a>
        <span class="text-[#4e5e97] text-sm">/</span>
        <span class="text-[#0e111b] dark:text-white text-sm font-bold">Candidate Profile</span>
    </div>

    <!-- Page Heading -->
    <div class="flex flex-col gap-3 py-6">
        <h1 class="text-[#0e111b] dark:text-white text-5xl font-black leading-tight tracking-tighter">
            <?php echo htmlspecialchars($candidate_name); ?> for Sunsari-2 | Political Vision & Commitments
        </h1>
        <p class="text-[#4e5e97] dark:text-gray-400 text-lg max-w-2xl leading-relaxed">Meet
            <?php echo htmlspecialchars($candidate_name); ?>, the candidate for Sunsari-2 constituency. Learn about the
            political vision, development priorities, and commitments to the region.
        </p>
    </div>

    <div class="flex flex-col lg:flex-row gap-10">
        <!-- Main Content -->
        <div class="flex-1 space-y-8">
            <!-- Candidate Background -->
            <article
                class="bg-white dark:bg-background-dark p-8 rounded-xl border border-gray-100 dark:border-gray-800">
                <h2 class="text-3xl font-bold text-secondary mb-4">Background & Experience</h2>
                <div class="space-y-4">
                    <p class="text-lg leading-relaxed"><strong>Education:</strong>
                        <?php echo htmlspecialchars($candidate_info['background']['education']); ?></p>
                    <p class="text-lg leading-relaxed"><strong>Professional Background:</strong></p>
                    <ul class="list-disc pl-5">
                        <?php foreach ($candidate_info['background']['professional_background'] as $item): ?>
                            <li><?php echo htmlspecialchars($item); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <p class="text-lg leading-relaxed"><strong>Family Background:</strong>
                        <?php echo htmlspecialchars($candidate_info['background']['family_background']); ?></p>
                    <p class="text-lg leading-relaxed"><strong>Community Connection:</strong>
                        <?php echo htmlspecialchars($candidate_info['background']['community_connection']); ?></p>
                </div>
            </article>

            <!-- Political Journey -->
            <article
                class="bg-white dark:bg-background-dark p-8 rounded-xl border border-gray-100 dark:border-gray-800">
                <h2 class="text-3xl font-bold text-secondary mb-4">Political Journey</h2>
                <div class="space-y-4">
                    <p class="text-lg leading-relaxed"><strong>Experience:</strong>
                        <?php echo htmlspecialchars($candidate_info['political_journey']['experience']); ?></p>
                    <p class="text-lg leading-relaxed"><strong>Party Affiliation:</strong>
                        <?php echo htmlspecialchars($candidate_info['political_journey']['party_affiliation']); ?></p>
                    <p class="text-lg leading-relaxed"><strong>Organizational Roles:</strong></p>
                    <ul class="list-disc pl-5">
                        <?php foreach ($candidate_info['political_journey']['organizational_roles'] as $role): ?>
                            <li><?php echo htmlspecialchars($role['organization']); ?>:
                                <?php echo htmlspecialchars($role['positions']); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </article>

            <!-- Vision and Priorities -->
            <article
                class="bg-white dark:bg-background-dark p-8 rounded-xl border border-gray-100 dark:border-gray-800">
                <h2 class="text-3xl font-bold text-secondary mb-4">
                    <?php echo htmlspecialchars($candidate_info['vision']['title']); ?>
                </h2>
                <p class="text-lg leading-relaxed mb-6">
                    <?php echo htmlspecialchars($candidate_info['vision']['introduction']); ?>
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php foreach ($candidate_info['vision']['priorities'] as $priority): ?>
                        <div class="flex items-start gap-4 p-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                            <span
                                class="material-symbols-outlined text-primary text-3xl flex-shrink-0"><?php echo htmlspecialchars($priority['icon']); ?></span>
                            <div>
                                <h3 class="font-bold text-slate-800 dark:text-white mb-1">
                                    <?php echo htmlspecialchars($priority['title']); ?>
                                </h3>
                                <p class="text-sm text-slate-600 dark:text-slate-300">
                                    <?php echo htmlspecialchars($priority['description']); ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </article>

            <!-- Approach to Representation -->
            <article
                class="bg-white dark:bg-background-dark p-8 rounded-xl border border-gray-100 dark:border-gray-800">
                <h2 class="text-3xl font-bold text-secondary mb-4">
                    <?php echo htmlspecialchars($candidate_info['approach']['title']); ?>
                </h2>
                <div class="space-y-4">
                    <?php foreach ($candidate_info['approach']['points'] as $point): ?>
                        <div>
                            <h3 class="font-bold text-slate-800 dark:text-white">
                                <?php echo htmlspecialchars($point['heading']); ?>
                            </h3>
                            <p class="text-lg leading-relaxed"><?php echo htmlspecialchars($point['description']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </article>

            <!-- Focus Areas -->
            <article
                class="bg-white dark:bg-background-dark p-8 rounded-xl border border-gray-100 dark:border-gray-800">
                <h2 class="text-3xl font-bold text-secondary mb-4">Key Focus Areas</h2>
                <ul class="list-disc pl-5 space-y-2">
                    <?php foreach ($candidate_info['focus_areas'] as $area): ?>
                        <li class="text-lg leading-relaxed"><?php echo htmlspecialchars($area); ?></li>
                    <?php endforeach; ?>
                </ul>
            </article>
        </div>

        <!-- Sidebar -->
        <aside class="w-full lg:w-80 space-y-8">
            <!-- Meet the Candidate Widget -->
            <div
                class="bg-white dark:bg-background-dark border border-gray-100 dark:border-gray-800 rounded-xl overflow-hidden shadow-lg">
                <div class="p-1 bg-primary"></div>
                <div class="p-6 text-center">
                    <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-white shadow-md mb-4">
                        <img class="w-full h-full object-cover"
                            alt="Headshot of <?php echo htmlspecialchars($candidate_info['candidate']['name']); ?>, political candidate for Sunsari-2"
                            itemprop="image"
                            src="<?php echo htmlspecialchars($candidate_info['candidate']['image']); ?>" />
                    </div>
                    <h4 class="text-2xl font-black text-[#0e111b] dark:text-white leading-tight">
                        <?php echo htmlspecialchars($candidate_info['candidate']['name']); ?>
                    </h4>
                    <p class="text-primary text-sm font-bold mb-4">Candidate for
                        <?php echo htmlspecialchars($candidate_info['candidate']['constituency']); ?>
                        (<?php echo htmlspecialchars($candidate_info['candidate']['affiliation']); ?>)
                    </p>
                    <div class="bg-gray-50 dark:bg-gray-800/50 p-4 rounded-lg text-left mb-6">
                        <p class="text-[#4e5e97] dark:text-gray-400 text-sm leading-relaxed italic">
                            "<?php echo htmlspecialchars($candidate_info['candidate']['key_message']); ?>"
                        </p>
                    </div>
                    <div class="space-y-3">
                        <a href="https://sujanlama.com" target="_blank">
                            <button
                                class="w-full py-3 bg-primary text-white rounded-lg font-bold shadow-md hover:bg-opacity-90 transition-all">
                                Full Profile &amp; Bio
                            </button>
                        </a>

                        <a href="https://forms.gle/cUi2Wy9VAPjMtcKH8" target="_blank">
                            <button
                                class="w-full py-3 bg-white dark:bg-transparent border-2 border-primary text-primary rounded-lg font-bold hover:bg-primary/5 transition-all">
                                Ask For Help
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Widget -->
            <div class="bg-primary rounded-xl p-6 text-white shadow-lg overflow-hidden relative">
                <div class="absolute -right-4 -bottom-4 opacity-10">
                    <span class="material-symbols-outlined text-9xl">campaign</span>
                </div>
                <h5 class="text-lg font-bold mb-2">
                    <?php echo htmlspecialchars($candidate_info['contact']['heading']); ?>
                </h5>
                <p class="text-xs text-white/80 mb-4">
                    <?php echo htmlspecialchars($candidate_info['contact']['message']); ?>
                </p>
                <a href="<?php echo htmlspecialchars($candidate_info['contact']['button_link']); ?>"
                    target="<?php echo htmlspecialchars($candidate_info['contact']['button_target']); ?>"
                    class="w-full bg-accent-crimson text-white font-bold py-2 rounded-lg text-sm shadow-md inline-block text-center">
                    <?php echo htmlspecialchars($candidate_info['contact']['button_text']); ?>
                </a>
            </div>
        </aside>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>
<?php require_once 'includes/header.php'; ?>

<!-- Header Section - Dynamic Stats -->

<main class="max-w-7xl mx-auto p-4 md:p-8 space-y-12">
    <!-- Section 1: Constituency Boundaries -->
    <section>
        <div class="flex items-center gap-3 mb-6">
            <span class="material-symbols-outlined text-primary text-3xl">grid_view</span>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Constituency Boundaries</h2>
        </div>
        <div
            class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-900/50">
                            <th class="px-6 py-4 text-sm font-semibold text-slate-600 dark:text-slate-400">Local Unit
                            </th>
                            <th class="px-6 py-4 text-sm font-semibold text-slate-600 dark:text-slate-400">Wards Covered
                            </th>
                            <th class="px-6 py-4 text-sm font-semibold text-slate-600 dark:text-slate-400">Type</th>
                            <th class="px-6 py-4 text-sm font-semibold text-slate-600 dark:text-slate-400">Population
                                Density</th>
                            <th class="px-6 py-4 text-sm font-semibold text-slate-600 dark:text-slate-400 text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        <?php foreach ($local_units as $unit): ?>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/50 transition-colors">
                                <td class="px-6 py-4 font-bold text-secondary">
                                    <?php echo htmlspecialchars($unit['name']); ?>
                                </td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                    <?php echo htmlspecialchars($unit['wards']); ?>
                                </td>
                                <td class="px-6 py-4"><span
                                        class="<?php echo htmlspecialchars($unit['type_class']); ?> px-3 py-1 rounded-full text-xs font-medium"><?php echo htmlspecialchars($unit['type']); ?></span>
                                </td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                    <?php echo htmlspecialchars($unit['density']); ?>
                                </td>
                                <td class="px-6 py-4 text-right"><button
                                        class="text-primary hover:underline text-sm font-bold">Details</button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
                    <div class="bg-secondary text-white px-4 py-3 font-bold"><?php echo htmlspecialchars($demo['name']); ?>
                        <?php echo isset($demo['wards']) ? '(' . htmlspecialchars($demo['wards']) . ')' : ''; ?></div>
                    <div class="p-5 space-y-4">
                        <div>
                            <p class="text-xs text-slate-500 uppercase font-bold tracking-tighter mb-1">Population Breakdown
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
                                <?php echo htmlspecialchars($demo['area_unit']); ?></p>
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
                                <?php echo htmlspecialchars($landmark['name']); ?></h3>
                            <p class="text-sm text-slate-500 mb-2"><?php echo htmlspecialchars($landmark['location']); ?>
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
                                        <?php echo htmlspecialchars($issue['title']); ?></p>
                                    <p class="text-sm text-slate-500"><?php echo htmlspecialchars($issue['description']); ?>
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
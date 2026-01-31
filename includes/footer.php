    <!-- Universal Footer -->
    <footer class="mt-12 border-t border-slate-200 dark:border-slate-700 py-12 px-4 text-slate-500 text-sm">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-start gap-8 mb-8">
                <div class="space-y-4">
                    <img src="/assets/images/logo.png" alt="Sunsari-2 Logo" class="h-12 w-auto grayscale opacity-70 hover:grayscale-0 hover:opacity-100 transition-all">
                    <p class="max-w-xs leading-relaxed">Official data management and constituency information portal for Sunsari-2, Koshi Province, Nepal.</p>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-8">
                    <div>
                        <h4 class="text-slate-900 dark:text-white font-bold mb-4 uppercase text-xs tracking-widest">Quick Links</h4>
                        <ul class="space-y-2">
                            <li><a href="/" class="hover:text-primary transition-colors">Home</a></li>
                            <li><a href="/candidate" class="hover:text-primary transition-colors">Candidates</a></li>
                            <li><a href="/blogs" class="hover:text-primary transition-colors">Updates</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-slate-900 dark:text-white font-bold mb-4 uppercase text-xs tracking-widest">Legal</h4>
                        <ul class="space-y-2">
                            <li><a href="/privacy" class="hover:text-primary transition-colors">Privacy Policy</a></li>
                            <li><a href="/terms" class="hover:text-primary transition-colors">Terms of Use</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="pt-8 border-t border-slate-100 dark:border-slate-800 text-center">
                 <div itemscope itemtype="https://schema.org/GovernmentOrganization">
                    <meta itemprop="name" content="<?php echo $candidate_name; ?> for Sunsari-2">
                    <meta itemprop="legalName" content="Official Campaign for <?php echo $candidate_name; ?>">
                    <p>Authorized by: <span itemprop="founder" class="font-bold"><?php echo $candidate_name; ?></span></p>
                    <p itemprop="address" class="mt-1">Campaign Office: <?php echo $campaign_office_address; ?></p>
                </div>
                <p class="mt-6">© <?php echo date('Y'); ?> Sunsari-2 Constituency Office. Official Dashboard for Planning and Analysis.</p>
                <p class="mt-2 text-xs">Koshi Province, Nepal • Source: Central Bureau of Statistics &amp; Local Unit Data</p>
            </div>
        </div>
    </footer>

</body>
</html>
<?php
// Flush the output buffer
ob_end_flush();
?>
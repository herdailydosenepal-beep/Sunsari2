    <!-- Universal Footer -->
    <footer class="mt-12 border-t border-slate-200 dark:border-slate-700 py-8 px-4 text-center text-slate-500 text-sm">
        <div class="max-w-7xl mx-auto">
             <div itemscope itemtype="https://schema.org/GovernmentOrganization">
                <meta itemprop="name" content="<?php echo $candidate_name; ?> for Sunsari-2">
                <meta itemprop="legalName" content="Official Campaign for <?php echo $candidate_name; ?>">
                <p>Authorized by: <span itemprop="founder"><?php echo $candidate_name; ?></span></p>
                <p itemprop="address">Campaign Office: <?php echo $campaign_office_address; ?></p>
            </div>
            <p class="mt-4">© <?php echo date('Y'); ?> Sunsari-2 Constituency Office. Official Dashboard for Planning and Analysis.</p>
            <p class="mt-2">Koshi Province, Nepal • Source: Central Bureau of Statistics &amp; Local Unit Data</p>
            <div class="flex justify-center gap-6 mt-4">
                <a class="text-slate-500 hover:text-primary transition-colors" href="privacy.php">Privacy Policy</a>
                <a class="text-slate-500 hover:text-primary transition-colors" href="terms.php">Terms of Use</a>
                <a class="text-slate-500 hover:text-primary transition-colors" href="contact.php">Contact Us</a>
            </div>
        </div>
    </footer>

</body>
</html>
<?php
// Flush the output buffer
ob_end_flush();
?>
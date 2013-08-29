<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>http://<?php echo $_SERVER['HTTP_HOST']; ?>/</loc>
    </url>
<?php foreach ($homenav['data'] as $entry): ?>
    <?php if (count( deka(array(), $entry,'children') )): ?>
        <?php foreach ($entry['children'] as $sub_entry): ?>
            <?php if (!deka(FALSE, $entry,'custom') ): ?>
            <url>
                <loc>http://<?php echo $_SERVER['HTTP_HOST'].'/'.$sub_entry['slug']; ?></loc>
            </url>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <url>
            <loc>http://<?php echo $_SERVER['HTTP_HOST'].'/'.$entry['slug']; ?></loc>
        </url>
    <?php endif; ?>
<?php endforeach; ?>
<?php foreach ($nav['data'] as $entry): ?>
    <url>
        <loc>http://<?php echo $_SERVER['HTTP_HOST'].'/'.$entry['slug']; ?></loc>
    </url>
    <?php if (count( deka(array(), $entry,'children') )): ?>
        <?php foreach ($entry['children'] as $sub_entry): ?>
            <url>
                <loc>http://<?php echo $_SERVER['HTTP_HOST'].'/'.$entry['slug'].'/'.$sub_entry['slug']; ?></loc>
            </url>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endforeach; ?>
<?php foreach ($products as $product): ?>
    <url>
        <loc>http://<?php echo $_SERVER['HTTP_HOST'].'/'.$product['slug']; ?></loc>
    </url>
<?php endforeach; ?>
</urlset>


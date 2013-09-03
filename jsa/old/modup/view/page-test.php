<?php include DIR_TMPL.'/header.php'; ?>

<div id="page" class="<?php echo ake('class', $page) ? $page['class'] : ''; ?>">
    <div class="content">
        <h1 class = "<?php echo $pageclass; echo $page['title']; ?>"><?php echo $page['title']; ?></h1>
       
        <div><?php echo $page['body']; ?></div>
    </div>

</div>

<?php include DIR_TMPL.'/footer.php'; ?>

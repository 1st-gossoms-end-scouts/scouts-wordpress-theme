<?php b5st_footer_before();?>

<footer id="site-footer" class="bg-secondary border-top border-bottom">

  <div class="container">

    <?php if(is_active_sidebar('footer-widget-area')): ?>
    <div class="row pt-5 pb-4" id="footer" role="navigation">
      <?php dynamic_sidebar('footer-widget-area'); ?>
    </div>
    <?php endif; ?>

  </div>
    <?php b5st_bottomline();?>
</footer>

<?php b5st_footer_after();?>


<?php wp_footer(); ?>
</body>
</html>

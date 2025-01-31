<div class="blogsingle__sidebar">
    <?php if (is_active_sidebar('uaintbev_sidebar')) : ?>
    <div class="widget-area">
        <?php dynamic_sidebar('uaintbev_sidebar'); ?>
    </div>
    <?php else : ?>
    <!-- Default content when no widgets are added -->
    <div class="blogsingle__search">
        <div class="sideallheading">
            <h6>Search Your Keywords</h6>
        </div>
        <div class="search-area">
            <!-- WordPress Search Widget Form -->
            <?php get_search_form(); ?>
            <div class="icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
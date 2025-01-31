<?php
get_header();
?>

<section class="blogsingle bg-white">
    <div class="container">
        <div>
            <div class="row g-4">

            </div>
        </div>
        <div class="row g-4">


            <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>
            <div class="col-md-3">
                <div class="blog__item">
                    <div class="blog__inner blog__inner--innerblogpage">
                        <div class="thumb">
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                            // Display the featured image if it exists
                                            if (has_post_thumbnail()) {
                                                the_post_thumbnail('medium');
                                            } else {
                                                echo '<img src="assets/img/home-2/blog/img1.jpg" alt="' . get_the_title() . '">';
                                            }
                                            ?>
                            </a>
                        </div>
                        <div class="content bg-white">
                            <div class="text">
                                <ul>
                                    <li><a href="blog.html#"><i class="fa-solid fa-user"></i>Admin</a></li>
                                    <li><a href="blog.html#"><i
                                                class="fa-regular fa-eye"></i><?php echo track_post_views(get_the_ID()); ?></a>
                                    </li>
                                    <li><a href="blog.html#"><i
                                                class="fa-solid fa-message"></i><?php comments_number('0 Comment', '1 Comment', '% Comments'); ?></a>
                                    </li>
                                </ul>
                                <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                            </div>
                            <div class="blogbtn">
                                <a href="<?php the_permalink(); ?>" class="custom-btn">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>

            <?php
                    // Call the custom pagination function
                    uaintbev_pagination();
                    ?>

            <?php else : ?>
            <p>No results found for your search query.</p>
            <?php endif; ?>


        </div>
    </div>
</section>

<?php
get_footer();
?>
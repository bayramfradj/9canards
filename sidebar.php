<?php
$statement = $settings->all();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $total_recent_post_sidebar = $row['total_recent_post_sidebar'];
    $total_popular_post_sidebar = $row['total_popular_post_sidebar'];
}
?>
<div class="sidebar"> 
    <div class="widget">
        <h4>Categories</h4>
        <ul>
            <?php
            $statement = $category->all();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
            foreach ($result as $row) {
                ?>
                <li><a href="category.php?slug=<?php echo $row['category_slug']; ?>"><?php echo $row['category_name']; ?></a></li>
                <?php
            } 
            ?>
        </ul>
    </div>
    <div class="widget">
        <h4>Latest Posts</h4>
        <ul>
            <?php
            $i = 0;
            $statement = $post->allPost();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
            foreach ($result as $row) {
                $i++;
                if($i > $total_recent_post_sidebar) {
                    break;
                }
                ?>
                <li><a href="blog-single.php?slug=<?php echo $row['post_slug']; ?>"><?php echo $row['post_title']; ?></a></li>
                <?php
            }
            ?>
        </ul>
    </div>
    <div class="widget">
        <h4>Popular Posts</h4>
        <ul>
            <?php
            $i = 0;
            $statement = $post->allPopular();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
            foreach ($result as $row) {
                $i++;
                if($i > $total_popular_post_sidebar) {
                    break;
                }
                ?>
                <li><a href="blog-single.php?slug=<?php echo $row['post_slug']; ?>"><?php echo $row['post_title']; ?></a></li>
                <?php
            }
            ?>
        </ul>
    </div>
</div>
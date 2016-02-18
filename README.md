# Using the function wp_exist_post()
**Check exist post by title, author and post type in WordPress.org**

```PHP
<?php
// Ebook Arnold Schwarzenegger
$title = "Total Recall - My unbelievably true life story";
$author = '';
$post_type = 'ebook';

if(!wp_exist_post( $title, $author, $post_type ){
  echo "There, do something!";
}else{
  echo "Exist!";
}
?>
```

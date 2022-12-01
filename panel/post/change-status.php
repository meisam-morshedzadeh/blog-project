<?php

require_once '../../functions/helpers.php';
require_once '../../functions/pdo_connection.php';
require_once '../../functions/check-login.php';

if(isset($_GET['post_id']) && $_GET['post_id']!=="")
{
    global $pdo;

    $query ="SELECT * FROM blog_project.posts WHERE id=?";
    $statement = $pdo->prepare($query);
    $statement->execute([$_GET['post_id']]);
    $post = $statement->fetch();

    if($post!==false)
    {
        $status = ($post->status == 10) ? 0 : 10;
        $query ="UPDATE blog_project.posts SET status=?, updated_at=NOW() WHERE id=?;";
        $statement = $pdo->prepare($query);
        $statement->execute([$status,$_GET['post_id']]);

    }
}

redirect('panel/post');
<?php
require_once './providers/posts.php';
require_once './providers/database.php';
include './include/header.php'
    ?>

<h2 class="my-3">
    My Profile
</h2>

<h5 class="my-2">
    My Posts
</h5>

<?php

$query = 'SELECT posts.id, posts.title, posts.last_update, posts.body, posts.image_url, posts.image_alt, users.name FROM posts LEFT JOIN users ON posts.user_id = users.id';

$conn = new Database();
$result = $conn->dbQuery($query);
$posts = [];

foreach ($result as $item) {
    array_push($posts, new TextPost(
        $item['id'],
        $item['title'],
        $item['last_update'],
        $item['name'],
        $item['body'],
    ));
}

foreach ($posts as $post) {
    echo <<<CARD
        <div class="card text-start">
            <div class="card-header">
                {$post->get('author')}
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    {$post->get('title')}
                </h5>
                <p class="card-text">
                    {$post->get('post_body')}
                </p>

                <small class="text-muted">
                    updated:
                    {$post->formatDate()}
                </small>
            </div>
        </div>
    CARD;
}

?>



<?php include './include/footer.php' ?>
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

$db = new Database();
$db->connect();
$query = 'SELECT posts.id, posts.title, posts.last_update, posts.body, posts.image_url, posts.image_alt, users.name FROM posts LEFT JOIN users ON posts.user_id = users.id';
$result = $db->selectRecords($query);
$posts = [];
// var_dump($result);

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


// $posts = [
//     [
//         "id" => 1,
//         "title" => "Post title 1",
//         "last_update" => 1674150425,
//         "author" => "Lucie Lu",
//         "post_body" => "With supporting text below as a natural lead-in to additional content."
//     ],
//     [
//         "id" => 2,
//         "title" => "Post title 2",
//         "last_update" => 1674150425,
//         "author" => "Sim Yan",
//         "image_url" => "https://cdn.pixabay.com/photo/2017/02/20/17/47/social-media-2083456__340.png",
//         "image_alt" => "New awesome icons!"
//     ]
// ];

// $text_post = new TextPost();
// $text_post->set($posts[0]);

// $image_post = new ImagePost();
// $image_post->set($posts[1]);



?>



<?php include './include/footer.php' ?>
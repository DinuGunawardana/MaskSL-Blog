<!-- Include Head -->
<?php include "assest/head.php"; ?>
<?php

// Get Latest articles
$stmt = $conn->prepare("SELECT * FROM `article` INNER JOIN category ON id_categorie=category_id ORDER BY `article_created_time` DESC  LIMIT 9");
$stmt->execute();
$articles = $stmt->fetchAll();

// Get Categories
$stmt = $conn->prepare("SELECT *,COUNT(*) as article_count FROM `article` INNER JOIN category ON id_categorie=category_id GROUP BY id_categorie");
$stmt->execute();
$categories = $stmt->fetchAll();

// Get Most Read Articles
$stmt = $conn->prepare("SELECT * FROM `article` INNER JOIN category ON id_categorie=category_id order by RAND() LIMIT 4");
$stmt->execute();
$most_read_articles = $stmt->fetchAll();

?>

<!-- Google font -->
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet">

<!-- Custom CSS -->
<!-- <link href="css/home.css" rel="stylesheet"> -->
<link type="text/css" rel="stylesheet" href="css/style.css" />
<style>
    .bg-div {
        background: linear-gradient(rgba(0, 0, 0, 0.1),
                rgba(0, 0, 0, 0.1)), url("./img/slider/home o.png");
        /* Full height */
        height: 700px;
        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        margin-top: 4rem;
    }
</style>

<title>MaskSL - Blog</title>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Header -->
    <?php include "assest/header.php" ?>
    <!-- </Header> -->

    <!-- Main -->
    <main class="main">

        <!-- Jumbotron -->
        <div class="jumbotron text-center p-0 mb-0">
            <div class="bg-div px-5 d-flex align-items-center">

                <div class="text-left w-100 ml-5 col-md-12">
                    <h1 class="display-3 text-white">Welcome to MaskSL Blog!</h1>
                    <h2 class="display-6 text-white">Join in for an Educational and Artistic Journey!</h2>

                </div>


            </div>
        </div><!-- /Jumbotron -->

        <!-- Latest Articles -->
        <div class="section about">

            <!-- container -->
            <div class="container">

                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2 class="text-light">Latest Articles</h2>
                        </div>
                    </div>

                    <?php foreach ($articles as $article) : ?>

                        <!-- post -->
                        <div class="col-md-4">
                            <div class="post">
                                <a class="post-img" href="single_article.php?id=<?= $article['article_id'] ?>">
                                    <img src="img/article/<?= $article['article_image'] ?>" alt="">
                                </a>
                                <di class="post-body">

                                    <div class="post-meta">
                                        <a class="post-category cat-1" href="articleOfCategory.php?catID=<?= $article['category_id'] ?>" style="background-color:<?= $article['category_color'] ?>"><?= $article['category_name'] ?></a>
                                        <span class="post-date">
                                            <?= date_format(date_create($article['article_created_time']), "F d, Y ") ?>
                                        </span>
                                    </div>

                                    <h3 class="post-title"><a href="single_article.php?id=<?= $article['article_id'] ?>"><?= $article['article_title'] ?></a></h3>

                                </di>
                            </div>
                        </div>
                        <!-- /post -->

                    <?php endforeach;  ?>

                    <div class="clearfix visible-md visible-lg"></div>
                </div>
                <!-- /row -->

            </div>
            <!-- /container -->
        </div><!-- /Latest Articles -->

        <!-- Most Read -->
        <div class="section education">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-title">
                                    <h2 class="text-light">Most Read</h2>
                                </div>
                            </div>

                            <?php foreach ($most_read_articles as $article) : ?>

                                <!-- post -->
                                <div class="col-md-12">
                                    <div class="post post-row">
                                        <a class="post-img" href="single_article.php?id=<?= $article['article_id'] ?>">
                                            <img src="img/article/<?= $article['article_image'] ?>" alt="">
                                        </a>
                                        <div class="post-body">
                                            <div class="post-meta">
                                                <a href="articleOfCategory.php?catID=<?= $article['category_id'] ?>" class="post-category" style="background-color:<?= $article['category_color'] ?>">
                                                    <?= $article['category_name'] ?>
                                                </a>
                                                <span class="post-date">
                                                    <?= date_format(date_create($article['article_created_time']), "F d, Y ") ?>
                                                </span>
                                            </div>

                                            <h3 class="post-title"><a href="single_article.php?id=<?= $article['article_id'] ?>"><?= $article['article_title'] ?></a></h3>
                                            <p>
                                                <?= substr($article['article_content'], 0, 150) ?>...
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /post -->

                            <?php endforeach;  ?>

                        </div>
                    </div>

                    <div class="col-md-4">

                        <!-- catagories -->
                        <div class="aside-widget">
                            <div class="section-title">
                                <h2 class="text-light">Categories</h2>
                            </div>
                            <div class="category-widget">

                                <ul>
                                    <!-- /category -->
                                    <?php foreach ($categories as $category) : ?>
                                        <li>
                                            <a href="articleOfCategory.php?catID=<?= $category['category_id'] ?>"> <?= $category["category_name"] ?>
                                                <span style="background-color: <?= $category["category_color"] ?>"> <?= $category["article_count"] ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                    <!-- /category -->
                                </ul>
                            </div>
                        </div>
                        <!-- /catagories -->

                        <!-- tags -->
                        <!-- <div class="aside-widget">
                            <div class="tags-widget">
                                <ul>
                                    <li><a href="#">Chrome</a></li>
                                    <li><a href="#">CSS</a></li>
                                    <li><a href="#">Tutorial</a></li>
                                    <li><a href="#">Backend</a></li>
                                    <li><a href="#">JQuery</a></li>
                                    <li><a href="#">Design</a></li>
                                    <li><a href="#">Development</a></li>
                                    <li><a href="#">JavaScript</a></li>
                                    <li><a href="#">Website</a></li>
                                </ul>
                            </div>
                        </div> -->
                        <!-- /tags -->
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div><!-- /Most Read -->

    </main><!-- </Main> -->

    <!-- Footer -->
    <?php include "assest/footer.php" ?>
    <!-- </Footer> -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>
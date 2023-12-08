<?php

require 'elements/header.php';
require 'class/GhibliMovieInfo.php';
require 'class/Form.php';

$infos = new GhibliMovieInfo();

?>

<h1 class="h1 mb-5"> Elements divers sur les films </h1>

<main>
    <section class="container-fluid">
        
    </section>
    <section class='container'>
        <form class="row mb-3" method="get" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <div class="form-group col-md-9">
                <?= Form::select('movie', 'Sélectionnez un film', $infos->get_movie_count(), $infos->get_movies_title_list()) ?>
            </div>
            <input class="btn btn-primary col-md-2" type="submit" value="Trouver">
        </form>
    </section>
    <?php if(!empty($_GET)) : ?>
    <section class="container">
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card" style="width: 19rem;">
                    <div class="card-body">
                        <h5 class="card-title">Title</h5>
                        <p class="card-text"><?=  $infos->get_movie_unique_info($_GET['movie'], 'title') ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 19rem;">
                    <div class="card-body">
                        <h5 class="card-title">Genre</h5>
                        <p class="card-text"><?=  $infos->get_movie_unique_info($_GET['movie'], 'genre') ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 19rem;">
                    <div class="card-body">
                        <h5 class="card-title">Rating</h5>
                        <p class="card-text"><?=  $infos->get_movie_unique_info($_GET['movie'], 'rating') ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card" style="width: 19rem;">
                    <div class="card-body">
                        <h5 class="card-title">Release</h5>
                        <p class="card-text"><?=  $infos->get_movie_unique_info($_GET['movie'], 'release') ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 19rem;">
                    <div class="card-body">
                        <h5 class="card-title">Runtime (minutes)</h5>
                        <p class="card-text"><?=  $infos->get_movie_unique_info($_GET['movie'], 'runtimeMinutes') ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 19rem;">
                    <div class="card-body">
                        <h5 class="card-title">Director</h5>
                        <p class="card-text"><?=  $infos->get_movie_unique_info($_GET['movie'], 'director') ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Producer(s)</h5>
                        <?php foreach ($infos->get_movie_unique_info($_GET['movie'], 'producers') as $producer) : ?>
                            <p class="card-text"><?=  $producer ?></p>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Music</h5>
                        <p class="card-text"><?=  $infos->get_movie_unique_info($_GET['movie'], 'music') ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Budget(USD)</h5>
                        <p class="card-text"><?=  $infos->get_movie_unique_info($_GET['movie'], 'budgetUSD') ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="input-group row mb-4">
            <div class="input-group-prepend d-flex justify-content-center">
                <span class="input-group-text col-md-12 mb-2">Synopsis</span>
            </div>
            <p class="form-control col-md-8"><?=  $infos->get_movie_unique_info($_GET['movie'], 'synopsis') ?></p>
        </div>
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card" style="width: 19rem;">
                    <div class="card-body">
                        <h5 class="card-title">Characters</h5>
                        <?php foreach ($infos->get_movie_unique_info($_GET['movie'], 'character') as $k => $character) : ?>
                            <p class="card-text"><?= $k . ' : ' . $character ?></p>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
            <img src="<?= $infos->get_movie_unique_info($_GET['movie'], 'poster') ?>" alt="" class="img-fluid" style="max-height:600px;max-width:200">
            </div>
            <div class="col-md-3">
                <div class="card mb-3" style="width: 19rem;">
                    <div class="card-body">
                        <h5 class="card-title">Box Office</h5>
                        <p class="card-text"><?=  $infos->get_movie_unique_info($_GET['movie'], 'boxOfficeUSD') ?></p>
                    </div>
                </div>
                <div class="card mb-3" style="width: 19rem;">
                    <div class="card-body">
                        <h5 class="card-title">Reviews</h5>
                        <?php foreach ($infos->get_movie_unique_info($_GET['movie'], 'reviews') as $review) : ?>
                            <p class="card-text"><?= $review ?></p>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="card mb-3" style="width: 19rem;">
                    <div class="card-body">
                        <h5 class="card-title">Screenwriter(s)</h5>
                        <?php foreach ($infos->get_movie_unique_info($_GET['movie'], 'screenwriters') as $screenwriter) : ?>
                            <p class="card-text"><?= $screenwriter ?></p>
                        <?php endforeach ?>                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif ?>
</main>
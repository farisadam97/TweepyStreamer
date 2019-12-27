<?php 
    require('main_q.php');
?>


<nav class="navbar navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">Streamer Tweet from DishubSurabaya</span>
    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target=".bd-example-modal-xl">Extra large modal</button>

    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <nav>
                <div class="nav nav-tabs justify-content-center pt-2" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Mingguan</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Bulanan</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Tahunan</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <canvas id="myChart"></canvas>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <canvas id="myChart1"></canvas>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <canvas id="myChart2"></canvas>
                </div>
            </div>
        </div>
    </div>
    </div>
    <span class="navbar-brand mb-0 h1 float-right"><?php echo date("l").", ".date("d")." ".date("F")." ".date("Y")?></span>
</nav>
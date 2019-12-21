<?php
    while($post = $result->fetch_assoc()){
        $phpdate = strtotime($post['dateTweet']);
        $mysqldatephp = date('l,d F Y H:i', $phpdate);
?>

<div class="card post-list" id="<?php echo $post['idstreamTable']; ?>">
    <?php
    if($post['category'] == "Padat"):
    ?>
        <div class="card-header bg-danger">
            <h6 class="text-white"><?php echo $post['idstreamTable']; ?><span id="kategory"><?php echo $post['category']; ?></span> <span class="float-right"> <?php echo $mysqldatephp; ?></span></h6>
        </div>
    <?php else :?>
        <div class="card-header bg-success">
            <h6 class="text-white"><?php echo $post['idstreamTable']; ?><?php echo $post['category']; ?> <span class="float-right"> <?php echo $mysqldatephp; ?></span></h6>
        </div>
    <?php endif; ?>
    
    <div class="card-body">
        <p class="card-text"><?php echo $post['textTweet']; ?></p>
        <?php if(is_null($post['mediaLink'])) : ?>
        <?php else: ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> Media</button>
        <?php endif; ?>
    </div>
    <div class="card-footer text-muted text-center" id="jalan-text">
        <p><?php echo "Jalan " . $post['jalanName'] . " Surabaya"; ?></p>
        <p id="latitude" hidden><?php echo $post['latLoc']; ?></p>
        <p id="longitude" hidden><?php echo $post['lngLoc']; ?></p>
    </div>
</div>
<?php
    }
?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gambar Kondisi Lalu Lintas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php if(is_null($post['mediaLink'])) : ?>
        <?php else: ?>
            <img src="<?php echo $post['mediaLink']?>" alt="" srcset="">
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
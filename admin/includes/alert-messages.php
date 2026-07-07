<?php if(isset($_SESSION['msg_error'])) { ?>
<div class="alert alert-danger">
    <?php
    echo $_SESSION['msg_error'];
    unset($_SESSION['msg_error']);
    ?>
</div>
<?php } ?>

<?php if(isset($_SESSION['msg_success'])) { ?>
<div class="alert alert-success">
    <?php 
    echo $_SESSION['msg_success']; 
    unset($_SESSION['msg_success']);
    ?>
</div>
<?php } ?>
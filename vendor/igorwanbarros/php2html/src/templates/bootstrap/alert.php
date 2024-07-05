<<?php echo $alert->getTagName();?> <?php echo $alert->renderAttributes();?>>
    <?php if ($alert->getDismissible()):?>
        <button type="button" class="close" data-dismiss="alert">
            <?php echo $alert->getTextDismissible();?>
        </button>
    <?php endif;?>

    <?php echo $alert->getText();?>
</<?php echo $alert->getTagName();?>>

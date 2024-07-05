<div class="<?php echo $panel->getClassPanel()?>">
    <div class="<?php echo $panel->getClassPanelHeading(); ?>">
        <h3 class="<?php echo $panel->getClassPanelHeadingTitle(); ?>"><?php echo $panel->getTitle()?></h3>
        <?php if ($panel->isBoxToolsCollapse() || $panel->isBoxToolsRemove()): ?>
            <div class="box-tools pull-right">
            <?php if ($panel->isBoxToolsCollapse()): ?>
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <?php endif; ?>
            <?php if ($panel->isBoxToolsRemove()): ?>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="<?php echo $panel->getClassPanelBody(); ?>">
        <?php echo $panel->getBody()?>
    </div>


    <?php if ($panel->getFooter()):?>
    <div class="<?php echo $panel->getClassPanelFooter(); ?>">
        <?php echo $panel->getFooter()?>
    </div>
    <?php endif?>
</div>

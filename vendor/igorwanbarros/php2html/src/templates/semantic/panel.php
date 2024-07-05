<div class="ui top attached <?php echo $panel->getClassPanel()?> segment">
    <?php if ($panel->isBoxToolsCollapse() || $panel->isBoxToolsRemove()):?>
    <div class="ui grid row">
        <div class="ui thirteen wide column header">
            <?php echo $panel->getTitle()?>
        </div>
        <div class="ui three wide column right aligned">
            <?php if ($panel->isBoxToolsCollapse() || $panel->isBoxToolsRemove()):?>
            <div class="box-tools pull-right">
                <div class="pull-right box-tools">
                    <?php if ($panel->isBoxToolsCollapse()):?>
                    <button class="tools circular ui basic mini icon button" data-widget="collapse">
                        <i class="minus icon"></i>
                    </button>
                    <?php endif?>

                    <?php if ($panel->isBoxToolsRemove()):?>
                    <button class="tools circular ui basic mini icon button" data-widget="remove">
                        <i class="close icon"></i>
                    </button>
                    <?php endif?>
                </div>
            </div>
            <?php endif?>
        </div>
    </div>
    <?php else:?>
        <div class="ui padded header" style="padding-bottom: 0.75em;">
            <?php echo $panel->getTitle()?>
        </div>
    <?php endif;?>
</div>

<div class="ui <?php echo $panel->getFooter() == null ? 'bottom' : ''?> attached segment body">
    <?php echo $panel->getBody()?>
</div>

<?php if ($panel->getFooter()):?>
<div class="ui bottom attached segment">
    <?php echo $panel->getFooter()?>
</div>
<?php endif;?>

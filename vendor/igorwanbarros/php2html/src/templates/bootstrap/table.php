<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="table-responsive">
            <table class="<?php echo $table->getClassTable()?>">
                <thead>
                    <tr>
                    <?php foreach($table->getHeaders() as $key => $value):?>
                        <th class="column-<?php echo $key?> <?php echo $table->getClassThead()?>">
                            <?php echo $value?>
                        </th>
                    <?php endforeach;?>
                    </tr>
                </thead>
                <tbody>
                    <?php ?>
                    <?php if (count($table->getCollection()) == 0):?>
                        <tr>
                            <td colspan="<?php echo count($table->getHeaders()) ?>"
                                class="column-empty <?php echo $table->getClassTd() ?>">
                                <?php echo $table->getEmptyList()?>
                            </td>
                        </tr>
                    <?php endif;?>

                    <?php foreach($table->getCollection() as $row):?>
                        <?php $row = $table->getRow($row)?>
                        <?php $row->addAttributes('class', "column-{$key} {$table->getClassTd()}")?>
                        <tr>
                        <?php foreach($table->getHeaders() as $key => $header):?>
                                <td <?php echo $row->getColumnAttributes($key)?>>
                                    <?php if (!$row->getLineLink()):?>
                                        <?php echo $row->getDataValue($key)?>
                                    <?php else:?>
                                        <a href="<?php echo $row->getLineLink()?>">
                                            <?php echo $row->getValueKey($key)?>
                                        </a>
                                    <?php endif;?>
                                </td>
                            <?php endforeach;?>
                        </tr>
                    <?php endforeach;?>

                </tbody>
                <?php if($table->getFooter()):?>
                <tfoot>
                    <tr>
                        <th colspan="<?php echo count($table->getHeaders())?>"
                            class="column-footer <?php echo $table->getClassTfooter() ?>">
                            <?php echo $table->getFooter()?>
                        </th>
                    </tr>
                </tfoot>
                <?php endif;?>
            </table>
        </div>
    </div>
</div>

<?php if (($paginator = $table->getPaginator())):?>
    <?php echo $paginator;?>
<?php endif;?>

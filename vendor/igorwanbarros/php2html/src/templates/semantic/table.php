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
        <?php
            $total = count($table->getCollection());
            $totalColunas = count($table->getHeaders());
        ?>
        <?php if ($total == 0):?>
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
                    <td <?php echo $row->getAttributes()?>>
                        <?php if (!$row->getLineLink()):?>
                            <?php echo $row->getDataValue($key)?>
                        <?php else:?>
                            <a href="<?php echo $row->getLineLink()?>">
                                <?php echo $row->getData()->{$key}?>
                            </a>
                        <?php endif;?>
                    </td>
                <?php endforeach;?>
            </tr>
        <?php endforeach;?>

    </tbody>
    <tfoot>
        <?php if($table->getFooter()):?>
        <tr>
            <th colspan="<?php echo count($table->getHeaders())?>"
                class="column-footer <?php echo $table->getClassTfooter() ?>">
                <?php echo $table->getFooter()?>sjdlkj
            </th>
        </tr>
        <?php endif;?>
        <?php if($table->getPaginator()):?>
        <tr>
            <th colspan="<?php echo $totalColunas?>">
                <?php echo $table->getPaginator();?>
            </th>
        </tr>
        <?php endif;?>
    </tfoot>
</table>


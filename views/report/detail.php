<?php

/* @var $report array */

?>

<div class="row">
    <div class="col-md-10">
        <h3 class="alert-heading"><b>Детализированный отчет по расходам за <?=$report['month']?></b></h3>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <table class="table table-hover table table-bordered">
            <thead>
                <tr>
                    <th>День\Категория</th>
                    <?php foreach($report['head'] as $head):?>
                        <th><?=$head?></th>
                    <?php endforeach;?>
                    <th>Итого</th>
                </tr>
            </thead>

            <tbody>
            <?php foreach($report['data'] as $key => $value):?>
                <tr>
                    <td><b><?=$key?></b></td>
                    <?php foreach($value as $keyRow => $valueRow): ?>
                        <td><?=$valueRow?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
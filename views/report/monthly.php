<?php

/* @var $report array */
?>

<div class="row">
    <div class="col-md-10">
        <h3 class="alert-heading"><b>Сводный отчет по расходам</b></h3>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <table class="table table-hover table table-bordered">
            <thead>
            <tr>
                <th>Месяц</th>
                <th>Сумма расходов, руб.</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($report as $row):?>
                <tr>
                    <td><?=$row['key']?></td>
                    <td><?=$row['value']?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<?php

use ptrnov\fusionchart\ChartAsset;

ChartAsset::register($this);
?>

<?php if (isset($chartSale)) { ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="book-chart">
                <?= $chartSale ?>
            </div>
        </div>
    </div>
<?php } ?>
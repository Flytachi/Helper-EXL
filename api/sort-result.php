<?php
require 'lib.php';

if ($_FILES) {
    if ($_FILES['file']) $data = read_excel($_FILES['file']['tmp_name']); unset($data[0]);
            
    $newData = [];
    foreach ($data as $value) {
        $status = true;
        foreach ($newData as $k => $v) {
            if ($v['mark'] == $value['0'] and  $v['art'] == $value['1'] and $v['price'] == $value['3']) {
                $newData[$k]['qty'] += (is_numeric($value['2'])) ? $value['2'] : 0;
                $status = false;
            }
        }
        if ($status) {
            $newData[] = array(
                'mark' => $value[0],
                'art' => $value[1],
                'price' => $value[3],
                'qty' => (is_numeric($value['2'])) ? $value['2'] : 0,
            );
        }
    }

    ?>
    <button class="btn" onclick="ExportExcel('table', 'Document', 'document.xls')">Excel</button>
    <table class="table" id="table">
        <thead>
            <tr>
                <th>Марка</th>
                <th>Артикул</th>
                <th>Количество</th>
                <th>Цена</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach (array_multisort_value($newData, $_POST['sort'], SORT_DESC) as $row) {
                ?>
                <tr>
                    <td><?= $row['mark'] ?></td>
                    <td><?= $row['art'] ?></td>
                    <td><?= $row['qty'] ?></td>
                    <td><?= $row['price'] ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}
?>
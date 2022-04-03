<?php
require 'lib.php';

if ($_FILES) {
    if ($_FILES['file1']) $data1 = read_excel($_FILES['file1']['tmp_name']); unset($data1[0]);
    if ($_FILES['file2']) $data2 = read_excel($_FILES['file2']['tmp_name']); unset($data2[0]);
    
    $newData1 = [];
    foreach ($data1 as $value) {
        $status = true;
        foreach ($newData1 as $k => $v) {
            if ($v['mark'] == $value['0'] and  $v['art'] == $value['1'] and $v['price'] == $value['3']) {
                $newData1[$k]['qty'] += (is_numeric($value['2'])) ? $value['2'] : 0;
                $status = false;
            }
        }
        if ($status) {
            $newData1[] = array(
                'mark' => $value[0],
                'art' => $value[1],
                'price' => $value[3],
                'qty' => (is_numeric($value['2'])) ? $value['2'] : 0
            );
        }
    }

    $newData2 = [];
    foreach ($data2 as $value) {
        $status = true;
        foreach ($newData2 as $k => $v) {
            if ($v['mark'] == $value['0'] and  $v['art'] == $value['1'] and $v['price'] == $value['3']) {
                $newData2[$k]['qty'] += (is_numeric($value['2'])) ? $value['2'] : 0;
                $status = false;
            }
        }
        if ($status) {
            $newData2[] = array(
                'mark' => $value[0],
                'art' => $value[1],
                'price' => $value[3],
                'qty' => (is_numeric($value['2'])) ? $value['2'] : 0
            );
        }
    }

    $newData = [];
    foreach ($newData1 as $item1) {
        foreach ($newData2 as $item2) {
            if($item1['mark'] == $item2['mark'] and $item1['art'] == $item2['art'] and $item1['price'] == $item2['price']){
                $newData[] = array(
                    'mark' => $item1['mark'], 
                    'art' => $item1['art'], 
                    'qtyOld' => $item1['qty'],
                    'qtyNew' => $item2['qty'],
                    'price' => $item1['price']
                );
            }
        }
    }
    ?>
    <button class="btn" onclick="ExportExcel('table', 'Document', 'document.xlsx')">Excel</button>
    <table class="table" id="table">
        <thead>
            <tr>
                <th>Модель</th>
                <th>Артикул</th>
                <th>Кол-во (Старый)</th>
                <th>Кол-во (Новый)</th>
                <th>Цены</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach (array_multisort_value($newData, $_POST['sort'], SORT_DESC) as $row) {
                ?>
                <tr>
                    <td><?= $row['mark'] ?></td>
                    <td><?= $row['art'] ?></td>
                    <td><?= $row['qtyOld'] ?></td>
                    <td><?= $row['qtyNew'] ?></td>
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
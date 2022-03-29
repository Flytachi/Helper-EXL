<?php
require 'lib.php';

if ($_FILES) {
    if ($_FILES['file1']) $data1 = read_excel($_FILES['file1']['tmp_name']); unset($data1[0]);
    if ($_FILES['file2']) $data2 = read_excel($_FILES['file2']['tmp_name']); unset($data2[0]);
    $data = [];

   /*  echo "<pre>";
    print_r($data1);
    echo "</pre>";
    echo "<pre>";
    print_r($data2);
    echo "</pre>"; */

    $array = [];
    $new_data1 = [];
    foreach ($data1 as $value) {
        if (isset($array[$value[0]][$value[1]]) and $array[$value[0]][$value[1]]) $array[$value[0]][$value[1]] += $value[2];
        else $array[$value[0]][$value[1]] = $value[2];
    }
    foreach ($array as $key => $value) {
        foreach ($value as $art => $qty) {
            $new_data1[] = array(
                'mark' => $key, 
                'art' => $art, 
                'qty' => $qty
            );
        }
    }
    $array = [];
    $new_data2 = [];
    foreach ($data2 as $value) {
        if (isset($array[$value[0]][$value[1]]) and $array[$value[0]][$value[1]]) $array[$value[0]][$value[1]] += $value[2];
        else $array[$value[0]][$value[1]] = $value[2];
    }
    foreach ($array as $key => $value) {
        foreach ($value as $art => $qty) {
            $new_data2[] = array(
                'mark' => $key, 
                'art' => $art, 
                'qty' => $qty
            );
        }
    }

    $newData = [];
    foreach ($new_data1 as $item1) {
        foreach ($new_data2 as $item2) {
            if($item1['mark'] == $item2['mark'] and $item1['art'] == $item2['art']){
                $newData[] = array(
                    'mark' => $item1['mark'], 
                    'art' => $item1['art'], 
                    'qtyOld' => $item1['qty'],
                    'qtyNew' => $item2['qty']
                );
            }
        }
    }
    ?>
    <table class="table">
        <thead>
            <tr>
                <th>Модель</th>
                <th>Артикул</th>
                <th>Старый пр.</th>
                <th>Новый пр.</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach (array_multisort_value($newData, 'mark', SORT_DESC) as $row) {
                ?>
                <tr>
                    <td><?= $row['mark'] ?></td>
                    <td><?= $row['art'] ?></td>
                    <td><?= $row['qtyOld'] ?></td>
                    <td><?= $row['qtyNew'] ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}
?>
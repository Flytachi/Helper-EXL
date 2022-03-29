<?php
require 'lib.php';

if ($_FILES) {
    if ($_FILES['file']) $data = read_excel($_FILES['file']['tmp_name']); unset($data[0]);
    ?>
    <table class="table">
        <thead>
            <tr>
                <th>Марка</th>
                <th>Артикул</th>
                <th>Количество</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $array = [];
            $new_data = [];
            foreach ($data as $value) {
                if (isset($array[$value[0]][$value[1]]) and $array[$value[0]][$value[1]]) $array[$value[0]][$value[1]] += $value[2];
                else $array[$value[0]][$value[1]] = $value[2];
            }
            foreach ($array as $key => $value) {
                foreach ($value as $art => $qty) {
                    $new_data[] = array(
                        'mark' => $key, 
                        'art' => $art, 
                        'qty' => $qty
                    );
                }
            }
            foreach (array_multisort_value($new_data, 'qty', SORT_DESC) as $row) {
                ?>
                <tr>
                    <td><?= $row['mark'] ?></td>
                    <td><?= $row['art'] ?></td>
                    <td><?= $row['qty'] ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}
?>
<h2>Сравнение</h2>

<label for="file1"><b>Файл (старый):</b></label>
<input id="file1" type="file" name="file1" onchange="submitFile()">

<label for="file2"><b>Файл (новый):</b></label>
<input id="file2" type="file" name="file2" onchange="submitFile()">

<label for="sorting"><b>Сортировать по:</b></label>
<select id="sorting" onchange="submitFile()">
    <option value="mark">Модель</option>
    <option value="art">Артикул</option>
    <option value="qtyOld">Кол-во (Старый)</option>
    <option value="qtyNew">Кол-во (Новый)</option>
    <option value="price">Цена</option>
</select>

<hr>

<div id="result"></div>

<script>
    function submitFile() {
        event.preventDefault();
        var data = new FormData;
        var file1 = $("#file1");
        var file2 = $("#file2");

        if(file1.val() && file2.val()){
            data.append('file1', file1.prop('files')[0]);
            data.append('file2', file2.prop('files')[0]);
            data.append('sort', $("#sorting").val());
    
            isLoading();
            $.ajax({
                type: "POST",
                url: "api/comparison-result.php",
                processData: false,
                contentType: false,
                data: data,
                success: function (response) {
                    $("#result").html(response);
                },
            });
        }
    }
</script>
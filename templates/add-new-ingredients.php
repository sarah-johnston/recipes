<script src="../jquery-1.12.1.min.js"></script>
<script>
    $(function() {
        $("#add-new-ingredient").click(function(){
            var new_row = $('#new-table-row').clone().show()
                    .appendTo('#ingredients-table').removeAttr('id')
                    .removeAttr('style');
        }); 
        $("#ingredients-table").on('click','.delete-ingredient',function(){
            $(this).closest('tr').remove();
        });
    });
</script> 
<table id="ingredients-table" width="350px" border="1">
    <tr class="table-headings">
        <td>Ingredient</td>
        <td>Amount</td>
        <td>Unit</td>
    </tr>
    <tr class="new-ingredient">
        <?php include("new-ingredient-row.php")?>
    </tr>
    <tr id="new-table-row" class="new-ingredient">
        <?php include("new-ingredient-row.php")?>
    </tr>
</table>
<input type="button" value="Add Ingredient" id="add-new-ingredient" />
<br>
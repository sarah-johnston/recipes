<script src="resources/jquery-1.12.1.min.js"></script>
<script>
    $(function() {
        $("#add-new-ingredient").click(function(){
        $('#new-table-row').clone().show().appendTo('#ingredients-table')
                    .removeAttr('id').removeAttr('style');
        $('#add-new-ingredient').removeAttr('id');
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
 </table>
<input type="button" value="Add" id="add-new-ingredient" />
<br>

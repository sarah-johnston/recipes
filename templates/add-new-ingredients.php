<script src="resources/jquery-1.12.1.min.js"></script>
<script>
    $(function() {
        $("#add-new-ingredient").click(function(){
        $('#new-table-row select.input-recipe-ingredient').attr("name", "ingredients[]");    
        $('#new-table-row input.ingredient-amount').attr("name", "ingredient_amount[]");
        $('#new-table-row select.input-recipe-unit').attr("name", "ingredient_unit[]");
        $('#new-table-row').clone().show().appendTo('#ingredients-table')
                    .removeAttr('id').removeAttr('style');
        $('#new-table-row select.input-recipe-ingredient').attr("name", "hide_ingredients[]");    
        $('#new-table-row input.ingredient-amount').attr("name", "hide_ingredient_amount[]");
        $('#new-table-row select.input-recipe-unit').attr("name", "hide_ingredient_unit[]");
            
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
    <?php include("first-ingredient-row.php")?>
    <?php include("new-ingredient-row.php")?>
 </table>
<input type="button" value="Add" id="add-new-ingredient" />
<br>
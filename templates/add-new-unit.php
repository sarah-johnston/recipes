<button id="create-unit" type="button" value="Add a new unit" onclick="showUnitNinja()">Add a new unit</button>
<script src="resources/jquery-1.12.1.min.js"></script>
<script>
    $(function(){
        $(".add-unit-input").keypress(function (e) {
            if (e.keyCode == 13)  // the enter key code
            {
                $('#add-unit-button').click();
                return false;
            }
        });
    });</script>
<div id="new-unit-ninja">
    <form id="new-unit-form">
        <h3>Add a new unit</h3>
        Unit:
        <input type="text" name="new_unit_name" id="new-unit-name" class="add-unit-input">
        <br/>
        Unit type:
        <select id="new-unit-type" name="new_unit_type" class="add-unit-input"
            <option value="volume">Volume</option>
            <option value="mass">Mass</option>
        </select>
        <br/>   
        Unit to SI amount:
        <input type="text" name="new_unit_to_si" id="new-unit-to-si" class="add-unit-input">
        <br/>   
        <button id="add-unit-button" type="button" onclick="addUnit()">Add</button>
        <button type="button" onclick="hideUnitNinja()">Cancel</button>
    </form>
</div>
function validateCollectionForm(){
    var name_valid = validateName();
    var recipes_valid = validateRecipes();
    return (name_valid && recipes_valid);
}

function validateName(){
    var collection_name = document.getElementById('input-collection-name').value;
    if((collection_name === "") || (collection_name === null) || (collection_name.trim().length === 0)){
        document.getElementById('collection-name-required').style.display='inline';
        document.getElementById('input-collection-name').style.background = "rgb(255, 204, 204)";
        return false;
    }
    else{
        document.getElementById('collection-name-required').style.display='none';
        document.getElementById('input-collection-name').style.background = "#f1f1f1";
        return true;
    }
}

function validateRecipes(){
    var recipes_repeated = false;
    var recipes = document.getElementsByClassName("input-recipe");
    var recipe_names = new Array();
    
    for(i = 0; i < recipes.length; i++){
        recipe_names.push(recipes[i].value);
    }
    
    recipe_names.sort();
    for(i = 0; i < recipe_names.length; i++){
        if(recipe_names[i] === recipe_names[i + 1]){
            recipes_repeated = true;
        }
    }
    
//    if((new Set(recipe_names)).size !== recipe_names.length){
    if(recipes_repeated === true){
        document.getElementById('no-duplicate-recipes').style.display='inline';
    }
    else{
        document.getElementById('no-duplicate-recipes').style.display='none';
    }
    
    return !recipes_repeated;    
}
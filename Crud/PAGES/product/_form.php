<?php
/////////////////////////////////////////////////////////////////////
// ---------------------------------FORM --------------------------------------------------
////////////////////////////////////////////////////////////////////
function book_stat_form ($BS, $cat, $photo = null) {
    echo "<form method='post' class='form' enctype='multipart/form-data'>";

    //<!------------------------------------------------------------------------------------------ID-->
        echo '<label for="product_id">Product ID</label>';
        echo html_input('text', 'product_id');
        echo err('product_id');
       
//<!-----------------------------------------------------------------------------------------NAME-->
        echo '<label for="name">Product Name</label>';
        echo html_input('text', 'name');
        echo err('name');
        
//<!-------------------------------------------------------------------------------------------PRICE-->
        echo '<label for="price">Price</label>';
        echo html_input('number', 'price', 'min="0.5" max="9999.99", step="0.01"');
        echo err('price');
                
//<!-----------------------------------------------------------------------------------------CATEGORY-->
        echo '<label for="category_id">Category</label>';
        echo html_select('category_id', $cat);
        /*echo '
        <div>
            <input type="text" id="category" name="detail_id" list="cat_name_list">
            <input type="text" id="category" name="category_id" list="cat_id_list">
        </div>';*/
        echo err('category_id');
    
//<!-----------------------------------------------------------------------------------------GENRE-->
        echo '<label for="genre">Genre</label>';
        echo html_input('text', 'genre', 'list="genre_list"');
        echo err('genre');
        
        if ($BS == 'BOOK' || $BS == null) {
            //<!-----------------------------------------------------------------------------------------PUBLISHER-->
            echo '<label for="publisher">Publisher</label>';
            echo html_input('text', 'publisher', 'list="publisher_list"');
            echo err('publisher');

            //<!-----------------------------------------------------------------------------------------DATE-->
            echo '<label for="publish_date">Publish Date</label>';
            echo html_input('date', 'publish_date');
            echo err('publish_date');

            //<!-----------------------------------------------------------------------------------------AUTHOR-->
            echo '<label for="author">Author</label>';
            echo html_input('text', 'author', 'list="author_list"');
            echo err('author');  
        } else   {
            //<!-----------------------------------------------------------------------------------------PUBLISHER-->
            echo '<label for="brand">Brand</label>';
            echo html_input('text', 'brand', 'list="brand"');
            echo err('brand');

            //<!-----------------------------------------------------------------------------------------DATE-->
            echo '<label for="material">Material</label>';
            echo html_input('text', 'material', 'list="material_list"');
            echo err('material');
        }

//<!-----------------------------------------------------------------------------------------KEYWORD-->
        echo '<label for="keywords">Keyword</label>';
        echo html_input('text', 'keywords');
        echo err('keywords') ;

//<!-----------------------------------------------------------------------------------------STOCK-->
        echo '<label for="stock">Stock</label>';
        echo html_input('number', 'stock', "min='1', max='999999' step='1'");
        echo err('stock');
        

//<!-----------------------------------------------------------------------------------------image-->       
        echo '<label for="image" class="image">Product Picture</label>';
        //echo '<label class="upload" >';
        echo html_file('image', 'image/*', 'data-target="preview_img"');
        //echo '<img src="' . (!empty($photo) ? '/IMG/' . $photo: '/IMG/icons/photo.jpg') . '">';
        //echo '<img src="/IMG/icons/photo.jpg">';
        //echo '</label>';
        echo err('image');
}


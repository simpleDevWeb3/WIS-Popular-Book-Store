<?php
/////////////////////////////////////////////////////////////////////
// ---------------------------------FORM --------------------------------------------------
////////////////////////////////////////////////////////////////////
function book_stat_form ($BS, $cat,$product_detail, $photo = null) {
        $flat_categories = [];

        foreach ($cat as $cats) {
                $flat_categories[$cats['category_id']] = $cats['category_name'];
        }    
        
       
    echo "<form class='admin_crud_form' method='post' enctype='multipart/form-data'>";

    //<!------------------------------------------------------------------------------------------ID-->
        echo '<label class="admin_crud_label" for="product_id">Product ID</label>';
        echo html_input('text',$product_detail['product_id'] ?? '','product_id');
        echo err('product_id');
       
//<!-----------------------------------------------------------------------------------------NAME-->
        echo '<label class="admin_crud_label" for="name">Product Name</label>';
        echo html_input('text',$product_detail['name']??'' ,'name');
        echo err('name');
        
//<!-------------------------------------------------------------------------------------------PRICE-->
        echo '<label class="admin_crud_label" for="price">Price</label>';
        echo html_input('number', $product_detail['price']??0,'price' ,'min="0.5" max="9999.99", step="0.01"');
        echo err('price');
                
//<!-----------------------------------------------------------------------------------------CATEGORY-->
        echo '<label class="admin_crud_label" for="category_id">Category</label>';
        echo html_select($flat_categories, $cat);
        echo err('category_id');
    
        
        if ($BS == 'BOOK' || $BS == null) {
            //<!-----------------------------------------------------------------------------------------GENRE-->
            echo '<label class="admin_crud_label" for="genre">Genre</label>';
            echo html_input('text', $product_detail['genre'] ?? '', 'list="genre_list"');
            echo err('genre');

            //<!-----------------------------------------------------------------------------------------PUBLISHER-->
            echo '<label class="admin_crud_label" for="publisher">Publisher</label>';
            echo html_input('text', $product_detail['publisher'] ?? '','publisher', 'list="publisher_list"');
            echo err('publisher');

            //<!-----------------------------------------------------------------------------------------DATE-->
            echo '<label class="admin_crud_label" for="publish_date">Publish Date</label>';
            echo html_input('date', $product_detail['publish_date'] ?? '','publish_date');
            echo err('publish_date');

            //<!-----------------------------------------------------------------------------------------AUTHOR-->
            echo '<label class="admin_crud_label" for="author">Author</label>';
            echo html_input('text', $product_detail['author'] ?? '','author', 'list="author_list"');
            echo err('author');  
        } else   {
            //<!-----------------------------------------------------------------------------------------PUBLISHER-->
            echo '<label class="admin_crud_label" for="brand">Brand</label>';
            echo html_input('text', $product_detail['brand'] ?? '','brand', 'list="brand"');
            echo err('brand');

            //<!-----------------------------------------------------------------------------------------DATE-->
            echo '<label class="admin_crud_label" for="material">Material</label>';
            echo html_input('text', $product_detail['material'] ?? '','material', 'list="material_list"');
            echo err('material');
        }

//<!-----------------------------------------------------------------------------------------KEYWORD-->
        echo '<label class="admin_crud_label" for="keywords">Keyword</label>';
        echo html_input('text',$product_detail['keywords'] ?? '', 'keywords');
        echo err('keywords') ;

//<!-----------------------------------------------------------------------------------------STOCK-->
        echo '<label class="admin_crud_label" for="stock">Stock</label>';
        echo html_input('number',$product_detail['stock'] ?? 0,'stock', "min='1', max='999999' step='1'");
        echo err('stock');
        

//<!-----------------------------------------------------------------------------------------image-->       
        echo '<label class="admin_crud_label" for="image" class="image">Product Picture</label>';
        echo html_file('image', 'image/*', 'data-target="preview_img"');
        echo err('image');
}


<?php
auth('Admin');
require '_form.php';
require 'controller/_updateValidation.php';


//***************************************************************************get product detail
if (is_get()) {
    $id = req('id');

    $stm = $_db->query('SELECT * FROM products p
                            INNER JOIN product_details pd
                            ON p.product_id = pd.product_id
                            WHERE p.product_id = ?',[$id]);
    $stm->execute();
    $product_detail = $stm->fetch();
 
    if (!$product_detail) {
        redirect('/product_list');
    }

    extract((array)$product_detail);


    //temp_image('image', $image);
    $_SESSION['image'] = $image;
}



if(is_post()){
 // Output

    if (!$_err) {

        //delete old image and save new image
        if ($f) {
            unlink("/Img/Product/$image");
            $image = save_photo($f, '/Img/Product/');
        }

        // DB operation
        $stm = $_db->query('UPDATE products 
                                SET name = ?,
                                    price = ?,
                                    image = ?,
                                    category_id = ?
                                    WHERE product_id = ?',[$name, $price, $image, $category_id, $product_id]);


        if ($BS == 'BOOK' || $BS == null) {
            $stm = $_db->query('UPDATE product_details 
                                    SET category_id = ?,
                                        author = ?,
                                        publisher = ?,
                                        publish_date = ?,
                                        stock = ?,
                                        genre = ?,
                                        keywords = ?
                                        WHERE product_id = ?',[$category_id, $author, $publisher, $publish_date, $stock, $genre, $keywords, $product_id]);

        } else if($_err) {
      
            dd($_err);
         
           
        }
        
        temp('info', 'Record updated');
        redirect('/product_list');
    }

}



$id = req('id');

$stm = $_db->query('SELECT * FROM products p
                        INNER JOIN product_details pd
                        ON p.product_id = pd.product_id
                        WHERE p.product_id = ?',[$id]);
$stm->execute();
$product_detail = $stm->fetch();

if (!$product_detail) {
    redirect('/product_list');
}

extract((array)$product_detail);


//temp_image('image', $image);
$_SESSION['image'] = $image;


$BS = statOrBook($category_id);

//***************************************************************************fetch category name and id 
$category_prepare = $_db->query('SELECT c3.category_id, c3.category_name
                        FROM categories c1
                        INNER JOIN categories c2
                        ON c1.category_id = c2.parent_id
                        INNER JOIN categories c3
                        ON c2.category_id = c3.parent_id
                        WHERE c3.category_id LIKE ?
                        ORDER BY c3.category_name ASC',[$BS.'%']);
$category_prepare->execute();
$category_db = $category_prepare->fetchAll();


$author_list = preapreDataList('author');
$genre_list = preapreDataList('genre');
$publisher_list = preapreDataList('publisher');
$brand_list = preapreDataList('brand');
$material_list = preapreDataList('material');

$_title = "Product - Update";
include 'view/partials/head.php';
include 'view/partials/header.php';
?>

<!----------------------------------------------------------HTML------------------------------------------------------------------------------>
<main style="padding-top: 120px;">
    <a href="/product_list">
        <button class="back">
            <img src="/Img/Icon/arrow.png" class="back-img">
        </button>
    </a>
    <div class="admin_crud_page_container">

    <!-------------------------------------------------------------------------------------------------------------------form insert product-->
  
        <div class="admin_crud_form_container">
            
            <div>
           
                <?php book_stat_form($BS, $category_db,$product_detail, $image) ?>

                <!-----------------------------------------------------------------------------------------------------------------------------DATALIST-->
                <datalist id="author_list">
                    <?php foreach ($author_list as $data): ?>
                        <option value=<?= $data['author'] ?>>
                    <?php endforeach ?>
                </datalist>

                <datalist id="publisher_list">
                    <?php foreach ($publisher_list as $data): ?>
                        <option value=<?= $data['publisher'] ?>>
                    <?php endforeach ?>
                </datalist>

                <datalist id="brand_list">
                    <?php foreach ($brand_list as $data): ?>
                        <option value=<?= $data['brand'] ?>>
                    <?php endforeach ?>
                </datalist>

                <datalist id="genre_list">
                    <?php foreach ($genre_list as $data): ?>
                        <option value=<?= $data['genre'] ?>>
                    <?php endforeach ?>
                </datalist>

                <datalist id="material_list">
                    <?php foreach ($material_list as $data): ?>
                        <option value=<?= $data['material'] ?>>
                    <?php endforeach ?>
                </datalist>
            </div>

            <div class="admin_crud_product_img_container">
                <img src="<?= $image ?>" data-id="preview_img">
            </div>

        </div>

        <!--buttons-->
            <section class="admin_crud_form_section">
                <button data-get="/product_detail?id=<?= $product_id ?>" class="admin_crud_close_btn">Cancel</button>
                <button  data-post="/update?id=<?= $product_id ?>" type="submit" class="admin_crud_submit_btn">Submit</button>
            </section>

            
        <!--!!!!!dont delete this form tag!!!!!-->
    </div>
    </form>
</main>
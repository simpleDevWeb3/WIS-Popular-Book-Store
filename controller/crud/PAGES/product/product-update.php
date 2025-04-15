<?php
require $_SERVER['DOCUMENT_ROOT'] . '/_base.php';
require '_form.php';
require '_updateValidation.php';

//***************************************************************************get product detail
if (is_get()) {
    $id = req('id');

    $stm = $_db->prepare('SELECT * FROM products p
                            INNER JOIN product_details pd
                            ON p.product_id = pd.product_id
                            WHERE p.product_id = ?');
    $stm->execute([$id]);
    $product_detail = $stm->fetch();

    if (!$product_detail) {
        redirect('product.php');
    }

    extract((array)$product_detail);
    //temp_image('image', $image);
    $_SESSION['image'] = $image;
}
$BS = statOrBook($category_id);


//***************************************************************************fetch category name and id 
$category_prepare = $_db->prepare('SELECT c3.category_id, c3.category_name
                        FROM categories c1
                        INNER JOIN categories c2
                        ON c1.category_id = c2.parent_id
                        INNER JOIN categories c3
                        ON c2.category_id = c3.parent_id
                        WHERE c3.category_id LIKE ?
                        ORDER BY c3.category_name ASC');
$category_prepare->execute([$BS.'%']);
$category_db = $category_prepare->fetchAll();

//***************************************************************************fetch data list
$author_list = preapreDataList('author');
$genre_list = preapreDataList('genre');
$publisher_list = preapreDataList(('publisher'));
$brand_list = preapreDataList('brand');
$material_list = preapreDataList('material');

//***************************************************************************update into DB
if (is_post()) {
        // Output
        if (!$_err) {

            //delete old image and save new image
            if ($f) {
                unlink("../../IMG/$image");
                $image = save_photo($f, '../../IMG');
            }
    
            // DB operation
            $stm = $_db->prepare('UPDATE products 
                                    SET name = ?,
                                        price = ?,
                                        image = ?,
                                        category_id = ?
                                        WHERE product_id = ?');
            $stm->execute([$name, $price, $image, $category_id, $product_id]);
    
            if ($BS == 'BOOK' || $BS == null) {
                $stm = $_db->prepare('UPDATE product_details 
                                        SET category_id = ?,
                                            author = ?,
                                            publisher = ?,
                                            publish_date = ?,
                                            stock = ?,
                                            genre = ?,
                                            keywords = ?
                                            WHERE product_id = ?');

                $stm->execute([$category_id, $author, $publisher, $publish_date, $stock, $genre, $keywords, $product_id]);
    
            } else {
                $stm = $_db->prepare('UPDATE product_details 
                                        SET category_id = ?,
                                            brand = ?,
                                            material = ?,
                                            stock = ?,
                                            genre = ?,
                                            keywords = ?
                                            WHERE product_id = ?');
                $stm->execute([$category_id, $brand, $material, $stock, $genre, $keywords, $product_id]);
    
            }
    
            temp('info', 'Record updated');
            redirect('product.php');
        }    
}                                    


$_title = "Product - Update";
include $_SERVER['DOCUMENT_ROOT'] . '/_head.php';
?>

<!----------------------------------------------------------HTML------------------------------------------------------------------------------>
<a href="product.php">
    <button class="back">
        <img src="/IMG/icons/arrow.png" class="back-img">
    </button>
</a>
<div class="page-container">

<!-------------------------------------------------------------------------------------------------------------------form insert product-->
    <div class="form-container">
        <div>
            <?= book_stat_form($BS, $category_db, $image) ?>

            <!-----------------------------------------------------------------------------------------------------------------------------DATALIST-->
            <datalist id="author_list">
                <?php foreach ($author_list as $data): ?>
                    <option value=<?= $data->author ?>>
                <?php endforeach ?>
            </datalist>

            <datalist id="publisher_list">
                <?php foreach ($publisher_list as $data): ?>
                    <option value=<?= $data->publisher ?>>
                <?php endforeach ?>
            </datalist>

            <datalist id="brand_list">
                <?php foreach ($brand_list as $data): ?>
                    <option value=<?= $data->brand ?>>
                <?php endforeach ?>
            </datalist>

            <datalist id="genre_list">
                <?php foreach ($genre_list as $data): ?>
                    <option value=<?= $data->genre ?>>
                <?php endforeach ?>
            </datalist>

            <datalist id="material_list">
                <?php foreach ($material_list as $data): ?>
                    <option value=<?= $data->material ?>>
                <?php endforeach ?>
            </datalist>
        </div>

        <div class="image-container">
            <img src="/IMG/<?= $image ?>" data-id="preview_img">
        </div>

    </div>

    <!--buttons-->
        <section>
            <button data-get="product-details.php?id=<?= $product_id ?>" class="close-btn">Cancel</button>
            <button type="submit" class="submit-btn">Submit</button>
        </section>

        
    </form><!--!!!!!dont delete this form tag!!!!!-->
</div>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/_base.php';
require '_form.php';
require '_insertValidation.php';

$BS = req('BS') ?: 'BOOK';
if ($BS == 'BOOK') {
    $prod_title = 'Book';
} else {
    $prod_title = 'Stationary';
}
$image = temp_image('image');

//***************************************************************************category
$category_prepare = $_db->prepare('SELECT c3.category_id, c3.category_name
                        FROM categories c1
                        INNER JOIN categories c2
                        ON c1.category_id = c2.parent_id
                        INNER JOIN categories c3
                        ON c2.category_id = c3.parent_id
                        WHERE c3.category_id LIKE ?
                        ORDER BY c3.category_name ASC');
$category_prepare->execute(["$BS%"]);
$category_db = $category_prepare->fetchAll();

//**************************************************************************prepare datalist
$author_list = preapreDataList('author');
$genre_list = preapreDataList('genre');
$publisher_list = preapreDataList(('publisher'));
$brand_list = preapreDataList('brand');
$material_list = preapreDataList('material');

//----------------------------------------------------------------------------------------INSERT INTO DB

if (is_post()) {

    // Output
    if (!$_err) {
        $image = save_photo($f, '../../IMG');

        $stm = $_db->prepare('INSERT INTO products
                            (product_id, name, price, image, category_id, rating)
                            VALUES(?, ?, ?, ?, ?, null)');
        $stm->execute([$product_id, $name, $price, $image, $category_id]);

        if ($BS == 'BOOK' || $BS == null) {
            $stm = $_db->prepare('INSERT INTO product_details
                                (product_id, category_id, author, publisher, publish_date, brand, material, stock, genre, keywords) 
                                VALUES(?, ?, ?, ?, ?, null, null, ?, ?, ?)');
            $stm->execute([$product_id, $category_id, $author, $publisher, $publish_date, $stock, $genre, $keywords]);     ///warning

        } else {
            $stm = $_db->prepare('INSERT INTO product_details
                                (product_id, category_id, author, publisher, publish_date, brand, material, stock, genre, keywords) 
                                VALUES(?, ?, null, null, null, ?, ?, ?, ?, ?)');

            $stm->execute([$product_id, $category_id, $brand, $material, $stock, $genre, $keywords]);

        }

        temp('info', 'Record inserted');
        redirect('product.php');
    }
}

$_title = "Product - Insert";
include $_SERVER['DOCUMENT_ROOT'] . '/_head.php';
?>


<!----------------------------------------------------------HTML------------------------------------------------------------------------------>


<a href="product.php">
    <button class="back">
        <img src="/IMG/icons/arrow.png" class="back-img">
    </button>
</a>

<div class="page-container">
    
    <div class="book-stat">
        <div>        
            <a href="?BS=BOOK">Book</a>
        </div>
        <div>        
            <a href="?BS=STAT">Stationary</a>
        </div>
    </div>

    <P><?= $prod_title ?></p>

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
            <img src="/IMG/icons/photo.jpg" data-id="preview_img">
        </div>

    </div>


    <!--buttons-->
        <section>
            <button data-get="product.php" class="close-btn">Cancel</button>
            <button type="reset" class="reset-btn">Reset</button>
            <button type="submit" class="submit-btn">Submit</button>
        </section>
    </form><!--!!!!!dont delete this form tag!!!!!-->
</div>
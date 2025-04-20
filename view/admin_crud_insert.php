<?php
auth('Admin');
$_db = new Database();

require 'controller/_insertValidation.php';
require '_form.php';

$BS = req('BS') ?: 'BOOK';
if ($BS == 'BOOK') {
    $prod_title = 'Book';
} else {
    $prod_title = 'Stationary';
}
$image = temp_image('image');

//***************************************************************************category
$category_prepare = $_db->query('SELECT c3.category_id, c3.category_name
                        FROM categories c1
                        INNER JOIN categories c2
                        ON c1.category_id = c2.parent_id
                        INNER JOIN categories c3
                        ON c2.category_id = c3.parent_id
                        WHERE c3.category_id LIKE ?
                        ORDER BY c3.category_name ASC',["$BS%"]);

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
        $image = save_photo($f, '/Img/Product');

        $stm = $_db->query('INSERT INTO products
                            (product_id, name, price, image, category_id, rating)
                            VALUES(?, ?, ?, ?, ?, null)',[$product_id, $name, $price, $image, $category_id]);
  

        if ($BS == 'BOOK' || $BS == null) {
            $stm = $_db->query('INSERT INTO product_details
                                (product_id, category_id, author, publisher, publish_date, brand, material, stock, genre, keywords) 
                                VALUES(?, ?, ?, ?, ?, null, null, ?, ?, ?)',[$product_id, $category_id, $author, $publisher, $publish_date, $stock, $genre, $keywords]);
     

        } else {
            $stm = $_db->query('INSERT INTO product_details
                                (product_id, category_id, author, publisher, publish_date, brand, material, stock, genre, keywords) 
                                VALUES(?, ?, null, null, null, ?, ?, ?, null, ?)',[$product_id, $category_id, $brand, $material, $stock, $genre, $keywords]);

        

        }

        temp('info', 'Record inserted');
        redirect('/product_list');
    }
}

$_title = "Product - Insert";
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
        
        <div class="book-stat">
            <a href="?BS=BOOK" class="book-stat-book">
                <div>Book</div>
            </a>
            <a href="?BS=STAT" class="book-stat-stat">
                <div>Stationary</div>
            </a>
        </div>

        <P><?= $prod_title ?></p>

    <!-------------------------------------------------------------------------------------------------------------------form insert product-->
        <div class="admin_crud_form_container">
            <div>
                <?= book_stat_form($BS, $category_db, $image) ?>

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
                <img src="/Img/Icon/photo.jpg" data-id="preview_img">
            </div>

        </div>


        <!--buttons-->
            <section class="admin_crud_form_section">
                <button data-get="\product_list" class="admin_crud_close_btn">Cancel</button>
                <button type="reset" class="admin_crud_reset_btn">Reset</button>
                <button type="submit" class="admin_crud_submit_btn">Submit</button>
            </section>
        </form><!--!!!!!dont delete this form tag!!!!!-->
    </div>
</main>


<?php require 'view/partials/footer.php' ?>
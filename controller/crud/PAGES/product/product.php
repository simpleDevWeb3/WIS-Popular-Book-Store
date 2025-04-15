<?php
require $_SERVER['DOCUMENT_ROOT'] . '/_base.php';
//************************************************************************ */ Searching
$search = isset($_REQUEST['search']) ? $_REQUEST['search'] : temp('search');
temp('search', $search);

//************************************************************************ */ Sorting
$fields = [
    'p.product_id'  => 'Product ID.',
    'p.name'        => 'Product Name',
    'p.category_id' => 'Category',
    'pd.stock'      => 'Stock',
    'p.rating'      => 'Rating',
    'p.price'       => 'Price(RM)',
];

$sort = req('sort');
key_exists($sort, $fields) || $sort = 'p.product_id';

$dir = req('dir');
in_array($dir, ['asc', 'desc']) || $dir = 'asc';

//************************************************************************* */ Paging
//$page = req('page', 1);
$page = req('page') ?? temp('page') ?? 1;
//dd($page);
temp('page', $page);

require_once $_SERVER['DOCUMENT_ROOT'] . '/LIB/SimplePager.php';
$p = new SimplePager("SELECT * FROM products p
                        INNER JOIN product_details pd
                        ON p.product_id = pd.product_id
                        WHERE p.name LIKE ?
                        ORDER BY $sort $dir",
                        ["%$search%"], 10, $page);
$arr = $p->result;


$_title = "Product";
include $_SERVER['DOCUMENT_ROOT'] . '/_head.php';


$index = 1;
?>
<!-----------------------------------------------------------------------------------------HTML-->
<div class="function-toolsbar">
    <div class="data-manage-button">
        <button class="insert-btn" data-get='insert.php'>
            Insert
        </button>
    </div>
    
    <div class="searching-and-filtering">
        <form>
            <?= html_search('search', 'placeholder="Search something..."') ?>
            <button class="search-button">
                <img src="/IMG/icons/search.png" class="search-img">
            </button>
        </form>
    </div>
</div>

<div class="page-container">
    <div class="product-content">
        <p>
            <?= $p->count ?> of <?= $p->item_count ?> record(s) |
            Page <?= $p->page ?> of <?= $p->page_count ?>
        </p>

        <!-- table -->
        <div class="product-content-table">
            <!--display total products-->
            <table class="product_table">
                <tr>
                    <th>No.</th>        
                    <?= table_headers($fields, $sort, $dir, "page=$page") ?>   
                    <th></th>     <!--empty th for buttons-->           
                </tr>

                <!-- display products from database -->
                <?php foreach ($arr as $prod): ?>
                <tr>
            
                    <td><?= $index++ ?></td>
                    <td><?= $prod->product_id ?></d>
                    <td><?= $prod->name ?></d>
                    <td><?= $prod->category_id ?></d>
                    <td><?= $prod->stock ?><d>
                    <td><?= $prod->rating ?></d>
                    <td><?= $prod->price ?></d>
                    <td>
                        <button class="detail-btn" data-get="product-details.php?id=<?= $prod->product_id ?>&page='<?= $page ?>'">Detail</button>
                        <button class="update-btn" data-get="product-update.php?id=<?= $prod->product_id ?>&page='<?= $page ?>'">Update</button>
                        <button class="delete-btn" data-confirm="Delete this record?" data-post="_delete.php?id=<?= $prod->product_id ?>" >Delete</button>
                    </td>
                </tr> 

                <?php endforeach ?>
            </table>

        </div>
    </div>

    <br>
    <?= $p->html("sort=$sort&dir=$dir&search=$search") ?>
</div>

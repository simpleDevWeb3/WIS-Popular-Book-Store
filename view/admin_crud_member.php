<?php
//require $_SERVER['DOCUMENT_ROOT'] . '/_base.php';
auth('Admin');
$_title = 'Member';
include 'view/partials/head.php';
include 'view/partials/header.php';
?>

        <?php
        //require $_SERVER['DOCUMENT_ROOT'] . '/_base.php';

        //************************************************************************ */ Searching
        $search = isset($_REQUEST['admin_search']) ? $_REQUEST['admin_search'] : temp('admin_search');
        temp('admin_search', $search);

        //************************************************************************ */ Sorting
        $fields = [
            'user_id'   => 'User ID',
            'username'  => 'Username',
            'email'    => 'E-mail',
            'phone_number' => 'Phone no.',
            'dob'   => 'DOB',
            'gender' => 'Gender',
            'role' => 'Role',
        ];

        $sort = req('sort');
        key_exists($sort, $fields) || $sort = 'user_id';

        $dir = req('dir');
        in_array($dir, ['asc', 'desc']) || $dir = 'asc';

        //************************************************************************* */ Paging
        $page = req('page') ?? temp('page') ?? 1;
        temp('page', $page);

        //                                         got error, comment first, dont delete
        //require_once $_SERVER['DOCUMENT_ROOT'] . '/LIB/SimplePager.php';
        $p = new SimplePager("SELECT * FROM users
                                WHERE username LIKE ?
                                ORDER BY $sort $dir",
                                ["%$search%"], 10, $page);
        $arr = $p->result;


        $_title = "Member";
        include 'view/partials/head.php';
       

        $index = 1;
        ?>
<div style="display: flex; justify-content:center; align-items:center; margin:auto; gap:10px;">

    <div style=" margin-bottom:400px; margin-left:0px;">
         <?php include 'view/partials/admin_crud_navBar.php'; ?>
    </div>

    <main style="padding-top:50x; margin-top:100px; height:700px ">
                <!-----------------------------------------------------------------------------------------HTML-->
            <div style="display:flex; justify-content:center; gap:20px; ">


                    <div class="admin_crud_page_container">
                     

                        <div class="product-content">

                        <div style="display:flex; justify-content:space-between; align-items:center; margin-right:40px; ">
                            <p>
                                <?= $p->count ?> of <?= $p->item_count ?> record(s) |
                                Page <?= $p->page ?> of <?= $p->page_count ?>
                            </p>

                            <div class="admin_crud_searching-and-filtering">
                                <form>
                                    <?= html_search('admin_search', 'placeholder="Search something..."') ?>
                                    
                                </form>
                            </div>
                          </div>                            <!-- table -->
                            <div class="product-content-table">
                                <!--display total products-->
                                <table class="admin_crud_table">
                                    <tr>
                                        <th>No.</th>        
                                        <?= table_headers($fields, $sort, $dir, "page=$page") ?>   
                                        <th></th>     <!--empty th for buttons-->           
                                    </tr>

                                    <!-- display products from database -->
                                    <?php foreach ($arr as $user): ?>
                                    <tr>
                                
                                        <td><?= $index++ ?></td>
                                        <td><?= $user['user_id'] ?></d>
                                        <td><?= $user['username'] ?></d>
                                        <td><?= $user['email'] ?></d>
                                        <td><?= $user['phone_number'] ?><d>
                                        <td><?= $user['dob'] ?></d>
                                        <td><?= $user['gender'] ?></d>
                                        <td><?= $user['role'] ?></d>
                                        <td><button>details</button></td>
                                    </tr> 

                                    <?php endforeach ?>
                                </table>

                            </div>
                        </div>

                        <br>
                        <?= $p->html("sort=$sort&dir=$dir&search=$search") ?>
                    </div>
            
        </div>
    </main>
 </div>
<?php require 'view/partials/footer.php' ?>



    <!-- Flash message -->
    <div id="info"><?= temp('info') ?></div>

        <div>
            <h1><?= $_title ?? "LOGO and NAME"?></h1>
        </div>
            
        <div class="admin_crud_navigation_bar ">
        

            <a href="/product_list" class="admin_crud_navigation_bar_button">
                    <button class="navigation_bar_button">
                        <img class="navigation_bar_button_icon_image" src="/Img/Icon/boxes.png">
                        <p>Product</p>
                    </button>
            </a>

            <a href="/member_list" class="admin_crud_navigation_bar_button">
                    <button class="navigation_bar_button">
                        <img class="navigation_bar_button_icon_image" src="/Img/Icon/user.png">
                        <p>Member</p>
                    </button>
            </a>

            <a href="sales_list" class="admin_crud_navigation_bar_button">
                    <button class="navigation_bar_button">
                        <img class="navigation_bar_button_icon_image" src="/Img/Icon/book-alt.png">
                        <p>Sales</p>
                    </button>
            </a>

          

            <a class="admin_crud_navigation_bar_button  ">
                <button style="padding-top:10px;align-items:center;"  class="admin_crud_insert-btn" data-get='/insert'>
                     <img style="width: 10px; " src="/Img/Icon/user.png">
                     
                    <p>Insert</p>
                </button>
            </a>

        </div>



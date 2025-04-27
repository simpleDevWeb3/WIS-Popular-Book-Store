
    <!-- Flash message -->
    <div id="info"><?= temp('info') ?></div>

        
        <div class="admin_crud_navigation_bar " style=" margin-top: 138px; margin-right: 30px;">
        

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

          

            <a class="admin_crud_navigation_bar_button" href='/insert'> <!--   i change the dataget from button to heref on a tag -->
                <button style="padding-top:10px;align-items:center;"  class="navigation_bar_button ">
                     <img class="navigation_bar_button_icon_image" src="/Img/Icon/user.png">
                     
                    <p>Insert</p>
                </button>
            </a>

        </div>



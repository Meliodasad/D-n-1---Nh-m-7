<div class="row mb">
        <div class="boxtrai mr">
        <div class="row mb">
           
            <div class="boxtitle">Đăng Ký Thành Viên</div>
                <div class="row boxcontent formtaikhoan">
                    <form action="index.php?act=dangky" method="post">
                    <div class="row mb10" >
                        Email:
                         <input type="email" name="email">
                    </div>
                    <div class="row mb10" > 
                        Tên Tài Khoản:
                        <input type="text" name="user">
                    </div>
                    <div class="row mb10" >
                        Mật Khẩu:
                         <input type="password" name="password">
                    </div>
                    <div class="row mb10" > 
                        <input type="submit" name="dangky" value="Đăng Ký">
                        <input type="reset" value="Nhập Lại">
                    </div> 
                    </form>
                    <h2 class="thongbao">
                        <?php
                            if(isset($thongBao)&&($thongBao!="")) echo $thongBao;
                        ?>
                    </h2>
                </div>
        </div>
       
    </div>
        <div class="boxphai">
            <?php
                include "./view/boxphai.php";
            ?>
        </div>
</div>
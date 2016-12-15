<!DOCTYPE html>
<html>
    <head>
        <title> <?php echo $title; ?> </title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
            <?php require (PATH_TEMPLATE . '/header.php'); ?>        
        
            <div class="group-box">    
                <div align="center">

                    <form action="index.php/?c=login&a=login" method="post" name="frmLogin">
                    <br>         
                    <table class=frm>
                    <tr> 
                        <td align="right"><label for="txtTenDangNhap"> Tên Đăng nhập: </label> </td>
                        <td align="left"><input type="text" name="txtTenDangNhap" placeholder="tên đăng nhập"> </td>
                    </tr>
                    <tr>
                        <td align="right"> <label for="txtMatKhau"> Mật khẩu: </label></td>
                        <td align="left"> <input type="password" name="txtMatKhau" placeholder="mật khẩu"> <br /> </td>
                    </tr>       
                    <tr>
                        <td> &nbsp; </td> 
                        <td> <button type="submit" name="btnDangNhap" class="btn" >Đăng nhập</button></td>
                    </tr>
                    </table>         
                    <br>
                    </form> 
                </div>
            </div>
            <?php require (PATH_TEMPLATE . '/footer.php'); ?>
    </body>
</html>
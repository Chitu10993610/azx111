<div style="width:818px;border:#FF0000 solid 0px;"><form method="post" action="<?=site_url('user/login')?>" onsubmit="return verlogin();">
 <table align="center" cellspacing="2" cellpadding="0" border="0">
  <tbody><tr>
    <td>Tên truy cập </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="text" name="username" value="" id="username" style="width: 160px;"></td>
    <td></td>
  </tr>
  <tr>
    <td>Mật khẩu</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="password" value="" id="password" style="width: 110px;" name="password"><input type="submit" onmouseover="this.style.color='#FF0000;'" style="padding: 2px; font-size: 10px; font-weight: bold;" value="Login"></td>
    <td>
        
    </td>
  </tr>
  <tr>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight: normal;"><input type="checkbox" value="" id="save_account">Tự động đăng nhập lần sau</td>
  </tr>
  <tr>
  
    <td>&nbsp;
        
    </td>
  </tr>
  <!--<tr>
    <td colspan="2"><a href="lostpassword.php" target="_parent" class="bold_red">Quên mật khẩu</a></td>
  </tr>-->
</tbody>
</table>
  </form>
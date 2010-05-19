<div align="center"  style="  padding-top:100px;" class="narrowcolumn">
	<div  style=" border: #CCCCCC solid 2px; width:600px;" id="container">
	<?php $this->lang->load('userauth', $this->session->userdata('ua_language')); ?>
	<span id="error" class="error"><?php if(isset($error)) echo $error;?></span>
	     <table align="center" width="480" border="0" cellpadding="5" cellspacing="5">
	          <tbody><tr valign="center" align="middle" bgcolor="#ffffff">
	            <td colspan="3" style="text-transform:uppercase; font-weight:bold; color:#0000FF;" align="center"><h2>Đăng nhập</h2>
	              </td>
	          </tr>
	          <tr>
	            <td valign="top" width="74%" align="middle" bgcolor="#ffffff">
				<table width="350" border="0" cellpadding="4" cellspacing="1">
	                <tbody><tr>
	                  <td valign="top">
	                  <form method="post" action="<?=site_url('user/login')?>" onsubmit="return verlogin();">
					  <table width="100%" border="0" cellpadding="3" cellspacing="5" height="100%">
	                      <tbody><tr>
	                        <td colspan="2" class="headerlogin" height="5">&nbsp;</td>
	                      </tr>
	                      <tr>
	                        <td class="headerlogin" valign="middle" width="30%"><b> <?=$this->lang->line('ua_username');?>:</b></td>
	                        <td class="headerlogin2" valign="middle" width="70%">
							<input value="<?=$username?>" style="border-color: rgb(153, 153, 153);" name="username" id="username" size="35" maxlength="40" class="inputbox" onBlur="style.borderColor='#999999';" onMouseOver="style.borderColor='#FFEB70'" onMouseOut="style.borderColor='#999999'" type="text"></td>
	                      </tr>
	                      <tr>
	                        <td class="headerlogin" valign="middle"><b><?=$this->lang->line('ua_password');?>:</b></td>
	                        <td class="headerlogin2" valign="middle">
							<input value="<?=$password?>" style="border-color: rgb(153, 153, 153);" name="password" id="password" class="inputbox" size="35" maxlength="40" onBlur="style.borderColor='#999999';" onMouseOver="style.borderColor='#FFEB70'" onMouseOut="style.borderColor='#999999'" type="password"></td>
	                      </tr>
						  <tr class="headerlogin">
						    <td>&nbsp;</td>
						    <td colspan="3"><span id="error" style="visibility: hidden;" class="error">Xin mời nhập đầy đủ, username, password</span></td>
					      </tr>
	                      <!--<tr>
	                        <td class="headerlogin" valign="middle">&nbsp;</td>
	                        <td align="left" valign="middle">
							<input type="checkbox" name="remember_me" id="remember_me" value="true" <?=(isset($remember_me) && $remember_me)? "checked":""?> /><label for="remember_me"> &nbsp;Nhớ thông tin đăng nhập</label>
							</td>
	                      </tr>-->
	                      <td class="headerlogin" valign="middle">&nbsp;</td>
	                        <td class="headerlogin2" valign="middle" align="left">
							<input style="" class="button" value="Login" title="Login" onMouseOver="this.style.borderColor='#FFEB70';" onMouseOut="this.style.borderColor='';" type="submit">
							</td>
	                      </tr>
	                    </tbody></table>
	                    </form>
	                    </td>
	                </tr>
					<tr><td class="tabel_super_header" height="4">
					</tr>
	              </tbody></table></td>
	            <td style="padding-top: 10px;" valign="top" width="26%" align="center" bgcolor="#ffffff">
					<img src="<?=base_url()?>images/login_lock.jpg" alt="Login" name="imglog" id="imglog" s="">
				</td>
	          </tr>
			          </tbody></table>
	      
	</div>
</div>
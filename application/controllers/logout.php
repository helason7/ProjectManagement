<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to ILCS Project Management Tools</title>
</head>
<body class="main background lazy-loaded">

<div class="header">
	<div class="wrapper">
	<h1>
		<img class="lazy-loaded" src="assets/img/logo ilcs.png" alt="ILCS">
	</h1>
	<form class="login-form" action="<?php echo _URL;?>login/loginMe" method="post" >
		<div>
			<!--label for="login-username">UserName</label-->
			<input type="text" class="login-username" tabindex="1" id="login-username" placeholder="User Name" name="username" required autofocus="autofocus" dir="ltr"/>
			<!--span class="glyphicon glyphicon-envelope form-control-feedback"></span-->
		</div>
		<div>
			<!--label for="login-password">Password</label-->
			<input type="password" class="login-password" tabindex="1" id="login-password" placeholder="Password" name="password" required autofocus="autofocus" dir="ltr" />
			<!--span class="glyphicon glyphicon-lock form-control-feedback"></span-->
		</div>
		<div>
				<input tabindex="1" id="login-submit" type="submit" class="login submit-button" value="Sign In" />
	</form>
        <p class="login-box-msg"></p>
        <?php $this->load->helper('form'); ?>
        <div class="row">
            <div class="login">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
        <?php
        $this->load->helper('form');
        $error = $this->session->flashdata('error');
        if($error)
        {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error; ?>
            </div>
        <?php }
        $success = $this->session->flashdata('success');
        if($success)
        {
            ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $success; ?>
            </div>
        <?php } ?>

        <!-- <a href="<?php echo base_url() ?>forgotPassword">Forgot Password</a><br> -->

</div>
</div>

</body>
</html>

<style type="text/css">
#main{
width:960px;
margin:50px auto;
font-family:raleway;
}

img.lazy-loaded {
    -webkit-transition: opacity 0.3s;
    transition: opacity 0.3s;
		height: 30px;
}

.header{
padding: 0 12px;
}

.header
.wrapper{
display: flex;
justify-content: space-between;
width: 1116px;
height: 62px;
margin: 0 auto;
}

html,
body,
div, span, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, abbr, address, cite, code, del, dfn, em, img, ins, kbd, q, samp, small, strong, var, b, i, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, figcaption, figure, footer, header, hgroup, menu, nav, section, summary, time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	outline: 0;
	font-size: 100%;
	vertical-align: baseline;
	background: transparent;
}

.login-form input[type="submit"] {
    font-family: /* Roman */ -apple-system, system-ui, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Fira Sans, Ubuntu, Oxygen, Oxygen Sans, Cantarell, Droid Sans, Lucida Grande, Helvetica, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Emoji, Segoe UI Symbol, /* CJK */ Hiragino Kaku Gothic Pro, Meiryo, Hiragino Sans GB W3, /* Arabic */ Noto Naskh Arabic, Droid Arabic Naskh, Geeza Pro, Simplified Arabic, /* Thai */ Noto Sans Thai, Thonburi, Dokchampa, Droid Sans Thai, /* Sans Fallbacks */ Droid Sans Fallback, '.SFNSDisplay-Regular', /* CJK Fallbacks */ Heiti SC, Microsoft Yahei;
    font-size: 12px;
    line-height: 16px;
    font-weight: 600;
    color: #FFFF;
    font-weight: 400;
    display: flex;
    width: auto;
    height: 29px;
    margin: 18px 7px 0;
    padding: 0 20px;
    background-color: #30343a;
    border: 1px solid #b3b6b9;
    border-radius: 11px;
}

.login-form input {
    font-family: /* Roman */ -apple-system, system-ui, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Fira Sans, Ubuntu, Oxygen, Oxygen Sans, Cantarell, Droid Sans, Lucida Grande, Helvetica, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Emoji, Segoe UI Symbol, /* CJK */ Hiragino Kaku Gothic Pro, Meiryo, Hiragino Sans GB W3, /* Arabic */ Noto Naskh Arabic, Droid Arabic Naskh, Geeza Pro, Simplified Arabic, /* Thai */ Noto Sans Thai, Thonburi, Dokchampa, Droid Sans Thai, /* Sans Fallbacks */ Droid Sans Fallback, '.SFNSDisplay-Regular', /* CJK Fallbacks */ Heiti SC, Microsoft Yahei;
    font-size: 12px;
    line-height: 16px;
    font-weight: 600;
    color: rgba(0,0,0,0.9);
    display: inline-block;
    width: 180px;
    height: 29px;
    margin: 17px 10px 10px 0;
    padding: 0 14px;
    background: #f3f6f8;
    border: 1px solid #b3b6b9;
    border-radius: 11px;
}

span{
color:red;
}

h1{
text-align:center;
border-radius: 10px 10px 0 0;
margin: -10px -40px;
padding: 30px;
color: #FFFF;
}

.login-form {
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    position: relative;
    -webkit-box-align: start;
    -ms-flex-align: start;
    align-items: flex-start;
    -webkit-box-pack: end;
    -ms-flex-pack: end;
    justify-content: flex-end;
    text-align: right;
}

#profile{
padding:50px;
border:1px dashed grey;
font-size:20px;
background-color:#DCE6F7;
}

#logout{
float:right;
padding:5px;
border:dashed 1px gray;
margin-top: -168px;
}

a{
text-decoration:none;
color: cornflowerblue;
}

i{
color: cornflowerblue;
}

.error_msg{
color:red;
font-size: 16px;
}

.message{
position: absolute;
font-weight: bold;
font-size: 28px;
color: #6495ED;
left: 262px;
width: 500px;
text-align: center;
}

.main.background.lazy-loaded{
background: #333 url("assets/img/background.jpg") repeat top center;
background-size: cover;
opacity: 90%;
}

p.footer {
text-align: right;
font-size: 11px;
border-top: 1px solid #D0D0D0;
line-height: 32px;
padding: 0 10px 0 10px;
margin: 20px 0 0 0;
}
</style>

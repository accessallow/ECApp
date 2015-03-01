<html>
    <head>
        <title>Login</title>
        <style type="text/css">
            body{
                background: url('<?php echo base_url('assets/images/ricepaper.png'); ?>');
            }
            .centerPseudo {
                display:inline-block;
                text-align:center;
            }

            .centerPseudo::before{
                content:'';
                display:inline-block;
                height:100%;
                vertical-align:middle;
                width:0px;
            }
            .centerFlex {
                /* Internet Explorer 10 */
                display:-ms-flexbox;
                -ms-flex-pack:center;
                -ms-flex-align:center;
                /* Firefox */
                display:-moz-box;
                -moz-box-pack:center;
                -moz-box-align:center;
                /* Safari, Opera, and Chrome */
                display:-webkit-box;
                -webkit-box-pack:center;
                -webkit-box-align:center;
                /* W3C */
                display:box;
                box-pack:center;
                box-align:center;
            }
            div{text-align: center;}
            #pwd_box{
                width:250px;
                background: white;
                font-size: 1.3em;
                text-align: center;
                border-radius: 0.2em;
                border:solid 1px #B0B0B0; 
            }
            #pwd_box:focus {
                border: 1px solid #07c;
                box-shadow: 0 0 10px #07c;
                background:white;
            }
            #login_btn{
                margin-top: 10px;
                font-size: 1.2em;
                width:80px;
                padding: 5px;
                padding-right: 8px;
                padding-left: 8px;
                border-radius:0.9em;
                border:solid 1px rgb(218, 218, 218);
                color:white;
                background: #6B5A94;
            }
            #login_btn:hover{
                background: #4E348B;
            }
            input:-webkit-autofill {
                -webkit-box-shadow: 0 0 0px 1000px white inset;
            }
        </style>
    </head>
    <body  class="centerFlex">
        <div class="centerFlex">
            <img src="<?php echo base_url('assets/images/login.png'); ?>"/>

            <form action="<?php site_url('Front/login'); ?>"
                  autocomplete="off"
                  method="post">

                <input id="pwd_box" type="password" name="password"/>
                <br/>
                <input id="login_btn" type="submit" value="Login"/>
            </form>
        </div>
    </body>
</html>

<?php

    require_once 'config.php';
    
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>LayoutBuddy frontend example</title>
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/css/bootstrap-combined.min.css" rel="stylesheet">
    <script type="text/javascript" src="http://tool.layoutbuddy.com/embed/"></script>
    
</head>
<body>
    
    <div style="width: 900px; margin: 20px auto">
        
        <div class="page-header">
            <h1>LayoutBuddy frontend example</h1>
        </div>
        
        <div id="layoutbuddy_holder" style="width: 900px; height: 700px; background: url(http://tool.layoutbuddy.com/img/preloader.gif) center no-repeat;">
            <a name="layoutbuddy"></a>
            <div id="layout_container">
                <div style="text-align:center; padding: 50px 0 50px 0">
                    In order to use LayoutBuddy, you need to update your Flash-Player.<br />
                    <a href="http://www.adobe.com/go/getflashplayer">
                        <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player"/>
                    </a>
                </div>
            </div>
        </div>
        
        <script type="text/javascript" charset="utf-8">
            var layoutbuddy = new LayoutBuddy('<?php echo $MY_PUBLIC_KEY ?>', '<?php echo $MY_CONFIG_ID ?>');
            layoutbuddy.language = 'en_US';
            //layoutbuddy.initWithId = '';
            layoutbuddy.hideOnSubmit = true;
            layoutbuddy.onSubmitLayout = function(uid) {
                alert('Congrats, you just created a new layout with the ID ' + uid);
            };
            layoutbuddy.embed('layout_container', 'layoutbuddy');
        </script>
        
    </div>

</body>
</html>

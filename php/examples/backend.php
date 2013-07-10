<?php
    
    require_once '../classes/LayoutBuddy.php';
    require_once 'config.php';
    
    // Create new LayoutBuddy instance
    $layoutBuddy = new LayoutBuddy($MY_PUBLIC_KEY, $MY_PRIVATE_KEY);
    
    // Prepare basic parameters
    $params = array(       
        'id' => $MY_GENERATED_LAYOUT_ID,
    );
    
    // Call "details" api request
    $detailsObject = $layoutBuddy->jsonRequest('details', $params, true);
    
    // Prepare extended parameters
    $params = array(       
        'id' => $MY_GENERATED_LAYOUT_ID,
        'order_code' => 'example_order_code',
        'item_code' => 'some_item_code',
        'item_number' => '1',
        'item_qty' => '1',
        'show_options' => true,
    );
    
    // Build signed url for direct download
    $downloadUrl = $layoutBuddy->buildSignedRequestUrl('downloadPdf', $params);
    
    // Build signed url for widget
    $widgetUrl = $layoutBuddy->buildSignedRequestUrl('widget', $params);
    
    // Image urls can be generated directly from the class
    $thumbnailUrl = LayoutBuddy::getThumbnailImage($params['id']);
    $previewUrl = LayoutBuddy::getPreviewImage($params['id']);
    
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>LayoutBuddy backend example</title>
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/css/bootstrap-combined.min.css" rel="stylesheet">
</head>
<body>
    
    <div style="width: 600px; margin: 20px auto">
        
        <div class="page-header">
            <h1>LayoutBuddy backend example</h1>
        </div>
        
        
        
        <h3>Usage of API call (e.g. "details")</h3>
        <ul>
            <li><strong>Width:</strong> <?php echo $detailsObject->width ?></li>
            <li><strong>Height:</strong> <?php echo $detailsObject->height ?></li>
            <li><strong>Price:</strong> <?php echo $detailsObject->price ?></li>
        </ul>
        <hr />
        
        
        
        <h3>Usage of direct download link</h3>
        <p><a class="btn" href="<?php echo $downloadUrl ?>">Download PDF</a></p>
        <hr />
        
        
        
        <h3>Usage of widget</h3>
        <div style="width: 400px; background: #DCEAF4; padding: 5px">
            <iframe src="<?php echo $widgetUrl ?>" scrolling="no" frameborder="0" style="border: none; width: 100%; height: 100px; "></iframe>
        </div>
        <hr />
        
        
        
        <h3>Displaying images</h3>
        <h4>Thumbnail</h4>
        <p><img src="<?php echo $thumbnailUrl ?>" style="border: 1px solid gray" /></p>
        <h4>Preview</h4>
        <p><img src="<?php echo $previewUrl ?>" style="border: 1px solid gray" /></p>
        
    </div>
    
</body>
</html>

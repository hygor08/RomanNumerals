<?php
//use autoloader to load class files
require_once 'autoloader.php';
$preval = '';
if(isset($_POST['entryItem']) && $_POST['entryItem'] != ''){
    $preval = $_POST['entryItem'];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="windows-1252">
        <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="assets/js/global.js"></script>
        <title></title>
    </head>
    <body>
        <div id="formhold">
            <form method="POST" id="searchForm">
                <label for="entryItem">Enter a whole number or Roman Numeral for conversion</label>
                <input type="text" id="entryItem" name="entryItem" value="<?php print $preval; ?>"/>
                <div><input type="submit" id="submit" name="submit" value="Convert"/><img src="assets/images/question.png" alt="hint" id="hint" style="display: none;"/></div>
                <p id="info"><span>Info:<br/>Number must be whole and between 1 - 3999<br/>Roman Numeral must be between I and MMMCMXCIX</span></p>
            </form>
        </div>
        <?php 
        $romDisp = 'style="display:none;"';
        $intDisp = 'style="display:none;"';
        
        if(isset($_POST['entryItem']) && $_POST['entryItem'] != ''){
            $output = new InputValidation();
            $output->decipherStringType($_POST['entryItem']); 
            $romDisp = ($output->inputType == 'integer') ? '' : 'style="display:none;"';
            $intDisp = ($output->inputType == 'roman') ? '' : 'style="display:none;"';
            
        ?>
     <?php }             
        ?>
        <div id="romanOutput" <?php print $romDisp; ?>>          
            <div class="resultText"><span><?php if(isset($output) && $output->inputType == 'integer'){ print $output->result; } ?></span></div>
        </div>
        <div id="integerOutput" <?php print $intDisp; ?>>
            <div class="resultText"><span><?php if(isset($output) && $output->inputType == 'roman'){ print $output->result; } ?></span></div>
        </div>
    </body>
</html>

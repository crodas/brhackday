<?php
require "pagerank.php";
require "baserank.php";
require "baselang.php";
require "textrank.php";

if (isset($_POST['text'])) {
    ob_start();

    $time = microtime(true);
    register_shutdown_function(create_function('', 'var_dump(microtime(true) - $GLOBALS["time"]);'));

    ob_start();
/*    $tr = new PhraseRank;
    $tr->loadStopWords('english.txt');
    $tr->setStemmer(new StemmerEnglish);
    $tr->setText($_POST['text']);
    $tr->calculate();
    $tr->dump(); /**/
    $phrases = ob_get_clean(); 


    $tr = new TextRank;
    $tr->setLanguage('spanish');
    $tr->setWindowSize(2);
    $tr->setText($_POST['text']);
    $tr->calculate();
    $tr->dump();
    unset($tr);
    $text = ob_get_clean();/**/
}


?>
<html>
<head>
    <title>TextRank: Demo</title>
</head>
<body>
    <form action="/demo1" method="POST">
        <textarea cols=100 rows=10 name="text"><?php echo @$_POST['text']?></textarea>
        <input type="submit" value="Submit" />
    </form>

<table border=1>
<tr>
    <td valign=top width=50%>
    <?php if (isset($text)) : ?>
    <h1>Relevants words</h1>
<?php echo $text;?>
    <?php endif;?>
    </td>
    <td valign=top>
    <?php if (isset($phrases)) : ?>
    <h1>Relevants phrases</h1>
<?php echo $phrases;?>
    <?php endif;?>
    </td>
</tr>
</table>
</body>
</html>

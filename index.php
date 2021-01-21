<?
include('simplehtmldom_1_9_1/simple_html_dom.php');
?>
<form method="post">
<p>Введиете название футбольной команды из итальянской лиги, и вы узнаете, какие места она занимала в сезонах чемпионата серии А</p>
    <input type="text" name="name" />
    <input type="submit" value="Искать" />
    
</form>
<?php
if ($_POST) {
    // get DOM from URL or file https://terrikon.com/football/italy/championship/archive
    //$html = file_get_html('https://terrikon.com/football/italy/championship/');
    $domain = 'https://terrikon.com';
    $html = file_get_html($domain . '/football/italy/championship/archive');

    // find all link
    foreach ($html->find('.tab .news dd a') as $e) {
        $html2 = file_get_html($domain . '/' . $e->href);
        echo 'Parse <b>' . $e->href . '</b><br />'; 
        foreach ($html2->find('.colored tr') as $e2) {
            if (strpos($e2->plaintext, $_POST['name']) !== false) {
                $str = $e2->plaintext;
                $arr = explode('#', $str);
                $arr2 = explode('.',$arr[0]); 
                if(trim($arr2[1]) == trim($_POST['name'])){
                    echo 'место ' . $arr[0] . ' <br />';
                }
            }
        }
        echo '<hr>';
    }
}
?>
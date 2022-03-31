<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="stylesheet" href="index.css">
    <title>囲碁サッカー部</title>
</head>
<body>
    <h1 class="center"><span class="rainbowA">ようこそ！ 大濠高校囲碁サッカー部へ！</span></h1>
    
    <?php

    $counter_file = 'counter.txt';
    $counter_lenght = 8;

    $fp = fopen($counter_file, 'r+');

    if ($fp){
        if (flock($fp, LOCK_EX)){

            $counter = fgets($fp, $counter_lenght);
            $counter++;

            rewind($fp);

            if (fwrite($fp,  $counter) === FALSE){
                print('ファイル書き込みに失敗しました');
            }

            flock($fp, LOCK_UN);
        }
    }

    fclose($fp);

    print('<p class="center"><span class="spn">◆あなたは'.$counter.'人目の訪問者です◆</span></p>');

    ?>

    <p class="center"><span class="spn">◆キリ番の方は書き込みお願いします！◆</span></p>

    <h1 class="center">★理念★</h1>

    <div class="flex">
        <img src="img/poster2.png" alt="囲碁サッカー部">
        <div class="item">
            <h2>愛のサッカー、平和の囲碁</h2>
            <p>私たちは、囲碁サッカーの普及のために日々活動しています。</p>
            <p>現在は「スポーツの秋に囲碁サッカーを加えよう」がメインテーマです。</p>
            <p>いつでも見学、入部お待ちしています！</p>
        </div>
    </div>

    <h1 class="center">★リンク集★</h1>
    <a href="http://shuyu.fku.ed.jp/Default2.aspx" target="_blank" rel="noopener noreferrer"><p class="center">大濠高校</p></a>


    <h1 class="center">★掲示板★</h1>
    <p class="center">荒らしは辞めてください！！！</p>

    <form method="POST" action="<?php print($_SERVER['PHP_SELF']) ?>" class="flex" id="form">
    <p>名前</p>
    <input type="text" name="personal_name" id="formname">
    <p>コメント</p>
    <textarea name="contents" rows="8" cols="40" id="comment">
    </textarea>
    <input type="submit" name="btn1" value="投稿する" id="submit">
    </form>

    <?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        writeData();
    }

    readData();

    function readData(){
        $keijban_file = 'keijiban.txt';

        $fp = fopen($keijban_file, 'rb');

        if ($fp){
            if (flock($fp, LOCK_SH)){
                while (!feof($fp)) {
                    $buffer = fgets($fp);
                    print($buffer);
                }

                flock($fp, LOCK_UN);
            }else{
                print('ファイルロックに失敗しました');
            }
        }

        fclose($fp);
    }

    function writeData(){
        $personal_name = $_POST['personal_name'];
        $contents = $_POST['contents'];
        $contents = nl2br($contents);

        $data = "<hr>";
        $data = $data."<p>投稿者:".$personal_name."</p>";
        $data = $data."<p>内容:".$contents."</p>";

        $keijban_file = 'keijiban.txt';

        $fp = fopen($keijban_file, 'ab');

        if ($fp){
            if (flock($fp, LOCK_EX)){
                if (fwrite($fp,  $data) === FALSE){
                    print('ファイル書き込みに失敗しました');
                }

                flock($fp, LOCK_UN);
            }else{
                print('ファイルロックに失敗しました');
            }
        }

        fclose($fp);
    }

    ?>


</body>
</html>
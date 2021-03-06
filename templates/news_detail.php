<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include("./head.inc");

if(count($page->news_image)) {
    $image = $page->news_image;
    $imageurl = $image->url;
    $thumburl = $image->getCrop('thumbnail')->url;
} else {
    $imageurl = $thumburl = $config->urls->templates."styles/images/news_placeholder.gif";
    $image = new Page();
}

$author = "";
if($page->news_author != NULL) {
    $author = $page->news_author;
} elseif($page->createdUser->name != "admin") {
    $author = $page->createdUser->user_real_name;
}

$out = "";
$out .= "<h1>".$page->news_title."</h1>";
$out .= "<div class='news-info'>";
if($page->date) {
  $out .=     "<div class='news-date'>".strftime("%A, %d.%m.%Y %H:%M", $page->date)."</div>";
} else {
  $out .=     "<div class='news-date'>".strftime("%A, %d.%m.%Y %H:%M", $page->created)."</div>";
}
$out .=     "<div class='news-single-author'>Von: ".$author."</div>";
$out .= "</div>";
$out .= "<div class='news-intro'>".$page->news_intro."</div>";
$out .= "<div class='news-main'>";
$out .= "<a href='{$imageurl}' data-lightbox='{$page->title}' data-title='{$image->description}'>";
$out .= "<img class='news-single-img' src='".$thumburl."' alt='".$image->description."'/></a>";
$out .= "".$page->news_main."</div>";

echo $out;

include("./foot.inc");

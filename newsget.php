<?php
	$site="";
	$site = $_GET['site'];
	include 'simple_html_dom.php';
	header("Access-Control-Allow-Origin: *");
	$html = new simple_html_dom();
	$arr=array();
	if(empty($homepage)){
		$homepage="http://www.peopo.org/list/post/all/all/all";
	}
	
	$html->load_file($site);//進入主頁//進入主頁
	//$url = file_get_contents("http://www.peopo.org/list/post/all/all/all");
	
	/*$xml = '<?xml version="1.0" encoding="utf-8"?><news></news>';*/
	//$xmlObj = simplexml_load_string($xml);//創造XML
	$i=0;
	//foreach($t=$html->find("div[class=view-content]") as $element){
	foreach($html->find("h3[class=post-title]/a") as $element){
		$content=new simple_html_dom();
		$content->load_file("http://www.peopo.org".($element->href));//進入新聞
		$locations=$content->find("div[id=node-terms]",0)->find("div[class=field-items]",0)->find("ul li"); //尋找位置
		$site="";
		//$local = $xmlObj->addChild('local');// add XML local
		foreach( $locations as $location ){
			
			$site =$site. ($location->plaintext);
			//echo $location->plaintext."<br>";
			
		}
		
		//XML文本創建
		array_push($arr, array ("local"=>$site,"newstitle"=>'<a href="'.("http://www.peopo.org".($element->href)).'">'.$element->plaintext.'</a>',"newscontent"=>$html->find("div[class=main-content clearfix]/p",$i)->plaintext));
		//$xmlNews=$xmlObj->addChild("news");
		//$xmlNews->addChild("local",$site);
		//$xmlNews->addChild("newstitle",$element->plaintext);
		//$xmlNews->addChild("newscontent",$html->find("div[class=main-content clearfix]/p",$i)->plaintext );
		//echo $element->plaintext."<br>";
		//echo gettype($t);
		//XML文本創建
		$i++;
		$content->clear();
	}
	
	//$xmlObj->asXML('test.xml');
	//$xml=file_get_contents('test.xml');
	echo json_encode($arr);
	$html->clear();
	//echo $xml;
?>
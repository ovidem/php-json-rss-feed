<?php
header('Content-type: text/xml');

print('<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet href="feed.xslt" type="text/xsl"?>
<feed xml:lang="en-US" xmlns="http://www.w3.org/2005/Atom">
	<id>tag:distinctivequality.com:blog</id>
	<link rel="alternate" type="text/html" href="https://distinctivequality.com/blog/"/>
	<link rel="self" type="application/atom+xml" href="https://distinctivequality.com/blog/feed/"/>
	<title>Distinctive Quality blog</title>
	<updated>' . date("Y-m-d", filemtime('posts.json')) . "T" . date("H:i:s", filemtime('posts.json')) . "Z" . '</updated>');

$json_file = file_get_contents('posts.json');
$json = json_decode($json_file,true);
$posts = $json['posts'];

foreach($posts as $post) {
	print('
	<entry>
		<id>tag:distinctivequality.com:blog/'.$post['var'].'</id>
		<published>' . date_format(date_create($post['date']), "Y-m-d") . "T" . date_format(date_create($post['date']), "H:i:s") . "Z" . '</published>
		<updated>' . date_format(date_create($post['date']), "Y-m-d") . "T" . date_format(date_create($post['date']), "H:i:s") . "Z" . '</updated>
		<link rel="alternate" type="text/html" href="');
	if ($post['url'] != "") {
		echo htmlspecialchars(html_entity_decode($post['url']));
	} else {
		echo htmlspecialchars(html_entity_decode('https://distinctivequality.com/blog/'.$post['var']));
	}
	print('"/>
		<title>' . htmlspecialchars(html_entity_decode($post['title'])) . '</title>
		<content type="html">');
	if ($post['var'] != "") {
		echo htmlspecialchars(html_entity_decode(file_get_contents($post['var'].".html")));
	} else {
		echo htmlspecialchars(html_entity_decode($post['blurb']));
	}
	print ('</content>
		<author>
			<name>Ovi Demetrian Jr</name>
			<email>ovi@distinctivequality.com</email>
		</author>
	</entry>');
}

print('</feed>');
?>
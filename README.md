# PHP Atom RSS feed output from JSON entries

Atom RSS feed output from a JSON file using PHP.

JSON example entries for a post and an external link:
<pre><code>{
	"posts": [{
		"var": "rip-flash",
		"title": "RIP Flash",
		"date": "2017-08-28",
		"blurb": "Recently, Adobe officially announced it is discontinuing support for its Flash browser plugin by 2020.",
	}, {
		"var": "introducing-blocks-edit",
		"url": "https://blocksedit.com/content-code/introducing-blocks-edit/",
		"title": "Introducing Blocks Edit, content management for email",
		"date": "2017-10-02",
		"blurb": "Blocks Edit is now live and ready for you to improve how you send out marketing campaigns.",
	}]
}
</code></pre>

<code>var</code> is used for entry ID's:
<pre><code>&lt;id&gt;tag:distinctivequality.com:blog/'.$post['var'].'&lt;/id&gt;
</code></pre>

<code>url</code> is used for external links:
<pre><code>&lt;link rel="alternate" type="text/html" href="');
if ($post['url'] != "") {
	echo htmlspecialchars(html_entity_decode($post['url']));
} else {
	echo htmlspecialchars(html_entity_decode('https://distinctivequality.com/blog/'.$post['var']));
}
print('"/&gt;
</code></pre>

Content output includes special character encoding for HTML:
<pre><code>echo htmlspecialchars(html_entity_decode(file_get_contents($post['var'].".html")));
</code></pre>

<code>updated</code> is based on latest JSON file change:
<pre><code>&lt;updated&gt;' . date("Y-m-d", filemtime('posts.json')) . "T" . date("H:i:s", filemtime('posts.json')) . "Z" . '&lt;/updated&gt;');
</code></pre>
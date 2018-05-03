
<html>
<head>

<meta charset="utf-8" />
<title>Awesomplete: Ultra lightweight, highly customizable, simple autocomplete, by Lea Verou</title>
<link rel="stylesheet" href="awesomplete.css" />
<link rel="stylesheet" href="stylea.css" />

<script src="awesomplete.js"></script>

</head>
<body class="language-markup">

<header>


</header>


	<section id="combobox">
	
	<input data-list="CSS, JavaScript, HTML, SVG, ARIA, MathML" class="dropdown-input" /><button class="dropdown-btn" ></button>
	
	<pre class="language-javascript"><code><script>var comboplete = new Awesomplete('input.dropdown-input', {
	minChars: 0,
});
Awesomplete.$('.dropdown-btn').addEventListener("click", function() {
	if (comboplete.ul.childNodes.length === 0) {
		comboplete.minChars = 0;
		comboplete.evaluate();
	}
	else if (comboplete.ul.hasAttribute('hidden')) {
		comboplete.open();
	}
	else {
		comboplete.close();
	}
});</script></code></pre>
	</section>






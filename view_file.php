<head>
    <title>CodeMirror: Lazy Mode Loading Demo</title>
    <meta charset="utf-8"/>

    <link rel="stylesheet prefetch" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.9.1/styles/default.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>
<div class="container">
    <pre><code class=""><?php echo htmlspecialchars(file_get_contents( $_GET["file"]) ) ?></code></pre>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.9.1/highlight.min.js"></script>
<script>
    hljs.initHighlightingOnLoad();
</script>
</body>
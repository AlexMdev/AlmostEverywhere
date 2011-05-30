<!DOCTYPE html>
<html> 
	<head> 
		<title>{titolo}</title> 

		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name = "viewport" content = "width = device-width, user-scalable = no" />

		<meta http-equiv="expires" content="0" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta http-equiv="cache-control" content="no-cache" />
		<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
		<meta http-equiv="reply-to" content="thpf@hotmail.it" />
        
		<meta name="classification" content="Sito personale." />
		<meta name="revisit-after" content="1 days" />

		<meta name="author" content="Alessandro Piatti" />
		<meta name="rating" content="work" />
		<meta name="keywords" content="TruePixel, Alessandro Piatti, Sito Personale" />
		<meta name="description" content="Sito personale." />
		<meta name="robot" content="index, follow" />
		<meta name="geography" content="Italia" />
		<meta name="country" content="Italia" />
		<meta name="language" content="it" />
		<meta name="distribution" content="global" />

		<meta name="audience" content="all" />
		<meta name="designer" content="Alessandro" />
		<meta name="publisher" content="Alessandro, TruePixel for TruePixel.it ®" />
		<meta name="copyright" content="(c) 2010 by TruePixel.it" />

		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a2/jquery.mobile-1.0a2.min.css" />

		<script src="http://www.google.com/jsapi?key=ABQIAAAAf5n4HJo5KQE_I-wvKeFhwhTO-IDEhy8skYDIN3teZgkIFzzuYBSmJO3Xro9WSIITUuMYAEIrEtQHrQ" type="text/javascript"></script>
		<script language="Javascript" type="text/javascript">
			google.load("jquery", "1");
		</script>

		<script src="http://code.jquery.com/mobile/1.0a2/jquery.mobile-1.0a2.min.js"></script>

		<script src="./commons/scripts/script.js" type="text/javascript"></script>
	</head> 
	<body data-role="page">
		<noscript>
			<meta http-equiv="refresh" content="0; url=./nojs/" />
		</noscript>
		<header data-role="header">
			<h1>{titolo}</h1> 
<nav>
<a href="./homepage" class="link" title="homepage">Home</a> <a href="./eventi" class="link" title="eventi">Eventi</a> <a href="./contatti" class="link" title="contatti">Contatti</a> <a href="./info" class="link" title="info">Informazioni</a> <a href="./login" class="link" title="login">Login</a> <a href="./registrazione" class="link" title="registrazione">Registrati</a>
</nav>
		</header>
		<section data-role="content">
			<article>
				{testo}
			</article>
		</section>
		<footer> 
			<a href="admin.php" title="Amministrazione">Pannello Amministrazione</a>
			<br />footer
		</footer> 
	</body> 
</html>
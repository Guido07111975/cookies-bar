/* Cookies bar script */
function cookiesBarCreateCookie() {
	if ( objectL10n.cookieValue && objectL10n.cookieExpires ) {
		document.cookie = "cookies_bar="+objectL10n.cookieValue+"; expires="+objectL10n.cookieExpires+";";
		window.location.reload();
	}
}

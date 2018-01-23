	<footer class="footer navbar navbar-static-bottom" style="margin-bottom: 0 !important">
		<div class="container">
			<p class="pull-left navbar-text">Copyright © 2017 <a href="http://eadhassan.com/feast-cms" target="_blank">FEAST-CMS</a>. All rights reserved.</p>
		</div>
	</footer>

	<script type="text/javascript">
		$(function() {
			var footerHeight = $('.footer').outerHeight();
			$('.footer').css('marginTop', -footerHeight);
		});
	</script>

	<script type="text/javascript">
		function resizeIframe(obj) {
			obj.style.height = $(document).height() + 'px';
		}

		$('.dropdown-toggle').dropdownHover();

		$(window).resize(function() {
			if ($(window).width() < 992){
				$(".post-item").each(function() {
					var str = $(this).find('img').attr('src');
					var wide = str.replace(/medium|large|small/gi, 'wide');
					$(this).find('img').attr('src', wide);
				});
			} else {
				$(".post-item").each(function() {
					var str2 = $(this).find('img').attr('src');
					var src = str2.replace(/wide/gi, 'medium');
					$(this).find('img').attr('src', src);
				});
			}
		});
	</script>

  </body>
</html>
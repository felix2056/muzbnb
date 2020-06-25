<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner"> 2017 &copy; LOREM IPSUM By
		<a target="_blank" href="#">Dummy Text</a> &nbsp;|&nbsp;
		
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN CORE PLUGINS -->
        
<script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/assets/global/plugins/moment.min.js" type="text/javascript"></script>

<script src="/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>

<script src="/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

        
@if(Session::has('success'))
<script type="text/javascript">
	App.alert({ container: $('#alert_container').val(),
		// alerts parent container place: 'append', // append or prepent in container 
		type: 'success', // alert's type 
		message: "{{Session::get('success')}}", // alert's message
		close: true, // make alert closable reset: false, // close all previouse alerts first 
		focus: true, // auto scroll to the alert after shown closeInSeconds: 10000, // auto close after defined seconds
		icon: 'fa fa-check' // put icon class before the message 
	});
</script>
@elseif (count($errors) > 0)
<script type="text/javascript">
	App.alert({ container: $('#alert_container').val(),
		// alerts parent container place: 'append', // append or prepent in container 
		type: 'warning', // alert's type 
		message: "{{$errors->first()}}", // alert's message
		close: true, // make alert closable reset: false, // close all previouse alerts first 
		focus: true, // auto scroll to the alert after shown closeInSeconds: 10000, // auto close after defined seconds
		icon: 'fa fa-warning' // put icon class before the message 
	});
	
</script>
@endif
       <script type="text/javascript">

    $(".nav a").on("click", function(){
   $(".nav").find(".active").removeClass("active");
   $(this).parent().addClass("active");
});
</script>
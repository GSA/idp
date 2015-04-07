<?php

$home_link = $this->configuration->getValue('home_link', '#');


if(!empty($this->data['htmlinject']['htmlContentPost'])) {
	foreach($this->data['htmlinject']['htmlContentPost'] AS $c) {
		echo $c;
	}
}


?>


	
	</div><!-- #content -->
<div class="content-info">

    <div class="container">
        <div class="row">



            <div class="col-md-4 col-lg-4">
                <form action="http://catalog.data.gov/dataset" class="search-form form-inline" method="get" role="search">
                    <div class="input-group">

                        <input type="search" onfocus="if(value=='Search Data.Gov') value = ''" onblur="if(value=='') value = 'Search Data.Gov'" id="search-header" value="Search Data.Gov" name="q" class="search-field form-control" placeholder="Search Data.Gov">
        <span class="input-group-btn">
        <button class="search-submit btn_new btn-default" type="submit"> <i class="fa fa-search"></i> <span class="sr-only">Search</span> </button>
        </span> </div>
                </form>
                <div class="footer-logo"> <a href="http://www.data.gov/" class="logo-brand">Data.Gov</a> </div>
            </div>
            <nav role="navigation" class="col-md-2 col-lg-2">
                <ul class="nav" id="menu-primary-navigation-1">



                </ul>
            </nav>
            <nav role="navigation" class="col-md-2 col-lg-2">
                <ul class="nav" id="menu-footer">

                </ul>
            </nav>
            <div aria-hidden="true" role="tooltip" class="tooltip" id="external_disclaimer" style="display:none">This link will direct you to an external website that may have different content and privacy policies from Data.gov.
            </div>
            <div class="col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 social-nav">
                <nav role="navigation">
                    <ul class="nav" id="menu-social_navigation">
                        <li><a href="https://twitter.com/usdatagov" aria-describedby="external_disclaimer" title="This link will direct you to an external website that may have different content and privacy policies from Data.gov."><i class="fa fa-twitter"></i><span>Twitter</span></a></li>
                        <li><a href="http://github.com/GSA/data.gov/" aria-describedby="external_disclaimer" title="This link will direct you to an external website that may have different content and privacy policies from Data.gov."><i class="fa fa-github"></i><span>Github</span></a></li>

                    </ul>
                </nav>
            </div>

        </div><br clear="all" /></div>

    </div><!-- #wrap -->




<!-- federated_analytics start -->
<script id="_fed_an_ua_tag" src="https://analytics.usa.gov/dap/dap.min.js?agency=GSA"></script>
<!-- federated_analytics end --> 
<script type="text/javascript">
	var _gaq = _gaq || [];
  
	_gaq.push(['_setAccount', 'UA-17367410-17']);
    _gaq.push(['_addDevId', 'i9k95']); // Google Analyticator App ID with Google
    _gaq.push(['_gat._anonymizeIp']);
	_gaq.push(['_trackPageview']);
	<!-- tracking for UA-42145528-2  start -->
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-42145528-2', 'auto');
  ga('set', 'anonymizeIp', true);
  ga('send', 'pageview');
<!-- tracking for UA-42145528-2  end -->
	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>
        <script type="text/javascript">


            // function to dyanamically pull menus

                    (function($) {
                        var home_url='<?php echo $home_link; ?>';

                        //alert(home_url);

                        var url = home_url+'/app/plugins/datagov-custom/wp_download_links.php?callback=';
                        $.ajax({
                            type: 'GET',
                            url: url,
                            async: false,
                            jsonpCallback: 'jsonCallback',
                            contentType: "application/json",
                            dataType: 'jsonp',
                            success: function(json) {
                                var menus = [];
                                var topmenus=[];
                                var topsecondarys=[];
                                $.each(json.footer_navigation, function(i,menu){
                                    menus.push('<li><a href="' +menu.link + '">' +menu.name + '</a></li>');
                                            if(menu.name=='Log In'){
                                                menus.push('<li style="display:none;"><a href="' +menu.link + '">' +menu.name + '</a></li>');
                                            }
                                });
                                $.each(json.primary_navigation, function(i,topmenu){
                                    if(!topmenu.parent_id) {
                                        if(topmenu.name=='Topics'){
                                            topmenus.push('<li class="dropdown menu-topics"><a data-toggle="dropdown" class="dropdown-toggle">Topics<b class="caret"></b></a><ul class="dropdown-menu"></ul></li>');
                                        }else{
                                            topmenus.push('<li><a href="' +topmenu.link + '">' +topmenu.name + '</a></li>');
                                        }

                                    }
                                });
                                $.each(json.primary_navigation, function(i,topsecondary){
                                    if(topsecondary.parent_id ) {
                                        topsecondarys.push('<li><a href="' +topsecondary.link + '">' +topsecondary.name + '</a></li>');
                                    }
                                });
                                $('#menu-primary-navigation-1').append( topmenus.join('') );
                                $('#menu-footer').append(menus.join('') );
                                $('#menu-primary-navigation-1 .dropdown-menu').append( topsecondarys.join('') );
                            },
                            error: function(e) {
                                console.log(e.message);
                            }
                        });

                    })(jQuery);


            fixToggle = function () {
                jQuery(document).ready(function()
               {
                  jQuery(".dropdown-toggle").click(function()

                    {

                        var X=jQuery(".dropdown-toggle").attr('id');

                        if(X==1)

                        {

                            jQuery(".dropdown-menu").hide();

                            jQuery(".dropdown-toggle").attr('id', '0');

                        }

                        else

                        {

                            jQuery(".dropdown-menu").show();

                            jQuery(".dropdown-toggle").attr('id', '1');

                        }



                    });



//Mouse click on sub menu

                    jQuery(".dropdown-menu").click(function()

                    {

                        return false

                    });



//Mouse click on topics link

                    jQuery(".dropdown-toggle").mouseup(function()

                    {

                        return false

                    });





//Document Click

                    jQuery(document).mouseup(function()

                    {

                        jQuery(".dropdown-menu").hide();

                        jQuery(".dropdown-toggle").attr('id', '');

                    });

                });
            }
            setTimeout('fixToggle()', 1000);


        </script>
</body>
</html>

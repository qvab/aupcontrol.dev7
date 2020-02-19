<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);?>
<!doctype html>
<html>
<head>
	<title><?$APPLICATION->ShowTitle()?></title>
	<?$APPLICATION->ShowHead();?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Loading Bootstrap -->
    <link href="<?=SITE_TEMPLATE_PATH?>/css/bootstrap.css" rel="stylesheet"> 

    <!-- Loading Template CSS -->
    <link href="<?=SITE_TEMPLATE_PATH?>/css/style.css" rel="stylesheet">
    <link href="<?=SITE_TEMPLATE_PATH?>/css/animate.css" rel="stylesheet">
    <link href="<?=SITE_TEMPLATE_PATH?>/css/style-magnific-popup.css" rel="stylesheet">
    
    <!-- Loading Layer Slider -->
    <link href="<?=SITE_TEMPLATE_PATH?>/layerslider/css/layerslider.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="<?=SITE_TEMPLATE_PATH?>/css/fonts.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,100' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700' rel='stylesheet' type='text/css'>

    <!-- Font Favicon -->
    <link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/images/favicon.ico">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    
    <!--headerIncludes-->
  <!-- Favicon -->
  <link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/img/favicon.ico">
  
  <!-- Font -->
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Arimo:400,700,400italic,700italic'>

</head>
<body>
<?$APPLICATION->ShowPanel();?>

<?$APPLICATION->IncludeFile(
	SITE_DIR . "/include/preloader.php",
	Array(),
	Array("MODE"=>"html"));
?>

    <!--begin header -->
    <header class="header">

        <!--begin nav -->
        <nav class="navbar navbar-default navbar-fixed-top">
            
            <!--begin container -->
            <div class="container">
        
                <!--begin navbar -->
                <div class="navbar-header">
                    <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                                                    
                    <a href="/" class="navbar-brand brand scrool">
					
						<?$APPLICATION->IncludeFile(
							SITE_DIR . "/include/logo.php",
							Array(),
							Array("MODE"=>"html"));
						?>

					</a>
                </div>
                        
                <div id="navbar-collapse-02" class="collapse navbar-collapse">
						<?$APPLICATION->IncludeComponent("bitrix:menu", "top_main", Array(
								"ROOT_MENU_TYPE" => "top",
								"MENU_CACHE_TYPE" => "N",
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"MENU_CACHE_GET_VARS" => array(
									0 => "",
								),
								"MAX_LEVEL" => "1",
								"CHILD_MENU_TYPE" => "left",
								"USE_EXT" => "N",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "N",
							),
							false
						);?>					
                        
                </div>
                <!--end navbar -->
                                    
            </div>
    		<!--end container -->
            
        </nav>
    	<!--end nav -->
        
    </header>
    <!--end header -->
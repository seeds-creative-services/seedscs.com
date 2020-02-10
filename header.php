<?php global $wp;

/** Get current page URL and SEO settings. */
$page_meta = get_post_meta(get_the_ID(), "seeds_seo", true);
$page_url = home_url(add_query_arg(array(), $wp->request));

/** Get SEO index and follow preferences for the current page. */
$seo_index = $page_meta['indexing'] === "index" ? "index" : "noindex";
$seo_follow = $page_meta['crawling'] === "follow" ? "follow" : "nofollow";

$analytics = array();

/** Fetch analytics tracking codes. */
foreach(get_theme_mods() as $theme_mod => $value) {
    if(strpos($theme_mod, "analytics_") === 0) {
        $tracker = str_replace("analytics_", "", $theme_mod);
        $analytics[$tracker] = $value;
    }
}

?>

<!DOCTYPE html>
<html lang="en-US">
<head>

    <meta charset="utf-8">
    <meta name="language" content="EN">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="<?php echo $seo_index; ?>, <?php echo $seo_follow; ?>">

    <!-- Basic meta content. -->
    <title><?php echo $page_meta['title']; ?></title>
    <meta name="description" content="<?php echo $page_meta['description']; ?>">
    <meta name="author" content="Seeds Creative Services">
    <meta name="url" content="<?php echo $page_url; ?>">

    <!-- Page post & revision dates. -->
    <meta name="date" content="<?php echo get_the_date("l, F jS Y, h:iA"); ?>">
    <meta name="revised" content="<?php the_modified_date("l, F jS Y, h:iA"); ?>">

    <!-- Open Graph meta content. -->
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo $page_url; ?>">
    <meta property="og:title" content="<?php echo $page_meta['title']; ?>">
    <meta property="og:description" content="<?php echo $page_meta['description']; ?>">

    <!-- Apple device meta content. -->
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Windows & IE meta content. -->
    <meta http-equiv="cleartype" content="on">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="mssmarttagspreventparsing" content="true">

    <! -- Google Analytics -->
    <?php if(isset($analytics['google']) && $analytics['google'] !== "") { ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $analytics['google']; ?>"></script>
    <script>window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date()); gtag('config', '<?php echo $analytics['google']; ?>');</script>
    <?php } ?>

    <!-- Hotjar Analytics -->
    <?php if(isset($analytics['hotjar']) && $analytics['hotjar'] !== "") { ?>
    <script>(function(h,o,t,j,a,r){
    h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
    h._hjSettings={hjid:<?php echo $analytics['hotjar']; ?>,hjsv:6};
    a=o.getElementsByTagName('head')[0];r=o.createElement('script');r.async=1;
    r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    <?php } ?>

    <!-- Mixpanel Analytics -->
    <?php if(isset($analytics['mixpanel']) && $analytics['mixpanel'] !== "") { ?>
    <script type="text/javascript">(function(c,a){if(!a.__SV){var b=window;try{var d,m,j,k=b.location,f=k.hash;d=function(a,b){return(m=a.match(RegExp(b+"=([^&]*)")))?m[1]:null};f&&d(f,"state")&&(j=JSON.parse(decodeURIComponent(d(f,"state"))),"mpeditor"===j.action&&(b.sessionStorage.setItem("_mpcehash",f),history.replaceState(j.desiredHash||"",c.title,k.pathname+k.search)))}catch(n){}var l,h;window.mixpanel=a;a._i=[];a.init=function(b,d,g){function c(b,i){var a=i.split(".");2==a.length&&(b=b[a[0]],i=a[1]);b[i]=function(){b.push([i].concat(Array.prototype.slice.call(arguments,
    0)))}}var e=a;"undefined"!==typeof g?e=a[g]=[]:g="mixpanel";e.people=e.people||[];e.toString=function(b){var a="mixpanel";"mixpanel"!==g&&(a+="."+g);b||(a+=" (stub)");return a};e.people.toString=function(){return e.toString(1)+".people (stub)"};l="disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
    for(h=0;h<l.length;h++)c(e,l[h]);var f="set set_once union unset remove delete".split(" ");e.get_group=function(){function a(c){b[c]=function(){call2_args=arguments;call2=[c].concat(Array.prototype.slice.call(call2_args,0));e.push([d,call2])}}for(var b={},d=["get_group"].concat(Array.prototype.slice.call(arguments,0)),c=0;c<f.length;c++)a(f[c]);return b};a._i.push([b,d,g])};a.__SV=1.2;b=c.createElement("script");b.type="text/javascript";b.async=!0;b.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?
    MIXPANEL_CUSTOM_LIB_URL:"file:"===c.location.protocol&&"//cdn4.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn4.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn4.mxpnl.com/libs/mixpanel-2-latest.min.js";d=c.getElementsByTagName("script")[0];d.parentNode.insertBefore(b,d)}})(document,window.mixpanel||[]);
    mixpanel.init("<?php echo $analytics['mixpanel']; ?>");</script>
    <?php } ?>

    <!-- Facebook Tracking -->
    <?php if(isset($analytics['facebook']) && $analytics['facebook'] !== "") { ?>
    <script>!function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '<?php echo $analytics['facebook']; ?>');
    fbq('track', 'PageView');</script><noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?php echo $analytics['facebook']; ?>&ev=PageView&noscript=1">
    </noscript>
    <? } ?>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/29f0ff1eb5.js" crossorigin="anonymous"></script>

    <!-- Child Theme Styles -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . "/assets/dist/css/styles.css" ?>">

</head>
<body>

<?php include_once("layout/header.php"); ?>
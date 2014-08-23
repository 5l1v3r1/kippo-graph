<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
    <title>Kippo-Graph | Fast Visualization for your Kippo SSH Honeypot Stats</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="imagetoolbar" content="no"/>
    <link rel="stylesheet" href="styles/layout.css" type="text/css"/>
    <link rel="stylesheet" href="styles/tablesorter.css" type="text/css"/>
    <script type="text/javascript" src="scripts/jquery-1.4.1.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="scripts/jquery.tablesorter.pager.js"></script>
</head>
<body id="top">
<div class="wrapper">
    <div id="header">
        <h1><a href="index.php">Kippo-Graph</a></h1>
        <br/>

        <p>Fast Visualization for your Kippo SSH Honeypot Stats</p>
    </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper">
    <div id="topbar">
        <div class="fl_left">Version: 1.3 | Website: <a href="http://bruteforce.gr/kippo-graph">bruteforce.gr/kippo-graph</a>
        </div>
        <br class="clear"/>
    </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper">
    <div id="topnav">
        <ul class="nav">
            <li><a href="index.php">Homepage</a></li>
            <li><a href="kippo-graph.php">Kippo-Graph</a></li>
            <li><a href="kippo-input.php">Kippo-Input</a></li>
            <li><a href="kippo-playlog.php">Kippo-Playlog</a></li>
            <li class="active"><a href="kippo-ip.php">Kippo-Ip</a></li>
            <li><a href="kippo-geo.php">Kippo-Geo</a></li>
            <li class="last"><a href="gallery.php">Graph Gallery</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper">
    <div class="container">
        <div class="whitebox">
            <!-- ####################################################################################################### -->
            <h2>IP activity gathered from the honeypot system</h2>
            <hr/>
            <?php
            #Author: ikoniaris, s0rtega
            #Website: bruteforce.gr/kippo-graph

            require_once('config.php');
            require_once(DIR_ROOT . '/class/KippoIP.class.php');

            $kippoIP = new KippoIp();

            //-----------------------------------------------------------------------------------------------------------------
            //APT-GET COMMANDS
            //-----------------------------------------------------------------------------------------------------------------
            $kippoIP->printOverallIpActivity();
            //-----------------------------------------------------------------------------------------------------------------
            //END
            //-----------------------------------------------------------------------------------------------------------------

            ?>
            <!-- ####################################################################################################### -->
            <div id="extended-ip-info"></div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper">
    <div id="copyright">
        <p class="fl_left">Copyright &copy; 2011 - 2014 - All Rights Reserved - <a
                href="http://bruteforce.gr/kippo-graph">Kippo-Graph</a></p>

        <p class="fl_right">Thanks to <a href="http://www.os-templates.com/" title="Free Website Templates">OS
                Templates</a></p>
        <br class="clear"/>
    </div>
</div>
<script type="text/javascript" src="scripts/superfish.js"></script>
<script type="text/javascript">
    jQuery(function () {
        jQuery('ul.nav').superfish();
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#Overall-IP-Activity")
            .tablesorter({sortList: [
                [3, 1]
            ], widthFixed: true, widgets: ['zebra']})
            .tablesorterPager({container: $("#pager1")});
    });
</script>
<script type="text/javascript">
    function getIPinfo(ip) {
        $.ajax({
            type: "POST",
            url: 'include/kippo-ip.ajax.php',
            data: 'ip=' + ip,
            complete: function (response) {
                $('#extended-ip-info').html(response.responseText);

                $("#IP-attemps")
                    .tablesorter({widthFixed: true, widgets: ['zebra']})
                    .tablesorterPager({container: $("#pager2")});

                $("#IP-commands")
                    .tablesorter({widthFixed: true, widgets: ['zebra']})
                    .tablesorterPager({container: $("#pager3")});

            },
            error: function () {
                $('#output').html('Bummer: there was an error!');
            }
        });
        return false;
    }
</script>
</body>
</html>
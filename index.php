<?php
session_start();
if (isset($_GET['code'])) {
    $_SESSION['code'] = $_GET['code'];
    header('Location: ' . substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?')));
}
?><!DOCTYPE html>
<html>
    <head>
        <title>Ultimate Start Page (git version)</title>
        <style type="text/css">
            @import "960gs.css";
            @import "style.css";
        </style>
        <script type="text/javascript" src="jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="jquery-cron-min.js"></script>
        <script type="text/javascript" src="apps.js"></script>
        <script type="text/javascript">
      
            var Apps = new Object();
      
            function refresh() {
                var app_name;
                for (app_name in Apps) {
                    if (typeof(Apps[app_name].refresh) == 'function') {
                        Apps[app_name].refresh();
                    }
                }
            }
      
            function suc1(app_name,data) {
                var pos = app_name.indexOf('App');
                if (pos>0) {
                    var context = $('tile.'+app_name.slice(0,pos));
                    $(context).animate({
                        height: "0"
                    }, 500, function() { 
                        $(context).animate({
                            height: "150px"
                        }, 200, function() { 
                            if (classExists(app_name)) {
                                Apps[app_name] = eval('new '+app_name+'(context,data);');
                                $(this).find('content').html(Apps[app_name].getHTML());
                            } else {
                                $(this).find('content').html(data);
                            }
                        });
                    });
                }
            }
      
            $(document).ready(function() {
                //$('.grid_1, .grid_2').css('float', 'none');
                //$('.grid_1, .grid_2').css('position', 'fixed');
                var apps = new Array();
                $('tile').each(function() {
                    var pos = $(this).attr('class').indexOf(' ');
                    if (pos>0) {
                        apps.push($(this).attr('class').slice(0,pos)+'App');
                    } else {
                        apps.push($(this).attr('class')+'App');
                    }
                });

                $.ajax({
                    url: "getjson.php",
                    data: {
                        apps: apps.join('|'),
                        code: '<?php print $_SESSION['code']; ?>'
                    },
                    success: function(data) {
                        var ar = jQuery.parseJSON(data);
                        var key;
                        for (key in ar) {
                            var value = ar[key];
                            suc1(key,value);
                        };
                        setInterval('refresh();',5000);
                        //$('#feed').html(data);
                    }
                });
            });
        </script>
    </head>
    <body class="darkgreen">
        <div id="feed"></div>
        <div class="container_6">
            <div class="grid_2">
                <tile class="Mail lightgreen">
                    <content></content>
                </tile>
            </div>
            <div class="grid_2">
                <tile class="News orange">
                    <content></content>
                </tile>
            </div>
            <div class="grid_2">
                <tile class="Calendar okker">
                    <content></content>
                </tile>
            </div>
            <div class="grid_1">
                <tile class="Web lightblue">
                    <content></content>
                </tile>
            </div>
            <div class="grid_1">
                <tile class="Image ">
                    <content></content>
                </tile>
            </div>
            <div class="grid_2">
                <tile class="Music red">
                    <content></content>
                </tile>
            </div>
            <div class="grid_2">
                <tile class="Photos">
                    <content></content>
                </tile>
            </div>
            <div class="grid_1">
                <tile class="Store orange">
                    <content></content>
                </tile>
            </div>
            <div class="grid_1">
                <tile class="Messages lightgreen">
                    <content></content>
                </tile>
            </div>
            <div class="grid_2">
                <tile class="Weather lightblue">
                    <content></content>
                </tile>
            </div>
            <div class="grid_2">
                <tile class="Investments lightgreen">
                    <content></content>
                </tile>
            </div>

        </div>
    </body>

</html>
{{ partial("partials/nav_bar_top") }}
<div id="pjax-loading" style="position: fixed; top: 0px; width: 100%; z-index:1200;">
    <div class="progress" style="height:10px">
        <div class="progress-bar progress-bar-primary progress-bar-striped active" role="progressbar" style="width: 100%;">
        </div>
    </div>
</div>

<div class="container">
    <div id="flashcontainer">
        {{ flash.output() }}
    </div>
    <br/>
    {{ content() }}
    <hr>
    <footer>
        <ul class="list-inline">
            <li><small>Powered by CloudOJ, an Online Judge under Apache License.</small></li>
            <li><small>{{ link_to('about', 'About') }}</small></li>
            <li><small><a href="mailto:iSkyZH@163.com">Feedback</a></small></li>
        </ul>
    </footer>
</div>

<head>
    {{ get_title() }}
</head>

{{ partial("partials/stat_plugin") }}

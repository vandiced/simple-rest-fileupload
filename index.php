<?php //phpinfo(); ?>

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="styles/css/main.css">

    </head>
    <body>

        <!--<div class="menu-container">
            <a href="upload-file.php">Upload</a>
            <a href="view-my-files.php">My Files</a>
        </div>-->

        <div class="file-action-container">

            <div class="nav-menu-container">
                <ul class="nav nav-pills">
                    <li class="active"><a data-toggle="pill" href="#upload">Upload</a></li>
                    <li><a id="my-files" data-toggle="pill" href="#my-files-view">My Files</a></li>
                </ul>
            </div>

            <div class="tab-content">

                <div id="upload" class="tab-pane fade in active">
                    <h3>Please choose your file</h3>

                    <span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>

                    <label class="btn btn-primary btn-file">
                        Select File <input id="my-file-input" type="file" class="display-none">
                    </label>

                    <!--<progress id="progressBar" value="0" max="100" style="width:300px;"></progress>-->

                    <!--<canvas id="file-upload-progress" width="70" height="70"></canvas>-->

                    <span class="file-rule">50K max</span>

                    <span class="upload-response hide">File uploaded!</span>
                </div>
                
                <div id="my-files-view" class="tab-pane fade">
                    <h3>My Files</h3>
                    
                    <div class="my-files-container">
                        <span class="no-files-uploaded-message">No files uploaded</span>
                    </div>

                </div>
            
            </div>
            
        </div>

        <?php
            
        ?>

        <script src="scripts/jquery/3.1.1/jquery.min.js"></script>
        <script src="scripts/bootstrap/3.3.7/bootstrap.min.js"></script>
        <script src="scripts/http-service.js"></script>
        <script src="scripts/index.js"></script>

        <?php

        /*<script>
            var ctx = document.getElementById('file-upload-progress').getContext('2d');
            // amount loaded 0 - 100%
            var al = 0;
            // start point of circle within the canvas, perfect north
            var start = 4.72;
            // canvas width
            var cw = ctx.canvas.width;
            // canvas height
            var ch = ctx.canvas.height;
            var diff;
            function progressSim() {
                diff = ((al/100) * Math.PI*2*10).toFixed(2);
                ctx.clearRect(0, 0, cw, ch);
                ctx.lineWidth = 10;
                ctx.fillStyle = '#337ab7';
                ctx.strokeStyle = '#337ab7';
                ctx.textAlign = 'center';
                ctx.fillText(al + '%', cw*0.5, ch*0.5+2, cw);
                ctx.beginPath();
                ctx.arc(35, 35, 30, start, diff/10+start, false);
                ctx.stroke();

                if (al >= 100) {
                    clearTimeout(sim);
                }

                al++;
            }
            var sim = setInterval(progressSim, 50);
        </script>*/
        ?>

    </body>
</html>
<?php session_start();
if(!$_SESSION['player']) header('Location:/login');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <title>Крестики Нолики</title>
    <link href="/assets/template/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/template/css/main.css">
</head>

<body>
<div class="head">
    <h1>Крестики Нолики</h1>
    <a href="/main/" class="btn btn-info main">На главную</a>
    <div class="player_turn center-block"></div>
</div>
<div class="container">
    <div class="col-sm-4 playerstats pull-left"></div>
    <div class="col-sm-4 oppstats pull-right"></div>
</div>

<div class="container field_hide">
    <svg class="board" style="width: 216px;">
        <path class="lines" d="M108,83L6,83" style="stroke-dasharray: 102; stroke-dashoffset: 0;"></path>
        <path class="lines" d="M108,83L210,83"
              style="stroke-dasharray: 102; stroke-dashoffset: 0;"></path>
        <path class="lines" d="M73,118L73,16"
              style="stroke-dasharray: 102; stroke-dashoffset: 0;"></path>
        <path class="lines" d="M73,118L73,220"
              style="stroke-dasharray: 102; stroke-dashoffset: 0;"></path>
        <path class="lines" d="M108,153L6,153"
              style="stroke-dasharray: 102; stroke-dashoffset: 0;"></path>
        <path class="lines" d="M108,153L210,153"
              style="stroke-dasharray: 102; stroke-dashoffset: 0;"></path>
        <path class="lines" d="M143,118L143,16"
              style="stroke-dasharray: 102; stroke-dashoffset: 0;"></path>
        <path class="lines" d="M143,118L143,220"
              style="stroke-dasharray: 102; stroke-dashoffset: 0;"></path>
    </svg>
    <table class="table">
        <tbody>
        <tr>
            <td class="td" data-col="0" data-row="0" role="button" tabindex="0">
                <svg class="svgX" aria-label="X" role="img" viewBox="0 0 128 128"
                     style="display: none; visibility: visible;">
                    <path d="M16,16L112,112"
                          style="stroke: rgb(84, 84, 84); stroke-dasharray: 135.764; stroke-dashoffset: 0;"></path>
                    <path d="M112,16L16,112"
                          style="stroke: rgb(84, 84, 84); stroke-dasharray: 135.764; stroke-dashoffset: 0;"></path>
                </svg>
                <svg class="svgO" aria-label="O" role="img" viewBox="0 0 128 128"
                     style="display: none; visibility: visible;">
                    <path d="M64,16A48,48 0 1,0 64,112A48,48 0 1,0 64,16" style="stroke: rgb(242, 235, 211);"></path>
                </svg>
            </td>
            <td class="td" data-col="1" data-row="0" role="button" tabindex="0">
                <svg class="svgX" aria-label="X" role="img" viewBox="0 0 128 128"
                     style="display: none;">
                    <path d="M16,16L112,112" style="stroke: rgb(84, 84, 84);"></path>
                    <path d="M112,16L16,112" style="stroke: rgb(84, 84, 84);"></path>
                </svg>
                <svg class="svgO" aria-label="O" role="img" viewBox="0 0 128 128"
                     style="display: none;">
                    <path d="M64,16A48,48 0 1,0 64,112A48,48 0 1,0 64,16" style="stroke: rgb(242, 235, 211);"></path>
                </svg>
            </td>
            <td class="td" data-col="2" data-row="0" role="button" tabindex="0">
                <svg class="svgX" aria-label="X" role="img" viewBox="0 0 128 128"
                     style="display: none;">
                    <path d="M16,16L112,112" style="stroke: rgb(84, 84, 84);"></path>
                    <path d="M112,16L16,112" style="stroke: rgb(84, 84, 84);"></path>
                </svg>
                <svg class="svgO" aria-label="O" role="img" viewBox="0 0 128 128"
                     style="display: none;">
                    <path d="M64,16A48,48 0 1,0 64,112A48,48 0 1,0 64,16" style="stroke: rgb(242, 235, 211);"></path>
                </svg>
            </td>
        </tr>
        <tr>
            <td class="td" data-col="0" data-row="1" role="button" tabindex="0">
                <svg class="svgX" aria-label="X" role="img" viewBox="0 0 128 128"
                     style="display: none;">
                    <path d="M16,16L112,112" style="stroke: rgb(84, 84, 84);"></path>
                    <path d="M112,16L16,112" style="stroke: rgb(84, 84, 84);"></path>
                </svg>
                <svg class="svgO" aria-label="O" role="img" viewBox="0 0 128 128"
                     style="display: none;">
                    <path d="M64,16A48,48 0 1,0 64,112A48,48 0 1,0 64,16" style="stroke: rgb(242, 235, 211);"></path>
                </svg>
            </td>
            <td class="td" data-col="1" data-row="1" role="button" tabindex="0">
                <svg class="svgX" aria-label="X" role="img" viewBox="0 0 128 128"
                     style="display: none;">
                    <path d="M16,16L112,112" style="stroke: rgb(84, 84, 84);"></path>
                    <path d="M112,16L16,112" style="stroke: rgb(84, 84, 84);"></path>
                </svg>
                <svg class="svgO" aria-label="O" role="img" viewBox="0 0 128 128"
                     style="display: none;">
                    <path d="M64,16A48,48 0 1,0 64,112A48,48 0 1,0 64,16" style="stroke: rgb(242, 235, 211);"></path>
                </svg>
            </td>
            <td class="td" data-col="2" data-row="1" role="button" tabindex="0">
                <svg class="svgX" aria-label="X" role="img" viewBox="0 0 128 128"
                     style="display: none; visibility: visible;">
                    <path d="M16,16L112,112" style="stroke: rgb(84, 84, 84);"></path>
                    <path d="M112,16L16,112" style="stroke: rgb(84, 84, 84);"></path>
                </svg>
                <svg class="svgO" aria-label="O" role="img" viewBox="0 0 128 128"
                     style="display: none; visibility: visible;">
                    <path d="M64,16A48,48 0 1,0 64,112A48,48 0 1,0 64,16"
                          style="stroke: rgb(242, 235, 211); stroke-dasharray: 301.635; stroke-dashoffset: 0;"></path>
                </svg>
            </td>
        </tr>
        <tr>
            <td class="td" data-col="0" data-row="2" role="button" tabindex="0">
                <svg class="svgX" aria-label="X" role="img" viewBox="0 0 128 128"
                     style="display: none;">
                    <path d="M16,16L112,112" style="stroke: rgb(84, 84, 84);"></path>
                    <path d="M112,16L16,112" style="stroke: rgb(84, 84, 84);"></path>
                </svg>
                <svg class="svgO" aria-label="O" role="img" viewBox="0 0 128 128"
                     style="display: none;">
                    <path d="M64,16A48,48 0 1,0 64,112A48,48 0 1,0 64,16" style="stroke: rgb(242, 235, 211);"></path>
                </svg>
            </td>
            <td class="td" data-col="1" data-row="2" role="button" tabindex="0">
                <svg class="svgX" aria-label="X" role="img" viewBox="0 0 128 128"
                     style="display: none;">
                    <path d="M16,16L112,112" style="stroke: rgb(84, 84, 84);"></path>
                    <path d="M112,16L16,112" style="stroke: rgb(84, 84, 84);"></path>
                </svg>
                <svg class="svgO" aria-label="O" role="img" viewBox="0 0 128 128"
                     style="display: none;">
                    <path d="M64,16A48,48 0 1,0 64,112A48,48 0 1,0 64,16" style="stroke: rgb(242, 235, 211);"></path>
                </svg>
            </td>
            <td class="td" data-col="2" data-row="2" role="button" tabindex="0">
                <svg class="svgX" aria-label="X" role="img" viewBox="0 0 128 128"
                     style="display: none;">
                    <path d="M16,16L112,112" style="stroke: rgb(84, 84, 84);"></path>
                    <path d="M112,16L16,112" style="stroke: rgb(84, 84, 84);"></path>
                </svg>
                <svg class="svgO" aria-label="O" role="img" viewBox="0 0 128 128"
                     style="display: none;">
                    <path d="M64,16A48,48 0 1,0 64,112A48,48 0 1,0 64,16" style="stroke: rgb(242, 235, 211);"></path>
                </svg>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="container buttons">
    <div class="col-sm-12">
        <button id="btn" class="btn btn-info">Начать игру</button>
    </div>
    <div class="col-sm-12">
        <button id ="refresh" class="btn btn-info">Обновить список игр</button>
    </div>
</div>


<div id="ratings"></div>

<div id="games"></div>
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title modal_text"></h4>
            </div>
        </div>
        <div class="modal-footer">
            <a href="/main/" class="btn btn-info" data-toggle="modal" id="preview">На главную</a>
        </div>
    </div>
</div>

<div id="myError" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ваша учетная запись уже в этой игре!</h4>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Закрыть</button>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="/assets/template/js/bootstrap.min.js"></script>
<script src="/assets/template/js/main.js"></script>

</body>

</html>
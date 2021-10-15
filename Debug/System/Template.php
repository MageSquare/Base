<?php
/**
 * @author MageSquare Team
 * @copyright Copyright (c) 2021 MageSquare 
 * @package MageSquare_Base
 */


namespace MageSquare\Base\Debug\System;

/**
 * @codeCoverageIgnore
 * @codingStandardsIgnoreFile
 */
class Template
{
    public static $varWrapper = '<div class="magesquare-base-debug-wrapper"><code>%s</code></div>';

    public static $string = '"<span class="magesquare-base-string">%s</span>"';

    public static $var = '<span class="magesquare-base-var">%s</span>';

    public static $arrowsOpened =  '<span class="magesquare-base-arrow" data-opened="true">&#x25BC;</span>
        <div class="magesquare-base-array">';

    public static $arrowsClosed = '<span class="magesquare-base-arrow" data-opened="false">&#x25C0;</span>
        <div class="magesquare-base-array magesquare-base-hidden">';

    public static $arrayHeader = '<span class="magesquare-base-info">array:%s</span> [';

    public static $array = '<div class="magesquare-base-array-line" style="padding-left:%s0px">
            %s  => %s
        </div>';

    public static $arrayFooter = '</div>]';

    public static $arrayKeyString = '"<span class="magesquare-base-array-key">%s</span>"';

    public static $arrayKey = '<span class="magesquare-base-array-key">%s</span>';

    public static $arraySimpleVar = '<span class="magesquare-base-array-value">%s</span>';

    public static $arraySimpleString = '"<span class="magesquare-base-array-string-value">%s</span>"';

    public static $objectHeader = '<span class="magesquare-base-info" title="%s">Object: %s</span> {';

    public static $objectMethod = '<div class="magesquare-base-object-method-line" style="padding-left:%s0px">
            #%s
        </div>';

    public static $objectMethodHeader = '<span style="margin-left:%s0px">Methods: </span>
        <span class="magesquare-base-arrow" data-opened="false">◀</span>
        <div class="magesquare-base-array  magesquare-base-hidden">';

    public static $objectMethodFooter = '</div>';

    public static $objectFooter = '</div> }';

    public static $debugJsCss = '<script>
            var magesquareToggle = function() {
                if (this.dataset.opened == "true") {
                    this.innerHTML = "&#x25C0";
                    this.dataset.opened = "false";
                    this.nextElementSibling.className = "magesquare-base-array magesquare-base-hidden";
                } else {
                    this.innerHTML = "&#x25BC;";
                    this.dataset.opened = "true";
                    this.nextElementSibling.className = "magesquare-base-array";
                }
            };
            document.addEventListener("DOMContentLoaded", function() {
                arrows = document.getElementsByClassName("magesquare-base-arrow");
                for (i = 0; i < arrows.length; i++) {
                    arrows[i].addEventListener("click", magesquareToggle,false);
                }
            });
        </script>
        <style>
            .magesquare-base-debug-wrapper {
                background-color: #263238;
                color: #ff9416;
                font-size: 13px;
                padding: 10px;
                border-radius: 3px;
                z-index: 1000000;
                margin: 20px 0;
            }
            .magesquare-base-debug-wrapper code {
                background: transparent !important;
                color: inherit !important;
                padding: 0;
                font-size: inherit;
                white-space: inherit;
            }
            .magesquare-base-info {
                color: #82AAFF;
            }
            .magesquare-base-var, .magesquare-base-array-key {
                color: #fff;
            }
            .magesquare-base-array-value {
                color: #C792EA;
                font-weight: bold;
            }
            .magesquare-base-arrow {
                cursor: pointer;
                color: #82aaff;
            }
            .magesquare-base-hidden {
                display:none;
            }
            .magesquare-base-string, .magesquare-base-array-string-value {
                font-weight: bold;
                color: #c3e88d;
            }
            .magesquare-base-object-method-line {
                color: #fff;
            }
        </style>';
}

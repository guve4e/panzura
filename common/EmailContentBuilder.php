<?php

final class EmailContentBuilder
{
    private $order;
    private $text;
    private $today;

    /**
     * MailReceipt constructor.
     * @param $order
     * @throws ApiException
     */
    public function __construct(string $text, string $html)
    {
        if (!isset($html) || !isset($text))
            throw new ApiException("EmailContentBuilder has failed. Bad Parameters in constructor!");

        $this->text = $text;
        $this->html = $html;
        $this->today = date("F j, Y");
    }

    public function makeHtmlContent()
    {
        return "
            <!doctype html>
        <head>
             
        
        <style>
        
            .uk-grid+.uk-grid,.uk-grid-margin,.uk-grid>*>.uk-panel+.uk-panel {
                margin-top: 24px
            }
            .uk-table td {
                border-bottom-color: rgba(0,0,0,.12)
            }
            .uk-table th {
                border-bottom: 1px #444
            }
            .uk-table thead th {
                border-bottom: 2px solid rgba(0,0,0,.12)
            }
            .uk-table tfoot td,.uk-table tfoot th,.uk-table thead th {
                font-style: normal;
                font-weight: 400;
                color: #727272;
                font-size: 14px
            }
            .uk-table td {
                border-bottom-color: #e0e0e0
            }
            .uk-text-small {
                font-size: 12px
            }
            .uk-text-muted {
                color: #757575!important
            }
            .uk-text-danger {
                color: #e53935!important
            }
            .uk-text-success {
                color: #7cb342!important
            }
            .uk-margin-bottom {
                margin-bottom: 16px!important
            }
            .uk-margin-medium-bottom {
                margin-bottom: 32px!important
            }
            .uk-margin-large-bottom {
                margin-bottom: 48px!important
            }
            .md-bg-blue-grey-500 {
                background-color: #000000!important
            }
            .md-card {
                background: #fff;
                position: relative;
                -webkit-box-shadow: 0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);
                box-shadow: 0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);
                border: none
            }
            .md-card .md-card-content {
                padding: 16px
            }
            #header_main,#page_content,#top_bar {
                will-change: margin;
                -webkit-transition: margin 280ms;
                transition: margin 280ms
            }
            .invoice_header {
                height: 72px;
                padding: 20px;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                margin: -16px -16px 24px
            }
            .invoice_header>img {
                max-height: 100%;
                width: auto
            }
            .invoice_footer {
                border-top: 1px solid rgba(0,0,0,.12);
                margin-top: 40px;
                height: 64px;
                padding: 8px;
                font-size: 13px;
                text-align: center;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                line-height: 20px
            }
            .invoice_footer>span {
                font-weight: 700;
                font-size: 24px;
                vertical-align: -4px;
                padding: 0 8px
            }
            .invoice_content {
                position: relative
            }
            .invoice_content address p+p {
                margin-top: 0
            } 
            html {
                height: 100%;
                overflow-x: hidden;
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
                background: #ececec
            }
            body {
                min-height: 100%;
                font: 400 14px/1.42857143 Roboto,sans-serif;
                padding-top: 48px;
                -webkit-box-sizing: border-box;
                box-sizing: border-box
            }
            h1,h2,h3,h4,h5,h6 {
                font-family: Roboto,\"Helvetica Neue\",Helvetica,Arial,sans-serif;
                font-weight: 500
            }
            .heading_a {
                margin: 0;
                font: 400 18px/24px Roboto,sans-serif
            }
            .heading_b {
                margin: 0;
                font: 400 22px/28px Roboto,sans-serif
            }
            .uk-text-large {
                font-size: 16px;
                font-weight: 400;
                margin: 0 0 16px
            }
            *>.uk-text-large {
                margin-top: 16px
            }
            .uk-text-small {
                font-size: 12px!important
            } 
            .uk-text-upper {
                text-transform: uppercase
            }
            .uk-text-italic {
                font-style: italic
            }
            address {
                margin: 0
            } 
            address p {
                margin: 0
            }
            address p+p {
                margin-top: 4px
            }
            #page_content:before {
                content: '';
                position: fixed;
                left: 0;
                top: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,.3);
                display: block;
                opacity: 0;
                -webkit-transition: opacity .4s;
                transition: opacity .4s;
                z-index: -1
            } 
            #page_content_inner {
                padding: 24px 24px 100px
            } 
            html {
                font: 400 14px/20px \"Helvetica Neue\",Helvetica,Arial,sans-serif;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
                background: #fff;
                color: #444
            }
            body {
                margin: 0
            }
            b,strong {
                font-weight: 700
            }
            audio,canvas,iframe,img,svg,video {
                vertical-align: middle
            }
            audio,canvas,img,svg,video {
                max-width: 100%;
                height: auto;
                box-sizing: border-box
            }
            img {
                border: 0
            }
            address,blockquote,dl,fieldset,figure,ol,p,pre,ul {
                margin: 0 0 15px 0
            }
            *+address,*+blockquote,*+dl,*+fieldset,*+figure,*+ol,*+p,*+pre,*+ul {
                margin-top: 15px
            }
            h1,h2,h3,h4,h5,h6 {
                margin: 0 0 15px 0;
                font-family: \"Helvetica Neue\",Helvetica,Arial,sans-serif;
                font-weight: 400;
                color: #444;
                text-transform: none
            }
            .uk-h3,h3 {
                font-size: 18px;
                line-height: 24px
            }
            address {
                font-style: normal
            }
            .uk-grid {
                display: -ms-flexbox;
                display: -webkit-flex;
                display: flex;
                -ms-flex-wrap: wrap;
                -webkit-flex-wrap: wrap;
                flex-wrap: wrap;
                margin: 0;
                padding: 0;
                list-style: none
            }
            .uk-grid:after,.uk-grid:before {
                content: \"\";
                display: block;
                overflow: hidden
            }
            .uk-grid:after {
                clear: both
            }
            .uk-grid>* {
                -ms-flex: none;
                -webkit-flex: none;
                flex: none;
                margin: 0;
                float: left
            }
            .uk-grid>*>:last-child {
                margin-bottom: 0
            }
            .uk-grid {
                margin-left: -25px
            }    
            .uk-grid>* {
                padding-left: 25px
            }    
            .uk-grid+.uk-grid,.uk-grid-margin,.uk-grid>*>.uk-panel+.uk-panel {
                margin-top: 25px
            }
            .uk-grid-collapse {
                margin-left: 0
            }    
            .uk-grid-collapse>* {
                padding-left: 0
            }
            [class*=uk-width] {
                box-sizing: border-box;
                width: 100%
            }    
            .uk-width-1-1 {
                width: 100%
            }    
            .uk-width-small-2-5,.uk-width-small-4-10 {
                width: 40%
            }    
            .uk-width-small-3-5,.uk-width-small-6-10 {
                width: 60%
            }    
            .uk-width-medium-4-5,.uk-width-medium-8-10 {
                width: 80%
            }
            .uk-width-large-7-10 {
                width: 70%
            }
            .uk-table {
                border-collapse: collapse;
                border-spacing: 0;
                width: 100%;
                margin-bottom: 15px
            }   
            .uk-table td,.uk-table th {
                padding: 8px 8px;
                border-bottom: 1px solid #ddd
            }    
            .uk-table th {
                text-align: left
            }   
            .uk-table td {
                vertical-align: top
            }    
            .uk-table thead th {
                vertical-align: bottom
            }
            .uk-table-middle,.uk-table-middle td {
                vertical-align: middle!important
            }
            .uk-text-small {
                font-size: 11px;
                line-height: 16px
            }    
            .uk-text-large {
                font-size: 18px;
                line-height: 24px;
                font-weight: 400
            }    
            .uk-text-bold {
                font-weight: 700
            }   
            .uk-text-muted {
                color: #999!important
            }
            .uk-text-success {
                color: #659f13!important
            }
            .uk-text-danger {
                color: #d85030!important
            }
            .uk-text-center {
                text-align: center!important
            }
            .uk-container-center {
                margin-left: auto;
                margin-right: auto
            }
            .uk-float-right {
                float: right
            }   
            [class*=uk-float-] {
                max-width: 100%
            }  
            .uk-margin-bottom {
                margin-bottom: 15px!important
            }
            .uk-margin-large-bottom {
                margin-bottom: 50px!important
            }
            .uk-margin-top-remove {
                margin-top: 0!important
            }
            .img_thumb {
              width: 80px;
              max-width: 100%;
              height: auto;
            }
        
        </style>
        </head>
        <body>
            <div id='page_content' style=\"position: center\">
                <div id='page_content_inner'>
                    <div class='uk-grid'>
                        <div class='uk-width-large'>
                            <div class='md-card md-card-single' id='invoice'>
                                <div class='md-card-content invoice_content'>
        
                                        <div class='invoice_header md-bg-blue-grey-500'>
                                            <img class='uk-float-right' src='https://thevitcserum.com/assets/img/web-logo-V1.png' alt=' height='80' width='205'/>
                                        </div>
                                   
                                    {$this->html}
                                        
                                    <div class='invoice_footer'>
                                        AVA Cosmetika<span>&middot;</span>141 S Roxbury Dr. Beverly Hills, CA 90212<br>
                                        avacosmetika.com 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>
        ";
    }

}

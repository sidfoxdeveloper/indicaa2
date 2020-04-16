<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
        <title>Indicaa Group</title>
        <style>
            @font-face { font-family: 'FontAwesome'; src: url(mail_templates/fonts/fontawesome-webfont.eot?v=4.7.0); src: url(mail_templates/fonts/fontawesome-webfont.eot?#iefix&v=4.7.0) format('embedded-opentype'), url(mail_templates/fonts/fontawesome-webfont.woff2?v=4.7.0) format('woff2'), url(mail_templates/fonts/fontawesome-webfont.woff?v=4.7.0) format('woff'), url(mail_templates/fonts/fontawesome-webfont.ttf?v=4.7.0) format('truetype'), url(mail_templates/fonts/fontawesome-webfont.svg?v=4.7.0#fontawesomeregular) format('svg'); font-weight: normal; font-style: normal }
            .fa { display: inline-block; font: normal normal normal 14px/1 FontAwesome; font-size: inherit; text-rendering: auto; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale }
            .fa-facebook-f:before, .fa-facebook:before { content: "\f09a" }
            .fa-twitter:before { content: "\f099" }
            .fa-linkedin:before { content: "\f0e1" }
            .fa-instagram:before { content: "\f16d" }
            .fa-google-plus:before { content: "\f0d5" }
            @font-face { font-family: 'robotoregular'; src: url(mail_templates/fonts/Roboto-Regular-webfont.eot); src: url(mail_templates/fonts/Roboto-Regular-webfont.eot?#iefix) format('embedded-opentype'),  url(mail_templates/fonts/Roboto-Regular-webfont.woff) format('woff'),  url(mail_templates/fonts/Roboto-Regular-webfont.ttf) format('truetype'),  url(mail_templates/fonts/Roboto-Regular-webfont.svg#robotoregular) format('svg'); font-weight: normal; font-style: normal; }
            @font-face { font-family: 'robotomedium'; src: url(mail_templates/fonts/Roboto-Medium-webfont.eot); src: url(mail_templates/fonts/Roboto-Medium-webfont.eot?#iefix) format('embedded-opentype'),  url(mail_templates/fonts/Roboto-Medium-webfont.woff) format('woff'),  url(mail_templates/fonts/Roboto-Medium-webfont.ttf) format('truetype'),  url(mail_templates/fonts/Roboto-Medium-webfont.svg#robotoregular) format('svg'); font-weight: normal; font-style: normal; }
            @font-face { font-family: 'robotobold'; src: url(mail_templates/fonts/Roboto-Bold-webfont.eot); src: url(mail_templates/fonts/Roboto-Bold-webfont.eot?#iefix) format('embedded-opentype'),  url(mail_templates/fonts/Roboto-Bold-webfont.woff) format('woff'),  url(mail_templates/fonts/Roboto-Bold-webfont.ttf) format('truetype'),  url(mail_templates/fonts/Roboto-Bold-webfont.svg#robotoregular) format('svg'); font-weight: normal; font-style: normal; }
            @font-face { font-family: 'robotoslabbold'; src: url(mail_templates/fonts/RobotoSlab-Bold-webfont.eot); src: url(mail_templates/fonts/RobotoSlab-Bold-webfont.eot?#iefix) format('embedded-opentype'),  url(mail_templates/fonts/RobotoSlab-Bold-webfont.woff) format('woff'),  url(mail_templates/fonts/RobotoSlab-Bold-webfont.ttf) format('truetype'),  url(mail_templates/fonts/RobotoSlab-Bold-webfont.svg#robotoregular) format('svg'); font-weight: normal; font-style: normal; }
            *, ::after, ::before { box-sizing: border-box; }
            body { width: 100%; overflow: hidden; overflow-y: auto; }
            body, *, p { margin: 0px; padding: 0px; }
            .btn { display: inline-block; font-weight: 400; text-align: center; white-space: nowrap; vertical-align: middle; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; border: 1px solid transparent; padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; border-radius: .25rem; transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out; cursor: pointer; text-decoration: none !important; }
            .btn-social-icon { display: inline-flex; padding: 5px !important; width: 35px; height: 35px; border-radius: 100%; align-items: center; justify-content: center; background: #ef5438; color: #fff; float: left; margin-right: 8px; }
            .btn-social-icon:last-child{ margin:0px;}
            .s-icon { display: table; margin: 0px auto 20px auto; }
            .ul-li-span1 { width: 20%; }
            .ul-li-span2 { width: 80%; }
            .sender-info-holder { padding: 0px 45px; }

            @media only screen and (max-width:600px) {
                .ul-li-span2, .ul-li-span1 { width: 100%; }
                .sender-info-holder { padding: 0px 15px; }
                .sender-info-holder > div { padding: 25px !important; }
            }
        </style>
    </head>

    <body>
        <div style="display: block;width: 100%;box-sizing: border-box;overflow-x: auto;">
            <table style="width:100%; max-width:600px; margin:0px auto; float:none;border-spacing: 0;">
                <tbody>
                    <tr>
                        <td style="background:#1e2226; text-align:center; padding:35px 0px;">
                            <a href="javascript:void(0);"><img src="mail_templates/images/logo.png" height="100px;" alt="Indicaa Group"/></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style=" background:#ef5438; height:225px; display:flex; align-items:center; justify-content:center; overflow:hidden;">
                                <img src="mail_templates/images/email-banner-1.jpg" alt="Indicaa Group" style="opacity:0.05; width:100%; height:auto;"/>
                            </div>
                            <div style="z-index: 1;position: relative;margin-top: -170px;" class="sender-info-holder">
                                <div style="margin:0px auto 0px auto; padding:50px 35px; background:#fff; box-shadow:0px 0px 10px 0px rgba(31,31,31,0.25);border-radius: 5px;display: block;width: 100%;overflow-x: auto;">
                                    <ul style="padding:0px;">{{message}}</ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#1e2226; border-top:solid 5px #ef5438; box-shadow:0px 0px 10px 0px rgba(31,31,31,0.25); padding:30px 0px;">
                            <p style="color:#fff; font-size:14px; line-height:1; font-family: 'robotoregular'; text-align:center;">© Indicaa Group, All Rights Reserved</p>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </body>
</html>
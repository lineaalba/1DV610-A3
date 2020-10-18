<?php

namespace View;

require_once('Login/src/View/DateTimeView.php');

class LayoutView {
    private $dateTimeView;
    private $link;
    private $renderIsLoggedIn;
    private $correctHTML;

    public function __construct(string $link, string $renderIsLoggedIn, string $correctHTML) {
        $this->dateTimeView = new \View\DateTimeView();
        $this->link = $link;
        $this->renderIsLoggedIn = $renderIsLoggedIn;
        $this->correctHTML = $correctHTML;
    }

    public function echoHTML() {
        echo '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <title>Login Example</title>
            </head>
            <body>
                <h1>Assignment 2</h1>
                
                ' . $this->link . '
                ' . $this->renderIsLoggedIn . '

                ' . $this->correctHTML . '
               
                <div class="container">
                    ' . $this->dateTimeView->timeAndDate() . '
                </div>
            </body>
        </html>
        ';
    }
}
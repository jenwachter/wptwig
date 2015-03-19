<?php

// uncomment if you are not using composer installers
// require "vendor/autoload.php";

add_action("init", function () {

  // Create content types
  new \wptwig\ContentTypes\Book();

});

<?php

add_action("init", function () {

  // Create content types
  new \wptwig\ContentTypes\Book();

});

<?php

echo ajax_anchor(get_uri("agreements/add_remove_star/" . $client_id . "/add"), "<i data-feather='star' class='icon-16'></i>", array("data-real-target" => "#star-mark", "class" => "star-icon"));

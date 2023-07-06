<?php

$random_string = substr(bin2hex(random_bytes(3)), 0, 9);
echo $random_string;

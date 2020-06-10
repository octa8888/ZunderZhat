<?php

include '../helper/include.php';

session_destroy();

header("location: ../login.php");
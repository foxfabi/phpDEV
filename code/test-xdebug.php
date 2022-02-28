<?php

function saysomething($input) {
  if (!$input or $input == "") {
    throw new Exception('Es wurde kein Element übergeben');
  } else {
    echo $input . PHP_EOL;
  }
}

echo "Sample Exception Handling" . PHP_EOL;

try {
  saysomething(" Das wird noch ausgegeben");
  saysomething("");
} catch (Exception $error) {
  echo "Ops! ", $error->getMessage() . PHP_EOL;
}

echo " Das wird wieder ausgegeben" . PHP_EOL;

<?php

/* Brukes f.eks {{ post.phone_number|phone }} */
function phone( $number ) {
  $number = str_replace(' ', '', $number);
  if (substr($number, 0, 1) == 4 || (substr($number, 0 , 1) == 9)) {
    return substr($number, 0, 3) . " " . substr($number, 2, 2) . " " . substr($number, 4, 3);
  }
  return substr($number, 0, 2) . " " . substr($number, 2, 2) . " " . substr($number, 4, 2) . " " . substr($number, 6, 2);
}

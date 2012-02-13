
//************************************************
// Start Rotating Images
//************************************************
 if ( $("#rotating_images").length > 0)
 {
  $("#rotating_images").fadeIn('slow');
  $("#rotating_images").innerfade( { speed: "slow", timeout: 3000, type: "sequence", containerheight: "<?php echo $height; ?>px"});
 }


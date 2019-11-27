<?php

/*
* File for origin loop rate calcualtions.
*
*/

// Get the DTP charges from the origin city's CPT fields
$originargs = array(
    'numberposts' => 1,
    'post_type'   => 'service_cities',
    'meta_key'    => 'city',
    'meta_value'  => $origincity
    );

    // The Query
    $origin_query = new WP_Query( $originargs );

    // The Loop
    if ( $origin_query->have_posts() ) {

      while ( $origin_query->have_posts() ) {
          $origin_query->the_post();
          $postid = get_the_ID();

          // Get the origin pricing
              if($mode === 'air'){

                if( have_rows('air', $postid )): ?>

                   <?php while( have_rows('air', $postid )): the_row();

                       $airoriginordestination = get_sub_field('origin_or_destination');

                       if($airoriginordestination === 'origin') {

                            // Grabd all of the tarrif rates.
                           $airminimum = get_sub_field('air_minimum');
                           $air0to500lbs = get_sub_field('0_-_500_lbs');
                           $air500to1000lbs = get_sub_field('500_-_1000_lbs');
                           $air1000to1250lbs = get_sub_field('1000_-_1250_lbs');
                           $air1250to1500lbs = get_sub_field('1250_-_1500_lbs');
                           $air1500to1750lbs = get_sub_field('1500_-_1750_lbs');
                           $air1750to2000lbs = get_sub_field('1750_-_2000_lbs');
                           $air2000lbsup = get_sub_field('2000_lbs_+');

                           // Volumetric and weightbreak calcualtions
                           if($volumetricweight >= 0 && $volumetricweight <= 500){
                             $originrate = $cwtweight * $air0to500lbs;
                             $weightbreak = $air500to1000lbs * (500/100);
                           } elseif ($volumetricweight > 500 && $volumetricweight <= 1000)  {
                             $originrate = $cwtweight * $air500to1000lbs;
                             $weightbreak = $air1000to1250lbs * (1000/100);
                           } elseif ($volumetricweight > 1000 && $volumetricweight <= 1250) {
                             $originrate = $cwtweight * $air1000to1250lbs;
                             $weightbreak = $air1250to1500lbs * (1250/100);
                          }  elseif ($volumetricweight > 1250 && $volumetricweight <= 1500) {
                             $originrate = $cwtweight * $air1250to1500lbs;
                             $weightbreak = $air1500to1750lbs * (1500/100);
                          }  elseif ($volumetricweight > 1500 && $volumetricweight <= 1750) {
                             $originrate = $cwtweight * $air1500to1750lbs;
                             $weightbreak = $air1750to2000lbs * (1750/100);
                          }  elseif ($volumetricweight > 1750 && $volumetricweight <= 2000) {
                             $originrate = $cwtweight * $air1750to2000lbs;
                             $weightbreak = $air2000lbsup * (2000/100);
                          }  elseif ($volumetricweight > 2000) {
                             $originrate = $cwtweight * $air2000lbsup;
                          }

                          // Final comparison for min, actual, and weightbreak rates
                          if($originrate >= $airminimum && $weightbreak >= $airminimum){
                             $finaloriginrate = min($originrate, $weightbreak);
                          } elseif( $originrate >= $airminimum && $weightbreak <= $airminimum) {
                             $finaloriginrate = $originrate;
                          } elseif( $originrate <= $airminimum && $weightbreak >= $airminimum) {
                             $finaloriginrate = $airminimum;
                          } elseif( $originrate <= $airminimum && $weightbreak <= $airminimum) {
                             $finaloriginrate = $airminimum;
                          } else {
                             $finaloriginrate = 0;
                          }

                            if($DEBUG === 1){
                              echo "Air min: " . $airminimum;
                              echo "Origin rate: " . $originrate;
                              echo "Weightbreak rate: " . $weightbreak;
                              echo "Final origin rate: " . $finaloriginrate;
                            }

                            break;

                     } else {
                       // If the row is not an origin rate, set the origin rate to a -1 for JS error handling on the front end.
                       $finaloriginrate = -1;
                     }
                    endwhile; ?>

               <?php endif;




              }

              if($mode === 'lcl'){
                if( have_rows('lcl', $postid )): ?>

                   <?php while( have_rows('lcl', $postid )): the_row();

                      $lcloriginordestinaton = get_sub_field('origin_or_destination');

                      if($lcloriginordestinaton === 'origin') {

                      $lclminimum = get_sub_field('lcl_minimum');
                      $lcl0to500lbs = get_sub_field('0_-_500_lbs');
                      $lcl500to1000lbs = get_sub_field('500_-_1000_lbs');
                      $lcl1000to2000lbs = get_sub_field('1000_-_2000_lbs');
                      $lcl2000to3000lbs = get_sub_field('2000_-_3000_lbs');
                      $lcl3000to4000lbs =  get_sub_field('3000_-_4000_lbs');
                      $lcl4000to5000lbs = get_sub_field('4000_-_5000_lbs');


                      // Volumetric and weightbreak calculations
                      if($volumetricweight >= 0 && $volumetricweight <= 500){
                        $originrate = $cwtweight * $lcl0to500lbs;
                        $weightbreak = $lcl500to1000lbs * (500/100);
                      } elseif ($volumetricweight > 500 && $volumetricweight <= 1000)  {
                        $originrate = $cwtweight * $lcl500to1000lbs;
                        $weightbreak = $lcl1000to2000lbs * (1000/100);
                      } elseif ($volumetricweight > 1000 && $volumetricweight <= 2000) {
                        $originrate = $cwtweight * $lcl1000to2000lbs;
                        $weightbreak = $lcl2000to3000lbs * (2000/100);
                     }  elseif ($volumetricweight > 2000 && $volumetricweight <= 3000) {
                        $originrate = $cwtweight * $lcl2000to3000lbs;
                        $weightbreak = $lcl3000to4000lbs * (3000/100);
                     }  elseif ($volumetricweight > 3000 && $volumetricweight <= 4000) {
                        $originrate = $cwtweight * $lcl3000to4000lbs;
                        $weightbreak = $lcl4000to5000lbs * (4000/100);
                     }  elseif ($volumetricweight > 4000 && $volumetricweight <= 5000) {
                        $originrate = $cwtweight * $lcl4000to5000lbs;
                        $weightbreak = $lcl4000to5000lbs * (5000/100);
                     }  elseif ($volumetricweight > 5000) {
                        $originrate = $cwtweight * $lcl4000to5000lbs;
                     }

                     // Final comparison for min, actual, and weightbreak rates
                     if($originrate >= $lclminimum && $weightbreak >= $lclminimum){
                        $finaloriginrate = min($originrate, $weightbreak);
                     } elseif( $originrate >= $lclminimum && $weightbreak <= $lclminimum) {
                        $finaloriginrate = $originrate;
                     } elseif( $originrate <= $lclminimum && $weightbreak >= $lclminimum) {
                        $finaloriginrate = $lclminimum;
                     } elseif( $originrate <= $lclminimum && $weightbreak <= $lclminimum) {
                        $finaloriginrate = $lclminimum;
                     } else {
                        $finaloriginrate = 0;
                     }

                       if($DEBUG === 1){
                         echo "LCL min: " . $lclminimum;
                         echo "Origin rate: " . $originrate;
                         echo "Weightbreak rate: " . $weightbreak;
                         echo "Final origin rate: " . $finaloriginrate;
                       }
                       break;

                     } else {
                       $finaloriginrate = -1;
                     }

                    endwhile; ?>

               <?php endif;





              }

              if($mode === '20_fcl' || $mode === 'road_20_fcl'){
                  if( have_rows('20_fcl', $postid )): ?>

                  <?php while( have_rows('20_fcl', $postid )): the_row();

                       $twentyfcloriginordestination = get_sub_field('origin_or_destination');

                       if($twentyfcloriginordestination === 'origin') {

                       $twentyfclminimum = get_sub_field('20_fcl_minimum');
                       $twentyfcl1000to2000lbs = get_sub_field('1000_-_2000_lbs');
                       $twentyfcl2000to3000lbs = get_sub_field('2000_-_3000_lbs');
                       $twentyfcl3000to4000lbs = get_sub_field('3000_-_4000_lbs');
                       $twentyfcl4000to5000lbs = get_sub_field('4000_-_5000_lbs');
                       $twentyfcl5000to6000lbs = get_sub_field('5000_-_6000_lbs');
                       $twentyfcl6000to7000lbs = get_sub_field('6000_-_7000_lbs');
                       // Volumetric weight and weightbeak caluculations
                       if($volumetricweight >= 0 && $volumetricweight <= 2000){
                         $originrate = $cwtweight * $twentyfcl1000to2000lbs;
                         $weightbreak = $twentyfcl2000to3000lbs * (2000/100);
                       } elseif ($volumetricweight > 2000 && $volumetricweight <= 3000)  {
                         $originrate = $cwtweight * $twentyfcl2000to3000lbs;
                         $weightbreak = $twentyfcl3000to4000lbs * (3000/100);
                       } elseif ($volumetricweight > 3000 && $volumetricweight <= 4000) {
                         $originrate = $cwtweight * $twentyfcl3000to4000lbs;
                         $weightbreak = $twentyfcl4000to5000lbs * (4000/100);
                      }  elseif ($volumetricweight > 4000 && $volumetricweight <= 5000) {
                         $originrate = $cwtweight * $twentyfcl4000to5000lbs;
                         $weightbreak = $twentyfcl5000to6000lbs * (1500/100);
                      }  elseif ($volumetricweight > 5000 && $volumetricweight <= 6000) {
                         $originrate = $cwtweight * $twentyfcl5000to6000lbs;
                         $weightbreak = $twentyfcl6000to7000lbs * (1750/100);
                      }  elseif ($volumetricweight > 6000 && $volumetricweight <= 7000) {
                         $originrate = $cwtweight * $twentyfcl6000to7000lbs;
                      }  elseif ($volumetricweight > 7000) {
                         $originrate = $cwtweight * $twentyfcl6000to7000lbs;
                      }

                      // Final comparison for min, actual, and weightbreak rates
                      if($originrate >= $twentyfclminimum && $weightbreak >= $twentyfclminimum){
                         $finaloriginrate = min($originrate, $weightbreak);
                      } elseif( $originrate >= $twentyfclminimum && $weightbreak <= $twentyfclminimum) {
                         $finaloriginrate = $originrate;
                      } elseif( $originrate <= $twentyfclminimum && $weightbreak >= $twentyfclminimum) {
                         $finaloriginrate = $twentyfclminimum;
                      } elseif( $originrate <= $twentyfclminimum && $weightbreak <= $twentyfclminimum) {
                         $finaloriginrate = $twentyfclminimum;
                      } else {
                         $finaloriginrate = 0;
                      }

                        if($DEBUG === 1){
                          echo "20 FCL min: " . $twentyfclminimum;
                          echo "Origin rate: " . $originrate;
                          echo "Weightbreak rate: " . $weightbreak;
                          echo "Final origin rate: " . $finaloriginrate;
                        }

                        break;

                      } else {
                          $finaloriginrate = -1;
                      }
                 endwhile; ?>

            <?php endif;



              }

              if($mode === '40_fcl' || $mode === '40hc_fcl' || $mode === 'road_40_fcl'){
                 if( have_rows('40_fcl', $postid )): ?>

                 <?php while( have_rows('40_fcl', $postid )): the_row();

                      $fortyfcloriginordestination = get_sub_field('origin_or_destination');

                      if($fortyfcloriginordestination === 'origin') {

                      $fortyfclminimum = get_sub_field('40_fcl_minimum');
                      $fortyfcl6000to7000lbs = get_sub_field('6000_-_7000_lbs');
                      $fortyfcl7000to8000lbs = get_sub_field('7000_-_8000_lbs');
                      $fortyfcl8000to9000lbs = get_sub_field('8000_-_9000_lbs');
                      $fortyfcl9000to10000lbs = get_sub_field('9000_-_10000_lbs');
                      $fortyfcl10000to11000lbs = get_sub_field('10000_-_11000_lbs');
                      $fortyfcl11000to12000lbs = get_sub_field('11000_-_12000_lbs');
                      $fortyfcl12000to13000lbs = get_sub_field('12000_-_13000_lbs');
                      $fortyfcl13000to14000lbs = get_sub_field('13000_-_14000_lbs');
                      $fortyfcl14000to15000lbs = get_sub_field('14000_-_15000_lbs');
                      $fortyfcl15000to16000lbs = get_sub_field('15000_-_16000_lbs');
                      $fortyfcl16000to17000lbs = get_sub_field('16000_-_17000_lbs');
                      $fortyfcl17000lbsup = get_sub_field('17000_lbs_up');

                      //if volumetric weight is between 0 and 500, $cwt * rate
                      if($volumetricweight >= 0 && $volumetricweight <= 6000){
                        $originrate = $cwtweight * $fortyfcl6000to7000lbs;
                        $weightbreak = $fortyfcl7000to8000lbs * (7000/100);
                      } elseif ($volumetricweight > 6000 && $volumetricweight <= 7000)  {
                        $originrate = $cwtweight * $fortyfcl6000to7000lbs;
                        $weightbreak = $fortyfcl7000to8000lbs * (7000/100);
                      } elseif ($volumetricweight > 7000 && $volumetricweight <= 8000) {
                        $originrate = $cwtweight * $fortyfcl7000to8000lbs;
                        $weightbreak = $fortyfcl8000to9000lbs * (8000/100);
                     }  elseif ($volumetricweight > 8000 && $volumetricweight <= 9000) {
                        $originrate = $cwtweight * $fortyfcl8000to9000lbs;
                        $weightbreak = $fortyfcl9000to10000lbs * (9000/100);
                     }  elseif ($volumetricweight > 9000 && $volumetricweight <= 10000) {
                        $originrate = $cwtweight * $fortyfcl9000to10000lbs;
                        $weightbreak = $fortyfcl10000to11000lbs * (10000/100);
                     }  elseif ($volumetricweight > 10000 && $volumetricweight <= 11000) {
                        $originrate = $cwtweight * $fortyfcl10000to11000lbs;
                        $weightbreak = $fortyfcl11000to12000lbs * (11000/100);
                     }  elseif ($volumetricweight > 110000 && $volumetricweight <= 12000) {
                        $originrate = $cwtweight * $fortyfcl11000to12000lbs;
                        $weightbreak = $fortyfcl12000to13000lbs * (12000/100);
                     }  elseif ($volumetricweight > 12000 && $volumetricweight <= 13000) {
                        $originrate = $cwtweight * $fortyfcl12000to13000lbs;
                        $weightbreak = $fortyfcl13000to14000lbs * (13000/100);
                     }  elseif ($volumetricweight > 13000 && $volumetricweight <= 14000) {
                        $originrate = $cwtweight * $fortyfcl13000to14000lbs;
                        $weightbreak = $fortyfcl14000to15000lbs * (14000/100);
                     }  elseif ($volumetricweight > 14000 && $volumetricweight <= 15000) {
                        $originrate = $cwtweight * $fortyfcl14000to15000lbs;
                        $weightbreak = $fortyfcl15000to16000lbs * (15000/100);
                     }  elseif ($volumetricweight > 15000 && $volumetricweight <= 16000) {
                        $originrate = $cwtweight * $fortyfcl15000to16000lbs;
                        $weightbreak = $fortyfcl16000to17000lbs * (16000/100);
                     }  elseif ($volumetricweight > 16000 && $volumetricweight <= 17000) {
                        $originrate = $cwtweight * $fortyfcl16000to17000lbs;
                        $weightbreak = $fortyfcl17000lbsup * (17000/100);
                     }  elseif ($volumetricweight > 17000) {
                        $originrate = $cwtweight * $fortyfcl17000lbsup;
                     }

                     // Final comparison for min, actual, and weightbreak rates
                     if($originrate >= $fortyfclminimum && $weightbreak >= $fortyfclminimum){
                        $finaloriginrate = min($originrate, $weightbreak);
                     } elseif( $originrate >= $fortyfclminimum && $weightbreak <= $fortyfclminimum) {
                        $finaloriginrate = $originrate;
                     } elseif( $originrate <= $fortyfclminimum && $weightbreak >= $fortyfclminimum) {
                        $finaloriginrate = $fortyfclminimum;
                     } elseif( $originrate <= $fortyfclminimum && $weightbreak <= $fortyfclminimum) {
                        $finaloriginrate = $fortyfclminimum;
                     } else {
                        $finaloriginrate = 0;
                     }

                     $finaloriginrate = ceil($finaloriginrate);

                       if($DEBUG === 1){
                         echo "40 FCL min: " . $fortyfclminimum;
                         echo "Origin rate: " . $originrate;
                         echo "Weightbreak rate: " . $weightbreak;
                         echo "Final origin rate: " . $finaloriginrate;
                       }

                       break;

                     } else {
                       $finaloriginrate = -1;
                     }
                  endwhile; ?>

             <?php endif;

            }


            // Get the freight pricing
            // Here we will get the freight rates from the ACF fields
            if( have_rows('outbound_freight_rates', $postid )): ?>

            <?php while( have_rows('outbound_freight_rates', $postid )): the_row();


                 $freightmode = get_sub_field('freight_mode');
                 $freightdestinationcity = get_sub_field('destination_city');

                 // Check the user input destination city matches the freight row destination city
                 if($destinationcity === $freightdestinationcity){

                  // Enter the row and check the user input MODE against the freight mode, then check if empty.
                  // If empty, send back -1 to let JS on front end handle and display error message to the user.
                   if($mode === 'air'){
                     if(empty(get_sub_field('air'))){
                       $finalfreightprice = -1;
                     } else {
                       $freightprice = get_sub_field('air') * $acwkgs;
                       $finalfreightprice = $freightprice;
                     }

                   } elseif ($mode === 'lcl'){
                     if( empty(get_sub_field('lcl')) ){
                       $finalfreightprice = -1;
                     } else {
                       $freightprice = get_sub_field('lcl') * $volumecbm;
                       $finalfreightprice = $freightprice;
                     }
                   } elseif ($mode === '20_fcl') {
                     if( empty(get_sub_field('20_fcl'))){
                       $finalfreightprice = -1;
                     } else {
                       $freightprice = get_sub_field('20_fcl');
                       $finalfreightprice = $freightprice;
                     }

                   } elseif($mode === '40_fcl'){
                     if(empty(get_sub_field('40_fcl'))){
                       $finalfreightprice = -1;
                     } else {
                       $freightprice = get_sub_field('40_fcl');
                       $finalfreightprice = $freightprice;
                     }

                   } elseif($mode === '40_high'){
                     if( empty(get_sub_field('40_high'))){
                       $finalfreightprice = -1;
                     } else {
                       $freightprice = get_sub_field('40_high');
                       $finalfreightprice = $freightprice;
                     }

                   } elseif($mode === 'road_20_fcl'){
                     if( empty(get_sub_field('road_20_fcl'))) {
                       $finalfreightprice = -1;
                     } else {
                       $freightprice = get_sub_field('road_20_fcl');
                       $finalfreightprice = $freightprice;
                     }

                   } elseif($mode === 'road_40_fcl'){
                     if( empty(get_sub_field('road_40_fcl'))){
                       $finalfreightprice = -1;
                     } else {
                       $freightprice = get_sub_field('road_40_fcl');
                       $finalfreightprice = $freightprice;
                     }

                   } else {
                     $finalfreightprice = -1;
                   }

                 }

                 $finalfreightprice = ceil($finalfreightprice);


             endwhile; ?>


        <?php else:
            $finalfreightprice = -1;
            $finalfreightprice = ceil($finalfreightprice);

        endif;

        // Only include ACC rates if there are packing rates for the origin in the backend.
        if($finaloriginrate > 0){
          require('accessory-charges-oa.php');
        }


      $finaloriginrate = $finaloriginrate + $cartondropprice + $picturehangingprice + $longcarryprice + $staircarryprice + $holidayprice + $grandpianohandlingprice + $pianohandlingprice;

      }
    }

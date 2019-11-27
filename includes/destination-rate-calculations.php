<?php

/*
*  Destination Rate calculations - DESTINATION LOCATION
*/

// Get the DTP charges from the destination city's CPT fields
$destinationargs = array(
    'numberposts' => 1,
    'post_type'   => 'service_cities',
    'meta_key'    => 'city',
    'meta_value'  => $destinationcity
    );

    // The Query
    $destination_query = new WP_Query( $destinationargs );

    // The Loop
    if ( $destination_query->have_posts() ) {

      while ( $destination_query->have_posts() ) {
          $destination_query->the_post();
          $postid = get_the_ID();


          // Get the destination pricing
              if($mode === 'air'){

                if( have_rows('air', $postid )): ?>

                   <?php while( have_rows('air', $postid )): the_row();

                       $airoriginordestination = get_sub_field('origin_or_destination');
                       if($airoriginordestination === 'destination') {
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
                           $destinationrate = $cwtweight * $air0to500lbs;
                           $weightbreak = $air500to1000lbs * (500/100);
                         } elseif ($volumetricweight > 500 && $volumetricweight <= 1000)  {
                           $destinationrate = $cwtweight * $air500to1000lbs;
                           $weightbreak = $air1000to1250lbs * (1000/100);
                         } elseif ($volumetricweight > 1000 && $volumetricweight <= 1250) {
                           $destinationrate = $cwtweight * $air1000to1250lbs;
                           $weightbreak = $air1250to1500lbs * (1250/100);
                        }  elseif ($volumetricweight > 1250 && $volumetricweight <= 1500) {
                           $destinationrate = $cwtweight * $air1250to1500lbs;
                           $weightbreak = $air1500to1750lbs * (1500/100);
                        }  elseif ($volumetricweight > 1500 && $volumetricweight <= 1750) {
                           $destinationrate = $cwtweight * $air1500to1750lbs;
                           $weightbreak = $air1750to2000lbs * (1750/100);
                        }  elseif ($volumetricweight > 1750 && $volumetricweight <= 2000) {
                           $destinationrate = $cwtweight * $air1750to2000lbs;
                           $weightbreak = $air2000lbsup * (2000/100);
                        }  elseif ($volumetricweight > 2000) {
                           $destinationrate = $cwtweight * $air2000lbsup;
                        }

                        // Final comparison for min, actual, and weightbreak rates
                        if($destinationrate > $airminimum && $weightbreak > $airminimum){
                           $finaldestinationrate = min($destinationrate, $weightbreak);
                        } elseif( $destinationrate > $airminimum && $weightbreak < $airminimum) {
                           $finaldestinationrate = $destinationrate;
                        } elseif( $destinationrate < $airminimum && $weightbreak > $airminimum) {
                           $finaldestinationrate = $airminimum;
                        } elseif( $destinationrate < $airminimum && $weightbreak < $airminimum) {
                           $finaldestinationrate = $airminimum;
                        } else {
                           $finaldestinationrate = 0;
                        }


                          if($DEBUG === 1){
                            echo "Air min: " . $airminimum;
                            echo "Destination rate: " . $destinationrate;
                            echo "Weightbreak rate: " . $weightbreak;
                            echo "Final destination rate: " . $finaldestinationrate;
                          }

                          break;

                       } else {

                         $finaldestinationrate = -1;
                       }

                    endwhile; ?>

               <?php endif;




              }

              if($mode === 'lcl'){
                if( have_rows('lcl', $postid )): ?>

                   <?php while( have_rows('lcl', $postid )): the_row();

                      $lcloriginordestinaton = get_sub_field('origin_or_destination');

                      if($lcloriginordestinaton === 'destination') {

                      $lclminimum = get_sub_field('lcl_minimum');
                      $lcl0to500lbs = get_sub_field('0_-_500_lbs');
                      $lcl500to1000lbs = get_sub_field('500_-_1000_lbs');
                      $lcl1000to2000lbs = get_sub_field('1000_-_2000_lbs');
                      $lcl2000to3000lbs = get_sub_field('2000_-_3000_lbs');
                      $lcl3000to4000lbs =  get_sub_field('3000_-_4000_lbs');
                      $lcl4000to5000lbs = get_sub_field('4000_-_5000_lbs');

                      // Volumetric and weightbreak calculations
                      if($volumetricweight >= 0 && $volumetricweight <= 500){
                        $destinationrate = $cwtweight * $lcl0to500lbs;
                        $weightbreak = $lcl500to1000lbs * (500/100);
                      } elseif ($volumetricweight > 500 && $volumetricweight <= 1000)  {
                        $destinationrate = $cwtweight * $lcl500to1000lbs;
                        $weightbreak = $lcl1000to2000lbs * (1000/100);
                      } elseif ($volumetricweight > 1000 && $volumetricweight <= 2000) {
                        $destinationrate = $cwtweight * $lcl1000to2000lbs;
                        $weightbreak = $lcl2000to3000lbs * (2000/100);
                     }  elseif ($volumetricweight > 2000 && $volumetricweight <= 3000) {
                        $destinationrate = $cwtweight * $lcl2000to3000lbs;
                        $weightbreak = $lcl3000to4000lbs * (3000/100);
                     }  elseif ($volumetricweight > 3000 && $volumetricweight <= 4000) {
                        $destinationrate = $cwtweight * $lcl3000to4000lbs;
                        $weightbreak = $lcl4000to5000lbs * (4000/100);
                     }  elseif ($volumetricweight > 4000 && $volumetricweight <= 5000) {
                        $destinationrate = $cwtweight * $lcl4000to5000lbs;
                        $weightbreak = $lcl4000to5000lbs * (5000/100);
                     }  elseif ($volumetricweight > 5000) {
                        $destinationrate = $cwtweight * $lcl4000to5000lbs;
                     }

                     // Final comparison for min, actual, and weightbreak rates
                     if($destinationrate > $lclminimum && $weightbreak > $lclminimum){
                        $finaldestinationrate = min($destinationrate, $weightbreak);
                     } elseif( $destinationrate > $lclminimum && $weightbreak < $lclminimum) {
                        $finaldestinationrate = $destinationrate;
                     } elseif( $destinationrate < $lclminimum && $weightbreak > $lclminimum) {
                        $finaldestinationrate = $lclminimum;
                     } elseif( $destinationrate < $lclminimum && $weightbreak < $lclminimum) {
                        $finaldestinationrate = $lclminimum;
                     } else {
                        $finaldestinationrate = 0;
                     }

                       if($DEBUG === 1){
                         echo "LCL min: " . $lclminimum;
                         echo "Destination rate: " . $destinationrate;
                         echo "Weightbreak rate: " . $weightbreak;
                         echo "Final destination rate: " . $finaldestinationrate;
                       }

                       break;

                    } else {
                      $finaldestinationrate = -1;
                    }
                    endwhile; ?>

               <?php endif;


              }

              if($mode === '20_fcl' || $mode === 'road_20_fcl'){
                  if( have_rows('20_fcl', $postid )): ?>

                  <?php while( have_rows('20_fcl', $postid )): the_row();

                       $twentyfcloriginordestination = get_sub_field('origin_or_destination');

                       if($twentyfcloriginordestination === 'destination') {

                       $twentyfclminimum = get_sub_field('20_fcl_minimum');
                       $twentyfcl1000to2000lbs = get_sub_field('1000_-_2000_lbs');
                       $twentyfcl2000to3000lbs = get_sub_field('2000_-_3000_lbs');
                       $twentyfcl3000to4000lbs = get_sub_field('3000_-_4000_lbs');
                       $twentyfcl4000to5000lbs = get_sub_field('4000_-_5000_lbs');
                       $twentyfcl5000to6000lbs = get_sub_field('5000_-_6000_lbs');
                       $twentyfcl6000to7000lbs = get_sub_field('6000_-_7000_lbs');

                       // Volumetric weight and weightbeak caluculations
                       if($volumetricweight >= 0 && $volumetricweight <= 2000){
                         $destinationrate = $cwtweight * $twentyfcl1000to2000lbs;
                         $weightbreak = $twentyfcl2000to3000lbs * (2000/100);
                       } elseif ($volumetricweight > 2000 && $volumetricweight <= 3000)  {
                         $destinationrate = $cwtweight * $twentyfcl2000to3000lbs;
                         $weightbreak = $twentyfcl3000to4000lbs * (3000/100);
                       } elseif ($volumetricweight > 3000 && $volumetricweight <= 4000) {
                         $destinationrate = $cwtweight * $twentyfcl3000to4000lbs;
                         $weightbreak = $twentyfcl4000to5000lbs * (4000/100);
                      }  elseif ($volumetricweight > 4000 && $volumetricweight <= 5000) {
                         $destinationrate = $cwtweight * $twentyfcl4000to5000lbs;
                         $weightbreak = $twentyfcl5000to6000lbs * (1500/100);
                      }  elseif ($volumetricweight > 5000 && $volumetricweight <= 6000) {
                         $destinationrate = $cwtweight * $twentyfcl5000to6000lbs;
                         $weightbreak = $twentyfcl6000to7000lbs * (1750/100);
                      }  elseif ($volumetricweight > 6000 && $volumetricweight <= 7000) {
                         $destinationrate = $cwtweight * $twentyfcl6000to7000lbs;
                      }  elseif ($volumetricweight > 7000) {
                         $destinationrate = $cwtweight * $twentyfcl6000to7000lbs;
                      }

                      // Final comparison for min, actual, and weightbreak rates
                      if($destinationrate > $twentyfclminimum && $weightbreak > $twentyfclminimum){
                         $finaldestinationrate = min($destinationrate, $weightbreak);
                      } elseif( $destinationrate > $twentyfclminimum && $weightbreak < $twentyfclminimum) {
                         $finaldestinationrate = $destinationrate;
                      } elseif( $destinationrate < $twentyfclminimum && $weightbreak > $twentyfclminimum) {
                         $finaldestinationrate = $twentyfclminimum;
                      } elseif( $destinationrate < $twentyfclminimum && $weightbreak < $twentyfclminimum) {
                         $finaldestinationrate = $twentyfclminimum;
                      } else {
                         $finaldestinationrate = 0;
                      }

                        if($DEBUG === 1){
                          echo "20 FCL min: " . $twentyfclminimum;
                          echo "Destination rate: " . $destinationrate;
                          echo "Weightbreak rate: " . $weightbreak;
                          echo "Final destination rate: " . $finaldestinationrate;
                        }

                        break;

                     } else {
                       $finaldestinationrate = -1;
                     }
                 endwhile; ?>

            <?php endif;



              }

              if($mode === '40_fcl' || $mode === '40hc_fcl' || $mode == 'road_40_fcl'){
                 if( have_rows('40_fcl', $postid )): ?>

                 <?php while( have_rows('40_fcl', $postid )): the_row();

                      $fortyfcloriginordestination = get_sub_field('origin_or_destination');

                      if($fortyfcloriginordestination === 'destination') {

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
                        $destinationrate = $cwtweight * $fortyfcl6000to7000lbs;
                        $weightbreak = $fortyfcl7000to8000lbs * (7000/100);
                      } elseif ($volumetricweight > 6000 && $volumetricweight <= 7000)  {
                        $destinationrate = $cwtweight * $fortyfcl6000to7000lbs;
                        $weightbreak = $fortyfcl7000to8000lbs * (7000/100);
                      } elseif ($volumetricweight > 7000 && $volumetricweight <= 8000) {
                        $destinationrate = $cwtweight * $fortyfcl7000to8000lbs;
                        $weightbreak = $fortyfcl8000to9000lbs * (8000/100);
                     }  elseif ($volumetricweight > 8000 && $volumetricweight <= 9000) {
                        $destinationrate = $cwtweight * $fortyfcl8000to9000lbs;
                        $weightbreak = $fortyfcl9000to10000lbs * (9000/100);
                     }  elseif ($volumetricweight > 9000 && $volumetricweight <= 10000) {
                        $destinationrate = $cwtweight * $fortyfcl9000to10000lbs;
                        $weightbreak = $fortyfcl10000to11000lbs * (10000/100);
                     }  elseif ($volumetricweight > 10000 && $volumetricweight <= 11000) {
                        $destinationrate = $cwtweight * $fortyfcl10000to11000lbs;
                        $weightbreak = $fortyfcl11000to12000lbs * (11000/100);
                     }  elseif ($volumetricweight > 110000 && $volumetricweight <= 12000) {
                        $destinationrate = $cwtweight * $fortyfcl11000to12000lbs;
                        $weightbreak = $fortyfcl12000to13000lbs * (12000/100);
                     }  elseif ($volumetricweight > 12000 && $volumetricweight <= 13000) {
                        $destinationrate = $cwtweight * $fortyfcl12000to13000lbs;
                        $weightbreak = $fortyfcl13000to14000lbs * (13000/100);
                     }  elseif ($volumetricweight > 13000 && $volumetricweight <= 14000) {
                        $destinationrate = $cwtweight * $fortyfcl13000to14000lbs;
                        $weightbreak = $fortyfcl14000to15000lbs * (14000/100);
                     }  elseif ($volumetricweight > 14000 && $volumetricweight <= 15000) {
                        $destinationrate = $cwtweight * $fortyfcl14000to15000lbs;
                        $weightbreak = $fortyfcl15000to16000lbs * (15000/100);
                     }  elseif ($volumetricweight > 15000 && $volumetricweight <= 16000) {
                        $destinationrate = $cwtweight * $fortyfcl15000to16000lbs;
                        $weightbreak = $fortyfcl16000to17000lbs * (16000/100);
                     }  elseif ($volumetricweight > 16000 && $volumetricweight <= 17000) {
                        $destinationrate = $cwtweight * $fortyfcl16000to17000lbs;
                        $weightbreak = $fortyfcl17000lbsup * (17000/100);
                     }  elseif ($volumetricweight > 17000) {
                        $destinationrate = $cwtweight * $fortyfcl17000lbsup;
                     }

                     // Final comparison for min, actual, and weightbreak rates
                     if($destinationrate > $fortyfclminimum && $weightbreak > $fortyfclminimum){
                        $finaldestinationrate = min($destinationrate, $weightbreak);
                     } elseif( $destinationrate > $fortyfclminimum && $weightbreak < $fortyfclminimum) {
                        $finaldestinationrate = $destinationrate;
                     } elseif( $destinationrate < $fortyfclminimum && $weightbreak > $fortyfclminimum) {
                        $finaldestinationrate = $fortyfclminimum;
                     } elseif( $destinationrate < $fortyfclminimum && $weightbreak < $fortyfclminimum) {
                        $finaldestinationrate = $fortyfclminimum;
                     } else {
                        $finaldestinationrate = 0;
                     }


                     $finaldestinationrate = ceil($finaldestinationrate);

                       if($DEBUG === 1){
                         echo "40 FCL min: " . $fortyfclminimum;
                         echo "Destination rate: " . $destinationrate;
                         echo "Weightbreak rate: " . $weightbreak;
                         echo "Final Destination rate: " . $finaldestinationrate;
                       }

                       break;

                     } else {

                       $finaldestinationrate = -1;
                     }
                  endwhile; ?>

             <?php endif;

            }

            // Only include the DTHC and ACC rates if the DA rate if the location has DA rates in the backend.
            if($finaldestinationrate > 0){
              require('dtch-charges.php');
              require('accessory-charges-da.php');
            }


         // Sum all of the final charges up.
         $finaldestinationrate = $finaldestinationrate + $cartondroppriceDA + $picturehangingpriceDA + $longcarrypriceDA + $staircarrypriceDA + $holidaypriceDA + $grandpianohandlingpriceDA + $pianohandlingpriceDA;


      } // End while loop
    } // End post check if statement

<?php

/*
*  Accesssory charge calculations - ORIGIN LOCATION
*/
// Alright, let's get the grab the appropriate ACC charges based on the frontend input,
// calculate the rates, then add to the final OA rate.
if( have_rows('accessory_charges', $postid )):

  while( have_rows('accessory_charges', $postid )): the_row();

   if(get_sub_field('origin_or_destination') === 'origin'){

     if($cartonDrop === 'yes'){
       if(get_sub_field('charge_name') === 'Carton Drop'){

         if(get_sub_field('per_100_lbs_or_flat') === '100lbs'){
           $cartondropprice = get_sub_field('price') * ($volumetricweight / 100);
         } else {
           $cartondropprice = get_sub_field('price');
         }
       }
     }
     if($pictureHanging === 'yes'){
       if(get_sub_field('charge_name') === 'Picture Hanging'){

         if(get_sub_field('per_100_lbs_or_flat') === '100lbs'){
           $picturehangingprice = get_sub_field('price') * ($volumetricweight / 100);
         } else {
           $picturehangingprice = get_sub_field('price');
         }
       }
     }
     if($longCarry === 'yes'){
       if(get_sub_field('charge_name') === 'Long Carry'){

         if(get_sub_field('per_100_lbs_or_flat') === '100lbs'){
           $longcarryprice = get_sub_field('price') * ($volumetricweight / 100);
         } else {
           $longcarryprice = get_sub_field('price');
         }
       }
     }
     if($stairCarry === 'yes'){
       if(get_sub_field('charge_name') === 'Stair Carry'){

         if(get_sub_field('per_100_lbs_or_flat') === '100lbs'){
           $staircarryprice = get_sub_field('price') * ($volumetricweight / 100);
         } else {
           $staircarryprice = get_sub_field('price');
         }
       }
     }
     if($overTime === 'yes'){
       if(get_sub_field('charge_name') === 'Holiday'){

         if(get_sub_field('per_100_lbs_or_flat') === '100lbs'){
           $holidayprice = get_sub_field('price') * ($volumetricweight / 100);
         } else {
           $holidayprice = get_sub_field('price');
         }
       }
     }
     if($grandPiano === 'yes'){
       if(get_sub_field('charge_name') === 'Grand Piano Handling'){

         if(get_sub_field('per_100_lbs_or_flat') === '100lbs'){
           $grandpianohandlingprice = get_sub_field('price') * ($volumetricweight / 100);
         } else {
           $grandpianohandlingprice = get_sub_field('price');
         }
       }
     }
     if($uprightPiano === 'yes'){
       if(get_sub_field('charge_name') === 'Piano Handling'){

         if(get_sub_field('per_100_lbs_or_flat') === '100lbs'){
           $pianohandlingprice = get_sub_field('price') * ($volumetricweight / 100);
         } else {
           $pianohandlingprice = get_sub_field('price');
         }
       }
     }
     if($noPacking === 'yes'){

     }
     if($noUnpacking === 'yes'){

     }

  //   if(get_sub_field('charge_name') === 'Warehouse Handling'){
  //
  //     if(get_sub_field('per_100_lbs_or_flat') === '100lbs'){
  //       $whhprice = get_sub_field('price') * ($volumetricweight / 100);
  //     } else {
  //       $whhprice = get_sub_field('price');
  //     }
  //   }
  //   if(get_sub_field('charge_name') === 'Storage Per Month'){
  //
  //     if(get_sub_field('per_100_lbs_or_flat') === '100lbs'){
  //       $storagepermonthprice = get_sub_field('price') * ($volumetricweight / 100);
  //     } else {
  //       $storagepermonthprice = get_sub_field('price');
  //     }
  //   }
  // }
}

endwhile; // End accessory while loop

endif; // End accessory IF statement

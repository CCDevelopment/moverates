<?php

/*
*  Accesssory charge calculations
*/

// Alright, let's get the grab the appropriate ACC charges based on the frontend input,
// calculate the rates, then add to the final OA rate.
if( have_rows('accessory_charges', $postid )):

  while( have_rows('accessory_charges', $postid )): the_row();

   if(get_sub_field('origin_or_destination') === 'destination'){

     if($cartonDrop === 'yes'){
       if(get_sub_field('charge_name') === 'Carton Drop'){

         if(get_sub_field('per_100_lbs_or_flat') === '100lbs'){
           $cartondroppriceDA = get_sub_field('price') * ($volumetricweight / 100);
         } else {
           $cartondroppriceDA = get_sub_field('price');
         }
       }
     }
     if($pictureHanging === 'yes'){
       if(get_sub_field('charge_name') === 'Picture Hanging'){

         if(get_sub_field('per_100_lbs_or_flat') === '100lbs'){
           $picturehangingpriceDA = get_sub_field('price') * ($volumetricweight / 100);
         } else {
           $picturehangingpriceDA = get_sub_field('price');
         }
       }
     }
     if($longCarry === 'yes'){
       if(get_sub_field('charge_name') === 'Long Carry'){

         if(get_sub_field('per_100_lbs_or_flat') === '100lbs'){
           $longcarrypriceDA = get_sub_field('price') * ($volumetricweight / 100);
         } else {
           $longcarrypriceDA = get_sub_field('price');
         }
       }
     }
     if($stairCarry === 'yes'){
       if(get_sub_field('charge_name') === 'Stair Carry'){

         if(get_sub_field('per_100_lbs_or_flat') === '100lbs'){
           $staircarrypriceDA = get_sub_field('price') * ($volumetricweight / 100);
         } else {
           $staircarrypriceDA = get_sub_field('price');
         }
       }
     }
     if($overTime === 'yes'){
       if(get_sub_field('charge_name') === 'Holiday'){

         if(get_sub_field('per_100_lbs_or_flat') === '100lbs'){
           $holidaypriceDA = get_sub_field('price') * ($volumetricweight / 100);
         } else {
           $holidaypriceDA = get_sub_field('price');
         }
       }
     }
     if($grandPiano === 'yes'){
       if(get_sub_field('charge_name') === 'Grand Piano Handling'){

         if(get_sub_field('per_100_lbs_or_flat') === '100lbs'){
           $grandpianohandlingpriceDA = get_sub_field('price') * ($volumetricweight / 100);
         } else {
           $grandpianohandlingpriceDA = get_sub_field('price');
         }
       }
     }
     if($uprightPiano === 'yes'){
       if(get_sub_field('charge_name') === 'Piano Handling'){

         if(get_sub_field('per_100_lbs_or_flat') === '100lbs'){
           $pianohandlingpriceDA = get_sub_field('price') * ($volumetricweight / 100);
         } else {
           $pianohandlingpriceDA = get_sub_field('price');
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

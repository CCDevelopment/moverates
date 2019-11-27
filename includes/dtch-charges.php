<?php

/*
*  Destination Rate calculations
*/

//Grab the DTHC rates
if( have_rows('dthc', $postid )):

    while( have_rows('dthc', $postid )): the_row();

    $airdtchrate = get_sub_field('air');
    $lcldthcrate = get_sub_field('lcl');
    $twentyfcldthcrate = get_sub_field('20_fcl_flat');
    $fortyfcldthcrate = get_sub_field('40_fcl_flat');
    $fortyhighfcldthcrate = get_sub_field('40_high_flat');

 endwhile;

endif;

// Add the DTHC to the final price
if($mode === 'air'){
 $airfinaldthc = $airdtchrate * $acwkgs;
 $finaldestinationrate = $finaldestinationrate + $airfinaldthc;
 $finaldestinationrate = ceil($finaldestinationrate);
}
if($mode === 'lcl'){
 $lclfinaldthc = $lcldtchrate * $volumecbm;
 $finaldestinationrate = $finaldestinationrate + $lclfinaldthc;
 $finaldestinationrate = ceil($finaldestinationrate);
}
if($mode === '20_fcl' || $mode === 'road_20_fcl'){
 $finaldestinationrate = $finaldestinationrate + $twentyfcldthcrate;
 $finaldestinationrate = ceil($finaldestinationrate);
}
if($mode === '40_fcl' || $mode == 'road_40_fcl'){
 $finaldestinationrate = $finaldestinationrate + $fortyfcldthcrate;
 $finaldestinationrate = ceil($finaldestinationrate);
}
if($mode === '40hc_fcl'){
 $finaldestinationrate = $finaldestinationrate + $fortyhighfcldthcrate;
 $finaldestinationrate = ceil($finaldestinationrate);
}

<?php
/*
Generates the table of contents for the sosf-navigation                                                
*/
function sosftoc($start, $end)
    {
    global $hc, $hl, $s, $l;
    $ts_ta=array();

    if (isset($start) && !isset($end))
        $end=$start;

    if (!isset($end))
        $end=3;

    if (!isset($start))
        $start=1;

    for ($ts_i=0; $ts_i < $hl; $ts_i++)
        {
        if ($l[$hc[$ts_i]] == 1)
            {
            if ($start == 1)
                $ts_ta[]=$hc[$ts_i];
            $ts_r1=$ts_r2=$ts_i;
            }

        if ($s == $hc[$ts_i])
            {
            $ts_s3=true;

            for ($ts_j=$ts_r1 + 1; $ts_j < $hl; $ts_j++)
                {
                if ($l[$hc[$ts_j]] == 1)
                    break;

                if ($l[$hc[$ts_j]] == 2)
                    {
                    if ($start < 3 && $end > 1)
                        $ts_ta[]=$hc[$ts_j];
                    $ts_r2=$ts_j;
                    $ts_s3=false;
                    }

                if ($s == $hc[$ts_j])
                    {
                    for ($k=$ts_r2 + 1; $k < $hl; $k++)
                        {
                        if ($l[$hc[$k]] == 3)
                            {
                            if ($end > 2)
                                $ts_ta[]=$hc[$k];
                            }
                        else
                            {
                            $ts_s3=false;
                            break;
                            }
                        }
                    }

                if ($l[$hc[$ts_j]] == 3 && $l[$s] == 1 && $ts_s3)
                    if ($end > 2)
                        $ts_ta[]=$hc[$ts_j];
                }
            }
        }
    return sosfli($ts_ta, $start);
    }

function aWithClass($i, $aclass) {
   global $sn, $u;
   if ($aclass == '')
     return '<a href="'.$sn.'?'.$u[$i].$x.'">';
   else
     return '<a class="' . $aclass .'" href="'.$sn.'?'.$u[$i].$x.'">';
}
     
function sosfli($ts_ta, $ts_st)
    {
    global $s, $c, $l, $h, $hc, $hl;

    if (count($ts_ta) == 0)
        return;

    $ts_t='';

    if ($ts_st == 'submenu' || $ts_st == 'search')
        $ts_t.="\n".'<ul class="'.$ts_st . '"  class="'.$ts_st . '">';
    $b=0;

    if ($ts_st == 1 || $ts_st == 2 || $ts_st == 3)
        {
        $b=$ts_st - 1;
        $ts_st='menulevel';
        }
    $ts_j=0;
    $le=0;
    $lf[0]=$lf[1]=$lf[2]=$lf[3]=false;

    for ($ts_i=0; $ts_i < $hl; $ts_i++)
        {
        if (!isset($ts_ta[$ts_j]))
            break;

        if ($hc[$ts_i] != $ts_ta[$ts_j])
            continue;
        $ts_tf=($s != $ts_ta[$ts_j]);

        if ($ts_st == 'menulevel' || $ts_st == 'sitemaplevel')
            {
            for ($k=(isset($ts_ta[$ts_j - 1]) ? $l[$ts_ta[$ts_j - 1]] : $b); $k < $l[$ts_ta[$ts_j]]; $k++)
                $ts_t.="\n".'<ul class="'.$ts_st . ($k + 1) . '">';
            }
      
        $ts_t.="\n   <li ";  
    // hier das ende des Blocks ermitteln um die li klasse zu setzen. 
	// Es ist erreicht, am Ende aller Menueinträge oder wenn der Level wieder kleiner als der aktuelle wird.
    
	   if ($ts_st == 'menulevel' || $ts_st == 'sitemaplevel') {
 	
		  $mi = $ts_j+1;
		  $thislevel = $l[$ts_ta[$ts_j]];
		  while (isset($ts_ta[$mi])) {
		     if($l[$ts_ta[$mi]] <= $thislevel) break; 
			 $mi++;  // Level change oder ende ermitteln
		  }
          if ( !isset($ts_ta[$mi] ))  $ts_t.= 'class="nave"';
		  else if  ($l[$ts_ta[$mi]] < $thislevel)  $ts_t.= 'class="nave"'; 	    
       }               
      
	 
	   $ts_t.='>';   // Ende des li tags
 
  
  //WB+ --- dem selektierten a tag eine klasse geben ------------------------------------------
        if (!$ts_tf)                                      
          $ts_t.=aWithClass($ts_ta[$ts_j], 'navactive'); 
        else
          $ts_t.=aWithClass($ts_ta[$ts_j], '');            
 //-------------------------------------------------------------       
        $ts_t.=$h[$ts_ta[$ts_j]];
        $ts_t.='</a>';

        if ($ts_st == 'menulevel' || $ts_st == 'sitemaplevel')
            {
            if ((isset($ts_ta[$ts_j + 1]) ? $l[$ts_ta[$ts_j + 1]] : $b) > $l[$ts_ta[$ts_j]])
                $lf[$l[$ts_ta[$ts_j]]]=true;
            else
                {
                $ts_t.='</li>';
                $lf[$l[$ts_ta[$ts_j]]]=false;
                }

            for ($k=$l[$ts_ta[$ts_j]]; $k > (isset($ts_ta[$ts_j + 1]) ? $l[$ts_ta[$ts_j + 1]] : $b); $k--)
                {
                $ts_t.='<li class="roundend"></li></ul>';

                if ($lf[$k - 1])
                    {
                    $ts_t.='</li>';
                    $lf[$k - 1]=false;
                    }
                }
            ;
            }
        else
            $ts_t.='</li>';
        $ts_j++;
        }

    if ($ts_st == 'submenu' || $ts_st == 'search')
        $ts_t.='</ul>';
    return $ts_t;
    }
?>
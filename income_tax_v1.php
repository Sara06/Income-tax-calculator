<?php

// Fill in the code for the following four functions


function incomeTaxSingle($taxableIncome) {
    $incTax = 0.0;

 if ($taxableIncome < 0)
    return 0;

  if($taxableIncome >= 0 && $taxableIncome <= 9700) {
      $incTax = $taxableIncome * .10;
  }
  elseif($taxableIncome <= 39475) {
      $incTax = 970 + .12 * ($taxableIncome - 9700);
  }
  elseif($taxableIncome <= 84200) {
      $incTax = 4543 + .22 * ($taxableIncome - 39475);
  }
  elseif($taxableIncome <= 160725) {
      $incTax = 14382 + .24 * ($taxableIncome - 84200);
  }
  elseif($taxableIncome <= 204100) {
      $incTax = 32748 + .32 * ($taxableIncome - 160725);
  }
  elseif($taxableIncome <= 510300) {
      $incTax = 46628 + .35 * ($taxableIncome - 204100);
  }
  else {
      $incTax = 153798 + .37 * ($taxableIncome - 510300);
  }

    
    return $incTax;

}

function incomeTaxMarriedJointly($taxableIncome) {
    $incTax = 0.0;

  if ($taxableIncome < 0)
    return 0;

  if($taxableIncome >= 0 && $taxableIncome <= 19400) {
      $incTax = $taxableIncome * .10;
  }
  elseif($taxableIncome <= 78950) {
      $incTax = 1940 + .12 * ($taxableIncome - 19400);
  }
  elseif($taxableIncome <= 168400) {
      $incTax = 9086 + .22 * ($taxableIncome - 78950);
  }
  elseif($taxableIncome <= 321450) {
      $incTax = 28765 + .24 * ($taxableIncome - 168400);
  }
  elseif($taxableIncome <= 408200) {
      $incTax = 65497 + .32 * ($taxableIncome - 321450);
  }
  elseif($taxableIncome <= 612350) {
      $incTax = 93257 + .35 * ($taxableIncome - 408200);
  }
  else {
      $incTax = 164709 + .37 * ($taxableIncome - 612350);
  }

    
    return $incTax;

}

function incomeTaxMarriedSeparately($taxableIncome) {
    $incTax = 0.0;


 if ($taxableIncome < 0)
      return 0;

    if($taxableIncome >= 0 && $taxableIncome <= 9700) {
        $incTax = $taxableIncome * .10;
    }
    elseif($taxableIncome <= 39475) {
        $incTax = 970 + .12 * ($taxableIncome - 9700);
    }
    elseif($taxableIncome <= 84200) {
        $incTax = 4543 + .22 * ($taxableIncome - 39475);
    }
    elseif($taxableIncome <= 160725) {
        $incTax = 14382.50 + .24 * ($taxableIncome - 84200);
    }
    elseif($taxableIncome <= 204100) {
        $incTax = 32748.50 + .32 * ($taxableIncome - 160725);
    }
    elseif($taxableIncome <= 306175) {
        $incTax = 46628.50 + .35 * ($taxableIncome - 204100);
    }
    else {
        $incTax = 82354.75 + .37 * ($taxableIncome - 306175);
    }
    
    return $incTax;

}

function incomeTaxHeadOfHousehold($taxableIncome) {
    $incTax = 0.0;

    if ($taxableIncome < 0)
      return 0;

    if($taxableIncome >= 0 && $taxableIncome <= 13850) {
        $incTax = $taxableIncome * .10;
    }
    elseif($taxableIncome <= 52850) {
        $incTax = 1385 + .12 * ($taxableIncome - 13850);
    }
    elseif($taxableIncome <= 84200) {
        $incTax = 6065 + .22 * ($taxableIncome - 52850);
    }
    elseif($taxableIncome <= 160700) {
        $incTax = 12962 + .24 * ($taxableIncome - 84200);
    }
    elseif($taxableIncome <= 204100) {
        $incTax = 31322 + .32 * ($taxableIncome - 160700);
    }
    elseif($taxableIncome <= 510300) {
        $incTax = 45210 + .35 * ($taxableIncome - 204100);
    }
    else {
        $incTax = 152380 + .37 * ($taxableIncome - 510300);
    }

    
    return $incTax;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HW4 Part1 - Arun</title>

  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

    <h3>Income Tax Calculator</h3>

    <form class="form-horizontal" method="post">

        
        <div class="form-group">
            <label class="control-label col-sm-2" for="netIncome">Your Net Income:</label>
            <div class="col-sm-10">
            <input type="number" step="any" name="netIncome" placeholder="Taxable  Income" required autofocus>
            </div>
        </div>
        <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>

    <?php

        // Fill in the rest of the PHP code for form submission results

        if(isset($_POST['netIncome'])) {

            $incTaxSingle       = incomeTaxSingle($_POST['netIncome']);
            $incomeTaxJointly   = incomeTaxMarriedJointly($_POST['netIncome']);
            $incomeTaxSeparately = incomeTaxMarriedSeparately($_POST['netIncome']);
            $incomeTaxHeadOfHousehold = incomeTaxHeadOfHousehold($_POST['netIncome']);
    ?>      

     <p>With a net taxable  income of $
            <?php echo number_format($_POST['netIncome'], 2) ?>

     <table class="table table-striped" >
     <thead>
        <tr><th width="20%">Status</th><th>Tax</th></tr>
     </thead>
     <tbody>
         <tr><td>Single</td><td>$<?php echo number_format($incTaxSingle, 2) ?></td></tr>
         <tr><td>Married Filing Jointly</td><td>$<?php echo number_format($incomeTaxJointly, 2) ?></td></tr>
         <tr><td>Married Filing Separately</td><td>$<?php echo number_format($incomeTaxSeparately, 2) ?></td></tr>
         <tr><td>Head of Household</td><td>$<?php echo number_format($incomeTaxHeadOfHousehold, 2) ?></td></tr>
       </tbody>  
     </table>
            

          
       <?php }  ?>

           
</div>

</body>
</html>
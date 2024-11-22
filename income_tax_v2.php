<?php

define('TAX_RATES',
  array(
    'Single' => array(
      'Rates' => array(10,12,22,24,32,35,37),
      'Ranges' => array(0,9700,39475,84200,160725,204100,510300),
      'MinTax' => array(0, 970,4543,14382,32748,46628,153798)
      ),
    'Married_Jointly' => array(
      'Rates' => array(10,12,22,24,32,35,37),
      'Ranges' => array(0,19400,78950,168400,321450,408200,612350),
      'MinTax' => array(0, 1940,9086,28765,65497,93257,164709)
      ),
    'Married_Separately' => array(
      'Rates' => array(10,12,22,24,32,35,37),
      'Ranges' => array(0,9700,39475,84200,160725,204100,306175),
      'MinTax' => array(0, 970,4543,14382.50,32748.50,46628.50,82354.75)
      ),
    'Head_Household' => array(
      'Rates' => array(10,12,22,24,32,35,37),
      'Ranges' => array(0,13850,52850,84200,160700,204100,510300),
      'MinTax' => array(0, 1385,6065,12962,31322,45210,152380)
      )
    )
);

// Fill in the code for the following function

function incomeTax($taxableIncome, $status) {

   
  if ($taxableIncome < 0)
  return 0;

$ranges = TAX_RATES[$status]['Ranges'];
$mins =   TAX_RATES[$status]['MinTax'];
$tax_brackets = TAX_RATES[$status]['Rates'];

$incTax = 0.0;

$index = count($ranges);
for ($i = count($ranges) - 1; $i >= 0; $i--) {
  if ($taxableIncome > $ranges[$i]) {
    $index = $i;
    break;
  }
}

#echo "Status " . $status . " Index = " . $index . "<br/>";

$incTax = $mins[$index] + $tax_brackets[$index] * ($taxableIncome - $ranges[$index])/100.0;

    return $incTax;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HW4 Part2 - Arun</title>

  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container">

    <h3>Income Tax Calculator</h3>

    <form class="form-horizontal" method="post">

      <div class="form-group">
        <label class="control-label col-sm-2">Enter Net Income:</label>
        <div class="col-sm-10">
          <input type="number"  step="any" name="netIncome" placeholder="Taxable  Income" required autofocus>
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

          $netIncome = $_POST['netIncome'];
           
          $incTaxSingle       = 
              incomeTax($netIncome, 'Single');

          $incomeTaxJointly   = 
              incomeTax($netIncome, 'Married_Jointly');     
          
          $incomeTaxSeparately = 
              incomeTax($netIncome, 'Married_Separately');
                 
          $incomeTaxHeadOfHousehold = 
              incomeTax($netIncome, 'Head_Household');
                     

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

<hr>

    

    <h3>2019 Tax Tables</h3>

    <?php

      // Fill in the code for Tax Tables display

      
      foreach (TAX_RATES as $status => $status_data) {
        $ranges       = $status_data['Ranges'];
        $mins         = $status_data['MinTax'];
        $tax_brackets = $status_data['Rates'];
        $len = count($ranges);
   

    ?>

<h4><?php echo $status ?></h4>
       <table class="table table-striped table-bordered table-condensed" >
         <thead>
            <tr><th width="30%">Taxable Income</th><th>Tax Rate</th></tr>
         </thead>
         <tbody>
            
              <tr><td>$<?php echo number_format($ranges[0])?> - $<?php echo number_format($ranges[1])?></td>
                  <td><?php echo $tax_brackets[0]?>%</td>
              </tr>
              <?php
                for ($i = 1; $i < ($len-1); $i++) {
              ?>
<tr><td>$<?php echo number_format($ranges[$i]+1)?> - $<?php echo number_format($ranges[$i+1])?></td>
                  <td>$<?php echo number_format($mins[$i], 2)?> plus <?php echo $tax_brackets[$i]?>% of the amount over $<?php echo number_format($ranges[$i])?></td>
              </tr>
              <?php }  ?>
<tr><td>$<?php echo number_format($ranges[$len-1]+1)?> or more</td>
                  <td>$<?php echo number_format($mins[$len-1], 2)?> plus <?php echo $tax_brackets[$i]?>% of the amount over $<?php echo number_format($ranges[$i])?></td>
              </tr>
             
          </tbody>  
        </table>


        <?php }  ?>

   
       
</div>

</body>
</html>
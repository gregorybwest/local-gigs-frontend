<?php


	/* Form variables
	========================================================================== */
	$weight = $_POST['form_bmi_weight'];
	$height = $_POST['form_bmi_height'];


	/* ==========================================================================
	Calculation
	========================================================================== */
	$result = round( $weight / ( $height / 100 * $height / 100 ), 1 );

	if ( $result < 15 ) {
		echo '<p class="success-message">Your BMI is: ' . $result . ', This means you are Very severely underweight.</p>';
	} elseif ( $result < 16 ) {
		echo '<p class="success-message">Your BMI is: ' . $result . ', This means you are severely underweight.</p>';
	} elseif ( $result < 18.5 ) {
		echo '<p class="success-message">Your BMI is: ' . $result . ', This means you are underweight.</p>';
	} elseif ( $result < 25 ) {
		echo '<p class="success-message">Your BMI is: ' . $result . ', This means you are Normal (healthy weight).</p>';
	} elseif ( $result < 30 ) {
		echo '<p class="success-message">Your BMI is: ' . $result . ', This means you are overweight.</p>';
	} elseif ( $result < 35 ) {
		echo '<p class="success-message">Your BMI is: ' . $result . ', This means you are Obese Class I (Moderately obese).</p>';
	} elseif ( $result < 40 ) {
		echo '<p class="success-message">Your BMI is: ' . $result . ', This means you are Obese Class II (Severely obese).</p>';
	} elseif ( $result >= 40 ) {
		echo '<p class="success-message">Your BMI is: ' . $result . ', This means you are Obese Class III (Very severely obese).</p>';
	}


?>
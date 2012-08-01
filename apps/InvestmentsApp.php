<?php

/**
 * Description of InvestmentsApp
 *
 * @author sanya
 */
class InvestmentsApp extends MetroApp {

    public function GetHTML() {
        $result = '<h2>Investments ^ 2.3%</h2>';
	$result .= '<p>Roth IRA (TD Ameritrade)</p>';
	$result .= '<p>401K Fund (Fidelity)</p>';
	$result .= '<p>Investment Portfolio</p>';
	$result .= '<span class="icon"></span>';
        return $result;
    }

}
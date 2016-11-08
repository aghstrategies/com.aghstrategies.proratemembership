<?php

class CRM_Proratemembership_Prorate {

  public $fraction = 1;

  public $rollOver = 0;

  public function __construct($memtype) {

    try {
      $membershipType = civicrm_api3('MembershipType', 'getsingle', array(
        'id' => $memtype,
      ));
    }
    catch (CiviCRM_API3_Exception $e) {
      $error = $e->getMessage();
      CRM_Core_Error::debug_log_message(ts('API Error %1', array(
        'domain' => 'com.aghstrategies.proratemembership',
        1 => $error,
      )));
    }
    if ($membershipType['period_type'] == 'fixed' && $membershipType['duration_unit'] == 'year' && !empty($membershipType['duration_interval'])) {
      // Date of membership signup
      $today = time();

      //roll over and start dates
      $rolloverDayString = $membershipType['fixed_period_rollover_day'];
      if (strlen($rolloverDayString) == 3) {
        $rolloverDayString = '0' . $rolloverDayString;
      }
      $startDayString = $membershipType['fixed_period_start_day'];
      if (strlen($startDayString) == 3) {
        $startDayString = '0' . $startDayString;
      }
      $rolloverDate = str_split($rolloverDayString, 2);
      $fixedStartMonthDay = str_split($startDayString, 2);
      if (strlen($rolloverDate) == 3) {
        $rolloverDate = '0' . $rolloverDate;
      }
      $startYear = date('Y', $today);
      $endYear = $startYear + $membershipType['duration_interval'];
      $rolloverDateFormatted = $startYear . "-" . $rolloverDate[0] . "-" . $rolloverDate[1];
      $rolloverDate = date_create_from_format('Y-m-d', "$rolloverDateFormatted");
      $rolloverDate = date_timestamp_get($rolloverDate);
      $fixedStartDate = $startYear . '-' . $fixedStartMonthDay[0] . '-' . $fixedStartMonthDay[1];
      $fixedStartDate = date_timestamp_get(date_create_from_format('Y-m-d', "$fixedStartDate"));
      $fixedEndDate = $endYear . '-' . $fixedStartMonthDay[0] . '-' . $fixedStartMonthDay[1];
      $fixedEndDate = date_timestamp_get(date_create_from_format('Y-m-d', "$fixedEndDate"));
      $this->fraction = ($fixedEndDate - $today) / ($fixedEndDate - $fixedStartDate);
      if ($today > $rolloverDate) {
        $this->rollOver = 1;
      }
    }
  }
  public function calcprice($stickerPrice) {
    if ($this->rollOver == 0) {
      $factor = $this->fraction;
    }
    if ($this->rollOver == 1) {
      $factor = $this->fraction + 1;
    }
    $proratedPrice = $stickerPrice * $factor;
    return number_format((float) $proratedPrice, 2, '.', '');
  }

}

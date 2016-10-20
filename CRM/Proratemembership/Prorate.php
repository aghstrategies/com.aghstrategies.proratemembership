<?php

class CRM_Proratemembership_Prorate {

  public $fraction = 1;

  public $rollOver = FALSE;

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
    if ($membershipType['period_type'] == 'fixed' && $membershipType['duration_unit'] == 'year' &&  $membershipType['duration_interval'] == 1) {
      // Date of membership signup
      $today = time();

      //roll over date
      $rolloverDate = str_split($membershipType['fixed_period_rollover_day'], 2);
      $rolloverDateFormatted = date('Y', $today) . "-" . $rolloverDate[0] . "-" . $rolloverDate[1];
      $rolloverDate = date_create_from_format('Y-m-d', "$rolloverDateFormatted");
      $rolloverDate = date_timestamp_get($rolloverDate);
      $this->fraction = ($rolloverDate - $today) / 31622399;
    }
  }
  public function calcprice($stickerPrice, $terms = 1) {
    if ($terms == 1) {
      $factor = $this->fraction;
    }
    if ($terms > 1) {
      $factor = $this->fraction + ($terms - 1);
    }
    $proratedPrice = $stickerPrice * $factor;
    return $proratedPrice;
  }

}

<?php

require_once 'proratemembership.civix.php';

/**
 *  Implements hook_civicrm_buildAmount().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_buildAmount
 */
function proratemembership_civicrm_buildAmount($pageType, &$form, &$amount) {
  if ($pageType == 'membership') {
    //TODO make setting that sets priceFields array and then do an api call to get said price fields array
    $priceFields = array(455);
    foreach ($priceFields as $priceField) {
      $prorates = array();
      foreach ($amount[$priceField]['options'] as $option => $optionValues) {
        if (empty($prorates[$optionValues['membership_type_id']])) {
          $prorates[$optionValues['membership_type_id']] = new CRM_Proratemembership_Prorate($optionValues['membership_type_id']);
        }
        //TODO set calc variables a different way.
        $amount[$priceField]['options'][$option]['amount'] = $prorates[$optionValues['membership_type_id']]->calcprice($optionValues['amount'], $optionValues['membership_num_terms']);
      }
    }
  }
}

/**
 * Implements hook_civicrm_buildform().
 * @param  string $formName  Name of form
 * @param  object $form     form object
 */
function proratemembership_civicrm_buildform($formName, &$form) {
  if ($formName == 'CRM_Price_Form_Field') {
    $form->addElement('checkbox', 'proratemembership_pricefieldstoprorate', ts('Prorate this price field?'));        
    // Assumes templates are in a templates folder relative to this file.
    // $templatePath = realpath(dirname(__FILE__) . "/templates");
    // CRM_Core_Region::instance('page-body')->add(array(
    //   'template' => "{$templatePath}/pricefieldOthersignup.tpl",
    // ));
  }
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function proratemembership_civicrm_config(&$config) {
  _proratemembership_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param array $files
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function proratemembership_civicrm_xmlMenu(&$files) {
  _proratemembership_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function proratemembership_civicrm_install() {
  _proratemembership_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function proratemembership_civicrm_uninstall() {
  _proratemembership_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function proratemembership_civicrm_enable() {
  _proratemembership_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function proratemembership_civicrm_disable() {
  _proratemembership_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function proratemembership_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _proratemembership_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function proratemembership_civicrm_managed(&$entities) {
  _proratemembership_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * @param array $caseTypes
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function proratemembership_civicrm_caseTypes(&$caseTypes) {
  _proratemembership_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function proratemembership_civicrm_angularModules(&$angularModules) {
_proratemembership_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function proratemembership_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _proratemembership_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function proratemembership_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function proratemembership_civicrm_navigationMenu(&$menu) {
  _proratemembership_civix_insert_navigation_menu($menu, NULL, array(
    'label' => ts('The Page', array('domain' => 'com.aghstrategies.proratemembership')),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _proratemembership_civix_navigationMenu($menu);
} // */

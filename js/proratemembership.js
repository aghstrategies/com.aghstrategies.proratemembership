CRM.$(function ($) {
  //Moves custom setting above buttons on "Edit Price Field" form
  $('.crm-price-field-block-isprorate').insertAfter('.crm-price-field-form-block-is_active');
  $('.deleteme').remove();
});

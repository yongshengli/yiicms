Change Log: `yii2-widget-activeform`
====================================

## Version 1.4.8

**Date:** 28-Apr-2016

- (bug #73): Correct dependency for `ActiveFormAsset`.
- (enh #74): Add branch alias for dev-master latest release.

## Version 1.4.7

**Date:** 05-Dec-2015

- (bug #67, #69): Fix typo for `HINT_DEFAULT`.
- (bug #70): Correct `staticOnly` form render.

## Version 1.4.6

**Date:** 05-Dec-2015

- (enh #61): Use model `getAttributeLabel()` as default in `initPlaceholder`.
- (enh #64): Enhancement to display and style hints via icon popups or label hover
- (bug #65): Fixes to staticOnly form rendering.
- (enh #66): Better hint data fetch and code reformatting. Refer [updated docs and demo](http://demos.krajee.com/widget-details/active-field#input-hints).

## Version 1.4.5

**Date:** 22-Oct-2015

- (enh #59): Added .gitignore for composer stuff.
- (enh #60): Enhancements to `checkboxButtonGroup` and `radioButtonGroup`.


## Version 1.4.4

**Date:** 08-Jul-2015

- (enh #56): Implement feedback icons within inputs.

## Version 1.4.3

**Date:** 17-Jun-2015

- (enh #55): Set composer ## Version dependencies.

## Version 1.4.2

**Date:** 11-May-2015

- (enh #32): Create new `checkboxButtonGroup` & `radioButtonGroup` in ActiveField.
- (bug #33): Correct autoPlaceholder based attribute label generation for tabular inputs.
- (enh #36): Prevent offset of checkbox/radio labels for horizontal forms when `enclosedByLabel` is `false`.
- (enh #37): Scale inputs to full width in horizontal forms when `showLabels` is `ActiveForm:;SCREEN_READER`.
- (enh #38): Fix `autoPlaceholder` property for INLINE forms when `showLabels` is `true`.
- (enh #39): Change ActiveField private properties to protected.
- (enh #40): Initialize ActiveField template more correctly.
- (enh #41): New properties for adding or wrapping markup before LABEL, ERROR & HINT blocks.
- (enh #42): New ActiveField property `skipFormLayout` to override and skip special form layout styling.
- (bug #46): Bootstrap input group addons for horizontal forms.
- (enh kartik-v/yii2-widgets#243): Enhance CSS style `kv-fieldset-inline`.
- (enh #48): Various enhancements to Horizontal Form Layout Styles.
- (enh #49, #50): Updates to hint rendering for latest yii ActiveField upgrade.
- (enh #54): Set default ActiveForm field template to be consistent with yii\widgets\ActiveForm.

## Version 1.4.1

**Date:** 14-Feb-2015

- (enh #30): Add `control-label` class to labels for Vertical form.
- Set copyright year to current.

## Version 1.4.0

**Date:** 28-Jan-2015

- (enh #19): Add new `showHints` property to ActiveField configuration.
- (enh #20): Ability to add markup before and after ActiveField Input.
- (enh #21): Prevent display of error and hint blocks for static input.
- (enh #22): Enhance active field template for controlling labels, hints, & errors.
- (enh #24): Allow static data forms through new `ActiveForm::staticOnly` property.
- (enh #25): Default `showHints` to `true` for all form types in ActiveForm.
- (enh #26): Enhance `ActiveField::staticInput` to include options to show error and hint.
- (enh #27): New property `staticValue` in ActiveField.
- (enh #28): Enhancements for error and hint display for horizontal forms.

## Version 1.3.0

**Date:** 04-Dec-2014

- (enh #9): Enhance support for labels and horizontal form layouts
    - Allow labels to be set to `false` to hide them completely
    - Enhance HORIZONTAL forms to style labels appropriately when they are blank/empty.
    - Enhance HORIZONTAL forms to style labels, hints, and errors appropriately when they are set to false to fill the container width
- (enh #12): Include new `disabled` and `readonly` properties in ActiveForm.
- (enh #13): Allow `showLabels` property in ActiveForm & ActiveField to be tristate:
    - `true`: show labels
    - `false`: hide labels
    - `ActiveForm::SCREEN_READER`: show in screen reader only (hide from normal display)
    
## Version 1.2.0

**Date:** 26-Nov-2014

- (bug #7): Fix custom labels rendering for checkboxes
- Set release to stable

## Version 1.1.0

**Date:** 17-Nov-2014

- (enh #1): Enhance ActiveField inputs to include bootstrap default styles.
- Clean up invalid assets, unneeded classes, and refactor code.
- (enh #5): Add special styling for bootstrap input group button addons for success and error states.
- (enh #6): Fix incorrect alignment of inputs, buttons, and error block for INLINE FORM orientation.

## Version 1.0.0

**Date:** 08-Nov-2014

- Initial release 
- Sub repo split from [yii2-widgets](https://github.com/kartik-v/yii2-widgets)
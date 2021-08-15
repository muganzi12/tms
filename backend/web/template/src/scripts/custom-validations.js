/* 
 * Custom form valdation rules
 */

/**
 * ###### ITEM REGISTRATION FORM ############
 */
(function ($)
{
    $(document).ready(function ()
    {
        //Peice Unit Price
        $("#efrisitem-havepieceunit").on('change', function () {
            if ($(this).val() === '101') { //YES
                $('.field-efrisitem-pieceunitprice').addClass('required');
                $('.field-efrisitem-piecemeasureunit').addClass('required');
                $('.field-efrisitem-pieceScaledValue').addClass('required');
                $('.field-efrisitem-packageScaleValue').addClass('required');
                $('.peice_unit_options').show();

            } else { //No Peice Unit
                //Make dependednt fields required
                $('.peice_unit_options').hide();
                $('.field-efrisitem-pieceunitprice').removeClass('required');
                $('.field-efrisitem-piecemeasureunit').removeClass('required');
                $('.field-efrisitem-pieceScaledValue').removeClass('required');
                $('.field-efrisitem-packageScaleValue').removeClass('required');
            }
        });
        

        //Excise Tax
         $("#efrisitem-haveexcisetax").on('change', function () {
            if ($(this).val() === '101') { //YES
                $('.field-efrisitem-excisedutycode').addClass('required');
                $('.excise_tax_options').show();

            } else { //No Excise Tax
                //Make dependednt fields required
                $('.excise_tax_options').hide();
                $('.field-efrisitem-excisedutycode').removeClass('required');
            }
        });
        
        //Have Other Units
        $("#efrisitem-haveotherunit").on('change', function () {
            if ($(this).val() === '101') { //YES
                $('.field-efrisitem-otherUnit').addClass('required');
                $('.field-efrisitem-otherPrice').addClass('required');
                $('.field-efrisitem-otherScaled').addClass('required');
                $('.field-efrisitem-packageScaled').addClass('required');
                $('.other_unit_options').show();

            } else { //No Other Unit
                //Make dependednt fields required
                $('.other_unit_options').hide();
                $('.field-efrisitem-otherUnit').removeClass('required');
                $('.field-efrisitem-otherPrice').removeClass('required');
                $('.field-efrisitem-otherScaled').removeClass('required');
                $('.field-efrisitem-packageScaled').removeClass('required');
            }
        });
    }
    );
})(jQuery);


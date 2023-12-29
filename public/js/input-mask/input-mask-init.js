$(document).ready(function() {
    $('#date-mask-input').mask("00/00/0000", {placeholder: "__/__/____"});
    $('#time-mask-input').mask('00:00:00', {placeholder: "__:__:__"});
    $('#date-and-time-mask-input').mask('00/00/0000 00:00:00', {placeholder: "__/__/____ __:__:__"});
    $('#money-mask-input').mask('000.000.000.000.000,00', {reverse: true});
    $('#ip-address-mask-input,#ip-address-mask-input-network').mask('099.099.099.099');
    $('#mixed-mask-input').mask('AAA 000-S0S');
    $('.base-price-vn').mask('000,000,000,000,000', {reverse: true});
    $('.view-price-vn').mask('000,000,000,000,000', {reverse: true});
});

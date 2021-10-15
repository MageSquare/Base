var config = {
    paths: {
        'magesquare/base/jquery/popup': 'MageSquare_Base/js/jquery.magnific-popup.min',
        'magesquare/base/owl.carousel': 'MageSquare_Base/js/owl.carousel.min',
        'magesquare/base/bootstrap': 'MageSquare_Base/js/bootstrap.min',
        mpIonRangeSlider: 'MageSquare_Base/js/ion.rangeSlider.min',
        touchPunch: 'MageSquare_Base/js/jquery.ui.touch-punch.min',
        msDevbridgeAutocomplete: 'MageSquare_Base/js/jquery.autocomplete.min'
    },
    shim: {
        "magesquare/base/jquery/popup": ["jquery"],
        "magesquare/base/owl.carousel": ["jquery"],
        "magesquare/base/bootstrap": ["jquery"],
        msIonRangeSlider: ["jquery"],
        msDevbridgeAutocomplete: ["jquery"],
        touchPunch: ['jquery', 'jquery/ui']
    }
};

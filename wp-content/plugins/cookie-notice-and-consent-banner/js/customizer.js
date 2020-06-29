jQuery( document ).ready(function($) {
    "use strict";

    function CssParams(params) {
        if (!params.container) {
            console.error("Container is not exist.");
            return;
        }

        var _this = this;
        _this.container = params.container;
        _this.inputValue = _this.container.querySelector(".js-value");
        _this.inputValueLeft = _this.container.querySelector(".js-left");
        _this.inputValueRight = _this.container.querySelector(".js-right");
        _this.inputValueBottom = _this.container.querySelector(".js-bottom");
        _this.inputValueTop = _this.container.querySelector(".js-top");

        if (!_this.inputValue || !_this.inputValueLeft || !_this.inputValueRight || !_this.inputValueBottom || !_this.inputValueTop) {
            console.error("All inputs needed.");
            return;
        }

        function restore() {
            var savedValue = _this.inputValue.value;

            if (!savedValue) {
                _this.inputValueTop.value = '';
                _this.inputValueRight.value = '';
                _this.inputValueBottom.value = '';
                _this.inputValueLeft.value = '';

                return;
            }

            var splitValue = savedValue.split(" ");
            _this.inputValueTop.value = parseInt(splitValue[0]);
            _this.inputValueRight.value = parseInt(splitValue[1]);
            _this.inputValueBottom.value = parseInt(splitValue[2]);
            _this.inputValueLeft.value = parseInt(splitValue[3]);
        }

        function save() {
            _this.inputValue.value = calculateValue(_this.inputValueTop.value) + " " + calculateValue(_this.inputValueRight.value) + " " + calculateValue(_this.inputValueBottom.value) + " " + calculateValue(_this.inputValueLeft.value);
            jQuery(_this.inputValue).trigger('input');
        }

        function calculateValue(value) {
            if (value === '') {
                return 'auto';
            }
            return (value || 0) + 'px';
        }

        restore();

        _this.inputValueLeft.addEventListener("input", save, false);
        _this.inputValueRight.addEventListener("input", save, false);
        _this.inputValueBottom.addEventListener("input", save, false);
        _this.inputValueTop.addEventListener("input", save, false);
    }


    var workWithMargin = new CssParams({
        container: document.querySelector(".js-margin-group")
    });
});

( function( $, api ) {
    api.bind( 'ready', function() {
        var customize = this; // WordPress customize object alias.
        var positionsLine = ['top', 'bottom'];
        var positionsBlock = ['top-left', 'top-right', 'bottom-left', 'bottom-right', 'center'];

        function handleLineCase(positionsLine, positionsBlock, isLoad) {
            $.each(positionsLine, function( index, value ) {
                api.control('cncb_position').container.find( 'input[value="' + value + '"]').prop( 'disabled', false );
            });
            $.each(positionsBlock, function( index, value ) {
                api.control('cncb_position').container.find( 'input[value="' + value + '"]').prop( 'disabled', true );
            });
            if (!isLoad) {
                var topInput = api.control('cncb_position').container.find( 'input[value="top"]');
                topInput.prop('checked', true);
                topInput.trigger('input');
            }
        }

        function handleBlockCase(positionsLine, positionsBlock, isLoad) {
            $.each(positionsLine, function( index, value ) {
                api.control('cncb_position').container.find( 'input[value="' + value + '"]').prop( 'disabled', true );
            });
            $.each(positionsBlock, function( index, value ) {
                api.control('cncb_position').container.find( 'input[value="' + value + '"]').prop( 'disabled', false );
            });
            if (!isLoad) {
                var topLeftInput = api.control('cncb_position').container.find( 'input[value="top-left"]');
                topLeftInput.prop('checked', true);
                topLeftInput.trigger('input');
            }
        }

        customize('cncb_widget_type', function (value) {
            var verticalBtnInput = customize.control( 'cncb_vertical_btn' ).container.find( 'input' );
            switch (value.get()) {

                case 'line':
                    handleLineCase(positionsLine, positionsBlock, true);
                    verticalBtnInput.prop( 'disabled', 1 );
                    break;
                case 'block':
                    handleBlockCase(positionsLine, positionsBlock, true);
                    verticalBtnInput.prop( 'disabled', 0 );
                    break;
            }
            value.bind(function (to) {
                switch (to) {
                    case 'line':
                        handleLineCase(positionsLine, positionsBlock, false);
                        verticalBtnInput.prop( 'disabled', 1 );
                        break;
                    case 'block':
                        handleBlockCase(positionsLine, positionsBlock, false);
                        verticalBtnInput.prop( 'disabled', 0 );
                        break;
                }
            });
        });
        customize('cncb_type', function (value) {
            var allowTextInput = customize.control( 'cncb_allow_text' );
            var declineTextInput = customize.control( 'cncb_decline_text' );
            var dismissTextInput = customize.control( 'cncb_dismiss_text' );

            switch (value.get()) {
                case 'confirm':
                    allowTextInput.container[0].style.display = "block";
                    declineTextInput.container[0].style.display = "block";
                    dismissTextInput.container[0].style.display = "none";
                    break;
                case 'alert':
                    allowTextInput.container[0].style.display = "none";
                    declineTextInput.container[0].style.display = "none";
                    dismissTextInput.container[0].style.display = "block";
                    break;
            }
            value.bind(function (to) {
                switch (to) {
                    case 'confirm':
                        allowTextInput.container[0].style.display = "block";
                        declineTextInput.container[0].style.display = "block";
                        dismissTextInput.container[0].style.display = "none";

                        break;
                    case 'alert':
                        allowTextInput.container[0].style.display = "none";
                        declineTextInput.container[0].style.display = "none";
                        dismissTextInput.container[0].style.display = "block";
                        break;
                }
            });
        });
        function connectShadowFields(fieldName, fieldShadowtStyle) {
            customize( fieldName, function( value ) {
                var shadowStyleInput = customize.control( fieldShadowtStyle );
                shadowStyleInput.container[0].style.marginTop = "-12px";
                /**
                 * Disable the Input element
                 */
                if (!value.get()) {
                    shadowStyleInput.container[0].style.display = "none";
                }

                // 2. Binding to value change.
                value.bind( function( to ) {
                    if (to) {
                        shadowStyleInput.container[0].style.display = "block";
                    } else {
                        shadowStyleInput.container[0].style.display = "none";
                    }
                } );
            } );
        }

        function connectGradientFields(fieldName, fieldGradientStyle, fieldBgColor) {
            customize( fieldName, function( value ) {
                var gradientStyleInput = customize.control( fieldGradientStyle ).container[0];
                var bgColorInput = customize.control( fieldBgColor ).container.find( 'button' );
                gradientStyleInput.style.marginTop = "-12px";
                /**
                 * Disable the Input element
                 */
                if (!value.get()) {
                    gradientStyleInput.style.display = "none";
                }
                bgColorInput.prop( 'disabled', value.get() );

                // 2. Binding to value change.
                value.bind( function( to ) {
                    if (to) {
                        gradientStyleInput.style.display = "block";
                    } else {
                        gradientStyleInput.style.display = "none";
                    }
                    bgColorInput.prop( 'disabled', to );
                } );
            } );
        }

        function connectLinkFields(fieldName, fieldLinkText, fieldLinkHref) {
            customize( fieldName, function( value ) {
                var linkTextInput = customize.control( fieldLinkText );
                var linkHrefInput = customize.control( fieldLinkHref );
                /**
                 * Disable the Input element
                 */
                if (!value.get()) {
                    linkTextInput.container[0].style.display = "none";
                    linkHrefInput.container[0].style.display = "none";
                }

                // 2. Binding to value change.
                value.bind( function( to ) {
                    if (to) {
                        linkTextInput.container[0].style.display = "block";
                        linkHrefInput.container[0].style.display = "block";
                    } else {
                        linkTextInput.container[0].style.display = "none";
                        linkHrefInput.container[0].style.display = "none";
                    }
                } );
            } );
        }

        connectLinkFields('cncb_widget_link_show', 'cncb_widget_link_text', 'cncb_widget_link_href');

        connectShadowFields('cncb_shadow', 'cncb_shadow_style');
        connectShadowFields('cncb_ab_shadow', 'cncb_ab_shadow_style');
        connectShadowFields('cncb_db_shadow', 'cncb_db_shadow_style');

        connectGradientFields('cncb_ab_gradient', 'cncb_ab_gradient_style', 'cncb_ab_bg_color');
        connectGradientFields('cncb_ab_hover_gradient', 'cncb_ab_hover_gradient_style', 'cncb_ab_hover_bg_color');
        connectGradientFields('cncb_db_gradient', 'cncb_db_gradient_style', 'cncb_db_bg_color');
        connectGradientFields('cncb_db_hover_gradient', 'cncb_db_hover_gradient_style', 'cncb_db_hover_bg_color');
    });
} )( jQuery, wp.customize );


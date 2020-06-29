window.cookiebanner = new window.CookieBanner({
    ignoreAllow: true,
    showPoweredBy: false,
    theme: cncb_plugin_object.theme,
    type: cncb_plugin_object.type,
    blockType: cncb_plugin_object.bannerBlockType,
    blockPosition: cncb_plugin_object.position,
    buttonType: cncb_plugin_object.buttonType,
    corner: cncb_plugin_object.corner,
    message: cncb_plugin_object.message,
    link: cncb_plugin_object.link,
    buttonAllow: cncb_plugin_object.buttonAllow,
    buttonDismiss: cncb_plugin_object.buttonDismiss,
    buttonDecline: cncb_plugin_object.buttonDecline,
    blind: cncb_plugin_object.blind,
    buttonDirection: cncb_plugin_object.buttonDirection,
    animation: {
        type: cncb_plugin_object.animationType,
        duration: cncb_plugin_object.animationDuration,
        delay: cncb_plugin_object.animationDelay
    },
    popup: {
        styles: cncb_plugin_object.popupStyles
    },
    accept: cncb_plugin_object.accept,
});

wp.customize( 'cncb_widget_link_show', function( value ) {
    value.bind( function( show ) {
        cookiebanner.update({
            link: {
                styles: {
                    'display': (show) ? 'inline' : 'none'
                }
            },
        });
    } );
});

wp.customize( 'cncb_widget_type', function( value ) {
    value.bind( function( blockType ) {
        cookiebanner.update({
            blockType: blockType,
        });
    } );
});

wp.customize( 'cncb_widget_type', function( value ) {
    value.bind( function( blockType ) {
        if (blockType !== 'line' && wp.customize( 'cncb_vertical_btn' ).get()) {
            cookiebanner.update({
                buttonDirection: 'column'
            });
        }
    } );
});

wp.customize( 'cncb_blind_screen', function( value ) {
    value.bind( function( blindScreen ) {
        cookiebanner.update({
            blind: {
                visible: blindScreen
            },
        });
    } );
});

wp.customize( 'cncb_position', function( value ) {
    value.bind( function( blockPosition ) {
        cookiebanner.update({
            blockPosition: blockPosition,
        });
    } );
});

wp.customize( 'cncb_animation', function( value ) {
    value.bind( function( animationType ) {
        cookiebanner.update({
            animation: {
                type: animationType,
            }
        });
    } );
});

wp.customize( 'cncb_type', function( value ) {
    value.bind( function( type ) {
        cookiebanner.update({
            type: type
        });
    });
});

wp.customize( 'cncb_buttons_type', function( value ) {
    value.bind( function( buttonsType ) {
        cookiebanner.update({
            buttonType: buttonsType
        });
    });
});

wp.customize( 'cncb_vertical_btn', function( value ) {
    value.bind( function( buttonDirection ) {
        buttonDirection = buttonDirection ? 'column' : 'row';
        cookiebanner.update({
            buttonDirection: buttonDirection
        });
    });
});

wp.customize( 'cncb_text', function( value ) {
    value.bind( function( message ) {
        cookiebanner.update({
            message: {
                html: message
            }
        });
    });
});
wp.customize( 'cncb_text_font_family', function( value ) {
    value.bind( function( fontFamily ) {
        cookiebanner.update({
            message: {
                styles: {
                    'font-family': fontFamily
                }
            }
        });
    });
});

wp.customize( 'cncb_text_color', function( value ) {
    value.bind( function( color ) {
        cookiebanner.update({
            message: {
                styles: {
                    "color": color
                }
            }
        });
    });
});

wp.customize( 'cncb_link_color', function( value ) {
    value.bind( function( color ) {
        cookiebanner.update({
            link: {
                styles: {
                    "color": color
                }
            }
        });
    });
});
wp.customize( 'cncb_link_hover_color', function( value ) {
    value.bind( function( color ) {
        cookiebanner.update({
            link: {
                stylesHover: {
                    "color": color
                }
            }
        });
    });
});
wp.customize( 'cncb_allow_text', function( value ) {
    value.bind( function( text ) {
        cookiebanner.update({
            buttonAllow: {
                html: text
            }
        });
    });
});
wp.customize( 'cncb_dismiss_text', function( value ) {
    value.bind( function( text ) {
        cookiebanner.update({
            buttonDismiss: {
                html: text
            }
        });

    });
});

wp.customize( 'cncb_ab_bg_color', function( value ) {
    value.bind( function( bgColor ) {
        cookiebanner.update({
            buttonAllow: {
                styles: {
                    "background-color" : bgColor
                }
            }
        });
        cookiebanner.update({
            buttonDismiss: {
                styles: {
                    "background-color" : bgColor
                }
            }
        });
    });
});

wp.customize( 'cncb_ab_gradient', function( value ) {
    value.bind( function( gradient ) {
        var gradient_value = '';
        if(gradient){
            gradient_value = wp.customize( 'cncb_ab_gradient_style' ).get();
        }
        cookiebanner.update({
            buttonAllow: {
                styles: {
                    "background" : gradient_value
                }
            }
        });
        cookiebanner.update({
            buttonDismiss: {
                styles: {
                    "background" : gradient_value
                }
            }
        });
    });
});

wp.customize( 'cncb_ab_gradient_style', function( value ) {
    value.bind( function( gradient ) {
        cookiebanner.update({
            buttonAllow: {
                styles: {
                    "background" : gradient
                }
            }
        });
        cookiebanner.update({
            buttonDismiss: {
                styles: {
                    "background" : gradient
                }
            }
        });
    });
});

wp.customize( 'cncb_ab_shadow', function( value ) {
    value.bind( function( shadow ) {
        var shadow_value = 'none';
        if(shadow){
            shadow_value = wp.customize( 'cncb_ab_shadow_style' ).get();
        }
        cookiebanner.update({
            buttonAllow: {
                styles: {
                    "box-shadow" : shadow_value
                }
            }
        });
    });
});
wp.customize( 'cncb_ab_shadow_style', function( value ) {
    value.bind( function( shadow ) {
        cookiebanner.update({
            buttonAllow: {
                styles: {
                    "box-shadow" : shadow_value
                }
            }
        });
    });
});
wp.customize( 'cncb_ab_border_color', function( value ) {
    value.bind( function( borderColor ) {
        cookiebanner.update({
            buttonAllow: {
                styles: {
                    'border-color': borderColor
                }
            }
        });
        cookiebanner.update({
            buttonDismiss: {
                styles: {
                    'border-color': borderColor
                }
            }
        });
    });
});

wp.customize( 'cncb_ab_border_width', function( value ) {
    value.bind( function( borderWidth ) {
        cookiebanner.update({
            buttonAllow: {
                styles: {
                    'border-width': borderWidth  + 'px'
                }
            }
        });
        cookiebanner.update({
            buttonDismiss: {
                styles: {
                    'border-width': borderWidth  + 'px'
                }
            }
        });
    });
});

wp.customize( 'cncb_ab_border_radius', function( value ) {
    value.bind( function( borderRadius ) {
        cookiebanner.update({
            buttonAllow: {
                styles: {
                    'border-radius': borderRadius + 'px'
                }
            }
        });
        cookiebanner.update({
            buttonDismiss: {
                styles: {
                    'border-radius': borderRadius + 'px'
                }
            }
        });
    });
});

wp.customize( 'cncb_ab_font_family', function( value ) {
    value.bind( function( fontFamily ) {
        cookiebanner.update({
            buttonAllow: {
                styles: {
                    'font-family': fontFamily
                }
            }
        });
        cookiebanner.update({
            buttonDismiss: {
                styles: {
                    'font-family': fontFamily
                }
            }
        });
    });
});

wp.customize( 'cncb_ab_text_color', function( value ) {
    value.bind( function( color ) {
        cookiebanner.update({
            buttonAllow: {
                styles: {
                    'color': color
                }
            }
        });
        cookiebanner.update({
            buttonDismiss: {
                styles: {
                    'color': color
                }
            }
        });
    });
});
wp.customize( 'cncb_ab_hover_text_color', function( value ) {
    value.bind( function( color ) {
        cookiebanner.update({
            buttonAllow: {
                stylesHover: {
                    'color': color
                }
            }
        });
        cookiebanner.update({
            buttonDismiss: {
                stylesHover: {
                    'color': color
                }
            }
        });
    });
});
wp.customize( 'cncb_ab_hover_bg_color', function( value ) {
    value.bind( function( bgColor ) {
        cookiebanner.update({
            buttonAllow: {
                stylesHover: {
                    "background" : bgColor
                }
            }
        });
        cookiebanner.update({
            buttonDismiss: {
                stylesHover: {
                    "background" : bgColor
                }
            }
        });
    });
});
wp.customize( 'cncb_ab_hover_border_color', function( value ) {
    value.bind( function( borderColor ) {
        cookiebanner.update({
            buttonAllow: {
                stylesHover: {
                    "border-color" : borderColor
                }
            }
        });
        cookiebanner.update({
            buttonDismiss: {
                stylesHover: {
                    "border-color" : borderColor
                }
            }
        });
    });
});

wp.customize( 'cncb_ab_hover_gradient', function( value ) {
    value.bind( function( gradient ) {
        var gradient_value = 'none';
        if(gradient){
            gradient_value = wp.customize( 'cncb_ab_hover_gradient_style' ).get();
        }
        cookiebanner.update({
            buttonAllow: {
                stylesHover: {
                    "background" : gradient_value
                }
            }
        });
        cookiebanner.update({
            buttonDismiss: {
                stylesHover: {
                    "background" : gradient_value
                }
            }
        });
    });
});

wp.customize( 'cncb_ab_hover_gradient_style', function( value ) {
    value.bind( function( gradient ) {
        cookiebanner.update({
            buttonAllow: {
                stylesHover: {
                    "background" : gradient
                }
            }
        });
        cookiebanner.update({
            buttonDismiss: {
                stylesHover: {
                    "background" : gradient
                }
            }
        });
    });
});

wp.customize( 'cncb_decline_text', function( value ) {
    value.bind( function( text ) {
        cookiebanner.update({
            buttonDecline: {
                html: text
            }
        });
    });
});
wp.customize( 'cncb_db_bg_color', function( value ) {
    value.bind( function( bgColor ) {
        cookiebanner.update({
            buttonDecline: {
                styles: {
                    "background-color" : bgColor
                }
            }
        });
    });
});

wp.customize( 'cncb_db_gradient', function( value ) {
    value.bind( function( shadow ) {
        var shadow_value = 'none';
        if(shadow){
            shadow_value = wp.customize( 'cncb_db_gradient_style' ).get();
        }
        cookiebanner.update({
            buttonDecline: {
                styles: {
                    "background" : shadow_value
                }
            }
        });
    });
});

wp.customize( 'cncb_db_shadow', function( value ) {
    value.bind( function( shadow ) {
        var shadow_value = 'none';
        if(shadow){
            shadow_value = wp.customize( 'cncb_db_shadow_style' ).get();
        }
        cookiebanner.update({
            buttonDecline: {
                styles: {
                    "box-shadow" : shadow_value
                }
            }
        });
    });
});
wp.customize( 'cncb_db_shadow_style', function( value ) {
    value.bind( function( shadow ) {
        cookiebanner.update({
            buttonDecline: {
                styles: {
                    "box-shadow" : shadow_value
                }
            }
        });
    });
});
wp.customize( 'cncb_db_border_color', function( value ) {
    value.bind( function( borderColor ) {
        cookiebanner.update({
            buttonDecline: {
                styles: {
                    'border-color': borderColor
                }
            }
        });
    });
});
wp.customize( 'cncb_db_border_color', function( value ) {
    value.bind( function( borderColor ) {
        cookiebanner.update({
            buttonDecline: {
                styles: {
                    'border-color': borderColor
                }
            }
        });
    });
});
wp.customize( 'cncb_db_border_width', function( value ) {
    value.bind( function( borderWidth ) {
        cookiebanner.update({
            buttonDecline: {
                styles: {
                    'border-width': borderWidth  + 'px'
                }
            }
        });
    });
});
wp.customize( 'cncb_db_border_radius', function( value ) {
    value.bind( function( borderRadius ) {
        cookiebanner.update({
            buttonDecline: {
                styles: {
                    'border-radius': borderRadius + 'px'
                }
            }
        });
    });
});

wp.customize( 'cncb_db_font_family', function( value ) {
    value.bind( function( fontFamily ) {
        cookiebanner.update({
            buttonDecline: {
                styles: {
                    'font-family': fontFamily
                }
            }
        });
    });
});

wp.customize( 'cncb_db_text_color', function( value ) {
    value.bind( function( color ) {
        cookiebanner.update({
            buttonDecline: {
                styles: {
                    'color': color
                }
            }
        });
    });
});

wp.customize( 'cncb_db_hover_text_color', function( value ) {
    value.bind( function( color ) {
        cookiebanner.update({
            buttonDecline: {
                stylesHover: {
                    'color': color
                }
            }
        });
    });
});

wp.customize( 'cncb_db_hover_bg_color', function( value ) {
    value.bind( function( bgColor ) {
        cookiebanner.update({
            buttonDecline: {
                stylesHover: {
                    "background" : bgColor
                }
            }
        });
    });
});

wp.customize( 'cncb_db_hover_border_color', function( value ) {
    value.bind( function( borderColor ) {
        cookiebanner.update({
            buttonDecline: {
                stylesHover: {
                    "border-color" : borderColor
                }
            }
        });
    });
});

wp.customize( 'cncb_db_hover_gradient', function( value ) {
    value.bind( function( gradient ) {
        var gradient_value = 'none';
        if(gradient){
            gradient_value = wp.customize( 'cncb_db_hover_gradient_style' ).get();
        }
        cookiebanner.update({
            buttonDecline: {
                stylesHover: {
                    "background" : gradient_value
                }
            }
        });
    });
});

wp.customize( 'cncb_db_hover_gradient_style', function( value ) {
    value.bind( function( gradient ) {
        cookiebanner.update({
            buttonAllow: {
                stylesHover: {
                    "background" : gradient
                }
            }
        });
    });
});

wp.customize( 'cncb_widget_link_text', function( value ) {
    value.bind( function( text ) {
        cookiebanner.update({
            link: {
                html: text
            }
        });
    });
});

wp.customize( 'cncb_widget_link_href', function( value ) {
    value.bind( function( link ) {
        cookiebanner.update({
            link: {
                href: link
            }
        });
    });
});

wp.customize( 'cncb_theme', function( value ) {
    value.bind( function( theme ) {
        cookiebanner.update({
            theme: theme
        });
    });
});

wp.customize( 'cncb_banner_width', function( value ) {
    value.bind( function( width ) {
        cookiebanner.update({
            popup: {
                styles: {
                    "width" : width + 'px',
                }
            }
        });
    });
});

wp.customize( 'cncb_banner_margin', function( value ) {
    value.bind( function( margins ) {
        var splitValue = margins.split(" ");
        cookiebanner.update({
            popup: {
                styles: {
                    "margin-top" : splitValue[0],
                    "margin-right" : splitValue[1],
                    "margin-bottom" : splitValue[2],
                    "margin-left" : splitValue[3]
                }
            }
        });
    });
});

wp.customize( 'cncb_border_width', function( value ) {
    value.bind( function( border_width ) {
        cookiebanner.update({
            popup: {
                styles: {
                    "border-width" : border_width + 'px'
                }
            }
        });
    });
});

wp.customize( 'cncb_border_radius', function( value ) {
    value.bind( function( border_radius ) {
        cookiebanner.update({
            popup: {
                styles: {
                    "border-radius" : border_radius + 'px'
                }
            }
        });
    });
});

wp.customize( 'cncb_border_color', function( value ) {
    value.bind( function( border_color ) {
        cookiebanner.update({
            popup: {
                styles: {
                    "border-color" : border_color
                }
            }
        });
    });
});
wp.customize( 'cncb_show_border', function( value ) {
    value.bind( function( shadow ) {
        var border_value = 'none';
        console.log(shadow);
        if(shadow){
            border_value = 'solid';
        }
        cookiebanner.update({
            popup: {
                styles: {
                    "border-style" : border_value
                }
            }
        });
    });
});
wp.customize( 'cncb_shadow', function( value ) {
    value.bind( function( shadow ) {
        var shadow_value = 'none';
        if(shadow){
            shadow_value = wp.customize( 'cncb_shadow_style' ).get();
        }
        cookiebanner.update({
            popup: {
                styles: {
                    "box-shadow" : shadow_value
                }
            }
        });
    });
});
wp.customize( 'cncb_shadow_style', function( value ) {
    value.bind( function( shadow ) {
        cookiebanner.update({
            popup: {
                styles: {
                    "box-shadow" : shadow
                }
            }
        });
    });
});

wp.customize( 'cncb_animation_delay', function( value ) {
    value.bind( function( delay ) {
        cookiebanner.update({
            animation: {
                delay: delay + 'ms'
            }
        });
    });
});

wp.customize( 'cncb_animation_duration', function( value ) {
    value.bind( function( duration ) {
        cookiebanner.update({
            animation: {
                duration: duration + 'ms'
            }
        });
    });
});






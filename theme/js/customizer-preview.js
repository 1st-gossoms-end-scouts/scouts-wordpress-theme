( function( $ ) {

    wp.customize(
        'color_scheme_select',
        function ( value ) {
            value.bind(
                function ( to ) {
                    //$( 'a' ).css( 'color', to );
                    let primary;
                    switch (to){
                        case 'scout-white':
                            primary = "#FFFFFF";
                            console.log(primary);
                            break;
                    }
                    $( ':root' ).css( '--primary', primary );

                }
            );
        }
    );

} )( jQuery );
"use strict"
const el = wp.element.createElement;
const withSelect = wp.data.withSelect;
const withDispatch = wp.data.withDispatch;
const SelectControl = wp.components.SelectControl;
const { Button, Spinner, BaseControl } = wp.components;
const { MediaUpload, MediaUploadCheck } = wp.blockEditor;
const { useSelect, useDispatch } = wp.data;

wp.hooks.addFilter(
    'editor.PostFeaturedImage',
    'enhance-featured-image/align-featured-image-control',
    wrapPostFeaturedImage
);

function wrapPostFeaturedImage( OriginalComponent ) {
    return function (props) {
        return (
            el(
                wp.element.Fragment,
                {},
                el(
                    OriginalComponent,
                    props
                ),
                el(
                    composedSelectControl
                ),
                el(
                    ImageControl
                )
            )
        );
    }
}

class SelectControlCustom extends React.Component {
    render() {
        const {
            meta,
            updateFeaturedImage,
        } = this.props;

        return (
            el(
                wp.components.SelectControl,
                {
                    heading: "Manage Featured Image",
                    label: "Set Position",
                    help: "Set vertical alignment for featured image",
                    value: meta.align_featured_image,
                    options: [
                        { value: 'top', label: 'Top' },
                        { value: 'center', label: 'Center' },
                        { value: 'bottom', label: 'Bottom' },
                    ],
                    onChange:
                        ( value ) => {
                            this.setState( { alignment: value } );
                            updateFeaturedImage( value, meta );
                        }
                }
            )
        )
    }
}


const composedSelectControl = wp.compose.compose( [
    withSelect( ( select ) => {
        const currentMeta = select( 'core/editor' ).getCurrentPostAttribute( 'meta' );
        const editedMeta = select( 'core/editor' ).getEditedPostAttribute( 'meta' );
        return {
            meta: { ...currentMeta, ...editedMeta },
        };
    } ),
    withDispatch( ( dispatch ) => ( {
        updateFeaturedImage( value, meta ) {
            meta = {
                ...meta,
                align_featured_image: value,
            };
            dispatch( 'core/editor' ).editPost( { meta } );
        },
    } ) ),
] )( SelectControlCustom );


const ImageControl = () => {

    const { imageId, image } = useSelect( select => {

        const id = select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ 'logo_image' ];
        return {
            imageId: id,
            image: select( 'core' ).getMedia( id ),
        }
    })

    const { editPost } = useDispatch( 'core/editor', [ imageId ] )

    return(
        <BaseControl id={ 'logo_image' } label={ "Logo" } help={'(Optional) Upload a logo in place of the title'}>
            <MediaUploadCheck>
                <MediaUpload
                    onSelect={ ( media ) => editPost( { meta: { ['logo_image']: media.id } } ) }
                    allowedTypes={ [ 'image' ] }
                    value={ imageId }
                    render={ ( { open } ) => (
                        <div>
                            { ! imageId && <Button variant="secondary" onClick={ open }>Upload image</Button> }
                            { !! imageId && ! image &&
                                <Spinner />
                            }
                            { !! image && image &&
                                <Button variant="link" onClick={ open }>
                                    <img src={ image.source_url } />
                                </Button>
                            }
                        </div>
                    ) }
                />
            </MediaUploadCheck>
            { !! imageId &&
                <Button onClick={ () => editPost( { meta: { ["logo_image"]: null } } ) } isLink isDestructive>
                    Remove image
                </Button>
            }
        </BaseControl>
    )
}
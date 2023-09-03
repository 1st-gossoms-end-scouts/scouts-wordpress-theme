/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, RichText } from '@wordpress/block-editor';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps();

	const onChangeLeftContent = ( newContent ) => {
		setAttributes( { leftContent: newContent } )
	}

	const onChangeRightContent = ( newContent ) => {
		setAttributes( { rightContent: newContent } )
	}

	return (
		<div>
				<h4>Left Content:</h4>
				<RichText
					{ ...blockProps }
					tagName="div"
					id="leftContent"
					onChange={ onChangeLeftContent }
					allowedFormats={ [ 'core/bold', 'core/italic', 'core/link' ] }
					value={ attributes.leftContent }
					placeholder={ __( 'Write your text...' ) }
				/>
				<h4>Right Content:</h4>
				<RichText
					tagName="div"
					id="rightContent"
					onChange={onChangeRightContent}
					allowedFormats={['core/bold', 'core/italic', 'core/link']}
					value={attributes.rightContent}
					placeholder={__('Write your text...')}
				/>
		</div>
	);
}
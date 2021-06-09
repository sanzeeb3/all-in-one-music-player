const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const el = wp.element.createElement;
const { ServerSideRender } = wp.components;
const { InspectorControls } = wp.blockEditor || wp.editor;
const { SelectControl, PanelBody } = wp.components;

registerBlockType( 'music-player/music-player', {
    title: __( 'Music Player', 'music-player' ),
    description: __( 'For best results, plesae view and play the music player in the frontend of your site.', 'music-player' ),
    icon: 'format-audio',
    category: 'widgets',
    keywords: [ 'player', 'music', 'mp3', 'audio' ],
    attributes: {
        theme: {
            type: 'string',
        },
    },
    example: {
        attributes: {
            preview: true,
        },
    },
    edit( props ) {
        const {
                attributes: {
                    theme = "default",
                },

            setAttributes
         } = props;

        let jsx;
        
        function selectTheme( value ) {
            setAttributes( { theme: value } );
        }

        const event = new Event('musicPlayerInitialize');
        document.dispatchEvent( event );

        jsx = [
            <InspectorControls key="music-player-theme-selector-inspector-controls">
                <PanelBody title="Music Player Settings">
                    <SelectControl
                        label= "Select Theme"
                        value= { theme }
                        options={[
                                { value: 'default', label: 'Default' },
                                { value: 'circular-pink', label: 'Circular Pink' }
                            ]}    
                        onChange={ selectTheme }
                    />
                </PanelBody>
            </InspectorControls>
        ];

        jsx.push(
                <ServerSideRender
                    key="music-player-server-side-renderer"
                    block="music-player/music-player"
                    attributes={ props.attributes }
                />
            );

        return jsx;
    },
    save( { attributes, className } ) {
        // Gutenberg will save attributes we can use in server-side callback
       return null;
    },
});
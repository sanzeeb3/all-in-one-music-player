const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const el = wp.element.createElement;
const { ServerSideRender } = wp.components;
const { InspectorControls } = wp.blockEditor || wp.editor;
const { SelectControl, PanelBody } = wp.components;

registerBlockType( 'all-in-one-music-player/music-player-selector', {
    title: __( 'All in One Music Player', 'all-in-one-music-player' ),
    description: __( 'For best results, plesae view and play the music player in the frontend of your site.', 'all-in-one-music-player' ),
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
                    theme = "aplayer",
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
            <InspectorControls key="all-in-one-music-player-theme-selector-inspector-controls">
                <PanelBody title= { __( 'All in One Music Player Settings', 'all-in-one-music-player' ) }>
                    <SelectControl
                        label= { __( 'Select Theme', 'all-in-one-music-player' ) }
                        value= { theme }
                        options={[
                                { value: 'aplayer', label: 'APlayer' },
                                { value: 'circular-spikes', label: 'Circular Spikes' },
                                { value: 'flat-black', label: 'Flat Black' }
                            ]}    
                        onChange={ selectTheme }
                    />
                </PanelBody>
            </InspectorControls>
        ];

        jsx.push(
                <ServerSideRender
                    key="all-in-onemusic-player-server-side-renderer"
                    block="all-in-one-music-player/music-player-selector"
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

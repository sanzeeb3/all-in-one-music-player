const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const el = wp.element.createElement;
const { ServerSideRender } = wp.components;

registerBlockType( 'music-player/music-player', {
    title: __( 'Music Player', 'music-player' ),
    description: __( 'The music player by default plays all the music found in your media library. Please upload media files to your media library', 'music-player' ),
    icon: 'format-audio',
    category: 'widgets',
    attributes: {
        theme: {
            type: 'string',
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

        return jsx;
    },
    save() {
        // Gutenberg will save attributes we can use in server-side callback
       return null;
    }
});